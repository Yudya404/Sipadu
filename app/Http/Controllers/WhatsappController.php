<?php 

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
		Log::info("Payload diterima: " . json_encode($request->all()));

		$data = $request->input('data');

		// Validasi awal: apakah $data null atau tidak berbentuk array
		if (!is_array($data)) {
			Log::warning("Payload tidak memiliki struktur 'data' yang benar: " . json_encode($request->all()));
			return response()->json(['status' => 'invalid payload'], 400);
		}
		
		$from = $data['from'] ?? null;
		$messageId = $data['id'] ?? null;
		$body = isset($data['body']) ? trim($data['body']) : null;
		$type = $data['type'] ?? null;
		$mediaUrl = $data['media'] ?? null;
		$filename = $data['caption'] ?? ($data['filename'] ?? 'bukti_' . time());
		$fromMe = $data['fromMe'] ?? false;

		if ($fromMe) {
			Log::info("Pesan dari bot sendiri diabaikan.");
			return response()->json(['status' => 'ignored']);
		}

		// Validasi berdasarkan tipe
		if (!$from || (
			$type === 'chat' && !$body
		) || (
			in_array($type, ['image', 'video', 'document']) && !$mediaUrl
		)) {
			Log::warning('Data WA tidak lengkap atau tidak valid: ', $request->all());
			return response()->json(['status' => 'ignored'], 400);
		}

        $sessionKey = "wa_session_{$from}";
		Log::info("Webhook diterima dari [$from] dengan pesan: '$body', tipe: $type");

		// Tangani media (image, document, video)
		if (in_array($type, ['image', 'document', 'video']) && $mediaUrl) {
			try {
				Log::info("Menerima media dari [$from], URL: $mediaUrl");

				$fileContents = @file_get_contents($mediaUrl);
				if ($fileContents === false) {
					throw new \Exception("Tidak dapat mengambil file dari URL.");
				}

				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if (!$ext) {
					$ext = $type === 'image' ? 'jpg' : 'pdf'; // fallback
				}
				$hashedName = uniqid() . '.' . $ext;
				Storage::disk('public')->put("bukti/{$hashedName}", $fileContents);

				$session = Cache::get($sessionKey, ['step' => 'nik', 'data' => []]);
				$requiredFields = [
					'nik' => 'NIK',
					'nama' => 'Nama',
					'telp' => 'Nomor Telepon',
					'email' => 'Email',
					'alamat' => 'Alamat',
					'judul' => 'Judul Pengaduan',
					'isi' => 'Isi Pengaduan',
					'id_instansi' => 'Instansi Tujuan',
				];

				$missingFields = [];

				foreach ($requiredFields as $key => $label) {
					if (empty($session['data'][$key])) {
						$missingFields[] = $label;
					}
				}

				if (!empty($missingFields)) {
					$fieldList = implode(", ", $missingFields);
					$this->sendWaMessage($from, 
						"⚠️ Data berikut belum lengkap: \n\n" .
						"*$fieldList*.\n\n" .
						"Mohon isi semua data pengaduan terlebih dahulu sebelum mengirim bukti.\n\n" .
						"✏️ Tulis 'Oke' untuk melanjutkan pengisian data."
					);

					// Atur step ke field pertama yang kosong
					$firstMissingKey = array_key_first(array_filter($requiredFields, fn($k) => empty($session['data'][$k]), ARRAY_FILTER_USE_KEY));
					if ($firstMissingKey) {
						$session['step'] = $firstMissingKey;
						Cache::put($sessionKey, $session, now()->addMinutes(30));
					}

					return response()->json(['status' => 'waiting_data']);
				}

				$session['data']['bukti'] = $hashedName;
				$session['step'] = 'upload_bukti';
				Cache::put($sessionKey, $session, now()->addMinutes(30));

				Log::info("Bukti berhasil disimpan untuk [$from]: $hashedName");
				$this->sendWaMessage($from, "✅ Bukti berhasil diterima. Lanjutkan proses pengaduan ?");
			} catch (\Exception $e) {
				Log::error("Gagal mengunduh file bukti dari WA: " . $e->getMessage());
				$this->sendWaMessage($from, "❌ Gagal menerima file bukti. Silakan kirim ulang.");
			}
			return response()->json(['status' => 'received']);
		}
		
		$message = $request->input('data.body') ?? '';
		
		// Ambil sesi WA
		$session = Cache::get($sessionKey, [
			'step' => 'sapaan',
			'data' => [],
			'sapaan_terkirim' => false
		]);

		$step = $session['step'];
		$data = $session['data'];
		$sapaanTerkirim = $session['sapaan_terkirim'] ?? false;

		// Kirim sapaan jika belum pernah dikirim
		if (!$sapaanTerkirim) {
			$pengaduan = Pengaduan::where('wa_number', $from)
				->orderBy('tgl_buat', 'desc')
				->first();

			$nama = $pengaduan->nama ?? null;
			$sapaan = $nama
				? "👋 Hai *$nama*, selamat datang kembali di *Pengaduan Online*. 😊"
				: "👋 Hai! Selamat datang di *Pengaduan Online*. 😊";

			$sapaan .= "\n\nAda yang bisa kami bantu hari ini?\nSilakan pilih:\n\n1️⃣ *Tulis Pengaduan Baru*\n2️⃣ *Lacak Pengaduan Anda*";

			$this->sendWaMessage($from, $sapaan);

			$session['sapaan_terkirim'] = true;
			$session['step'] = 'pilih_menu_awal';
			Cache::put($sessionKey, $session, now()->addMinutes(30));
			return;
		}

		if ($step === 'pilih_menu_awal') {
			if (trim($message) === '1') {
				$this->sendWaMessage($from, "Silakan masukkan *NIK* Anda untuk memulai pengaduan.");
				$session['step'] = 'nik';
				Cache::put($sessionKey, $session, now()->addMinutes(30));
				return;
			} elseif (trim($message) === '2') {
				$pengaduan = Pengaduan::where('wa_number', $from)
					->orderBy('tgl_buat', 'desc')
					->first();


				if ($pengaduan) {
					$status = $pengaduan->status;
					$kategori = $pengaduan->kategori;
					$tglDibuat = $pengaduan->tgl_buat->format('d M Y, H:i');

					$this->sendWaMessage($from,
						"📄 *Status Pengaduan Terakhir Anda:*\n\n" .
						"📌 Kode Formulir : *{$pengaduan->kode_formulir}*\n" .
						"🗓️ Tanggal Dibuat : *{$tglDibuat}*\n" .
						"📈 Status : *{$status}*"
					);

					// Reset sesi
					Cache::forget($sessionKey);
					return;
				} else {
					$this->sendWaMessage($from, "📭 Kami tidak menemukan pengaduan sebelumnya.\nSilakan masukkan *kode formulir* Anda (contoh: *PGD-20250410-ABC123*) untuk melacak secara manual.");
					$session['step'] = 'lacak_pengaduan_manual';
					Cache::put($sessionKey, $session, now()->addMinutes(30));
					return;
				}
			} else {
				$this->sendWaMessage($from, "❌ Pilihan tidak dikenali. Silakan balas dengan *1* untuk tulis pengaduan atau *2* untuk lacak pengaduan.");
				return;
			}
		}

		// Menangani pelacakan pengaduan
		if ($step === 'lacak_pengaduan_manual') {
			$kodeFormulir = strtoupper(trim($message));

			$pengaduan = Pengaduan::where('kode_formulir', $kodeFormulir)
				->where('wa_number', $from)
				->orderBy('tgl_buat', 'desc')
				->first();


			if ($pengaduan) {
				$status = $pengaduan->status;
				$kategori = $pengaduan->kategori;
				$tglDibuat = $pengaduan->tgl_buat->format('d M Y, H:i');

				$this->sendWaMessage($from,
					"📄 *Status Pengaduan Anda:*\n\n" .
					"📌 Kode Formulir : *{$pengaduan->kode_formulir}*\n" .
					"🗓️ Tanggal Dibuat : *{$tglDibuat}*\n" .
					"📈 Status : *{$status}*"
				);
			} else {
				$this->sendWaMessage($from, "❌ Maaf, pengaduan dengan kode *$kodeFormulir* tidak ditemukan atau tidak cocok dengan nomor ini.");
			}

			// Selesai, reset sesi
			Cache::forget($sessionKey);
			return;
		}

		// Jika setelah sapaan, user langsung kirim NIK (fallback ke pengaduan lama)
		if ($step === 'tunggu_input_setelah_sapaan') {
			$this->sendWaMessage($from, "Silakan masukkan *NIK* Anda untuk memulai pengaduan.");
			$session['step'] = 'nik';
			Cache::put($sessionKey, $session, now()->addMinutes(30));
			return;
		}

        Log::info("WA [$from] sedang dalam step: [$step], isi pesan: '$body'");

        switch ($step) {
            case 'nik':
				if (!preg_match('/^\d{16}$/', $body)) {
					$reply = "⚠️ NIK harus terdiri dari *16 digit angka*. Silakan masukkan NIK yang valid.";
					$nextStep = 'nik';
				} else {
					$today = Carbon::today();
					$sevenDaysAgo = Carbon::now()->subDays(7);

					// Hitung jumlah pengaduan dari NIK atau WA dalam 7 hari terakhir
					$recentCount = Pengaduan::whereBetween('tgl_buat', [$sevenDaysAgo, $today])
						->where(function ($query) use ($body, $from) {
							$query->where('nik', $body)
								->orWhere('wa_number', $from);
						})
						->count();

					$maxWeekly = 3;
					$sisa = $maxWeekly - $recentCount;

					$alreadyToday = Pengaduan::whereDate('tgl_buat', $today)
						->where(function ($query) use ($body, $from) {
							$query->where('nik', $body)
								->orWhere('wa_number', $from);
						})
						->exists();

					if ($recentCount >= $maxWeekly || $alreadyToday) {
						$alasan = $recentCount >= $maxWeekly
							? "Anda sudah mengajukan *$recentCount pengaduan* dalam *7 hari terakhir*."
							: "Anda atau NIK ini sudah mengajukan pengaduan *hari ini*.";

						$reply = "⚠️ $alasan\n\nUntuk menghindari spam, Anda hanya bisa mengirim maksimal *$maxWeekly pengaduan per minggu*.\n\nKetik *stop* atau *keluar* untuk kembali ke menu utama.";
						$nextStep = 'pengajuan_terkunci'; // tahan sementara di sini
					}
					else {
						$data['nik'] = $body;
						$reply = "Masukkan *Nama Lengkap* Anda:\n\n📌 Sisa kuota pengaduan minggu ini: *$sisa kali*.";
						$nextStep = 'nama';
					}
				}
				break;
				
			case 'pengajuan_terkunci':
				if (in_array(strtolower($body), ['stop', 'keluar'])) {
					// Reset session
					$session = [
						'step' => 'sapaan',
						'data' => [],
						'sapaan_terkirim' => false
					];
					Cache::put($sessionKey, $session, now()->addMinutes(30));

					// Kirim pesan terima kasih
					$this->sendWaMessage($from, "✅ Terima kasih. Pengaduan Anda telah kami terima dan sedang diproses. Kami akan segera menindaklanjuti.");

					// Kirim sapaan ulang
					$sapaan = "👋 Hai! Selamat datang di *Pengaduan Online*. 😊\n\nAda yang bisa kami bantu hari ini?\nSilakan pilih:\n\n1️⃣ *Tulis Pengaduan Baru*\n2️⃣ *Lacak Pengaduan Anda*";
					$this->sendWaMessage($from, $sapaan);

					Cache::forget($sessionKey);
					return;
				} else {
					$reply = "⚠️ Anda tidak dapat melanjutkan pengaduan saat ini.\n\nKetik *stop* atau *keluar* untuk kembali ke menu utama.";
					$nextStep = 'pengajuan_terkunci';
				}
				break;

            case 'nama':
				if (!preg_match('/^[a-zA-Z\s]{3,50}$/', $body)) {
					$reply = "⚠️ Nama hanya boleh terdiri dari huruf dan spasi. Silakan masukkan nama yang valid.";
					$nextStep = 'nama'; // tetap di step ini
				} else {
					$data['nama'] = $body;
					$reply = "Masukkan *Nomor HP* Anda:";
					$nextStep = 'telp';
				}
				break;

            case 'telp':
				if (!preg_match('/^\d{12,13}$/', $body)) {
					$reply = "⚠️ Nomor HP hanya boleh terdiri dari angka dengan panjang 12 sampai 13 digit. Silakan masukkan nomor yang valid.";
					$nextStep = 'telp'; // tetap di step ini sampai valid
				} else {
					$data['telp'] = $body;
					$reply = "Masukkan *Email* Anda:";
					$nextStep = 'email';
				}
				break;

            case 'email':
				if (!filter_var($body, FILTER_VALIDATE_EMAIL)) {
					$reply = "⚠️ Alamat email tidak valid. Silakan masukkan email yang benar, contoh: nama@email.com";
					$nextStep = 'email'; // tetap di step ini sampai valid
				} else {
					$data['email'] = $body;
					$reply = "Masukkan *Alamat* Anda:";
					$nextStep = 'alamat';
				}
				break;

           case 'alamat':
				if (
					strlen($body) < 10 ||                                   // minimal panjang
					!preg_match("/^[a-zA-Z0-9\s.,\/-]+$/", $body) ||       // hanya karakter yang diizinkan
					!preg_match("/\d/", $body)                             // harus ada minimal 1 angka
				) {
					$reply = "⚠️ Alamat tidak valid. Harap masukkan alamat lengkap (minimal 10 karakter), mengandung setidaknya satu angka, dan tidak mengandung karakter aneh.";
					$nextStep = 'alamat'; // tetap di step ini sampai valid
				} else {
					$data['alamat'] = $body;
					$data['jenis_laporan'] = 'pengaduan'; // Set default tanpa perlu tanya
					$reply = "Masukkan *Judul Pengaduan* Anda:";
					$nextStep = 'judul';
				}
				break;

            case 'judul':
				if (
					!preg_match("/^[a-zA-Z\s]+$/", $body) ||  // hanya huruf dan spasi
					strlen($body) < 10 || strlen($body) > 25 // panjang antara 10 dan 25
				) {
					$reply = "⚠️ Judul tidak valid. Harus terdiri dari huruf dan spasi saja, dengan panjang antara 10 hingga 25 karakter.";
					$nextStep = 'judul'; // tetap di step ini sampai valid
				} else {
					$data['judul'] = $body;
					$reply = "Masukkan *Isi Pengaduan* Anda:";
					$nextStep = 'isi';
				}
				break;

            case 'isi':
				// Validasi isi: hanya huruf, angka, spasi, titik, koma, garis miring, dan tanda tanya (!, ?)
				// Panjang minimal 20 karakter dan maksimal 500 karakter
				if (
					!preg_match("/^[a-zA-Z0-9\s.,\/!?()]+$/", $body) ||
					strlen($body) < 20 || strlen($body) > 255
				) {
					$reply = "⚠️ Isi pengaduan tidak valid. Harus terdiri dari huruf, angka, dan tanda baca umum saja. Panjang minimal 20 karakter dan maksimal 500 karakter.";
					$nextStep = 'isi'; // tetap di step ini sampai valid
				} else {
					$data['isi'] = $body;
					$reply = "Masukkan *Tanggal Kejadian* (boleh dalam format seperti: 2 April 2025, 02-04-2025, atau 2025/04/02):";
					$nextStep = 'tgl_kejadian';
				}
				break;

           case 'tgl_kejadian':
				try {
					$tanggal = \Carbon\Carbon::parse($body);
					$formattedDate = $tanggal->format('Y-m-d');

					$now = \Carbon\Carbon::now()->format('Y-m-d');
					if ($formattedDate > $now) {
						$reply = "⚠️ Tanggal tidak valid. Tanggal kejadian tidak boleh di masa depan.";
						$nextStep = 'tgl_kejadian';
					} else {
						$data['tgl_kejadian'] = $formattedDate;

						// Ambil daftar instansi langsung
						$instansiList = Instansi::select('id', 'nama')->limit(10)->get();
						$instansiMap = [];
						$textList = [];

						foreach ($instansiList as $index => $instansi) {
							$no = $index + 1;
							$textList[] = "$no. " . $instansi->nama;
							$instansiMap[$no] = $instansi->id;
						}

						// Simpan instansi ke session
						$session['instansi_list'] = $instansiMap;
						$session['instansi_mode'] = 'default';
						Cache::put($sessionKey, $session, now()->addMinutes(30));

						$reply = "🏢 Pilih *Instansi Tujuan* dari daftar berikut:\n\n" . implode("\n", $textList) .
								 "\n\nBalas dengan angka (misal: *1*).\nJika tidak ada dalam daftar, ketik: *cari [kata_kunci]*";
						$nextStep = 'id_instansi';
					}
				} catch (\Exception $e) {
					$reply = "⚠️ Tanggal tidak dikenali. Silakan masukkan tanggal yang benar, contoh: *2 April 2025* atau *02-04-2025*.";
					$nextStep = 'tgl_kejadian';
				}
				break;

            case 'id_instansi':
				if (!isset($session['instansi_list'])) {
					// Tampilkan daftar default instansi
					$instansiList = Instansi::select('id', 'nama')->limit(5)->get();
					$instansiMap = [];
					$textList = [];

					foreach ($instansiList as $index => $instansi) {
						$no = $index + 1;
						$textList[] = "$no. " . $instansi->nama;
						$instansiMap[$no] = $instansi->id;
					}

					$session['instansi_list'] = $instansiMap;
					$session['instansi_mode'] = 'default';
					Cache::put($sessionKey, $session, now()->addMinutes(30));

					$reply = "🏢 Pilih *Instansi Tujuan* dari daftar berikut:\n\n" . implode("\n", $textList) .
							 "\n\nBalas dengan angka (misal: *1*).\nJika tidak ada dalam daftar, ketik: *cari [kata_kunci]*";
					$nextStep = 'id_instansi';

				} elseif (Str::startsWith(strtolower($body), 'cari ')) {
					$keyword = trim(substr($body, 5));

					$searchResults = Instansi::where('nama', 'like', "%$keyword%")
						->select('id', 'nama')
						->limit(5)
						->get();

					if ($searchResults->isEmpty()) {
						$reply = "🔍 Tidak ditemukan instansi dengan kata kunci *$keyword*. Coba dengan kata lain.";
						$nextStep = 'id_instansi';
					} else {
						$instansiMap = [];
						$textList = [];

						foreach ($searchResults as $index => $instansi) {
							$no = $index + 1;
							$textList[] = "$no. " . $instansi->nama;
							$instansiMap[$no] = $instansi->id;
						}

						$session['instansi_list'] = $instansiMap;
						$session['instansi_mode'] = 'search';
						Cache::put($sessionKey, $session, now()->addMinutes(30));

						$reply = "🔍 Hasil pencarian instansi dengan kata kunci *$keyword*:\n\n" .
								 implode("\n", $textList) .
								 "\n\nBalas dengan angka (misal: *1*)";
						$nextStep = 'id_instansi';
					}

				} else {
					// User balas angka
					$instansiMap = $session['instansi_list'];
					$chosenIndex = (int) $body;

					if (!isset($instansiMap[$chosenIndex])) {
						$reply = "⚠️ Pilihan tidak valid. Balas dengan angka sesuai daftar, atau ketik `cari [kata_kunci]`.";
						$nextStep = 'id_instansi';
					} else {
						$data['id_instansi'] = $instansiMap[$chosenIndex];
						unset($session['instansi_list']);
						unset($session['instansi_mode']);
						$reply = "📎 Silakan kirim *bukti pendukung* (gambar atau dokumen) terlebih dahulu.";
						$nextStep = 'upload_bukti';
					}
				}
				break;

			case 'upload_bukti':
				if (!isset($data['bukti'])) {
					$reply = "⚠️ Bukti belum diterima. Silakan unggah *gambar, video, atau dokumen* terlebih dahulu.";
					$nextStep = 'upload_bukti';
				} else {
					Log::info("Melakukan prediksi AI untuk [$from]...");
					$aiResponse = Http::post('http://127.0.0.1:5000/predict', [
						'judul' => $data['judul'],
						'isi' => $data['isi']
					]);

					$kategori = $aiResponse['kategori'] ?? 'Spam';
					$status = $kategori === 'Asli' ? 'Diajukan' : 'Tidak Diproses';
					
					Log::info("Kategori AI: $kategori, Status: $status");

					$kodeFormulir = $this->generateKodeFormulir();
					Log::info("Kode formulir untuk [$from]: $kodeFormulir");

					$pengaduan = new Pengaduan();
					$pengaduan->kode_formulir = $kodeFormulir;
					$pengaduan->nik = $data['nik'];
					$pengaduan->nama = $data['nama'];
					$pengaduan->telp = $data['telp'];
					$pengaduan->email = $data['email'];
					$pengaduan->alamat = $data['alamat'];
					$pengaduan->jenis_laporan = $data['jenis_laporan'];
					$pengaduan->judul = $data['judul'];
					$pengaduan->isi = $data['isi'];
					$pengaduan->tgl_kejadian = $data['tgl_kejadian'];
					$pengaduan->id_instansi = $data['id_instansi'];
					$pengaduan->kategori = $kategori;
					$pengaduan->status = $status;
					$pengaduan->via_wa = true;
					$pengaduan->wa_number = $from;
					$pengaduan->wa_message_id = $messageId;
					$pengaduan->bukti = $data['bukti'] ?? null;
					$pengaduan->save();

					Log::info("Pengaduan dari [$from] berhasil disimpan dengan ID: {$pengaduan->id}");
					
					// 🔁 Jika kategori adalah Spam, buat tanggapan otomatis
					if ($kategori === 'Spam') {
						$waMessageId = null;

						// 🔔 Kirim pesan ke WhatsApp jika ada
						if ($pengaduan->via_wa && $pengaduan->wa_number) {
							$waResponse = UltraMsgHelper::sendMessage(
								$pengaduan->wa_number,
								'Pengaduan Anda terdeteksi sebagai *SPAM* oleh sistem dan tidak akan diproses.'
							);

							if ($waResponse && isset($waResponse['message_id'])) {
								$waMessageId = $waResponse['message_id'];
							}
						}

						// 💾 Simpan tanggapan otomatis
						$tanggapan = new Tanggapan();
						$tanggapan->id_pengaduan = $pengaduan->id;
						$tanggapan->kode_formulir = $pengaduan->kode_formulir;
						$tanggapan->id_users = 1; // ID Bot
						$tanggapan->isi_tanggapan = 'Pengaduan Anda terdeteksi sebagai *SPAM* oleh sistem dan tidak akan diproses.';
						$tanggapan->tgl_ditanggapi = now();
						$tanggapan->via_wa = $pengaduan->via_wa ?? false;
						$tanggapan->wa_message_id = $waMessageId;
						$tanggapan->is_auto_reply = true;
						$tanggapan->save();

						Log::info("Tanggapan otomatis spam berhasil disimpan untuk ID Pengaduan: {$pengaduan->id}", [
							'wa_message_id' => $waMessageId,
						]);
					}

					$reply = "*Terima kasih!* Pengaduan Anda telah direkam.\n\nKode: {$pengaduan->kode_formulir}\nKategori Pengaduan: *$kategori*\nStatus: *$status*";
					$this->sendWaMessage($from, $reply); // ✅ Kirim detail pengaduan terlebih dahulu

					// (Opsional) Kirim info proses pengaduan
					$this->sendWaMessage($from, "✅ Terima kasih. Pengaduan Anda telah kami terima dan sedang diproses. Kami akan segera menindaklanjuti.");

					// Ambil nama dari pengaduan terbaru
					$nama = $pengaduan->nama ?? null;

					// Reset sesi
					$session = [
						'step' => 'sapaan',
						'data' => ['nama' => $nama],
						'sapaan_terkirim' => false
					];
					Cache::put($sessionKey, $session, now()->addMinutes(30));

					// Kirim menu awal
					$sapaan = isset($data['nama'])
						? "👋 Hai *{$data['nama']}*, selamat datang kembali di *Pengaduan Online*. 😊"
						: "👋 Hai! Selamat datang di *Pengaduan Online*. 😊";
					$sapaan .= "\n\nAda yang bisa kami bantu hari ini?\nSilakan pilih:\n\n1️⃣ *Tulis Pengaduan Baru*\n2️⃣ *Lacak Pengaduan Anda*";

					$this->sendWaMessage($from, $sapaan);

					// Hapus sesi lama agar tidak tumpang tindih
					Cache::forget($sessionKey);

					return; // ✅ Setelah semua pesan terkirim, baru keluar
				}
                break;
        }
		
		// ✅ Hanya kalau belum done, simpan sesi dan kirim reply
		if (isset($nextStep) && $nextStep !== 'done') {
			$session['data'] = $data;
			$session['step'] = $nextStep;
			Cache::put($sessionKey, $session, now()->addMinutes(30));
			$this->sendWaMessage($from, $reply);
		}

		return;

        $this->sendWaMessage($from, $reply);
		Log::info("Respon terkirim ke [$from]: $reply");

        return response()->json(['status' => 'ok']);
    }

    private function sendWaMessage($to, $message)
	{
		$instanceId = env('ULTRAMSG_INSTANCE_ID');
		$token = env('ULTRAMSG_TOKEN');

		$response = Http::asForm()->post("https://api.ultramsg.com/$instanceId/messages/chat", [
			'token' => $token,
			'to' => $to,
			'body' => $message
		]);

		if ($response->successful()) {
			return $response->json(); // Kembalikan message_id jika butuh disimpan
		}

		Log::error('Gagal kirim WA', ['to' => $to, 'error' => $response->body()]);
		return null;
	}
	
	private function generateKodeFormulir(): string
	{
		$today = date('Ymd');
		$lastPengaduan = Pengaduan::whereDate('tgl_buat', today())
			->orderBy('id', 'desc')
			->first();

		if ($lastPengaduan && strpos($lastPengaduan->kode_formulir, '-') !== false) {
			$parts = explode('-', $lastPengaduan->kode_formulir);
			$lastNoUrut = end($parts);
			$noUrut = is_numeric($lastNoUrut) ? (int) $lastNoUrut + 1 : 1;
		} else {
			$noUrut = 1;
		}

		return 'FORM-' . $today . '-' . str_pad($noUrut, 3, '0', STR_PAD_LEFT);
	}
}
