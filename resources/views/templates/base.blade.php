<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
	@include('includes.head')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<!--begin::App-->
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<!--begin::Header-->
			<div id="kt_app_header" class="app-header">
				<!--begin::Header container-->
				@include('includes.header')
				<!--end::Header container-->
			</div>
			<!--end::Header-->
			<!--begin::Wrapper-->
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!--begin::Sidebar-->
				<div id="sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
				@yield('sidebar')	
				</div>
				<!--end::Sidebar-->
				<!--begin::Main-->
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<!--begin::Content wrapper-->
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::Toolbar-->
						<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
							<!--begin::Toolbar container-->
							<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
									<!--begin::Title-->
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">@yield('breadcrumb')</h1>
									<!--end::Title-->
								</div>
								<!--end::Page title-->
								<!--begin::Actions-->

							</div>
							<!--end::Toolbar container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							@yield('content')
							<!--end: Card Body-->
						</div>
						<!--end::Tables widget 16-->
					</div>
					<!--end::Row-->

				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Content wrapper-->
		<!--begin::Footer-->
		<div id="kt_app_footer" class="app-footer">
			<!--begin::Footer container-->
			@include('includes.footer')
			<!--end::Footer container-->
		</div>
		<!--end::Footer-->
	</div>
	<!--end:::Main-->
	<!--Begin Modal Detail-->
	<div class="modal fade" tabindex="-1" id="modalDetailProfil" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
			<div class="modal-content">
				<!--Begin Modal-->
				<div class="modal-header">
					<h3 class="modal-title">Detail Pegawai</h3>
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
								<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
								<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
							</svg>
						</span>
					</div>
					<!--end::Close-->
				</div>

				<div class="modal-body text-start align-middle border-gray-200 fs-5 fw-semibold bg-lighten">
					<div class="row g-5">
						<div class="col-lg-12">
							<div class="card shadow-sm mb-5">
								<div class="card-body row">
									<div class="col-lg-6 d-flex flex-column">
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">NIP/NIPTT-PK</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailNipProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Nama</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailNamaProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">No. Telp</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailTelpProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Email</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailEmailProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Alamat</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailAlamatProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Jabatan</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailJabatanProfil"></label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 d-flex flex-column">
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Foto</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="col-lg-8">
													<div class="image-input image-input-outline" data-kt-image-input="true">
														<div class="image-input-wrapper w-125px h-125px" id="user-foto"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Instansi</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailInstansiProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Tanggal Daftar</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailTglDaftarProfil"></label>
												</div>
											</div>
										</div>
										<div class="row g-5">
											<div class="col-lg-4">
												<div class="mb-5">
													<label for="exampleFormControlInput1" class="form-label fs-5">Username</label>
												</div>
											</div>
											<div class="col-lg-8">
												<div>:
													<label for="exampleFormControlInput1" class="form-label fs-5" id="detailUsernameProfil"></label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="modalEditProfil" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!--Begin Modal-->
				<div class="modal-header">
					<h3 class="modal-title">Ubah Pengguna</h3>
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
								<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
								<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
							</svg>
						</span>
					</div>
					<!--end::Close-->
				</div>
				<div class="modal-body text-start align-middle border-gray-200 fs-5 fw-semibold bg-lighten">
					<div class="row g-5">
						<div class="col-lg-12">
							<div class="card shadow-sm mb-5">
								<div id="kt_docs_card_collapsible" class="collapse show">
									<div class="card-body">
										<form id="userFormEditProfile" enctype="multipart/form-data">
											@csrf
											<div class="row g-5">
												<div class="col-lg-12">
													<div class="mb-5">
														<label class="required d-block fw-semibold fs-6 mb-5">Foto</label>
														<div class="image-input image-input-outline" data-kt-image-input="true">
															<div class="image-input-wrapper w-125px h-125px" id="foto_preview"></div>
															<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
																   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Gambar">
																<i class="fa fa-pencil fs-7"></i>
																<input type="file" name="foto" id="fotoEdit" accept=".png, .jpg, .jpeg">
															</label>
															<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
																  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
																<i class="fa fa-trash fs-2"></i>
															</span>
														</div>
														<div class="form-text">Jenis file yang diperbolehkan: png, jpg, jpeg.</div>
													</div>
												</div>
												<!-- Kolom Kiri -->
												<div class="col-lg-12">
													<div class="mb-5">
														<label class="required form-label fs-5">NIP/NIPTT-PK</label>
														<input type="text" id="nipEditProfil" name="nip" class="form-control form-control-solid" placeholder="Nip" required>
													</div>
													<div class="mb-5">
														<label class="required form-label fs-5">Nama</label>
														<input type="text" id="namaEditProfil" name="nama" class="form-control form-control-solid" placeholder="Nama" autocomplete="name" required>
													</div>
													<div class="mb-5">
														<label class="required form-label fs-5">No. Telp</label>
														<input type="text" id="telpEditProfil" name="telp" class="form-control form-control-solid" placeholder="No Telp" autocomplete="tel" required>
													</div>
													<div class="mb-5">
														<label class="required fw-semibold fs-6 mb-2">Email</label>
														<input type="email" id="emailEditProfil" name="email" class="form-control form-control-solid" placeholder="Email" autocomplete="email" required>
													</div>
													<div class="mb-5">
														<label class="required form-label fs-5">Alamat</label>
														<textarea id="alamatEditProfil" name="alamat" class="form-control form-control-solid" rows="3" placeholder="Alamat" autocomplete="street-address" required></textarea>
													</div>
												</div>
											</div>
											<div class="separator border-dark my-10"></div>
											<div class="modal-footer">
												<button type="button" id="saSimpanEditProfil" class="btn btn-primary" data-id="{{ Auth::user()->id }}">Simpan</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
											</div>	
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Edit-->
	
	<!--begin::Javascript-->
	<script>
		var hostUrl = "/assets/";
	</script>

	<!--begin::Custom Javascript(used for this page only)-->
	<script src="/assets/js/scripts.bundle.js"></script>
	<script src="/assets/js/widgets.bundle.js"></script>
	<script src="/assets/js/custom/widgets.js"></script>
	<script src="/tinymce/tinymce/tinymce.min.js"></script>
	<!--end::Custom Javascript-->

	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="/assets/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<script src="/assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
	<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->

	<script> $("#kt_daterangepicker_1").daterangepicker(); </script>
	<script> $("#kt_datepicker_1").flatpickr(); </script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Menangani input pencarian dengan event delegation
			document.addEventListener("input", function (event) {
				if (event.target && event.target.id === "search-input") {
					searchTable(event.target.value.toLowerCase());
				}
			});
		});

		function searchTable(input) {
			// Mengambil referensi DataTable yang sudah diinisialisasi
			let table = $('#myTable').DataTable();
			
			// Menggunakan API DataTables untuk melakukan pencarian
			table.search(input).draw();
		}
	</script>
	<script>
	document.addEventListener("DOMContentLoaded", function () { 
		// 1️⃣ SETUP DATATABLES (PAGINATION)
		let table = $('#myTable').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"pageLength": 10,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
			"language": {
				"zeroRecords": "Tidak ada data ditemukan",
				"info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
				"infoEmpty": "Menampilkan 0 hingga 0 dari 0 data",
				"infoFiltered": "(Di Filter dari _MAX_ total data)",
				"search": "Cari:",
				"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
				}
			}
		});
	});
	</script>
	<!-- Begin Tiny MCE-->
	<script>
		tinymce.init({
			selector: "#kt_docs_tinymce_hidden",
			height: "200",
			menubar: false,
			toolbar: [
				"styleselect fontselect fontsizeselect",
				"undo redo | cut copy paste | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist"
			],
			plugins: "advlist autolink link image lists charmap",
			forced_root_block: false, // Mencegah TinyMCE menambahkan tag <p> secara otomatis
			setup: function (editor) {
				editor.on('change', function () {
					let content = editor.getContent();
					// Hapus semua tag HTML menggunakan regex
					content = content.replace(/<\/?[^>]+(>|$)/g, ""); 
					editor.setContent(content); // Simpan kembali ke editor tanpa tag HTML
				});
			}
		});
	</script>
	<!-- End Tiny MCE-->
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
			if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<script>
		function fetchCounts() {
			const ids = [
				"countDiajukan", "countDiproses", "countSelesai",
				"countTidakDiproses", "countPegawai"
			];

			// Tampilkan teks "Loading..." jika elemen ada
			ids.forEach(id => {
				let element = document.getElementById(id);
				if (element) element.innerHTML = "Loading...";
			});

			fetch('/beranda/count')
				.then(response => response.json())
				.then(data => {
					ids.forEach(id => {
						let element = document.getElementById(id);
						if (element) element.innerHTML = data[id] ?? "0"; // Jika data null, tampilkan "0"
					});
				})
				.catch(error => {
					console.error('❌ ERROR:', error);
					ids.forEach(id => {
						let element = document.getElementById(id);
						if (element) element.innerHTML = "Error!";
					});
				});
		}

		// Jalankan pertama kali saat halaman dimuat
		document.addEventListener("DOMContentLoaded", fetchCounts);

		// Jalankan setiap 1 jam (3600000 ms) untuk memperbarui data
		setInterval(fetchCounts, 3600000);
	</script>
	<!--begin:: Profil-->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			document.querySelectorAll(".btnProfil").forEach(button => {
				button.addEventListener("click", function () {
					let userId = this.getAttribute("data-id");

					fetch(`/users/show/${userId}`)
						.then(response => response.json())
						.then(data => {
							// Mengisi data ke dalam modal sesuai dengan ID di HTML
							document.querySelector("#detailNipProfil").textContent = data.nip;
							document.querySelector("#detailNamaProfil").textContent = data.nama;
							document.querySelector("#detailTelpProfil").textContent = data.telp;
							document.querySelector("#detailEmailProfil").textContent = data.email;
							document.querySelector("#detailAlamatProfil").textContent = data.alamat;
							document.querySelector("#detailUsernameProfil").textContent = data.username;
							document.querySelector("#detailJabatanProfil").innerHTML = getBadgeJabatan(data.jabatan);
							document.querySelector("#detailInstansiProfil").textContent = data.instansi ? data.instansi.nama : "Tidak ada instansi";
							document.querySelector("#detailTglDaftarProfil").textContent = "Dibuat, " + formatTanggalJam(data.tgl_buat);

							// Menampilkan foto pengguna
							let fotoElement = document.querySelector("#user-foto");
							fotoElement.style.backgroundImage = data.foto ? `url('/storage/foto/${data.foto}')` : "url('/storage/foto/default.png')";

							// Menampilkan modal
							let modal = new bootstrap.Modal(document.getElementById("modalDetailProfil"));
							modal.show();
						})
						.catch(error => console.error("Error fetching data:", error));
				});
			});
		});

		// Fungsi untuk mendapatkan badge berdasarkan jabatan
		function getBadgeJabatan(jabatan) {
			switch (jabatan) {
				case "Super user": return '<span class="badge badge-success fs-5 text-info">Administrator</span>';
				case "Kepala": return '<span class="badge badge-primary fs-5 text-info">Kepala Unit</span>';
				case "Admin": return '<span class="badge badge-warning fs-5 text-info">Staf</span>';
				default: return '<span class="badge badge-secondary fs-5 text-info">Tidak Diketahui</span>';
			}
		}

		// Fungsi untuk memformat tanggal dan jam ke Bahasa Indonesia
		function formatTanggalJam(tanggal) {
			if (!tanggal) return "-";

			let date = new Date(tanggal);

			// Format tanggal (day, month, year) dan jam (hour, minute, second)
			return new Intl.DateTimeFormat("id-ID", { 
				day: "numeric", 
				month: "long", 
				year: "numeric", 
				hour: "2-digit", 
				minute: "2-digit", 
				second: "2-digit", 
				hour12: false // Menggunakan format 24 jam
			}).format(date);
		}
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const btnPengaturan = document.getElementById("btnPengaturan");
			const form = document.getElementById("userFormEditProfile");
			const btnSimpan = document.getElementById("saSimpanEditProfil");
			const fotoInput = document.getElementById("fotoEdit");
			const fotoPreview = document.getElementById("foto_preview");
			
			 // ✅ Event Saat Tombol "Pengaturan" Diklik
			btnPengaturan.addEventListener("click", function () {
				let userId = this.getAttribute("data-id");

				// ✅ Ambil data user dan tampilkan di form edit
				fetch(`/users/show/${userId}`)
					.then(response => response.json())
					.then(data => {
						document.getElementById("nipEditProfil").value = data.nip;
						document.getElementById("namaEditProfil").value = data.nama;
						document.getElementById("telpEditProfil").value = data.telp;
						document.getElementById("emailEditProfil").value = data.email;
						document.getElementById("alamatEditProfil").value = data.alamat;
						fotoPreview.style.backgroundImage = data.foto ? `url('/storage/foto/${data.foto}')` : "url('/storage/foto/default.png')";

						// ✅ Tampilkan modal
						let modal = new bootstrap.Modal(document.getElementById("modalEditProfil"));
						modal.show();
					})
					.catch(error => console.error("Error fetching data:", error));
			});

			// ✅ Preview Foto Sebelum Upload
			fotoInput.addEventListener("change", function (event) {
				const file = event.target.files[0];
				if (file) {
					const reader = new FileReader();
					reader.onload = function (e) {
						fotoPreview.style.backgroundImage = `url(${e.target.result})`;
					};
					reader.readAsDataURL(file);
				}
			});

			// ✅ Event Saat Tombol "Simpan" Diklik
			btnSimpan.addEventListener("click", function () {
				let nip = document.getElementById("nipEditProfil").value.trim();
				let nama = document.getElementById("namaEditProfil").value.trim();
				let telp = document.getElementById("telpEditProfil").value.trim();
				let email = document.getElementById("emailEditProfil").value.trim();
				let alamat = document.getElementById("alamatEditProfil").value.trim();
				let foto = fotoInput.files[0];

				// Validasi NIP (Harus 16 digit angka)
				if (nip === "" || !/^\d{16}$/.test(nip)) {
					Swal.fire({
						title: "Peringatan!",
						text: "NIP harus terdiri dari 16 digit angka!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
					return;
				}

				// Validasi Nama (Hanya huruf dan spasi)
				if (nama === "" || !/^[a-zA-Z\s]+$/.test(nama)) {
					Swal.fire({
						title: "Peringatan!",
						text: "Nama hanya boleh berisi huruf dan spasi!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
					return;
				}

				// Validasi No Telp (10-15 digit angka)
				if (telp === "" || !/^\d{10,15}$/.test(telp)) {
					Swal.fire({
						title: "Peringatan!",
						text: "No. Telp harus terdiri dari 10 hingga 15 digit angka!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
					return;
				}

				// Validasi Email
				let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				if (email === "" || !emailPattern.test(email)) {
					Swal.fire({
						title: "Peringatan!",
						text: "Format email tidak valid!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
					return;
				}
				
				// ✅ Validasi Alamat (Tidak boleh kosong)
				if (alamat.length === 0) {
					Swal.fire({
						title: "Peringatan!",
						text: "Alamat tidak boleh kosong!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
					return;
				}

				// ✅ Validasi Foto (Jika ada, harus PNG, JPG, atau JPEG)
				if (foto) {
					let allowedExtensions = ["image/png", "image/jpg", "image/jpeg"];
					if (!allowedExtensions.includes(foto.type)) {
						Swal.fire({
						title: "Peringatan!",
						text: "Format foto harus PNG, JPG, atau JPEG!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
					});
						return;
					}
				}

				// ✅ Konfirmasi sebelum mengirim data
				Swal.fire({
					title: "Konfirmasi",
					text: "Apakah Anda yakin ingin menyimpan perubahan?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Ya, Simpan!",
					cancelButtonText: "Batal"
				}).then((result) => {
					if (result.isConfirmed) {
						
						// Tampilkan loading sebelum request dikirim
						Swal.fire({
							title: "Mohon Tunggu...",
							text: "Data sedang diproses...",
							allowOutsideClick: false,
							didOpen: () => {
								Swal.showLoading();
							}
						});
						
						// ✅ Mengirim Data dengan Fetch API
						let formData = new FormData(form);
						
						fetch("/users/updateProfile", {
							method: "POST",
							body: formData,
							headers: {
								"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
							}
						})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								Swal.fire({
									title: "Berhasil!",
									text: data.message, // Gunakan pesan yang dikirim dari server
									icon: "success",
									confirmButtonText: "Oke"
								}).then(() => location.reload()); // Refresh halaman setelah OK ditekan
							} else {
								Swal.fire("Gagal!", data.message, "error");
							}
						})
						.catch(error => {
							Swal.fire({
								title: "Error!",
								text: "Terjadi kesalahan, coba lagi nanti!", // Gunakan pesan yang dikirim dari server
								icon: "error",
								confirmButtonText: "Oke, Mengerti"
							})
							console.error("Error:", error);
						});
					}
				});
			});
		});
	</script>
	<!--end:: Profile-->
	<!--begin:: Pengaduan-->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Event delegation untuk menangani klik tombol detail
			document.body.addEventListener("click", function (event) {
				if (event.target.classList.contains("btnDetailPengaduan")) {
					let userId = event.target.getAttribute("data-id");

					fetch(`/pengaduan/${userId}`)
						.then(response => response.json())
						.then(data => {
							// Isi data ke dalam modal
							document.querySelector("#detailKodeFormulirPengaduan").textContent = data.kode_formulir;
							document.querySelector("#detailNikPengaduan").textContent = data.nik;
							document.querySelector("#detailNamaPengaduan").textContent = data.nama;
							document.querySelector("#detailTelpPengaduan").textContent = data.telp;
							document.querySelector("#detailEmailPengaduan").textContent = data.email;
							document.querySelector("#detailAlamatPengaduan").textContent = data.alamat;
							document.querySelector("#detailTglKejadianPengaduan").textContent = formatTanggal(data.tgl_kejadian);
							document.querySelector("#detailTglDiajukanPengaduan").textContent = "Dibuat, " + formatTanggalJam(data.tgl_buat);
							document.querySelector("#detailInstansiPengaduan").textContent = data.instansi ? data.instansi.nama : "Tidak ada instansi";
							document.querySelector("#detailKategoriPengaduan").innerHTML = getBadgeKategori(data.kategori);
							document.querySelector("#detailPlatformPengaduan").innerHTML = getBadgePlatform(data.via_wa);
							document.querySelector("#detailStatusPengaduan").innerHTML = getBadgeStatus(data.status);
							document.querySelector("#detailJudulPengaduan").textContent = data.judul;
							document.querySelector("#detailIsiPengaduan").textContent = data.isi;

							function stripHtml(html) {
								return html.replace(/<[^>]*>?/gm, '');
							}

							// Menampilkan tanggapan
							if (data.tanggapan.length > 0) {
								let tanggapan = data.tanggapan[0];
								document.querySelector("#detailTglDitanggapiPengaduan").textContent =
									tanggapan.tgl_ditanggapi ? formatTanggal(tanggapan.tgl_ditanggapi) : "Belum ada Tanggapan";
								document.querySelector("#detailIsiTanggapanPengaduan").textContent =
									tanggapan.isi_tanggapan ? stripHtml(tanggapan.isi_tanggapan) : "Belum ada Tanggapan";
								document.querySelector("#detailPegawaiPengaduan").textContent =
									tanggapan.user && tanggapan.user.nama ? tanggapan.user.nama : "Belum ada Tanggapan";
							} else {
								document.querySelector("#detailTglDitanggapiPengaduan").textContent = "Belum ada Tanggapan";
								document.querySelector("#detailIsiTanggapanPengaduan").textContent = "Belum ada Tanggapan";
								document.querySelector("#detailPegawaiPengaduan").textContent = "Belum ada Tanggapan";
							}

							// Menampilkan bukti pendukung
							let container = document.querySelector("#file-container");
							container.innerHTML = "";

							if (data.bukti) {
								let filePath = `/storage/bukti/${data.bukti}`;
								let fileExtension = data.bukti.split('.').pop().toLowerCase();

								if (["jpg", "jpeg", "png", "gif", "webp"].includes(fileExtension)) {
									container.innerHTML = `
										<img src="${filePath}" alt="Bukti Pengaduan" class="bukti-img" style="max-width: 100%; height: auto; cursor: pointer;">
										<div id="modalImage" class="modal fade" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h3 class="modal-title">Pratinjau Bukti</h3>
														<!--begin::Close-->
														<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
																	<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
																	<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
																</svg>
															</span>
														</div>
														<!--end::Close-->
													</div>
													<div class="modal-body text-center">
														<img src="${filePath}" alt="Bukti Pengaduan" style="max-width: 100%;">
													</div>
												</div>
											</div>
										</div>`;

									// Event listener untuk membuka modal gambar
									document.querySelector(".bukti-img").addEventListener("click", function () {
									let imageModal = new bootstrap.Modal(document.getElementById("modalImage"));
										imageModal.show();
									});

								} else if (["mp4", "webm", "ogg"].includes(fileExtension)) {
									container.innerHTML = `
										<video controls style="max-width: 100%; height: auto;">
											<source src="${filePath}" type="video/${fileExtension}">
											Browser Anda tidak mendukung tag video.
										</video>`;
								} else if (fileExtension === "pdf") {
									container.innerHTML = `
										<a href="${filePath}" class="btn btn-primary mt-2" target="_blank" download>
											Download PDF
										</a>`;
								} else {
									container.innerHTML = `<p class="text-danger">Format file tidak didukung.</p>`;
								}
							} else {
								container.innerHTML = `<p class="text-danger">Bukti tidak tersedia</p>`;
							}

							// Menampilkan modal utama
							let modalElement = document.getElementById("modalDetailPengaduan");
							if (!modalElement) {
								console.error("Modal tidak ditemukan!");
								return;
							}

							modalElement.removeAttribute("aria-hidden");
							modalElement.style.display = "block";

							let modal = bootstrap.Modal.getOrCreateInstance(modalElement);
							modal.show();
						})
						.catch(error => console.error("Error fetching data:", error));
				}
			});
		});

		// Fungsi untuk mendapatkan badge berdasarkan Kategori
		function getBadgeKategori(kategori) {
			switch (kategori) {
				case "Asli": return '<span class="badge badge-success fs-5">Asli</span>';
				case "Spam": return '<span class="badge badge-danger fs-5">Spam</span>';
				default: return '<span class="badge badge-secondary fs-5">Tidak Diketahui</span>';
			}
		}
		
		// Fungsi untuk mendapatkan badge berdasarkan Platform
		function getBadgePlatform(via_wa) {
			switch (parseInt(via_wa)) {
				case 0: return '<span class="fs-5"><i class="fa fa-globe text-primary fs-3"></i> Website</span>';
				case 1: return '<span class="fs-5"><i class="fa-brands fa-whatsapp text-success fs-3"></i> Whatsapp</span>';
				default: return '<span class="badge badge-secondary fs-5">Tidak Diketahui</span>';
			}
		}

		// Fungsi untuk mendapatkan badge berdasarkan Status
		function getBadgeStatus(status) {
			switch (status) {
				case "Selesai": return '<span class="badge badge-primary fs-5">Selesai</span>';
				case "Diproses": return '<span class="badge badge-success fs-5">Diproses</span>';
				case "Tidak diproses": return '<span class="badge badge-danger fs-5">Tidak Diproses</span>';
				case "Diajukan": return '<span class="badge badge-info fs-5">Diajukan</span>';
				default: return '<span class="badge badge-secondary fs-5">Tidak Diketahui</span>';
			}
		}

		// Fungsi untuk memformat tanggal ke Bahasa Indonesia
		function formatTanggal(tanggal) {
			if (!tanggal) return "-";
			let date = new Date(tanggal);
			return new Intl.DateTimeFormat("id-ID", { day: "numeric", month: "long", year: "numeric" }).format(date);
		}
		
		// Fungsi untuk memformat tanggal dan jam ke Bahasa Indonesia
		function formatTanggalJam(tanggal) {
			if (!tanggal) return "-";

			let date = new Date(tanggal);

			// Format tanggal (day, month, year) dan jam (hour, minute, second)
			return new Intl.DateTimeFormat("id-ID", { 
				day: "numeric", 
				month: "long", 
				year: "numeric", 
				hour: "2-digit", 
				minute: "2-digit", 
				second: "2-digit", 
				hour12: false // Menggunakan format 24 jam
			}).format(date);
		}
	</script>
	<script>
		$(document).ready(function() {
			$('#formTanggapan').on('submit', function(event) {
				event.preventDefault(); // Mencegah reload halaman

				// Ambil teks dari TinyMCE
				let tanggapan = tinymce.get('kt_docs_tinymce_hidden').getContent().trim();

				// Validasi: Cek apakah tanggapan kosong
				if (tanggapan === "") {
					Swal.fire({
						title: "Peringatan!",
						text: "Form tidak boleh kosong. Harap isi semua data",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti"
					});
					return;
				}

				// Simpan teks TinyMCE ke dalam <textarea>
				$('textarea[name="isi_tanggapan"]').val(tanggapan);
				
				// Tampilkan loading sebelum request dikirim
				Swal.fire({
					title: "Mohon Tunggu...",
					text: "Data sedang diproses...",
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});

				$.ajax({
					url: "/tanggapan",
					type: "POST",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: $(this).serialize(),
					dataType: "json",
					success: function(response) {
						if (response.success) {
							Swal.fire({
								title: "Berhasil!",
								text: response.message,
								icon: "success",
								confirmButtonText: "Oke"
							}).then(() => {
								// Redirect ke halaman tanggapan.index setelah klik "OKE"
								window.location.href = "/pengaduan";
							});
						}
					},
					error: function(xhr) {
						let errors = xhr.responseJSON.errors;
						let errorMessages = "";

						$.each(errors, function(key, value) {
							errorMessages += value[0] + "\n";
						});

						Swal.fire({
							title: "Gagal!",
							text: errorMessages,
							icon: "error",
							confirmButtonText: "Oke, Mengerti"
						});
					}
				});
			});
		});
	</script>
	<!--end:: Pengaduan-->
	<!--begin:: Instansi-->
	<script>
		$(document).ready(function () {
			$(document).on("shown.bs.modal", "#modalTambahInstansi", function () {
				let tipeSelect = document.getElementById("instansiTipeSelectTambah");
				let indukSelect = document.getElementById("instansiIndukSelectTambah");

				if (tipeSelect) {
					$(tipeSelect).select2({
						placeholder: "Pilih Tipe Instansi",
						allowClear: true,
						width: '100%',
						minimumInputLength: 0,
						dropdownParent: $('#modalTambahInstansi'),
						language: { searching: () => "Mencari..." }
					});
				}

				if (indukSelect) {
					$(indukSelect).select2({
						placeholder: "Pilih Induk Instansi",
						allowClear: true,
						width: '100%',
						minimumInputLength: 0,
						dropdownParent: $('#modalTambahInstansi'),
						language: { searching: () => "Mencari..." }
					});
				}
			});

			$(document).on("click", "#saSimpanTambahInstansi", function (event) {
				event.preventDefault();
				processForm("instansiFormTambah");
			});
		});
		
		function getFormattedDateTime() {
			const now = new Date();
			const options = { 
				year: "numeric", month: "long", day: "numeric", 
				hour: "2-digit", minute: "2-digit", second: "2-digit" 
			};
			return now.toLocaleString("id-ID", options);
		}

		function processForm(formId) {
			let form = document.getElementById(formId);
			if (!form) {
				console.error(`Form #${formId} tidak ditemukan!`);
				return;
			}

			let namaInput = form.querySelector("input[name='nama']");
			let tipeInput = form.querySelector("select[name='tipe']");
			let indukInput = form.querySelector("select[name='induk']");

			if (!namaInput || !tipeInput || !indukInput) {
				console.error("Salah satu elemen input tidak ditemukan!");
				return;
			}

			let nama = namaInput.value.trim();
			let tipe = tipeInput.value;
			let induk = indukInput.value;

			if (nama === "" || tipe === "" || induk === "") {
				Swal.fire({
					title: "Peringatan!",
					text: "Form tidak boleh kosong. Harap isi semua data!",
					icon: "warning",
					confirmButtonText: "Oke, Mengerti",
				});
				return;
			}

			if (!/^[a-zA-Z\s]+$/.test(nama)) {
				Swal.fire({
					title: "Peringatan!",
					text: "Nama hanya boleh berisi huruf dan spasi!",
					icon: "warning",
					confirmButtonText: "Oke, Mengerti",
				});
				return;
			}

			Swal.fire({
				title: "Mohon Tunggu...",
				text: "Data sedang diproses...",
				allowOutsideClick: false,
				didOpen: () => Swal.showLoading(),
			});

			fetch("/instansi", {
				method: "POST",
				body: new FormData(form),
				headers: {
					"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
					"Accept": "application/json"
				}
			})
			.then(response => {
				if (!response.ok) throw new Error("Server error saat menyimpan data!");
				return response.json();
			})
			.then(data => {
				Swal.close();
				Swal.fire({
					title: data.success ? "Berhasil!" : "Gagal!",
					text: data.success ? `Data instansi berhasil ditambahkan pada ${getFormattedDateTime()}!` : (data.message || "Terjadi kesalahan saat menyimpan data!"),
					icon: data.success ? "success" : "error",
					confirmButtonText: "OKE"
				}).then(() => { if (data.success) location.reload(); });
			})
			.catch(error => {
				Swal.close();
				Swal.fire({
					title: "Error!",
					text: error.message || "Terjadi kesalahan pada server!",
					icon: "error",
					confirmButtonText: "Oke, Mengerti"
				});
				console.error("Error:", error);
			});
		}
	</script>
	<script>
		$(document).ready(function () {
			// Event delegation untuk inisialisasi Select2 dalam DataTables dengan pagination
			$(document).on("shown.bs.modal", "#modalEditInstansi", function () {
				// Cek apakah Select2 sudah diinisialisasi untuk mencegah duplikasi
				if (!$.fn.select2 || $("#instansiTipeSelectEdit").data("select2")) {
					return;
				}

				// Inisialisasi Select2 untuk Tipe Instansi dengan fitur pencarian
				$("#instansiTipeSelectEdit").select2({
					placeholder: "Pilih Tipe Instansi",
					allowClear: true,
					width: "100%",
					minimumInputLength: 0, // Aktifkan pencarian setelah 1 karakter diketik
					dropdownParent: $("#modalEditInstansi"), // Pastikan dropdown tetap di dalam modal
					language: {
						searching: function () {
							return "Mencari...";
						}
					}
				});

				// Inisialisasi Select2 untuk Induk Instansi dengan fitur pencarian
				$("#instansiIndukSelectEdit").select2({
					placeholder: "Pilih Induk Instansi",
					allowClear: true,
					width: "100%",
					minimumInputLength: 0, // Aktifkan pencarian setelah 1 karakter diketik
					dropdownParent: $("#modalEditInstansi"),
					language: {
						searching: function () {
							return "Mencari...";
						}
					}
				});
			});

			// Event delegation saat tombol edit diklik
			$(document).on("click", '[data-bs-target="#modalEditInstansi"]', function () {
				var idInstansi = $(this).data("id");

				// Ambil data instansi berdasarkan ID
				$.ajax({
					url: "/instansi/" + idInstansi + "/edit",
					type: "GET",
					dataType: "json",
					success: function (response) {
						console.log("Respons API:", response); // Debugging
						
						if (response.success) {
							var instansi = response.data;

							// Set nilai di form edit
							$("#idInstansiEdit").val(instansi.id);
							$("#namaEdit").val(instansi.nama);

							// Atur nilai instansi di Select2
							$("#instansiTipeSelectEdit").val(instansi.tipe).trigger("change");

							// Atur nilai jabatan di Select2
							$("#instansiIndukSelectEdit").val(instansi.induk).trigger("change");

							// Tampilkan modal edit
							$("#modalEditInstansi").modal("show");
						} else {
							Swal.fire({
								icon: "error",
								title: "Oops...",
								text: "Data Instansi tidak ditemukan!"
							});
						}
					},
					error: function () {
						Swal.fire({
							icon: "error",
							title: "Gagal!",
							text: "Terjadi kesalahan saat mengambil data Instansi."
						});
					}
				});
			});

			// Event Delegation submit form edit instansi
			$(document).on('click', '#saSimpanEditInstansi', function () {
				var idInstansi = $("#idInstansiEdit").val();
				var formData = new FormData($("#instansiFormEdit")[0]);

				formData.append("_method", "PUT");
				formData.append("nama", $("#namaEdit").val());
				formData.append("tipe", $("#instansiTipeSelectEdit").val());
				formData.append("induk", $("#instansiIndukSelectEdit").val());

				Swal.fire({
					title: "Mohon Tunggu...",
					text: "Data sedang diproses...",
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});

				$.ajax({
					url: "/instansi/" + idInstansi,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					headers: {
						"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
					},
					success: function (response) {
						console.log("Respons API:", response); // Debugging
						
						if (response.success) {
							let currentDate = new Date();
							let formattedDate = currentDate.toLocaleDateString("id-ID", {
								year: "numeric",
								month: "long",
								day: "numeric"
							});
							let formattedTime = currentDate.toLocaleTimeString("id-ID");

							Swal.fire({
								title: "Berhasil!",
								text: `Data instansi berhasil diupdate pada tanggal ${formattedDate} & jam ${formattedTime}`,
								icon: "success",
								confirmButtonText: "OKE"
							}).then(() => {
								location.reload();
							});

							setTimeout(() => location.reload(), 1500);
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal!",
								text: response.message || "Gagal memperbarui data instansi."
							});
						}
					},
					error: function (xhr) {
						console.log("Error:", xhr.responseText); // Debugging

						Swal.fire({
							icon: "error",
							title: "Terjadi Kesalahan!",
							text: "Terjadi kesalahan saat menyimpan data. Silakan coba lagi.",
							footer: `<pre>${xhr.responseText}</pre>` // Menampilkan error dari server (opsional)
						});
					}
				});
			});
		});
	</script>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.addEventListener('click', function (event) {
			if (event.target.closest('.deleteInstansi')) {
				let button = event.target.closest('.deleteInstansi'); 
				let instansiId = button.getAttribute('data-id');

				Swal.fire({
					html: "Apakah Anda yakin ingin menghapus Data Ini?",
					icon: "question",
					buttonsStyling: false,
					showCancelButton: true,
					confirmButtonText: "Ya, Hapus!",
					cancelButtonText: 'Batal',
					customClass: {
						confirmButton: "btn btn-danger",
						cancelButton: 'btn btn-secondary'
					}
				}).then((result) => {
					if (result.isConfirmed) {
						// Kirim AJAX DELETE request ke server
						fetch(`/instansi/${instansiId}`, {
							method: "DELETE",
							headers: {
								"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
								"Content-Type": "application/json"
							}
						})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								Swal.fire({
									title: "Berhasil!",
									html: `Data Instansi telah berhasil dihapus pada tanggal <b>${data.tanggal}</b> & jam <b>${data.jam}</b>.`,
									icon: "success",
									confirmButtonText: "Oke, Mengerti"
								}).then(() => {
									location.reload(); // Reload halaman setelah menghapus
								});
							} else {
								Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
							}
						})
						.catch(error => {
							console.error("Error:", error);
							Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus.", "error");
						});
					}
				});
			}
		});
	});
	</script>
	<!--end:: Instansi-->
	<!--begin:: Pegawai-->
	<script>
		$(document).ready(function () {
			// 🔹 Inisialisasi Select2 saat modal ditampilkan
			$(document).on("shown.bs.modal", "#modalTambahPegawai", function () {
				// 🔹 Inisialisasi Select2 untuk Instansi dengan AJAX (pencarian dinamis)
				$('#instansiSelectTambah').select2({
					placeholder: "Pilih Instansi",
					allowClear: true,
					dropdownParent: $("#modalTambahPegawai"), // Pastikan dropdown tampil dalam modal
					language: {
						noResults: function () {
							return "Data tidak ditemukan";
						},
						searching: function () {
							return "Sedang mencari...";
						}
					},
					ajax: {
						url: '/instansi',
						dataType: 'json',
						delay: 250,
						data: function (params) {
							return { search: params.term };
						},
						processResults: function (data) {
							return {
								results: $.map(data, function (item) {
									return { id: item.id, text: item.nama };
								})
							};
						}
					}
				});

				// 🔹 Inisialisasi Select2 untuk Jabatan (Statis dengan Search)
				$('#jabatanSelectTambah').select2({
					placeholder: "Pilih Jabatan",
					allowClear: true,
					dropdownParent: $("#modalTambahPegawai"),
					minimumResultsForSearch: 0 // 🔥 Memungkinkan pencarian meskipun datanya statis
				});
			});

			// 🔹 Event delegation untuk tombol Simpan Tambah
			$(document).on("click", "#saSimpanTambahPegawai", function (event) {
				event.preventDefault();
				handleSubmit(event);
			});

			function handleSubmit(event) {
				event.preventDefault(); // 🔹 Mencegah submit sebelum validasi

				let form = document.getElementById("pegawaiFormTambah");
				if (!form) {
					console.error("❌ ERROR: Form pegawai tidak ditemukan!");
					return;
				}

				let formData = new FormData(form);
				let nip = form.querySelector("#nipTambah").value.trim();
				let nama = form.querySelector("#namaTambah").value.trim();
				let telp = form.querySelector("#telpTambah").value.trim();
				let email = form.querySelector("#emailTambah").value.trim();
				let alamat = form.querySelector("textarea[name='alamat']").value.trim();
				let id_instansi = form.querySelector("#instansiSelectTambah").value;
				let jabatan = form.querySelector("#jabatanSelectTambah").value;
				let username = form.querySelector("#usernameTambah").value.trim();
				let password = form.querySelector("#passwordTambah").value;
				let password_confirmation = form.querySelector("#passwordConfirmationTambah").value;
				let role = document.querySelector('input[name="role"]:checked');

				// 🔹 Validasi
				if (!nip || !nama || !telp || !email || !alamat || !id_instansi || !jabatan || !username || !password || !password_confirmation || !role) {
					Swal.fire({
						title: "Peringatan!",
						text: "Form tidak boleh kosong. Harap isi semua data!",
						icon: "warning",
						confirmButtonText: "Oke, Mengerti",
					});
					return;
				}

				// 🔹 Validasi tambahan
				if (!/^\d{16}$/.test(nip)) {
					showValidationError("NIP harus 16 digit angka!");
					return;
				}

				if (!/^[a-zA-Z\s]+$/.test(nama)) {
					showValidationError("Nama hanya boleh berisi huruf dan spasi!");
					return;
				}

				if (!/^\d{10,15}$/.test(telp)) {
					showValidationError("No. Telepon harus 10-15 digit angka!");
					return;
				}

				let emailPattern = /^[^\s@]+@[^\s@]+$/;
				if (!emailPattern.test(email)) {
					showValidationError("Format email tidak valid!");
					return;
				}

				let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
				if (!passwordPattern.test(password)) {
					showValidationError("Password minimal 8 karakter dengan huruf, angka, dan simbol!");
					return;
				}

				if (password !== password_confirmation) {
					showValidationError("Konfirmasi password tidak cocok!");
					return;
				}

				if (!id_instansi || !jabatan) {
					showValidationError("Harap pilih Instansi dan Jabatan sebelum menyimpan!");
					return;
				}

				// 🔹 Validasi jika NIP atau Username sudah ada di database
				checkNipAndUsername(nip, username).then((exists) => {
					if (exists.nip_exists) {
						showValidationError("NIP sudah terdaftar!");
						return;
					}

					if (exists.username_exists) {
						showValidationError("Username sudah digunakan!");
						return;
					}

					// 🔹 Jika valid, kirim form
					submitForm(formData);
				}).catch(error => {
					console.error("❌ ERROR:", error);
					Swal.fire({
						title: "Error!",
						text: "Gagal memeriksa NIP dan Username!",
						icon: "error",
						confirmButtonText: "Oke, Mengerti",
					});
				});
			}

			function showValidationError(message) {
				Swal.fire({
					title: "Peringatan!",
					text: message,
					icon: "warning",
					confirmButtonText: "Oke, Mengerti",
				});
			}

			function checkNipAndUsername(nip, username) {
				return fetch("/users/check-nip", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
					},
					body: JSON.stringify({ nip, username })
				})
				.then(response => {
					if (!response.ok) throw new Error("Server error saat memeriksa data!");
					return response.json();
				});
			}
			
			function getFormattedDateTime() {
				const now = new Date();
				const options = { 
					year: "numeric", month: "long", day: "numeric", 
					hour: "2-digit", minute: "2-digit", second: "2-digit" 
				};
				return now.toLocaleString("id-ID", options);
			}
			
			function submitForm(formData) {
				Swal.fire({
					title: "Mohon Tunggu...",
					text: "Data sedang diproses...",
					allowOutsideClick: false,
					didOpen: () => Swal.showLoading(),
				});

				fetch("/users", {
					method: "POST",
					body: formData,
					headers: {
						"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
						"Accept": "application/json",
					}
				})
				.then(response => response.json())
				.then(data => {
					Swal.fire({
						title: "Berhasil!",
						text: `Data Pegawai berhasil ditambahkan pada ${getFormattedDateTime()}!`,
						icon: "success",
						confirmButtonText: "Oke",
					}).then(() => location.reload());

				})
				.catch(error => {
					console.error("❌ ERROR:", error);
					Swal.fire({
						title: "Error!",
						text: "Terjadi kesalahan saat menyimpan data!",
						icon: "error",
						confirmButtonText: "Oke, Mengerti",
					});
				});
			}
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Menggunakan event delegation untuk menangani klik tombol detail pegawai
			document.addEventListener("click", function (event) {
				if (event.target.classList.contains("btnDetailPegawai")) {
					let userId = event.target.getAttribute("data-id");

					fetch(`/users/${userId}`)
						.then(response => response.json())
						.then(data => {
							// Mengisi data ke dalam modal
							document.querySelector("#detailNipPegawai").textContent = data.nip;
							document.querySelector("#detailNamaPegawai").textContent = data.nama;
							document.querySelector("#detailTelpPegawai").textContent = data.telp;
							document.querySelector("#detailEmailPegawai").textContent = data.email;
							document.querySelector("#detailAlamatPegawai").textContent = data.alamat;
							document.querySelector("#detailUsernamePegawai").textContent = data.username;
							document.querySelector("#detailHakAksesPegawai").innerHTML = getBadgeRole(data.role);
							document.querySelector("#detailJabatanPegawai").innerHTML = getBadgeJabatan(data.jabatan);
							document.querySelector("#detailInstansiPegawai").textContent = data.instansi ? data.instansi.nama : "Tidak ada instansi";
							document.querySelector("#detailAktivitasLoginPegawai").textContent = "Terakhir Login, " + formatTanggalJam(data.aktivitas_login);
							document.querySelector("#detailTglDaftarPegawai").textContent = "Dibuat, " + formatTanggalJam(data.tgl_buat);

							// Menampilkan foto pengguna
							let fotoElement = document.querySelector("#user-foto");
							fotoElement.style.backgroundImage = data.foto ? `url('/storage/foto/${data.foto}')` : "url('/storage/foto/default.png')";

							// Menampilkan modal
							let modal = new bootstrap.Modal(document.getElementById("modalDetailPegawai"));
							modal.show();
						})
						.catch(error => console.error("Error fetching data:", error));
				}
			});
		});

		// Fungsi untuk mendapatkan badge berdasarkan role
		function getBadgeRole(role) {
			switch (role) {
				case "Super user": return '<span class="badge badge-success fs-5">Administrator</span>';
				case "Kepala": return '<span class="badge badge-primary fs-5">Kepala Unit</span>';
				case "Admin": return '<span class="badge badge-info fs-5">Admin</span>';
				default: return '<span class="badge badge-secondary fs-5">Tidak Diketahui</span>';
			}
		}

		// Fungsi untuk mendapatkan badge berdasarkan jabatan
		function getBadgeJabatan(jabatan) {
			switch (jabatan) {
				case "Super user": return '<span class="badge badge-success fs-5">Administrator</span>';
				case "Bot": return '<span class="badge badge-danger fs-5">Bot Sistem</span>';
				case "Kepala": return '<span class="badge badge-primary fs-5">Kepala Unit</span>';
				case "Admin": return '<span class="badge badge-info fs-5">Staf</span>';
				default: return '<span class="badge badge-secondary fs-5">Tidak Diketahui</span>';
			}
		}

		// Fungsi untuk memformat tanggal dan jam ke Bahasa Indonesia
		function formatTanggalJam(tanggal) {
			if (!tanggal) return "-";
			
			let date = new Date(tanggal);
			
			// Format tanggal (day, month, year) dan jam (hour, minute, second)
			return new Intl.DateTimeFormat("id-ID", { 
				day: "numeric", 
				month: "long", 
				year: "numeric", 
				hour: "2-digit", 
				minute: "2-digit", 
				second: "2-digit", 
				hour12: false // Menggunakan format 24 jam
			}).format(date);
		}
	</script>
	<script>
		$(document).ready(function () {
			// 🔹 Inisialisasi Select2 saat modal ditampilkan
			$(document).on("shown.bs.modal", "#modalEditPegawai", function () {
				// 🔹 Inisialisasi Select2 untuk Instansi dengan AJAX (pencarian dinamis)
				$('#instansiSelectEdit').select2({
					placeholder: "Pilih Instansi",
					allowClear: true,
					dropdownParent: $("#modalEditPegawai"), // Pastikan dropdown tampil dalam modal
					language: {
						noResults: function () {
							return "Data tidak ditemukan";
						},
						searching: function () {
							return "Sedang mencari...";
						}
					},
					ajax: {
						url: '/instansi',
						dataType: 'json',
						delay: 250,
						data: function (params) {
							return { search: params.term };
						},
						processResults: function (data) {
							return {
								results: $.map(data, function (item) {
									return { id: item.id, text: item.nama };
								})
							};
						}
					}
				});

				// 🔹 Inisialisasi Select2 untuk Jabatan (Statis dengan Search)
				$('#jabatanSelectEdit').select2({
					placeholder: "Pilih Jabatan",
					allowClear: true,
					dropdownParent: $("#modalEditPegawai"),
					minimumResultsForSearch: 0 // 🔥 Memungkinkan pencarian meskipun datanya statis
				});
			});

			// Event delegation saat tombol edit diklik
			$(document).on('click', '[data-bs-target="#modalEditPegawai"]', function () {
				var idPegawai = $(this).data('id');

				// Ambil data pegawai berdasarkan ID
				$.ajax({
					url: '/users/' + idPegawai + '/edit',
					type: 'GET',
					dataType: 'json',
					success: function (response) {
						console.log("Respons API:", response); // Debugging
						
						if (response.success) {
							var pegawai = response.data;

							// Set nilai di form edit
							$('#idPegawaiEdit').val(pegawai.id);
							$('#nipEdit').val(pegawai.nip);
							$('#namaEdit').val(pegawai.nama);
							$('#telpEdit').val(pegawai.telp);
							$('#emailEdit').val(pegawai.email);
							$('#alamatEdit').val(pegawai.alamat);
							$('#usernameEdit').val(pegawai.username);

							// Atur nilai instansi di Select2
							var instansiOption = new Option(pegawai.instansi.nama, pegawai.instansi.id, true, true);
							$('#instansiSelectEdit').append(instansiOption).trigger('change');

							// Atur nilai jabatan di Select2
							$('#jabatanSelectEdit').val(pegawai.jabatan).trigger('change');

							// Atur hak akses (role)
							$('input[name="role"]').each(function () {
								if ($(this).val() === pegawai.role) {
									$(this).prop('checked', true);
								}
							});

							// Tampilkan foto yang sudah ada
							$('#foto_preview').css('background-image', 'url(/storage/foto/' + pegawai.foto + ')');

							// Tampilkan modal edit pegawai
							$('#modalEditPegawai').modal('show');

						} else {
							// SweetAlert jika data pegawai tidak ditemukan
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Data pegawai tidak ditemukan!'
							});
						}
					},
					error: function () {
						// SweetAlert jika terjadi error AJAX
						Swal.fire({
							icon: 'error',
							title: 'Gagal!',
							text: 'Terjadi kesalahan saat mengambil data pegawai.'
						});
					}
				});
			});

			// Event Delegation untuk submit form
			$(document).on('click', '#saSimpanEditPegawai', function () {
				var idPegawai = $('#idPegawaiEdit').val();
				var formData = new FormData($('#pegawaiFormEdit')[0]); // Ambil data dari form

				formData.append('_method', 'PUT');
				formData.append('nip', $('#nipEdit').val());
				formData.append('nama', $('#namaEdit').val());
				formData.append('telp', $('#telpEdit').val());
				formData.append('email', $('#emailEdit').val());
				formData.append('alamat', $('#alamatEdit').val());
				formData.append('username', $('#usernameEdit').val());
				formData.append('instansi_id', $('#instansiSelectEdit').val());
				formData.append('jabatan', $('#jabatanSelectEdit').val());
				formData.append('role', $('input[name="role"]:checked').val());

				// Cek apakah password diisi
				var password = $('#passwordEdit').val();
				var passwordConfirmation = $('#passwordConfirmationEdit').val();
				if (password !== '') {
					formData.append('password', password);
					formData.append('password_confirmation', passwordConfirmation);
				}

				// Tambahkan foto jika ada perubahan
				var foto = $('#fotoEdit')[0].files[0];
				if (foto) {
					formData.append('foto', foto);
				}
				
				// Tampilkan loading sebelum request dikirim
				Swal.fire({
					title: "Mohon Tunggu...",
					text: "Data sedang diproses...",
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});

				// Kirim data ke server dengan AJAX
				$.ajax({
					url: '/users/' + idPegawai,
					type: 'POST', // Laravel hanya menerima POST jika _method=PUT sudah ditambahkan
					data: formData,
					contentType: false,
					processData: false,
					dataType: 'json',
					headers: {
						"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
					},
					success: function (response) {
						console.log("Respons API:", response); // Debugging
						
						if (response.success) {
							let currentDate = new Date();
							let formattedDate = currentDate.toLocaleDateString('id-ID', {
								year: 'numeric',
								month: 'long',
								day: 'numeric'
							});
							let formattedTime = currentDate.toLocaleTimeString('id-ID');

							Swal.fire({
								title: "Berhasil!",
								text: `Data pegawai dengan NIP ${$('#nipEdit').val()} berhasil diupdate pada tanggal ${formattedDate} & jam ${formattedTime}`,
								icon: "success",
								confirmButtonText: "OKE"
							}).then(() => {
								location.reload(); // Refresh halaman setelah klik OK
							});

							// Jika pengguna tidak menekan tombol, halaman akan reload setelah 1,5 detik
							setTimeout(() => location.reload(), 1500);

						} else {
							// SweetAlert jika gagal memperbarui data
							Swal.fire({
								icon: 'error',
								title: 'Gagal!',
								text: response.message || 'Gagal memperbarui data pegawai.'
							});
						}
					},
					error: function (xhr, status, error) {
						console.log("Error:", xhr.responseText); // Debugging

						Swal.fire({
							icon: 'error',
							title: 'Terjadi Kesalahan!',
							text: 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
							footer: `<pre>${xhr.responseText}</pre>` // Menampilkan error dari server (opsional)
						});
					}
				});
			});
		});
	</script>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.addEventListener('click', function (event) {
			if (event.target.closest('.deleteUser')) {
				let button = event.target.closest('.deleteUser'); 
				let userId = button.getAttribute('data-id');

				Swal.fire({
					html: "Apakah Anda yakin ingin menghapus Data Ini?",
					icon: "question",
					buttonsStyling: false,
					showCancelButton: true,
					confirmButtonText: "Ya, Hapus!",
					cancelButtonText: 'Batal',
					customClass: {
						confirmButton: "btn btn-danger",
						cancelButton: 'btn btn-secondary'
					}
				}).then((result) => {
					if (result.isConfirmed) {
						// Kirim AJAX DELETE request ke server
						fetch(`/users/${userId}`, {
							method: "DELETE",
							headers: {
								"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
								"Content-Type": "application/json"
							}
						})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								Swal.fire({
									title: "Berhasil!",
									html: `Data Pegawai dengan NIP <b>${data.nip}</b> telah berhasil dihapus pada tanggal <b>${data.tanggal}</b> & jam <b>${data.jam}</b>.`,
									icon: "success",
									confirmButtonText: "Oke, Mengerti"
								}).then(() => {
									location.reload(); // Reload halaman setelah menghapus
								});
							} else {
								Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
							}
						})
						.catch(error => {
							console.error("Error:", error);
							Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus.", "error");
						});
					}
				});
			}
		});
	});
	</script>
	<!--end:: Pegawai-->
	<!-- Javascript Edit Sistem -->
	<script>
	document.addEventListener("DOMContentLoaded", function () {
		var logoutLink = document.querySelector('.menu-item a[href="/logout"]');

		if (logoutLink) {
			logoutLink.addEventListener('click', function (event) {
				event.preventDefault();

				Swal.fire({
					title: "Apakah Anda yakin ingin keluar?",
					text: "Anda akan keluar dari sesi ini.",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Ya, Keluar",
					cancelButtonText: "Batal",
					customClass: {
						confirmButton: "btn btn-danger",
						cancelButton: "btn btn-secondary"
					}
				}).then((result) => {
					if (result.isConfirmed) {
						fetch("/logout", {
							method: "POST",
							headers: {
								"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
								"Content-Type": "application/json",
								"Accept": "application/json" // 💡 Penting
							},
							body: JSON.stringify({})
						})
						.then(async response => {
							if (!response.ok) {
								if (response.status === 419) {
									throw new Error("Session expired atau CSRF token tidak valid.");
								}
								// Cek apakah JSON atau bukan
								const contentType = response.headers.get("content-type");
								if (!contentType || !contentType.includes("application/json")) {
									throw new Error("Respons server bukan JSON.");
								}
								const err = await response.json();
								throw new Error(err.message || "Logout gagal.");
							}
							return response.json();
						})
						.then(data => {
							if (data.success) {
								window.location.href = "/login";
							} else {
								Swal.fire("Gagal!", data.message || "Logout gagal.", "error");
							}
						})
						.catch(error => {
							console.error("Logout failed:", error);
							Swal.fire("Kesalahan", error.message || "Terjadi kesalahan saat logout.", "error");
						});
					}
				});
			});
		}
	});
	</script>
	<script>
	$(document).ready(function () {
		// ✅ Tangani klik pada tombol update
		$(".input-group .btn").click(function () {
			let parent = $(this).closest(".input-group"); // Temukan input-group terdekat
			let inputField = parent.find("input"); // Ambil input di dalamnya
			let field = inputField.attr("id"); // Ambil ID input sebagai nama field
			let value = inputField.val(); // Ambil nilai input

			// Cek apakah nilai input kosong
			if (!value.trim()) {
				Swal.fire({
					icon: "warning",
					title: "Peringatan!",
					text: "Field tidak boleh kosong!",
				});
				return; // Hentikan proses jika input kosong
			}

			$.ajax({
				url: "/editMediaSosial",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					[field]: value // Kirim data berdasarkan ID input
				},
				success: function (response) {
					Swal.fire({
						icon: "success",
						title: "Berhasil!",
						text: response.message,
						showConfirmButton: false,
						timer: 2000
					});
				},
				error: function (xhr) {
					Swal.fire({
						icon: "error",
						title: "Gagal!",
						text: "Terjadi kesalahan saat menyimpan data.",
					});
				}
			});
		});
	});
	</script>
	<script>
		$(document).ready(function () {
			$("#formFooter").submit(function (e) {
				e.preventDefault();

				let formData = new FormData(this);
				formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Tambahkan CSRF Token
				
				$.ajax({
					url: "/editFooter", // Ganti dengan URL yang sesuai
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
					beforeSend: function () {
						$("#saSimpanFooter").prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
					},
					success: function (response) {
						Swal.fire({
							icon: "success",
							title: "Berhasil!",
							text: "Data footer berhasil diperbarui!",
							showConfirmButton: false,
							timer: 2000
						});

						$("#saSimpanFooter").prop("disabled", false).html('<i class="fas fa-save"></i> Simpan Perubahan');
					},
					error: function (xhr) {
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Gagal menyimpan data footer!",
						});

						$("#saSimpanFooter").prop("disabled", false).html('<i class="fas fa-save"></i> Simpan Perubahan');
					}
				});
			});

			// ✅ Fungsi Pratinjau Gambar
			function previewImage(id) {
				const input = document.getElementById(id);
				const preview = document.getElementById("preview-" + id);
				
				if (input.files && input.files[0]) {
					const reader = new FileReader();
					reader.onload = function (e) {
						preview.src = e.target.result;
					};
					reader.readAsDataURL(input.files[0]);
				}
			}

			// ✅ Panggil fungsi preview saat gambar diubah
			$("#gambar1").change(function () { previewImage("gambar1"); });
			$("#gambar2").change(function () { previewImage("gambar2"); });
			$("#gambar3").change(function () { previewImage("gambar3"); });
		});
	</script>
	<script>
	$(document).ready(function() {
		// Fungsi untuk menampilkan preview gambar sebelum upload
		function previewImage(inputId) {
			let input = document.getElementById(inputId);
			let preview = document.getElementById('preview-' + inputId);

			if (input.files && input.files[0]) {
				let reader = new FileReader();

				reader.onload = function(e) {
					preview.src = e.target.result;
				};

				reader.readAsDataURL(input.files[0]);
			}
		}

		// Event listener untuk setiap input file
		$('#gambar1, #gambar2').on('change', function() {
			previewImage(this.id);
		});

		// Handle submit form dengan AJAX
		$('#formTentangLapor').on('submit', function(e) {
			e.preventDefault(); // Mencegah reload halaman

			let formData = new FormData(this);

			$.ajax({
				url: '/editTentangLapor', // Sesuaikan dengan route yang benar
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function() {
					Swal.fire({
						title: 'Mengunggah...',
						text: 'Mohon tunggu, data sedang diproses!',
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});
				},
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: 'Data berhasil disimpan!',
						timer: 2000,
						showConfirmButton: false
					});

					$('#formTentangLapor')[0].reset(); // Reset form setelah berhasil
					$('#preview-gambar1').attr('src', 'logo1.png'); // Reset preview gambar
					$('#preview-gambar2').attr('src', 'logo2.png');
				},
				error: function(xhr) {
					let errors = xhr.responseJSON.errors;
					let errorMessages = '';

					$.each(errors, function(key, value) {
						errorMessages += value[0] + '<br>';
					});

					Swal.fire({
						icon: 'error',
						title: 'Gagal!',
						html: errorMessages
					});
				}
			});
		});
	});
	</script>
	<!-- Javascript Edit Sistem -->
	<!-- Javascript Chart -->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			fetch("/beranda/count")
				.then(response => response.json())
				.then(data => {
					const canvasEl = document.getElementById('instansiBarChart');
					if (!canvasEl) {
						//console.warn("Elemen #instansiBarChart tidak ditemukan.");
						return;
					}

					if (data.pengaduanPerInstansi && data.pengaduanPerInstansi.length > 0) {
						const instansiLabels = data.pengaduanPerInstansi.map(item => item.instansi);
						const jumlahData = data.pengaduanPerInstansi.map(item => item.jumlah);

						const barCtx = canvasEl.getContext('2d');

						const colors = [
							'#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8',
							'#6f42c1', '#20c997', '#fd7e14', '#e83e8c', '#6610f2'
						];

						new Chart(barCtx, {
							type: 'bar',
							data: {
								labels: instansiLabels,
								datasets: [{
									label: 'Jumlah Pengaduan per Instansi',
									data: jumlahData,
									backgroundColor: colors.slice(0, jumlahData.length)
								}]
							},
							options: {
								responsive: true,
								scales: {
									y: {
										beginAtZero: true,
										title: {
											display: true,
											text: 'Jumlah'
										}
									}
								}
							}
						});
					}
				});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			fetch("/beranda/count")
				.then(response => response.json())
				.then(data => {
					const pieCanvas = document.getElementById('statusPieChart');
					
					if (pieCanvas) {
						const pieCtx = pieCanvas.getContext('2d');

						const statusLabels = Object.keys(data.statusCounts);
						const statusValues = Object.values(data.statusCounts);

						new Chart(pieCtx, {
							type: 'pie',
							data: {
								labels: statusLabels,
								datasets: [{
									label: 'Pengaduan per Status',
									data: statusValues,
									backgroundColor: ['#17a2b8', '#ffc107', '#28a745', '#dc3545'],
									borderWidth: 1
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								plugins: {
									legend: {
										position: 'bottom'
									}
								}
							}
						});
					} else {
						//console.warn("Elemen #statusPieChart tidak ditemukan di DOM.");
					}
				});
		});
	</script>
	<!-- Javascript Chart -->
	<script>
		setInterval(function () {
			const iframe = document.getElementById('logViewerIframe');
			if (iframe) {
				iframe.contentWindow.location.reload();
			}
		}, 3600000); // 10 detik, bisa diubah jadi 5000 (5 detik) atau lainnya
	</script>
	<!--end::Javascript-->
</body>
</html>