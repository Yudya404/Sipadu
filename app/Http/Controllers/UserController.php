<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{
	public function __construct()
	{
		Carbon::setLocale('id');
	}
	
	// ✅ Ambil Semua Data Instansi/Lembaga
	public function index()
	{
		Log::info("Memulai fungsi index untuk menampilkan daftar pegawai.");
		
		$user = Auth::user();
		Log::info("Pengguna {$user->nama} (ID: {$user->id}) mengakses Halaman Daftar Pegawai.");

		try {
			$users = User::with('instansi')->get(); // Ambil user beserta instansi terkait
			Log::info("Berhasil mengambil data pegawai.", ['Jumlah Pegawai' => $users->count()]);

			$instansi = Instansi::all(); // Ambil semua instansi dari tabel Instansi
			Log::info("Berhasil mengambil data instansi.", ['Jumlah Instansi' => $instansi->count()]);

			return view('admin.informasiPegawai', compact('users', 'instansi'));
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat mengambil daftar pegawai.", ['error' => $e->getMessage()]);

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat mengambil daftar pegawai.',
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

		Log::info("Pengguna Melihat detail pegawai dengan ID: $id.", $metaLog);

		try {
			$users = User::with('instansi')->find($id);

			if (!$users) {
				Log::warning("Peegawai dengan ID $id tidak ditemukan.", $metaLog);
				return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
			}

			Log::info("Berhasil mendapatkan data pegawai dengan ID: $id", array_merge($metaLog, ['status' => 'ditemukan']));

			return response()->json($users);
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat mengambil data pegawai dengan ID $id.", array_merge($metaLog, ['error' => $e->getMessage()]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat mengambil data pegawai.',
				'error' => $e->getMessage()
			], 500);
		}
	}
	
	// ✅ Fungsi Cek NIP
	public function checkNip(Request $request)
	{
		Log::info("Masuk ke checkNip", ['request' => $request->all()]);

		// Cek apakah NIP sudah ada di database
		$nipExists = User::where('nip', $request->nip)->exists();
		Log::info("Hasil pengecekan NIP", ['nip' => $request->nip, 'exists' => $nipExists]);

		// Cek apakah username sudah ada di database (jika dikirim)
		$usernameExists = false;
		if ($request->has('username')) {
			$usernameExists = User::where('username', $request->username)->exists();
			Log::info("Hasil pengecekan Username", ['username' => $request->username, 'exists' => $usernameExists]);
		}

		// Kirim response dalam format JSON
		return response()->json([
			'nip_exists' => $nipExists,
			'username_exists' => $usernameExists
		]);
	}

    // ✅ Tambah Data Baru
    public function store(Request $request)
	{
		try {
			$user = Auth::user();
			$metaLog = [
				'Diakses Oleh User ID' => $user->id ?? null,
				'Nip' => $user->nip ?? null,
				'Nama' => $user->nama ?? 'Guest',
				'Ip' => request()->ip(),
				'Browser' => request()->userAgent(),
				'Waktu' => now()->toDateTimeString(),
			];

			Log::info('Memulai proses penambahan pegawai:', array_merge($metaLog, ['request_data' => $request->all()]));

			// ✅ Validasi data
			$validatedData = $request->validate([
				'nip' => 'required|numeric|unique:users',
				'nama' => 'required|string|max:100',
				'telp' => 'required|string|max:15',
				'email' => 'required|email|max:50|unique:users',
				'alamat' => 'required|string|max:255',
				'id_instansi' => 'required|numeric',
				'jabatan' => 'required|string|max:100',
				'role' => 'required|in:Super user,Kepala,Admin',
				'foto' => 'nullable|image|max:10240',
				'username' => 'required|numeric|unique:users',
				'password' => 'required|string|min:8|confirmed',
			]);

			Log::info('Validasi berhasil', array_merge($metaLog, ['validated_data' => $validatedData]));

			// ✅ Simpan user
			$user = new User();
			$user->fill($request->except('password'));
			$user->password = Hash::make($request->password);
			$user->tgl_buat = now();

			Log::info('User object sebelum disimpan', array_merge($metaLog, ['user_data' => $user->toArray()]));

			// ✅ Upload foto jika ada
			if ($request->hasFile('foto')) {
				$filename = time() . '.' . $request->foto->extension();
				$request->foto->move(public_path('storage/foto'), $filename);
				$user->foto = $filename;

				Log::info('Foto berhasil diupload', array_merge($metaLog, ['filename' => $filename]));
			}

			$user->save();

			Log::info('User berhasil ditambahkan', array_merge($metaLog, ['user_id_baru' => $user->id]));

			return response()->json([
				'success' => true,
				'message' => 'User berhasil ditambahkan!',
				'data' => $user
			], 201);

		} catch (\Illuminate\Validation\ValidationException $e) {
			Log::error('Validasi gagal', array_merge($metaLog, ['errors' => $e->errors()]));

			return response()->json([
				'success' => false,
				'message' => 'Validasi gagal!',
				'errors' => $e->errors()
			], 422);

		} catch (\Exception $e) {
			Log::error('Terjadi kesalahan pada server', array_merge($metaLog, ['error' => $e->getMessage()]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan pada server!',
				'error' => $e->getMessage()
			], 500);
		}
	}

    // ✅ Ambil Data untuk Edit
    public function edit($id)
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

		Log::info("Memulai proses pencarian data pegawai dengan ID: $id", $metaLog);

		$user = User::with('instansi')->find($id);

		if (!$user) {
			Log::warning("Data pegawai dengan ID: $id tidak ditemukan.", array_merge($metaLog, ['status' => 'not_found']));
			return response()->json([
				'success' => false,
				'message' => "Data pegawai dengan ID: $id tidak ditemukan."
			], 404);
		}

		Log::info("Data pegawai dengan ID: $id berhasil ditemukan.", array_merge($metaLog, ['data' => $user]));

		return response()->json([
			'success' => true,
			'data' => $user
		], 200);
	}

	// ✅ Update Data
	public function update(Request $request, $id)
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

		Log::info("Memulai pembaruan data pegawai dengan ID: $id", array_merge($metaLog, ['request' => $request->all()]));

		try {
			$validator = Validator::make($request->all(), [
				'nip' => 'required|numeric|unique:users,nip,' . $id,
				'nama' => 'required|string|max:255',
				'telp' => 'nullable|string|max:15',
				'email' => 'required|email|unique:users,email,' . $id,
				'alamat' => 'nullable|string|max:255',
				'username' => 'required|string|max:255|unique:users,username,' . $id,
				'instansi_id' => 'required|exists:instansi,id',
				'jabatan' => 'required|string',
				'role' => 'required|string',
				'password' => 'nullable|min:8|confirmed',
				'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
			]);

			if ($validator->fails()) {
				Log::warning("Validasi gagal saat update data pegawai dengan ID: $id.", array_merge($metaLog, ['errors' => $validator->errors()]));
				return response()->json([
					'success' => false,
					'errors' => $validator->errors(),
				], 422);
			}

			$user = User::find($id);
			if (!$user) {
				Log::warning("Pegawai dengan ID: $id tidak ditemukan.", array_merge($metaLog, ['status' => 'not_found']));
				return response()->json([
					'success' => false,
					'message' => 'Data pegawai tidak ditemukan.',
				], 404);
			}

			$user->update([
				'nip' => $request->nip,
				'nama' => $request->nama,
				'telp' => $request->telp,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'username' => $request->username,
				'id_instansi' => $request->instansi_id,
				'jabatan' => $request->jabatan,
				'role' => $request->role,
			]);

			Log::info("Data pegawai dengan ID: $id berhasil diperbarui.", array_merge($metaLog, ['data' => $user]));

			if ($request->filled('password')) {
				$user->password = bcrypt($request->password);
				$user->save();
				Log::info("Password pegawai dengan ID: $id diperbarui.", $metaLog);
			}

			if ($request->hasFile('foto')) {
				if ($user->foto) {
					Storage::delete('public/foto/' . $user->foto);
				}
				$file = $request->file('foto');
				$path = $file->store('public/foto');
				$user->foto = str_replace('public/foto/', '', $path);
				$user->save();
				Log::info("Foto pegawai dengan ID: $id diperbarui.", array_merge($metaLog, ['foto_path' => $path]));
			}

			return response()->json([
				'success' => true,
				'message' => "Data pegawai berhasil diperbarui.",
				'data' => $user
			], 200);

		} catch (\Exception $e) {
			Log::error("Terjadi error saat memperbarui data pegawai dengan ID: $id.", array_merge($metaLog, ['error' => $e->getMessage()]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat memperbarui data pegawai.',
				'error' => $e->getMessage(),
			], 500);
		}
	}
	
	// ✅ Update Data Profile
	public function updateProfile(Request $request)
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

		Log::info("Memulai proses update profile dengan ID: $id", $metaLog);

		try {
			Log::info("Validasi data pegawai dengan ID: $id.", array_merge($metaLog, ['request_data' => $request->all()]));

			$request->validate([
				'nip' => 'required|digits:16',
				'nama' => 'required|string|max:255',
				'telp' => 'required|digits_between:10,15',
				'email' => 'required|email|unique:users,email,' . $user->id,
				'alamat' => 'required|string',
				'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
			]);

			Log::info("Validasi data pegawai dengan ID: $id berhasil.", $metaLog);

			// Update data user
			$user->nip = $request->nip;
			$user->nama = $request->nama;
			$user->telp = $request->telp;
			$user->email = $request->email;
			$user->alamat = $request->alamat;

			// Upload foto jika ada
			if ($request->hasFile('foto')) {
				Log::info("Upload foto pegawai dengan ID: $id dimulai.", $metaLog);

				if ($user->foto) {
					Storage::delete($user->foto);
					Log::info("Foto lama pegawai dengan ID: $id dihapus.", array_merge($metaLog, ['old_photo' => $user->foto]));
				}

				$path = $request->file('foto')->store('storage/foto', 'public');
				$user->foto = $path;

				Log::info("Foto baru pegawai dengan ID: $id berhasil disimpan.", array_merge($metaLog, ['photo_path' => $path]));
			}

			$user->save();
			Log::info("Profile Pegawai dengan ID: $id berhasil diperbarui.", array_merge($metaLog, ['updated_data' => $user->toArray()]));

			$tanggalJam = now()->translatedFormat('d F Y, H:i');
			$message = "Data profil anda dengan NIP {$user->nip} berhasil diupdate pada tanggal dan jam {$tanggalJam}";

			return response()->json(['success' => true, 'message' => $message]);
		} catch (\Exception $e) {
			Log::error("Gagal update profile pegawai dengan ID: $id.", array_merge($metaLog, ['error' => $e->getMessage()]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat memperbarui data profil.',
				'error' => $e->getMessage(),
			], 500);
		}
	}

    // ✅ Hapus Data Berdasarkan ID
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

		Log::info("Memulai proses penghapusan pegawai dengan ID: $id.", $metaLog);

		$users = User::find($id);

		if (!$users) {
			Log::warning("Pegawai dengan ID: $id tidak ditemukan saat mencoba menghapus.", $metaLog);

			return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
		}

		$nip = $users->nip;
		$tanggal = now()->format('d-m-Y');
		$jam = now()->format('H:i:s');

		try {
			$users->delete();

			Log::info("Pegawai dengan ID: $id berhasil dihapus.", array_merge($metaLog, [
				'NIP Target' => $nip,
				'Tanggal' => $tanggal,
				'Jam' => $jam,
				'Dihapus Pada' => now()->toDateTimeString(),
			]));

			return response()->json([
				'success' => true,
				'message' => 'Data berhasil dihapus',
				'nip' => $nip,
				'tanggal' => $tanggal,
				'jam' => $jam
			]);
		} catch (\Exception $e) {
			Log::error("Terjadi kesalahan saat menghapus pegawai dengan ID: $id.", array_merge($metaLog, [
				'NIP Target' => $nip,
				'Error' => $e->getMessage()
			]));

			return response()->json([
				'success' => false,
				'message' => 'Terjadi kesalahan saat menghapus data.',
				'error' => $e->getMessage(),
			], 500);
		}
	}
}
