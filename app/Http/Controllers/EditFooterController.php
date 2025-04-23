<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log

class EditFooterController extends Controller
{
    // ✅ Ambil Semua Data
    public function index()
    {
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Edit Footer.");
		
        $footer = Footer::first(); // Ambil data pertama (karena biasanya hanya satu footer)
		
		return view('admin.editFooter');
    }

    // ✅ Menyimpan Data Baru
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

		Log::info("Mengakses fungsi simpan data Footer.", $metaLog);

		$request->validate([
			'maps' => 'required|string|max:16777215',
			'telp' => 'required|string|max:20',
			'alamat' => 'required|string|max:255',
			'gambar1' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
			'gambar2' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
			'gambar3' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
		]);

		try {
			$footer = Footer::firstOrNew(); // Ambil atau buat baru

			$footer->maps = $request->maps;
			$footer->telp = $request->telp;
			$footer->alamat = $request->alamat;

			// Upload gambar jika ada
			if ($request->hasFile('gambar1')) {
				$footer->gambar1 = $request->file('gambar1')->store('uploads/footer', 'public');
				Log::info('Gambar 1 berhasil diupload.', array_merge($metaLog, [
					'Path Gambar 1' => $footer->gambar1
				]));
			}

			if ($request->hasFile('gambar2')) {
				$footer->gambar2 = $request->file('gambar2')->store('uploads/footer', 'public');
				Log::info('Gambar 2 berhasil diupload.', array_merge($metaLog, [
					'Path Gambar 2' => $footer->gambar2
				]));
			}

			if ($request->hasFile('gambar3')) {
				$footer->gambar3 = $request->file('gambar3')->store('uploads/footer', 'public');
				Log::info('Gambar 3 berhasil diupload.', array_merge($metaLog, [
					'Path Gambar 3' => $footer->gambar3
				]));
			}

			$footer->save();

			Log::info("Footer berhasil disimpan.", array_merge($metaLog, [
				'Isi Data' => [
					'maps' => $footer->maps,
					'telp' => $footer->telp,
					'alamat' => $footer->alamat,
				]
			]));

			return response()->json(['message' => 'Footer berhasil disimpan!']);
		} catch (\Exception $e) {
			Log::error("Gagal menyimpan data Footer.", array_merge($metaLog, [
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menyimpan data footer.',
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

		try {
			$footer = Footer::findOrFail($id);

			Log::info("Berhasil menampilkan detail Footer.", array_merge($metaLog, [
				'footer_id' => $id
			]));

			return response()->json($footer);
		} catch (\Exception $e) {
			Log::error("Gagal menampilkan detail Footer.", array_merge($metaLog, [
				'footer_id' => $id,
				'error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Data Footer tidak ditemukan.',
				'error' => $e->getMessage()
			], 404);
		}
	}
	
	public function edit($id)
	{
		$footer = Footer::findOrFail($id);

		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) membuka halaman edit Footer (ID: {$id}).", $metaLog);

		return view('admin.editFooter', compact('footer'));
	}


    // ✅ Update Data Berdasarkan ID
    public function update(Request $request, $id)
	{
		$request->validate([
			'maps' => 'required|string|max:255',
			'telp' => 'required|string|max:20',
			'alamat' => 'required|string|max:255',
			'gambar1' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
			'gambar2' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
			'gambar3' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
		]);

		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		try {
			$footer = Footer::findOrFail($id);

			$footer->maps = $request->maps;
			$footer->telp = $request->telp;
			$footer->alamat = $request->alamat;

			// Upload gambar jika ada
			if ($request->hasFile('gambar1')) {
				$footer->gambar1 = $request->file('gambar1')->store('uploads/footer', 'public');
				Log::info('Gambar 1 berhasil diupload saat update.', array_merge($metaLog, [
					'path' => $footer->gambar1
				]));
			}
			if ($request->hasFile('gambar2')) {
				$footer->gambar2 = $request->file('gambar2')->store('uploads/footer', 'public');
				Log::info('Gambar 2 berhasil diupload saat update.', array_merge($metaLog, [
					'path' => $footer->gambar2
				]));
			}
			if ($request->hasFile('gambar3')) {
				$footer->gambar3 = $request->file('gambar3')->store('uploads/footer', 'public');
				Log::info('Gambar 3 berhasil diupload saat update.', array_merge($metaLog, [
					'path' => $footer->gambar3
				]));
			}

			$footer->save();

			Log::info("Footer berhasil diperbarui.", array_merge($metaLog, [
				'footer_id' => $id,
				'maps' => $footer->maps,
				'telp' => $footer->telp,
				'alamat' => $footer->alamat,
			]));

			return response()->json(['message' => 'Footer berhasil diperbarui!']);

		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat memperbarui Footer.", array_merge($metaLog, [
				'footer_id' => $id,
				'error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat memperbarui data Footer.',
				'error' => $e->getMessage(),
			], 500);
		}
	}

    // ✅ Menghapus Data Berdasarkan ID
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

		try {
			$footer = Footer::findOrFail($id);
			$footer->delete();

			Log::warning("Footer berhasil dihapus oleh {$user->nama} (ID: {$user->id}).", array_merge($metaLog, [
				'footer_id' => $id,
				'maps' => $footer->maps,
				'telp' => $footer->telp,
				'alamat' => $footer->alamat,
			]));

			return response()->json(['message' => 'Footer berhasil dihapus!']);
		} catch (\Exception $e) {
			Log::error("Gagal menghapus Footer.", array_merge($metaLog, [
				'footer_id' => $id,
				'error' => $e->getMessage(),
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menghapus data Footer.',
				'error' => $e->getMessage()
			], 500);
		}
	}
}
