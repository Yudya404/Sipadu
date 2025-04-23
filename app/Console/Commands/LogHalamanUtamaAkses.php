<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LogHalamanUtamaAkses extends Command
{
    protected $signature = 'log:akses-halaman-utama';
    protected $description = 'Log jumlah akses Halaman Utama setiap hari';

    public function handle()
    {
        $tanggal = Carbon::yesterday()->format('Y-m-d');
        $key = "akses_halaman_utama_{$tanggal}";

        $jumlah = Cache::get($key, 0);

        Log::info("Jumlah akses halaman utama pada {$tanggal}: {$jumlah}");

        // Optionally hapus cache setelah dicatat
        Cache::forget($key);

        $this->info('Log akses halaman utama berhasil dicatat.');
    }
}
