<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LacakPengaduanController extends Controller
{
    public function index()
	{
		return view('lacakPengaduan');
	}
	
	public function cari(Request $request)
	{
		try {
			// Validasi input
			$request->validate([
				'kode' => ['required', 'regex:/^FORM-\d{8}-\d{3}$/']
			]);

			$kode = $request->input('kode');

			// Log input pencarian
			Log::info("Mencari pengaduan dengan kode: $kode");

			// Cari pengaduan dan ambil juga tanggapannya beserta user
			$pengaduan = Pengaduan::where('kode_formulir', $kode)
								  ->with('tanggapan.user') // Ambil tanggapan dan nama pengguna
								  ->first();

			if ($pengaduan) {
				Log::info("Pengaduan ditemukan: $kode");

				return response()->json([
					'status' => true,
					'data' => [
						'kode_formulir' => $pengaduan->kode_formulir,
						'judul' => $pengaduan->judul,
						'isi' => $pengaduan->isi,
						'status' => $pengaduan->status,
						'tgl_buat' => $pengaduan->tgl_buat->format('Y-m-d H:i:s'),
						'tanggapan' => $pengaduan->tanggapan->map(function ($tanggapan) {
							return [
								'nama_pengguna' => $tanggapan->user ? $tanggapan->user->nama : 'Tidak diketahui',
								'isi_tanggapan' => $tanggapan->isi_tanggapan,
								'tgl_ditanggapi' => $tanggapan->tgl_ditanggapi->format('Y-m-d H:i:s')
							];
						})
					]
				], 200); // Status kode 200 OK
			} else {
				Log::warning("Pengaduan tidak ditemukan: $kode");

				return response()->json([
					'status' => false,
					'message' => 'Pengaduan tidak ditemukan'
				], 404); // Status kode 404 Not Found
			}
		} catch (\Exception $e) {
			// Tangani jika terjadi kesalahan
			Log::error("Terjadi kesalahan saat mencari pengaduan: " . $e->getMessage());

			return response()->json([
				'status' => false,
				'message' => 'Terjadi kesalahan. Silakan coba lagi.'
			], 500); // Status kode 500 Internal Server Error
		}
	}
}
