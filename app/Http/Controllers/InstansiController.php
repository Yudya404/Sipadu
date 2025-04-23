<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InstansiController extends Controller
{
    // ✅ Ambil Semua Data Instansi/Lembaga
    public function index(Request $request)
	{
		$user = Auth::user();
		if ($user) {
			Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Informasi Instansi.");
		}

		// Ambil parameter pencarian dari request
		$search = $request->input('search');

		// Ambil data Instansi dengan filter pencarian jika ada
		$instansi = Instansi::orderBy('id', 'desc')
					  ->when($search, function ($query, $search) {
						  return $query->where('nama', 'LIKE', "%{$search}%");
					  })
					  ->get();

		Log::info("Jumlah instansi ditemukan: " . $instansi->count());
		
		Log::info("Mengambil semua data instansi untuk halaman informasi.");

		// Jika request meminta data JSON (biasanya dari frontend seperti AJAX atau API)
		if ($request->wantsJson()) {
			return response()->json($instansi);
		}

		// Jika bukan JSON, tampilkan view dengan data
		return view('admin.informasiInstansi', compact('instansi'));
	}

	// ✅ Tambah Data Baru
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

		Log::info("Memulai proses penambahan instansi baru.", $metaLog);

		Log::debug("Data request instansi:", array_merge($metaLog, [
			'request' => $request->all()
		]));

		$validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
			'tipe' => 'required|string|max:255',
			'induk' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			Log::warning("Validasi gagal saat menambahkan instansi.", array_merge($metaLog, [
				'errors' => $validator->errors()->toArray()
			]));

			return response()->json([
				'success' => false,
				'errors' => $validator->errors(),
			], 422);
		}

		try {
			$instansi = Instansi::create([
				'nama' => $request->nama,
				'tipe' => $request->tipe,
				'induk' => $request->induk,
			]);

			Log::info("Instansi baru berhasil ditambahkan.", array_merge($metaLog, [
				'data' => $instansi
			]));

			return response()->json([
				'success' => true,
				'message' => 'Data berhasil ditambahkan',
				'data' => $instansi
			], 201);
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat menambahkan instansi.", array_merge($metaLog, [
				'error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menambahkan data.',
				'error' => $e->getMessage()
			], 500);
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

		Log::info("Pengguna melihat detail Instansi ID: $id", $metaLog);

		$instansi = Instansi::find($id);

		if (!$instansi) {
			Log::warning("Data instansi dengan ID $id tidak ditemukan.", $metaLog);
			return response()->json(['message' => 'Data tidak ditemukan'], 404);
		}

		Log::info("Data instansi berhasil ditemukan ID: $id", array_merge($metaLog, [
			'Data Instansi' => $instansi
		]));

		return response()->json($instansi);
	}

    // ✅ Ambil Data untuk Edit
    public function edit($id)
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

		Log::info("Permintaan untuk mengedit data instansi dengan ID: $id", $metaLog);

		$instansi = Instansi::find($id);

		if (!$instansi) {
			Log::warning("Data instansi dengan ID: $id tidak ditemukan untuk diedit.", $metaLog);

			return response()->json([
				'success' => false,
				'message' => "Data instansi dengan ID: $id tidak ditemukan."
			], 404);
		}

		Log::info("Data instansi dengan ID: $id ditemukan untuk proses edit.", array_merge($metaLog, [
			'Data Instansi' => $instansi
		]));

		return response()->json([
			'success' => true,
			'data' => $instansi
		], 200);
	}

    // ✅ Update Data
    public function update(Request $request, $id)
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
			

		Log::info("Memulai pembaruan data instansi dengan ID: $id.", $metaLog);

		Log::debug("Data request instansi dengan ID: $id untuk update:", array_merge($metaLog, [
			'Request' => $request->all()
		]));

		try {
			$validator = Validator::make($request->all(), [
				'nama' => 'required|string|max:255',
				'tipe' => 'required|string',
				'induk' => 'required|string',
			]);

			if ($validator->fails()) {
				Log::warning("Validasi gagal saat memperbarui instansi dengan ID: $id", array_merge($metaLog, [
					'Errors' => $validator->errors()->toArray()
				]));

				return response()->json([
					'success' => false,
					'errors' => $validator->errors(),
				], 422);
			}

			$instansi = Instansi::find($id);
			if (!$instansi) {
				Log::warning("Instansi dengan ID: $id tidak ditemukan saat proses update.", $metaLog);

				return response()->json([
					'success' => false,
					'message' => 'Data instansi tidak ditemukan.',
				], 404);
			}

			$instansi->update([
				'nama' => $request->nama,
				'tipe' => $request->tipe,
				'induk' => $request->induk,
			]);

			Log::info("Data instansi dengan ID: $id berhasil diperbarui.", array_merge($metaLog, [
				'Data Baru' => $instansi
			]));

			return response()->json([
				'success' => true,
				'message' => "Data instansi dengan ID: $id berhasil diperbarui.",
				'data' => $instansi
			], 200);
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat memperbarui instansi.", array_merge($metaLog, [
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat memperbarui data instansi.',
				'error' => $e->getMessage(),
			], 500);
		}
	}

    // ✅ Hapus Data Berdasarkan ID
    public function destroy($id)
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

		Log::info("Memulai proses penghapusan instansi dengan ID: $id", $metaLog);

		$instansi = Instansi::find($id);

		if (!$instansi) {
			Log::error("Instansi dengan ID: $id tidak ditemukan.", $metaLog);

			return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
		}

		$tanggal = now()->format('d-m-Y');
		$jam = now()->format('H:i:s');

		try {
			$instansi->delete();

			Log::info("Instansi dengan ID: $id berhasil dihapus.", array_merge($metaLog, [
				'Nama Instansi' => $instansi->nama,
				'Tanggal' => now()->format('d-m-Y'),
				'Jam' => now()->format('H:i:s'),
			]));

			return response()->json([
				'success' => true,
				'message' => 'Data berhasil dihapus',
				'tanggal' => $tanggal,
				'jam' => $jam
			]);
		} catch (\Exception $e) {
			Log::error("Gagal menghapus instansi dengan ID: $id", array_merge($metaLog, [
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menghapus data.',
				'error' => $e->getMessage()
			], 500);
		}
	}
}
