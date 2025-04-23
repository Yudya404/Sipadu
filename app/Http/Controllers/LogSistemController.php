<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log

class LogSistemController extends Controller
{
    public function index()
	{
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Log Sistem.");
		
		return view('admin.logSistem');
	}
	
	public function getLog()
	{
		$logPath = storage_path('logs/laravel.log');

		if (!File::exists($logPath)) {
			return response()->json(['log' => 'Log file not found.']);
		}

		// Ambil hanya 50 baris terakhir
		$lines = array_slice(file($logPath), -50);

		return response()->json(['log' => implode("", $lines)]);
	}

}
