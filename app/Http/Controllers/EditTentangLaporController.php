<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Support\Facades\Storage;

class EditTentangLaporController extends Controller
{
	// ✅ Tampilkan semua data
    public function index()
    {
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Edit Tentang Lapor!.");
		
        $data = TentangKami::latest()->first(); // Ambil data terbaru
		return view('admin.editTentangLapor');
        return response()->json($data);
    }
	
	// ✅ Tampilkan data berdasarkan ID
    public function show()
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

		$tentangKami = TentangKami::first();

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses data Tentang Lapor!.", $metaLog);

		// Jika tidak ada data, kembalikan JSON kosong
		if (!$tentangKami) {
			Log::info("Data Footer tidak ditemukan.", $metaLog);
			return response()->json([], 200);
		}

		return response()->json($mediaSosial);
	}
	
	// ✅ Menyimpan data baru
    public function store(Request $request)
	{
		$request->validate([
			'video' => 'required|string',
			'deskripsi' => 'required|string',
			'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
			'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
			'ket_gambar1' => 'nullable|string|max:255',
			'ket_gambar2' => 'nullable|string|max:255',
		]);

		$data = $request->all();

		// Upload gambar jika ada
		if ($request->hasFile('gambar1')) {
			$data['gambar1'] = $request->file('gambar1')->store('tentang_kami', 'public');
		}
		if ($request->hasFile('gambar2')) {
			$data['gambar2'] = $request->file('gambar2')->store('tentang_kami', 'public');
		}

		$tentangKami = TentangKami::create($data);

		// Logging aktivitas penyimpanan
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Disimpan' => $tentangKami->toArray(),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) menyimpan data Tentang Kami.", $metaLog);

		return response()->json(['message' => 'Data berhasil disimpan!', 'data' => $tentangKami]);
	}
	
	// ✅ Edit Data
    public function edit($id)
	{
		$tentangKami = TentangKami::findOrFail($id);

		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) membuka halaman edit Tentang Lapor! (ID: {$id}).", $metaLog);

		return view('admin.editTentangLapor', compact('tentangKami'));
	}
	
	// ✅ Update Data
    public function update(Request $request, $id)
	{
		$request->validate([
			'video' => 'required|string',
			'deskripsi' => 'required|string',
			'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
			'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
			'ket_gambar1' => 'nullable|string|max:255',
			'ket_gambar2' => 'nullable|string|max:255',
		]);

		$tentangKami = TentangKami::findOrFail($id);
		$data = $request->all();

		// Upload gambar baru jika ada
		if ($request->hasFile('gambar1')) {
			if ($tentangKami->gambar1) {
				Storage::disk('public')->delete($tentangKami->gambar1);
			}
			$data['gambar1'] = $request->file('gambar1')->store('tentang_kami', 'public');
		}

		if ($request->hasFile('gambar2')) {
			if ($tentangKami->gambar2) {
				Storage::disk('public')->delete($tentangKami->gambar2);
			}
			$data['gambar2'] = $request->file('gambar2')->store('tentang_kami', 'public');
		}

		$tentangKami->update($data);

		// Logging aktivitas update
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Diperbarui' => $tentangKami->toArray(),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) memperbarui data Tentang Kami (ID: {$tentangKami->id}).", $metaLog);

		return response()->json(['message' => 'Data berhasil diperbarui!', 'data' => $tentangKami]);
	}
	
	// ✅ Hapus Data
    public function destroy($id)
	{
		$tentangKami = TentangKami::findOrFail($id);

		// Simpan data sebelum dihapus untuk log
		$dataSebelumHapus = $tentangKami->toArray();

		// Hapus gambar jika ada
		if ($tentangKami->gambar1) {
			Storage::disk('public')->delete($tentangKami->gambar1);
		}
		if ($tentangKami->gambar2) {
			Storage::disk('public')->delete($tentangKami->gambar2);
		}

		$tentangKami->delete();

		// Logging aktivitas hapus
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Dihapus' => $dataSebelumHapus,
		];

		Log::warning("Pengguna {$user->nama} (ID: {$user->id}) menghapus data Tentang Kami (ID: {$id}).", $metaLog);

		return response()->json(['message' => 'Data berhasil dihapus!']);
	}
}
