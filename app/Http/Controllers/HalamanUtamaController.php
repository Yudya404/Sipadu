<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class HalamanUtamaController extends Controller
{
    public function index()
	{
		$tanggalHariIni = Carbon::now()->format('Y-m-d');
		$key = "akses_halaman_utama_{$tanggalHariIni}";

		// Tambahkan 1 ke counter
		$jumlahAkses = Cache::increment($key, 1);

		// Set expired harian jika belum ada
		if (!Cache::has($key)) {
			Cache::put($key, 1, now()->endOfDay());
		}

		return view('halamanUtama');
	}
	
	// ✅ Ambil Semua Data Instansi/Lembaga
    public function getInstansi(Request $request)
	{
		Log::info("Mengambil semua data instansi.");

		// Ambil semua data Instansi tanpa filter pencarian
		$instansi = Instansi::orderBy('id', 'desc')->get();

		Log::info("Jumlah instansi ditemukan: " . $instansi->count());

		return response()->json($instansi);
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
	
	public function cariInstansi(Request $request)
	{
		Log::info("Mengambil semua data instansi.");

		// Ambil parameter pencarian dari request
		$search = $request->input('search');

		// Ambil data Instansi dengan filter pencarian jika ada
		$instansi = Instansi::orderBy('id', 'desc')
					  ->when($search, function ($query, $search) {
						  return $query->where('nama', 'LIKE', "%{$search}%");
					  })
					  ->get();

		Log::info("Jumlah instansi ditemukan: " . $instansi->count());

		return response()->json($instansi);
	}
}

