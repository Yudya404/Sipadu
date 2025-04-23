<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Support\Facades\File;

class BerandaController extends Controller
{
    public function index()
	{
		if (!Auth::check()) {
			Log::warning("Akses tidak sah ke beranda. Pengguna belum login.");
			return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
		}

		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Beranda.");

		// Query dasar dengan relasi
		$query = Pengaduan::with(['tanggapan.user', 'instansi'])
			->orderBy('tgl_buat', 'desc')
			->orderBy('id', 'desc');

		// Filter berdasarkan instansi, kecuali Super user
		if ($user->role !== 'Super user') {
			$query->where('id_instansi', $user->id_instansi);
		}

		$pengaduan = $query->get();
		Log::info("Total pengaduan yang diambil: " . $pengaduan->count());

		return view('admin.beranda', compact('user', 'pengaduan'));
	}

	public function getCount()
	{
		Log::info("Mengambil jumlah data untuk dashboard.");

		$user = Auth::user();
		$query = Pengaduan::query();

		// Filter jika bukan Super user
		if ($user->role !== 'Super user') {
			$query->where('id_instansi', $user->id_instansi);
		}

		// Duplikat query dasar untuk setiap status
		$countDiajukan = (clone $query)->where('status', 'Diajukan')->count();
		$countDiproses = (clone $query)->where('status', 'Diproses')->count();
		$countSelesai = (clone $query)->where('status', 'Selesai')->count();
		$countTidakDiproses = (clone $query)->where('status', 'Tidak Diproses')->count();

		// Hitung pegawai (bisa difilter juga)
		$countPegawai = ($user->role !== 'Super user')
			? User::where('id_instansi', $user->id_instansi)->count()
			: User::count();

		// Ambil label instansi (untuk tampilan)
		$instansiLabel = ($user->role === 'Super user')
			? 'Semua Instansi'
			: optional($user->instansi)->nama ?? 'Instansi Tidak Diketahui';

		// === Tambahan: Ambil jumlah pengaduan per status untuk Pie Chart ===
		$statusCounts = (clone $query)
			->selectRaw("status, COUNT(*) as jumlah")
			->groupBy('status')
			->pluck('jumlah', 'status'); // hasil: ['Diajukan' => 10, 'Selesai' => 4, ...]

		// === Tambahan: Hanya untuk Super user, ambil total pengaduan per instansi ===
		$pengaduanPerInstansi = [];
		if ($user->role === 'Super user') {
			$pengaduanPerInstansi = Pengaduan::with('instansi')
				->selectRaw("id_instansi, COUNT(*) as jumlah")
				->groupBy('id_instansi')
				->get()
				->map(function ($item) {
					return [
						'instansi' => optional($item->instansi)->nama ?? 'Tidak Diketahui',
						'jumlah' => $item->jumlah
					];
				});
		}

		// Log semua
		Log::info("Jumlah data: Diajukan ($countDiajukan), Diproses ($countDiproses), Selesai ($countSelesai), Tidak Diproses ($countTidakDiproses), Pegawai ($countPegawai)");
		Log::info("Data per status: " . json_encode($statusCounts));
		Log::info("Data per instansi: " . json_encode($pengaduanPerInstansi));

		return response()->json([
			'countDiajukan' => $countDiajukan,
			'countDiproses' => $countDiproses,
			'countSelesai' => $countSelesai,
			'countTidakDiproses' => $countTidakDiproses,
			'countPegawai' => $countPegawai,
			'instansiLabel' => $instansiLabel,
			'statusCounts' => $statusCounts,
			'pengaduanPerInstansi' => $pengaduanPerInstansi,
		]);
	}
}
