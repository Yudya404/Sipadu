<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instansi;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Exports\PengaduanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
	public function __construct()
	{
		Carbon::setLocale('id');
	}
	
	// ✅ Ambil Semua Data 
	public function index()
	{
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Laporan Pengaduan.");
		
		Log::info("Mengambil data laporan pengaduan.");

		$report = Pengaduan::with(['tanggapan.user', 'instansi'])
			->whereIn('status', ['Selesai', 'Tidak Diproses']) // Hanya ambil status tertentu
			->get();

		Log::info("Berhasil mengambil data laporan. Total: " . $report->count());

		return view('admin.laporan', compact('report'));
	}
	
	public function exportPDF()
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

		Log::info("Mengakses halaman laporan pengaduan (PDF).", $metaLog);

		try {
			// Ambil data pengaduan
			$report = Pengaduan::whereIn('status', ['Selesai', 'Tidak Diproses'])->get();

			Log::info("Data pengaduan berhasil diambil untuk PDF.", array_merge($metaLog, [
				'Jumlah Data' => $report->count(),
				'View Digunakan' => 'admin.exports.pengaduan_pdf',
			]));

			// Generate PDF
			$pdf = Pdf::loadView('admin.exports.pengaduan_pdf', compact('report'));

			Log::info("PDF laporan pengaduan berhasil dibuat.", array_merge($metaLog, [
				'File Name' => 'laporan_pengaduan.pdf',
				'Estimasi Ukuran (KB)' => round(strlen($pdf->output()) / 1024, 2),
			]));

			return $pdf->download('laporan_pengaduan.pdf');
		} catch (\Exception $e) {
			Log::error("Gagal mengekspor PDF laporan pengaduan.", array_merge($metaLog, [
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat mengekspor laporan.',
				'error' => $e->getMessage()
			], 500);
		}
	}

	public function exportExcel()
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

		Log::info("Mengakses halaman ekspor Excel laporan pengaduan.", $metaLog);

		try {
			$export = new PengaduanExport();

			Log::info("Instansiasi PengaduanExport berhasil.", array_merge($metaLog, [
				'Export Class' => get_class($export)
			]));

			$filename = 'laporan_pengaduan.xlsx';

			Log::info("Proses ekspor ke Excel dimulai.", array_merge($metaLog, [
				'File Name' => $filename
			]));

			return Excel::download($export, $filename);
		} catch (\Exception $e) {
			Log::error("Gagal mengekspor laporan pengaduan ke Excel.", array_merge($metaLog, [
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat mengekspor laporan ke Excel.',
				'error' => $e->getMessage()
			], 500);
		}
	}
}