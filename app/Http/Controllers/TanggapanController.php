<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TanggapanController extends Controller
{
	public function __construct()
    {
        Carbon::setLocale('id');
    }
	
    // ✅ Ambil Semua Data
    public function index()
    {
        Log::info('Memuat daftar tanggapan.');
		
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Tanggapan.");
	
        $tanggapan = Tanggapan::with(['pengaduan', 'user'])->get();
        Log::info('Daftar tanggapan berhasil dimuat.', ['jumlah' => $tanggapan->count()]);
        return view('admin.tanggapan', compact('tanggapan'));
    }

    // ✅ Ambil Data Berdasarkan ID
    public function show($id)
	{
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		Log::info("Mencari pengaduan dengan ID: $id", $metaLog);

		$pengaduan = Pengaduan::with('tanggapan.user', 'instansi')->find($id);

		if (!$pengaduan) {
			Log::warning("Pengaduan dengan ID: $id tidak ditemukan", $metaLog);
			return abort(404, 'Data tidak ditemukan');
		}

		Log::info("Pengaduan ditemukan", array_merge([
			'Data ID' => $pengaduan->id,
			'Kode' => $pengaduan->kode_formulir,
			'Judul' => $pengaduan->judul,
			'Nama' => $pengaduan->nama,
		]));

		if ($pengaduan->bukti) {
			$pengaduan->bukti = explode(',', $pengaduan->bukti);
		} else {
			$pengaduan->bukti = [];
		}

		return view('admin.tanggapan', compact('pengaduan'));
	}

    // ✅ Menyimpan Tanggapan Baru
    public function store(Request $request)
	{
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		$request->validate([
			'id_pengaduan' => 'required|exists:pengaduan,id',
			'kode_formulir' => 'required|exists:pengaduan,kode_formulir',
			'id_users' => 'required|exists:users,id',
			'isi_tanggapan' => 'required|string',
		]);

		try {
			
			// Ambil data pengaduan untuk cek apakah berasal dari WA
			$pengaduan = Pengaduan::with('tanggapan.user', 'instansi')->findOrFail($request->id_pengaduan);

			// Default: bukan auto reply & bukan via_wa
			$isAutoReply = false;
			$viaWA = $pengaduan->via_wa;
			$waMessageId = null;

			// Kirim ke WhatsApp jika pengaduan berasal dari WA
			if ($viaWA && $pengaduan->wa_number) {
				// Ambil data admin penanggap
				$petugas = $user->nama ?? 'Petugas';
				$instansi = optional($pengaduan->instansi)->nama ?? '-';
				$tglDibuat = \Carbon\Carbon::parse($pengaduan->tgl_buat)->translatedFormat('d F Y');
				$tglTanggapan = now()->translatedFormat('d F Y H:i');
				$status = 'Diproses';

				$templateWa = 
					"📄 *Status Pengaduan Anda:*\n\n" .
					"📌 *Kode Formulir:* {$pengaduan->kode_formulir}\n" .
					"🗓️ *Tanggal Dibuat:* {$tglDibuat}\n" .
					"📈 *Status:* {$status}\n" .
					"📬 *Ditanggapi Pada:* {$tglTanggapan}\n" .
					"👨‍💼 *Petugas:* {$petugas}\n" .
					"🏢 *Instansi:* {$instansi}\n\n" .
					"💬 *Isi Tanggapan:*\n{$request->isi_tanggapan}\n\n" .
					"🙏 Terima kasih telah menggunakan layanan *Pengaduan Online*. Kami akan terus menindaklanjuti setiap laporan Anda.";

				$waResponse = $this->sendWaMessage($pengaduan->wa_number, $templateWa);

				if (isset($waResponse['id'])) {
					$waMessageId = $waResponse['id']; // Ini adalah ID pesan WA dari UltraMsg
				}
			}
			
			// Simpan tanggapan baru
			$tanggapan = Tanggapan::create([
				'id_pengaduan' => $request->id_pengaduan,
				'kode_formulir' => $request->kode_formulir,
				'id_users' => $request->id_users,
				'isi_tanggapan' => $request->isi_tanggapan,
				'tgl_ditanggapi' => now(),
				'via_wa' => $viaWA,
				'wa_message_id' => $waMessageId,
				'is_auto_reply' => $isAutoReply,
			]);

			Log::info('Tanggapan berhasil disimpan.', array_merge($metaLog, [
				'ID Tanggapan' => $tanggapan->id,
				'ID Pengaduan' => $request->id_pengaduan,
				'Kode' => $request->kode_formulir
			]));

			// Update status pengaduan
			Pengaduan::where('id', $request->id_pengaduan)->update([
				'status' => 'Diproses'
			]);

			Log::info('Status pengaduan diperbarui menjadi "Diproses".', array_merge($metaLog, [
				'ID Pengaduan' => $request->id_pengaduan,
				'Kode' => $request->kode_formulir
			]));

			$tanggalJam = $tanggapan->tgl_ditanggapi->format('d-m-Y H:i:s');

			if ($request->ajax()) {
				return response()->json([
					'success' => true,
					'message' => "Pengaduan dengan kode {$request->kode_formulir} berhasil ditanggapi pada {$tanggalJam}.",
					'data' => $tanggapan
				]);
			}

			return redirect()->route('pengaduan.index')->with(
				'success',
				"Pengaduan dengan kode {$request->kode_formulir} berhasil ditanggapi pada tanggal {$tanggalJam} & status diubah menjadi Diproses."
			);
		} catch (\Exception $e) {
			Log::error('Gagal menyimpan tanggapan.', array_merge($metaLog, [
				'error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menyimpan tanggapan.',
				'error' => $e->getMessage()
			], 500);
		}
	}
	
	 private function sendWaMessage($to, $message)
	{
		$instanceId = env('ULTRAMSG_INSTANCE_ID');
		$token = env('ULTRAMSG_TOKEN');

		$response = Http::asForm()->post("https://api.ultramsg.com/$instanceId/messages/chat", [
			'token' => $token,
			'to' => $to,
			'body' => $message
		]);

		if ($response->successful()) {
			return $response->json(); // Kembalikan message_id jika butuh disimpan
		}

		Log::error('Gagal kirim WA', ['to' => $to, 'error' => $response->body()]);
		return null;
	}
}