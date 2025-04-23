<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class InstansiTerhubungController extends Controller
{
    public function index()
	{
		return view('instansiTerhubung');
	}
	
	public function getInstansi(Request $request)
	{
		Log::info("Mengambil semua data instansi.");

		// Ambil semua data dinas tanpa filter pencarian
		$instansi = Instansi::orderBy('id', 'desc')->get();

		Log::info("Jumlah instansi ditemukan: " . $instansi->count());

		return response()->json($instansi);
	}
}
