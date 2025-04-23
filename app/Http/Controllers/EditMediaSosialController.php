<?php

namespace App\Http\Controllers;

use App\Models\MediaSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log

class EditMediaSosialController extends Controller
{
    // ✅ Tampilkan semua data
    public function index()
    {
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Edit Media Sosial.");
		
        $mediaSosial = MediaSosial::all();
        return view('admin.editMediaSosial', compact('mediaSosial'));
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

		$mediaSosial = MediaSosial::first();

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses data Media Sosial.", $metaLog);

		// Jika tidak ada data, kembalikan JSON kosong
		if (!$mediaSosial) {
			Log::info("Data Media Sosial tidak ditemukan.", $metaLog);
			return response()->json([], 200);
		}

		return response()->json($mediaSosial);
	}

	// ✅ Menyimpan data baru
	public function store(Request $request)
	{
		$request->validate([
			'whatsapp'  => 'nullable|string|max:50',
			'instagram' => 'nullable|string|max:50',
			'tiktok'    => 'nullable|string|max:50',
			'twitter'   => 'nullable|string|max:50',
			'facebook'  => 'nullable|string|max:50',
			'email'     => 'nullable|email|max:50',
		]);

		$mediaSosial = MediaSosial::first() ?? new MediaSosial();

		// Loop hanya untuk field yang dikirimkan agar tidak mempengaruhi lainnya
		foreach ($request->only(['whatsapp', 'instagram', 'tiktok', 'twitter', 'facebook', 'email']) as $key => $value) {
			if ($value !== null) {
				$mediaSosial->$key = $value;
			}
		}

		$mediaSosial->save();

		// Logging aksi pengguna
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Dikirim' => $request->only(['whatsapp', 'instagram', 'tiktok', 'twitter', 'facebook', 'email']),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) menyimpan data Media Sosial.", $metaLog);

		return response()->json(['message' => 'Data berhasil diperbarui!']);
	}

    // ✅ Edit Data
    public function edit($id)
	{
		$mediaSosial = MediaSosial::findOrFail($id);

		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) membuka halaman edit Media Sosial (ID: {$id}).", $metaLog);

		return view('admin.editMediaSosial', compact('mediaSosial'));
	}

    // ✅ Update Data
	public function update(Request $request, $id)
	{
		$request->validate([
			'whatsapp'  => 'required|string|max:50',
			'instagram' => 'required|string|max:50',
			'tiktok'    => 'required|string|max:50',
			'twitter'   => 'required|string|max:50',
			'facebook'  => 'required|string|max:50',
			'email'     => 'required|email|max:50',
		]);

		$mediaSosial = MediaSosial::findOrFail($id);
		$mediaSosial->update($request->all());

		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Diperbarui' => $request->only([
				'whatsapp', 'instagram', 'tiktok', 'twitter', 'facebook', 'email'
			]),
		];

		Log::info("Pengguna {$user->nama} (ID: {$user->id}) melakukan update data Media Sosial (ID: {$id}).", $metaLog);

		return redirect()->back()->with('success', 'Data berhasil diperbarui!');
	}

    // ✅ Hapus Data
    public function destroy($id)
	{
		$mediaSosial = MediaSosial::findOrFail($id);

		// Simpan data sebelum dihapus untuk keperluan log
		$dataTerhapus = $mediaSosial->toArray();

		$mediaSosial->delete();

		// Logging penghapusan data
		$user = Auth::user();
		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Ip' => request()->ip(),
			'Browser' => request()->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Data Dihapus' => $dataTerhapus,
		];

		Log::warning("Pengguna {$user->nama} (ID: {$user->id}) menghapus data Media Sosial (ID: {$id}).", $metaLog);

		return redirect()->back()->with('success', 'Data berhasil dihapus!');
	}

}
