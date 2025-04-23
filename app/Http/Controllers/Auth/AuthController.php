<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
	
	public function __construct()
	{
		Carbon::setLocale('id');
	}

    public function login(Request $request)
	{
		// Batasi jumlah percobaan login
		if ($response = $this->ensureIsNotRateLimited($request)) {
			return $response;
		}

		Log::info('Percobaan login dengan data:', $request->except('password'));

		$validator = Validator::make(
			$request->all(),
			[
				'nip' => 'required|digits:16',
				'password' => 'required|string|min:6|max:255',
			],
			[
				'nip.digits' => 'NIP/NIPTT-PK harus terdiri dari 16 digit angka.',
			]
		);

		if ($validator->fails()) {
			Log::warning('Validasi login gagal', [
				'errors' => $validator->errors()->toArray(),
				'nip' => $request->nip,
				'ip' => $request->ip(),
				'user_agent' => $request->userAgent(),
				'waktu' => now()->toDateTimeString(),
			]);

			return response()->json([
				'success' => false,
				'errors' => $validator->errors()
			], 422);
		}

		$user = \App\Models\User::where('nip', $request->nip)->first();

		if (!$user) {
			RateLimiter::hit($this->throttleKey($request));

			Log::warning('Login gagal - NIP tidak ditemukan', [
				'nip' => $request->nip,
				'ip' => $request->ip(),
				'user_agent' => $request->userAgent(),
				'waktu' => now()->toDateTimeString()
			]);

			return response()->json([
				'success' => false,
				'message' => 'NIP/NIPTT-PK Salah, silahkan coba lagi.'
			], 401);
		}

		if (!Auth::attempt($request->only('nip', 'password'))) {
			RateLimiter::hit($this->throttleKey($request));

			Log::warning('Login gagal - Password salah', [
				'nip' => $request->nip,
				'nama' => $user->nama ?? 'Tidak diketahui',
				'ip' => $request->ip(),
				'user_agent' => $request->userAgent(),
				'waktu' => now()->toDateTimeString()
			]);

			return response()->json([
				'success' => false,
				'message' => 'Password salah, silahkan coba lagi.'
			], 401);
		}

		$request->session()->regenerate();
		RateLimiter::clear($this->throttleKey($request));
		$user = Auth::user();

		$metaLog = [
			'Diakses Oleh User ID' => $user->id ?? null,
			'Nip' => $user->nip ?? null,
			'Nama' => $user->nama ?? 'Guest',
			'Role' => $user->role ?? null,
			'Ip' => $request->ip(),
			'Browser' => $request->userAgent(),
			'Waktu' => now()->toDateTimeString(),
		];

		if (!$user->role) {
			Auth::logout();
			Log::error('Login gagal - Role tidak tersedia', $metaLog);

			return response()->json([
				'success' => false,
				'message' => 'Akun ini tidak memiliki peran yang valid.'
			], 403);
		}

		if (!in_array($user->role, ['Super user', 'Admin', 'Operator', 'Kepala'])) {
			Auth::logout();
			Log::error('Login gagal - Role tidak diizinkan', $metaLog);

			return response()->json([
				'success' => false,
				'message' => 'Anda tidak memiliki izin untuk mengakses sistem ini.'
			], 403);
		}

		$user->update(['aktivitas_login' => now()]);

		Log::info('Login sukses', $metaLog);

		return response()->json([
			'success' => true,
			'message' => 'Login berhasil.',
			'role' => $user->role,
			'redirect_url' => route('beranda.index')
		]);
	}

    public function logout(Request $request)
	{
		try {
			// Dapatkan informasi user sebelum logout
			$user = Auth::user();

			// Siapkan meta log yang konsisten
			$metaLog = [
				'Diakses Oleh User ID' => $user->id ?? null,
				'Nip' => $user->nip ?? null,
				'Nama' => $user->nama ?? 'Guest',
				'Role' => $user->role ?? null,
				'Ip' => $request->ip(),
				'Browser' => $request->userAgent(),
				'Waktu' => now()->toDateTimeString(),
			];

			// Logout
			Auth::logout();

			// Hancurkan session & regenerate token
			$request->session()->invalidate();
			$request->session()->regenerateToken();

			// Log aktivitas logout sukses
			Log::info('User berhasil logout.', $metaLog);

			// Respons JSON untuk request via AJAX
			if ($request->expectsJson()) {
				return response()->json(['success' => true, 'message' => 'Logout berhasil.'], 200);
			}

			// Redirect untuk request biasa
			return redirect('/login');
		} catch (\Exception $e) {
			// Siapkan log error
			$errorLog = [
				'Message' => $e->getMessage(),
				'File' => $e->getFile(),
				'Line' => $e->getLine(),
				'Trace' => $e->getTraceAsString(),
				'Ip' => $request->ip(),
				'User Agent' => $request->userAgent(),
				'Waktu' => now()->toDateTimeString(),
			];

			Log::error('Gagal melakukan logout.', $errorLog);

			// Jika request AJAX, kembalikan JSON error
			if ($request->expectsJson()) {
				return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat logout.'], 500);
			}

			// Untuk request biasa, redirect ke login dengan pesan error (opsional bisa ditambahkan flash message)
			return redirect('/login')->withErrors(['logout' => 'Terjadi kesalahan saat logout.']);
		}
	}

    // Fungsi untuk mencegah brute force attack
	protected function ensureIsNotRateLimited(Request $request)
	{
		if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
			return;
		}

		$seconds = RateLimiter::availableIn($this->throttleKey($request));

		Log::warning('Pengguna melebihi batas percobaan login.', [
			'Nip' => $request->input('nip'),
			'Ip' => $request->ip(),
			'User Agent' => $request->userAgent(),
			'Waktu' => now()->toDateTimeString(),
			'Percobaan' => RateLimiter::attempts($this->throttleKey($request)),
			'retry_after' => $seconds
		]);

		// Kirim response JSON langsung
		return response()->json([
			'message' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam beberapa saat.',
			'errors' => [
				'nip' => ['Terlalu banyak percobaan login. Silakan coba lagi dalam beberapa saat.']
			],
			'retry_after' => $seconds
		], 429);
	}

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('nip')) . '|' . $request->ip();
    }
}
