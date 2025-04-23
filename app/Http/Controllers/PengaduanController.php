<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengaduanController extends Controller
{
	public function __construct()
    {
        $this->middleware('throttle:5,1')->only('store');
        Carbon::setLocale('id');
    }
	
	public function pengaduanHarian()
    {
        Log::info("Mengambil jumlah pengaduan harian");

        try {
            $tanggalHariIni = date('Y-m-d');
            $jumlahPengaduan = Pengaduan::whereDate('tgl_buat', $tanggalHariIni)->count();

            return response()->json(['jumlah' => $jumlahPengaduan]);
        } catch (\Exception $e) {
            Log::error("Error saat mengambil pengaduan harian: " . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }
	
    // ✅ Ambil Semua Data 
    public function index()
	{
		$user = Auth::user();

		if ($user) {
			Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Informasi Pengaduan.");
		}

		try {
			// Query awal dengan relasi
			$query = Pengaduan::with(['tanggapan.user', 'instansi'])
				->orderBy('tgl_buat', 'desc')
				->orderBy('id', 'desc');

			// Jika bukan Super user, filter berdasarkan instansi
			if ($user->role !== 'Super user') {
				$query->where('id_instansi', $user->id_instansi);
			}

			$pengaduan = $query->get();

			return view('admin.informasiPengaduan', compact('pengaduan'));
		} catch (\Exception $e) {
			Log::error("Error saat mengambil data pengaduan: " . $e->getMessage());
			return response()->json(['message' => 'Terjadi kesalahan saat mengambil data'], 500);
		}
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

		Log::info("Pengguna melihat detail pengaduan ID: $id", $metaLog);

		try {
			$pengaduan = Pengaduan::with('tanggapan.user', 'instansi')->find($id);

			if (!$pengaduan) {
				Log::warning("Data pengaduan dengan ID $id tidak ditemukan", $metaLog);
				return response()->json(['message' => 'Data tidak ditemukan'], 404);
			}

			Log::info("Data pengaduan berhasil ditemukan ID: $id", array_merge(
				[
					'status' => 'ditemukan',
					'Data Pengaduan' => [
						'Kode' => $pengaduan->kode_formulir,
						'Judul' => $pengaduan->judul,
						'Nama' => $pengaduan->nama,
					]
				]
			));

			return response()->json($pengaduan);
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat mengambil pengaduan ID: $id - " . $e->getMessage(), $metaLog);
			return response()->json(['message' => 'Terjadi kesalahan saat mengambil data'], 500);
		}
	}
	
	// ✅ Menyimpan Data Baru
    public function store(Request $request)
    {
        Log::info("Memulai proses penyimpanan pengaduan");

        try {
            Log::debug("Data request: ", $request->all());

            // 🔹 Validasi input
            $validator = Validator::make($request->all(), [
                'nik' => 'required|digits:16',
                'nama' => 'required|regex:/^[a-zA-Z\s]+$/',
                'telp' => 'required|digits_between:10,15',
                'email' => 'required|email',
                'alamat' => 'required',
                'jenis_laporan' => 'required|in:pengaduan,aspirasi',
                'judul' => 'required',
                'isi' => 'required',
                'tgl_kejadian' => 'required|date',
                'id_instansi' => 'required',
                'bukti' => 'required|file|mimes:jpg,png,pdf,mp4,mov,avi|max:10240',
            ]);

            if ($validator->fails()) {
                Log::warning("Validasi gagal: ", $validator->errors()->toArray());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal!',
                    'error_detail' => $validator->errors()->first(),
                ], 422);
            }

            Log::info("Validasi berhasil, memeriksa NIK dan kemungkinan spam");

            $nik = $request->nik;
            $nama = $request->nama;
            $tanggalHariIni = date('Y-m-d');

            $pengaduanHariIni = Pengaduan::where('nik', $nik)
                ->whereDate('tgl_buat', $tanggalHariIni)
                ->first();

            if ($pengaduanHariIni) {
				Log::warning("Peringatan: NIK $nik dengan Nama $nama sudah mengajukan 1 laporan pada tanggal {$pengaduanHariIni->tgl_buat} dengan kode {$pengaduanHariIni->kode_formulir}");

				return response()->json([
					'status' => 'error',
					'message' => "Anda hanya bisa mengajukan 1 laporan per hari.",
					'kode_formulir' => $pengaduanHariIni->kode_formulir,
					'tgl_buat' => $pengaduanHariIni->tgl_buat,
					'status_pengaduan' => $pengaduanHariIni->status
				], 403);
			}

            $cekSpam = Pengaduan::where('nik', $nik)
                ->where('kategori', 'Spam')
                ->count();

            if ($cekSpam >= 1) {
				Log::warning("Peringatan: NIK $nik dengan Nama $nama terdeteksi melakukan pengaduan kategori Spam.");

				return response()->json([
					'status' => 'error',
					'message' => "Pengaduan Anda terdeteksi sebagai Spam.",
					'kategori' => 'Spam',
					'kode_formulir' => null
				], 403);
			}

            // 🔥 Kirim ke Flask API untuk klasifikasi AI
            Log::info("Mengirim data ke Flask API untuk klasifikasi");
            $response = Http::timeout(5)->post('http://127.0.0.1:5000/predict', [
                'judul' => $request->judul,
                'isi' => $request->isi
            ]);

            Log::debug("Response dari Flask API: ", ['status' => $response->status(), 'body' => $response->body()]);

            if (!$response->successful()) {
                Log::error("Flask API gagal merespon");
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mendapatkan respon dari AI.',
                ], 500);
            }

            $dataFlask = $response->json();
            if (!isset($dataFlask['kategori'])) {
                Log::error("Response AI tidak memiliki kategori");
                return response()->json([
                    'status' => 'error',
                    'message' => 'Response AI tidak sesuai!',
                ], 500);
            }

            $kategori = $dataFlask['kategori'];
            $status = ($kategori == 'Asli') ? 'Diajukan' : 'Tidak diproses';

            Log::info("Kategori AI: $kategori, Status: $status");
			
			// 🔹 Buat kode formulir unik
			$lastPengaduan = Pengaduan::orderBy('id', 'desc')->first();
			if ($lastPengaduan && strpos($lastPengaduan->kode_formulir, '-') !== false) {
				$parts = explode('-', $lastPengaduan->kode_formulir);
				$lastNoUrut = end($parts);
				$noUrut = is_numeric($lastNoUrut) ? (int) $lastNoUrut + 1 : 1;
			} else {
				$noUrut = 1;
			}
			// Buat kode formulir dengan format yang benar
			$kodeFormulir = 'FORM-' . date('Ymd') . '-' . str_pad($noUrut, 3, '0', STR_PAD_LEFT);

            // 🔥 Simpan ke database
            $pengaduan = new Pengaduan();
			$pengaduan->kode_formulir = $kodeFormulir;
            $pengaduan->nik = $request->nik;
            $pengaduan->nama = $request->nama;
            $pengaduan->telp = $request->telp;
            $pengaduan->email = $request->email;
            $pengaduan->alamat = $request->alamat;
            $pengaduan->jenis_laporan = $request->jenis_laporan;
            $pengaduan->judul = $request->judul;
            $pengaduan->isi = $request->isi;
            $pengaduan->tgl_kejadian = $request->tgl_kejadian;
            $pengaduan->id_instansi = $request->id_instansi;
            $pengaduan->kategori = $kategori;
            $pengaduan->status = $status;

            if ($request->hasFile('bukti')) {
				$file = $request->file('bukti'); // Ambil file yang diunggah
				$filename = $file->hashName(); // Buat nama file yang di-hash (otomatis dari Laravel)
				$file->storeAs('bukti', $filename, 'public'); // Simpan file dalam folder storage/app/public/bukti/
				$pengaduan->bukti = $filename; // Simpan hanya nama file ke database
			}

            $pengaduan->save();
            Log::info("Pengaduan berhasil disimpan dengan ID: {$pengaduan->id}");
			
			// 🔁 Jika kategori adalah Spam, buat tanggapan otomatis
			if ($kategori === 'Spam') {
				$waMessageId = null;

				// 🔔 Kirim pesan ke WhatsApp jika ada
				if ($pengaduan->via_wa && $pengaduan->wa_number) {
					$waResponse = UltraMsgHelper::sendMessage(
						$pengaduan->wa_number,
						'Pengaduan Anda terdeteksi sebagai *SPAM* oleh sistem dan tidak akan diproses.'
					);

					if ($waResponse && isset($waResponse['message_id'])) {
						$waMessageId = $waResponse['message_id'];
					}
				}

				// 💾 Simpan tanggapan otomatis
				$tanggapan = new Tanggapan();
				$tanggapan->id_pengaduan = $pengaduan->id;
				$tanggapan->kode_formulir = $pengaduan->kode_formulir;
				$tanggapan->id_users = 1; // Jika tidak ada admin yang membuatnya, biarkan null
				$tanggapan->isi_tanggapan = 'Pengaduan Anda terdeteksi sebagai *SPAM* oleh sistem dan tidak akan diproses.';
				$tanggapan->tgl_ditanggapi = now();
				$tanggapan->via_wa = $pengaduan->via_wa ?? false;
				$tanggapan->wa_message_id = $waMessageId;
				$tanggapan->is_auto_reply = true;
				$tanggapan->save();

				Log::info("Tanggapan otomatis spam berhasil disimpan untuk ID Pengaduan: {$pengaduan->id}", [
					'wa_message_id' => $waMessageId,
				]);
			}

            return response()->json([
				'status' => 'success',
				'message' => "Pengaduan berhasil diajukan.",
				'kode_formulir' => $kodeFormulir,
				'tgl_buat' => date('d F Y'),
				'kategori' => $kategori, // 'Asli' atau 'Spam'
				'status' => $status, // 'Diajukan' atau 'Tidak Diproses'
				'data' => $pengaduan
			], 201);

        } catch (\Exception $e) {
            Log::error('Error di PengaduanController:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan di server!',
                'error_detail' => $e->getMessage()
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