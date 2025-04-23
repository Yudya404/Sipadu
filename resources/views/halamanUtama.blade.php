@extends('templates.baseUser')
@section('title','Lapor Mase!')
@section('content')
	<section class="bg0 p-t-50" style="background: linear-gradient(to bottom, red, white); min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">
		<div class="container d-flex flex-column align-items-center justify-content-center" style="flex-grow: 1; padding-top: 50px; padding-bottom: 50px;">
			<div class="text-center mb-4">
				<div class="animated-text-wrapper">
					<h1 class="fw-bold text-white animated-text">Layanan Pengaduan Online Masyarakat</h1>
				</div>
				<br>
				<div class="animated-text-wrapper">
					<h2 class="fw-bold text-white animated-text">Sampaikan Pengaduan Anda Langsung Kepada Instansi Pemerintah</h2>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card shadow-lg mb-4">
						<div class="card p-4">
							<div class="card-header">
								<h4 class="mtext-105 cl2 txt-center p-b-20">
									<strong>Sampaikan Pengaduan Anda</strong>
								</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="text-md-start">
											<strong>Perhatikan Cara Menyampaikan Pengaduan Yang Baik dan Benar</strong>
											<a href="#" class="fw-bold ps-0 text-danger">
												<img src="img/info.svg" alt="Icon" class="hover-icon" data-bs-toggle="modal" data-bs-target="#modalPanduan">
											</a>
										</div>
									</div>
								</div>
								<!-- Garis Separator -->
								<hr class="my-4">
								<form id="formLaporan" enctype="multipart/form-data">
									@csrf
									<!-- Input Hidden -->
									<input type="hidden" id="jenis" name="jenisLaporan" value="pengaduan">
										<div class="row">
											<div class="col-md-6">
												<div class="floating-input-wrapper">
													<input type="number" name="nik" id="nik" placeholder=" " required>
													<label for="nik">NIK</label>
													<i class="fa fa-id-card" style="color: #e74c3c;"></i>
												</div>
											</div>
											<div class="col-md-6">
												<div class="floating-input-wrapper">
													<input type="text" name="nama" id="nama" placeholder=" " required>
													<label for="nama">Nama</label>
													<i class="fa fa-user-circle" style="color: #2980b9;"></i>
												</div>
											</div>
											<div class="col-md-6">
												<div class="floating-input-wrapper">
													<input type="number" name="telp" id="telp" placeholder=" " required>
													<label for="telp">Nomor HP (WhatsApp Aktif)</label>
													<i class="fa-brands fa-whatsapp" style="color: #25D366;"></i>
												</div>
											</div>
											<div class="col-md-6">
												<div class="floating-input-wrapper">
													<input type="email" name="email" id="email" placeholder=" " required>
													<label for="email">Email</label>
													<i class="fa fa-envelope-open-text" style="color: #f39c12;"></i>
												</div>
											</div>
											<div class="col-md-12">
												<div class="floating-input-wrapper">
													<textarea id="alamat" name="alamat" class="floating-textarea" placeholder=" " autocomplete="street-address" required></textarea>
													<label for="alamat">Alamat</label>
													<i class="fa fa-map-marker-alt" style="color: #9b59b6;"></i> <!-- ungu -->
												</div>
											</div>
										</div>
										<!-- Input Tanggal Kejadian -->
										<div class="floating-input-wrapper">
											<input id="tglLaporanPengaduan" name="tglKejadian" class="floating-input" type="text" placeholder=" " required>
											<label for="tglLaporanPengaduan">Tanggal Kejadian</label>
											<i class="fa fa-calendar-alt" style="color: #3498db;"></i> <!-- Ikon kalender biru -->
										</div>
										<!-- Input Judul Laporan -->
										<div class="floating-input-wrapper">
											<input id="judulLaporan" name="judul" class="floating-input" type="text" placeholder=" " required>
											<label for="judulLaporan">Judul Pengaduan</label>
											<i class="fa fa-edit" style="color: #9b59b6;"></i> <!-- Ikon ungu -->
										</div>
										<div class="floating-input-wrapper">
											<textarea id="editorPengaduan" name="editorPengaduan" class="floating-textarea" placeholder=" " required></textarea>
											<label for="editorPengaduan">Uraian Penganduan Anda</label>
											<i class="fa fa-edit" style="color: #9b59b6;"></i> <!-- Ikon ungu -->
										</div>
										<!-- Select Instansi Terkait -->
										<div class="custom-select-wrapper">
											<label for="selectInstansi" class="custom-select-label">
												<i class="fa fa-university"></i>
												<select id="selectInstansi" name="instansi" data-placeholder="Pilih Instansi" class="custom-select">
													<option value="" disabled selected hidden></option>
													<!-- Tambahkan opsi lain di sini -->
												</select>
											</label>
										</div>
										<!-- Input File -->
										<label for="filePengaduan" class="custom-file-label m-b-5">
											<i class="fa fa-file-import text-success"></i>
											<span id="fileLabel">Unggah Bukti</span>
										</label>
										<input type="file" class="hidden-input" id="filePengaduan" accept="image/*,video/*,.pdf">
										<!-- Preview File -->
										<div class="preview-container">
											<p id="fileNameDisplay">Tidak ada file yang dipilih</p> <!-- Perbaikan ID -->
											<img id="imagePreview" class="file-preview">
											<video id="videoPreview" class="file-preview" controls></video>
											<iframe id="pdfPreview" class="file-preview"></iframe>
										</div>	
									<!-- Garis Separator -->
									<hr class="my-4">
									<!-- Tombol -->
									<div class="row">
										<div class="text-end">
											<button type="submit" id="simpanLapor" class="btn btn-lapor mt-5">
												<i class="fas fa-paper-plane"></i> Lapor !
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row text-center process-wrapper justify-content-center">
			<div class="row text-center process-wrapper justify-content-center">
				<div class="col-md-3 process-step active">
					<div class="icon-wrapper">
						<i class="fas fa-edit fa-2x"></i>
					</div>
					<h5 class="p-b-10">Tulis Pengaduan</h5>
					<p>Laporkan keluhan anda dengan jelas dan lengkap.</p>
				</div>
				<div class="col-md-3 process-step">
					<div class="icon-wrapper">
						<i class="fas fa-tasks fa-2x"></i>
					</div>
					<h5 class="p-b-10">Proses Verifikasi</h5>
					<p>Dalam kurang dari 1 menit, pengaduan Anda akan diverifikasi oleh sistem dan diteruskan kepada instansi terkait.</p>
				</div>
				<div class="col-md-3 process-step">
					<div class="icon-wrapper">
						<i class="fas fa-comments fa-2x"></i>
					</div>
					<h5 class="p-b-10">Tanggapan</h5>
					<p>Dalam 2 hari kerja, pengaduan Anda akan ditanggapi oleh admin instansi terkait yang menerima pengaduan anda.</p>
				</div>
				<div class="col-md-3 process-step">
					<div class="icon-wrapper">
						<i class="fas fa-check-circle fa-2x"></i>
					</div>
					<h5 class="p-b-1">Selesai</h5>
					<p>Pengaduan Anda akan terus ditindaklanjuti hingga terselesaikan.</p>
				</div>
			</div>
			<div class="text-center">
				<a href="lacakPengaduan" class="btn btn-learn-more">
					<i class="fas fa-search"></i> Lacak Pengaduan Anda
				</a>
			</div>
		</div>
		
		<div class="banner">
			<h2>JUMLAH PENGADUAN SEKARANG</h2>
			<div class="instansi-container p-b-20">
				<div class="jumlah"></div>
			</div>
		</div>
		
		<div class="instansi-section p-b-5">
			<h2 class="p-b-10">INSTANSI TERHUBUNG</h2>
			<div class="instansi-container p-b-20">
				<div class="instansi-item" data-tipe="Dinas">
					<h3 class="count"></h3>
					<p>Dinas</p>
				</div>
				<div class="instansi-item" data-tipe="Lembaga">
					<h3 class="count"></h3>
					<p>Lembaga</p>
				</div>
				<div class="instansi-item" data-tipe="Kecamatan">
					<h3 class="count"></h3>
					<p>Kecamatan</p>
				</div>
				<div class="instansi-item" data-tipe="Desa">
					<h3 class="count"></h3>
					<p>Desa</p>
				</div>
			</div>
			<div class="text-center">
				<a href="instansiTerhubung" class="btn btn-learn-more">LIHAT SELENGKAPNYA</a>
			</div>
		</div>
    </section>
	
	<div class="modal fade" id="modalPanduan" tabindex="-1" aria-labelledby="pengaduanModalLabel">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content p-4">
				<!-- Header dengan garis pembatas -->
				<div class="modal-header border-bottom">
					<h5 class="modal-title w-100 text-center fw-bold">PANDUAN PENGISIAN PENGADUAN</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" autofocus></button>
				</div>
				<div class="modal-body text-center">
					<!-- Spinner saat loading -->
					<div id="loadingSpinner" class="my-3">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<p class="mt-2">Memuat panduan...</p>
					</div>
					<!-- Gambar panduan -->
					<img id="panduanImg" src="img/panduan.jpg" alt="Panduan Pengaduan" style="width:80%; height:60%; display:none; margin:auto;" />
				</div>
			</div>
		</div>
	</div>
@endsection