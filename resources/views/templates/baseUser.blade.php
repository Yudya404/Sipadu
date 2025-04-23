<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.headUser')
</head>
<body class="animsition">
	<!-- Header -->
	<header>
		@include('includes.headerUser')
	</header>
	
	<!-- Content -->
		@yield('content')
	<!-- End COntent -->
	
	<!-- Footer -->
		@include('includes.footerUser')
	<!-- End Footer -->
	
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fas fa-angle-up"></i>
		</span>
	</div>

	<!-- Tombol Aksesibilitas -->
    <button class="accessibility-button" onclick="togglePanel()">
        <i class="fa fa-wheelchair"></i>
    </button>

    <!-- Panel Aksesibilitas -->
    <div class="accessibility-panel" id="accessibilityPanel">
        <div class="panel-header">
            Menu Aksesibilitas (CTRL+U)
            <i class="fa fa-times" onclick="togglePanel()"></i>
        </div>
        <div class="panel-content">
            <div class="accessibility-option" onclick="alert('Mode suara diaktifkan')">
                <i class="fa fa-volume-up"></i>
                <p>Mode Suara</p>
            </div>
            <div class="accessibility-option" onclick="increaseTextSize()">
                <i class="fa fa-text-height"></i>
                <p>Perbesar Teks</p>
            </div>
            <div class="accessibility-option" onclick="decreaseTextSize()">
                <i class="fa fa-text-height"></i>
                <p>Perkecil Teks</p>
            </div>
            <div class="accessibility-option" onclick="toggleDesaturation()">
                <i class="fa fa-tint"></i>
                <p>Kejenuhan</p>
            </div>
            <div class="accessibility-option" onclick="toggleHighContrast()">
                <i class="fa fa-adjust"></i>
                <p>Kontras+</p>
            </div>
            <div class="accessibility-option" onclick="toggleImages()">
                <i class="fa fa-image"></i>
                <p>Sembunyikan Gambar</p>
            </div>
            <div class="accessibility-option" onclick="alert('Rata tulisan diaktifkan')">
                <i class="fa fa-align-left"></i>
                <p>Rata Tulisan</p>
            </div>
            <div class="accessibility-option" onclick="toggleEasyFont()">
                <i class="fa fa-font"></i>
                <p>Ramah Disleksia</p>
            </div>
            <div class="accessibility-option" onclick="alert('Tinggi garis diaktifkan')">
                <i class="fa fa-text-width"></i>
                <p>Tinggi Garis</p>
            </div>
        </div>
    </div>
	
	<div class="social-sidebar right">
		<a href="https://www.facebook.com/" target="_blank" class="mb-2 social-icon facebook">
		  <i class="fab fa-facebook-f fs-4"></i>
		</a>
		<a href="https://x.com/" target="_blank" class="mb-2 social-icon twitter">
		  <i class="fab fa-twitter fs-4"></i>
		</a>
		<a href="https://www.instagram.com/" target="_blank" class="mb-2 social-icon instagram">
		  <i class="fab fa-instagram fs-4"></i>
		</a>
		<a href="https://www.youtube.com/" target="_blank" class="mb-2 social-icon youtube">
		  <i class="fab fa-youtube fs-4"></i>
		</a>
	</div>

	<!--begin::Vendors Javascript(used for this page only)-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/slick/slick.min.js"></script>
	<script src="vendor/parallax100/parallax100.js"></script>
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<script src="js/main.js"></script>
	<!--end::Vendors Javascript-->
	
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--end::Custom Javascript-->
	
	<!-- Script JavaScript -->
	<script>
        $('.parallax100').parallax100();
	</script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
	<!-- Begin Aksesibilitas-->
	<script>
		// Fungsi untuk toggle panel aksesibilitas
		function togglePanel() {
			document.getElementById("accessibilityPanel").classList.toggle("show");
		}

		// Fungsi untuk toggle kontras tinggi
		function toggleHighContrast() {
			document.body.classList.toggle("high-contrast");
			// Memberikan feedback ke pembaca layar
			const isHighContrast = document.body.classList.contains("high-contrast");
			document.getElementById("highContrastBtn").setAttribute("aria-pressed", isHighContrast);
		}

		// Fungsi untuk menambah ukuran teks
		function increaseTextSize() {
			document.body.classList.add("increase-text");
			// Memberikan feedback ke pembaca layar
			document.getElementById("increaseTextBtn").setAttribute("aria-pressed", "true");
		}

		// Fungsi untuk mengurangi ukuran teks
		function decreaseTextSize() {
			document.body.classList.remove("increase-text");
			// Memberikan feedback ke pembaca layar
			document.getElementById("increaseTextBtn").setAttribute("aria-pressed", "false");
		}

		// Fungsi untuk toggle desaturasi (grayscale)
		function toggleDesaturation() {
			const isDesaturated = document.body.style.filter === "grayscale(100%)";
			document.body.style.filter = isDesaturated ? "none" : "grayscale(100%)";
			// Memberikan feedback ke pembaca layar
			document.getElementById("desaturationBtn").setAttribute("aria-pressed", !isDesaturated);
		}

		// Fungsi untuk toggle visibilitas gambar
		function toggleImages() {
			let images = document.querySelectorAll("img");
			images.forEach(img => {
				img.style.display = img.style.display === "none" ? "block" : "none";
			});
			// Memberikan feedback ke pembaca layar
			const areImagesHidden = images[0].style.display === "none";
			document.getElementById("toggleImagesBtn").setAttribute("aria-pressed", !areImagesHidden);
		}

		// Fungsi untuk toggle font mudah dibaca
		function toggleEasyFont() {
			document.body.classList.toggle("easy-font");
			// Memberikan feedback ke pembaca layar
			const isEasyFont = document.body.classList.contains("easy-font");
			document.getElementById("easyFontBtn").setAttribute("aria-pressed", isEasyFont);
		}
	</script>
	<!-- End Aksesibilitas-->
	<!-- Begin Modal-->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const modalEl = document.getElementById('modalPanduan');
			const imgEl = document.getElementById('panduanImg');
			const spinner = document.getElementById('loadingSpinner');
			
			// ✅ Cek apakah semua elemen yang diperlukan ada sebelum lanjut
			if (!modalEl || !imgEl || !spinner) {
				// console.warn("Modal atau elemen terkait tidak ditemukan. Melewati script modal panduan.");
				return;
			}

			modalEl.addEventListener('shown.bs.modal', function () {
				document.querySelector('#modalPanduan .btn-close').focus();

				// Sembunyikan gambar dan tampilkan spinner
				imgEl.style.display = 'none';
				spinner.style.display = 'block';

				// Cek jika gambar sudah dimuat
				if (imgEl.complete) {
				// Jika sudah dimuat sebelumnya (cached)
					showImage();
				} else {
					// Jika belum, tunggu sampai selesai
					imgEl.onload = showImage;
				}
			});

			function showImage() {
				spinner.style.display = 'none';
				imgEl.style.display = 'block';
				imgEl.onload = null; // bersihkan listener
			}
		});
	</script>
	<script>
	document.addEventListener("DOMContentLoaded", function () {
		const modalEl = document.getElementById('loginModal');
		const imgEl = document.getElementById('maafImg');
		const spinner = document.getElementById('loadingSpinner1');
		
		// ✅ Cek apakah semua elemen yang diperlukan ada sebelum lanjut
		if (!modalEl || !imgEl || !spinner) {
			// console.warn("Modal atau elemen terkait tidak ditemukan. Melewati script modal panduan.");
		return;
		}

		modalEl.addEventListener('shown.bs.modal', function () {
			document.querySelector('#loginModal .btn-close').focus();

			// Reset tampilan
			imgEl.style.display = 'none';
			spinner.style.display = 'block';

			if (imgEl.complete) {
				showImage();
			} else {
				imgEl.onload = showImage;
			}
		});

		function showImage() {
			spinner.style.display = 'none';
			imgEl.style.display = 'block';
			imgEl.onload = null; // bersihkan listener
		}
	});
	</script>
	<!-- End Modal-->
	<!-- Begin Instansi-->
	<script>
		$(document).ready(function() {
			const $selectInstansi = $("#selectInstansi");

			// Inisialisasi Select2
			$("#selectInstansi").select2({
				allowClear: true,
				width: '100%',
				language: {
					noResults: function() {
						return "🚫 Data Tidak Ditemukan";
					},
					searching: function() {
						return "🔍 Mencari Data...";
					},
					inputTooShort: function() {
						return "Ketikkan minimal 1 huruf";
					}
				}
			});

			// Opsi loading awal
			const loadingOption = `<option value="">⏳ Mengambil data...</option>`;
			const gagalOption = `<option value="">⚠️ Gagal memuat data</option>`;
			const kosongOption = `<option value="">🚫 Tidak ada data ditemukan</option>`;

			// Tampilkan loading saat awal
			$selectInstansi.html(loadingOption).trigger("change");

			// Ambil data instansi lewat AJAX
			$.ajax({
				url: "/api/cari-instansi",
				type: "GET",
				dataType: "json",
				beforeSend: function() {
					$selectInstansi.html(loadingOption).trigger("change");
				},
				success: function(response) {
					let instansiData = response.data || response;

					// Validasi data
					if (!Array.isArray(instansiData)) {
						console.error("Format response tidak sesuai:", response);
						$selectInstansi.html(gagalOption).trigger("change");
						return;
					}

					// Cek apakah data kosong
					if (instansiData.length === 0) {
						$selectInstansi.html(kosongOption).trigger("change");
						return;
					}

					// Isi opsi select
					let options = `<option value="">Pilih Instansi/Lembaga Terkait</option>`;
					instansiData.forEach(instansi => {
						options += `<option value="${instansi.id}">${instansi.nama}</option>`;
					});

					$selectInstansi.html(options).trigger("change");
				},
				error: function(xhr, status, error) {
					console.error("Error fetching instansi:", error);
					$selectInstansi.html(gagalOption).trigger("change");
				}
			});
		});
	</script>
	<script>
	$(document).ready(function() {
		var table = $('#instansiTable').DataTable({
			"paging": true,
			"searching": true,
			"lengthChange": false,
			"pageLength": 10,
			"processing": true,
			"serverSide": false,
			"responsive": true, // ✅ Tambahkan ini!
			"ajax": {
				"url": "/api/daftar-instansi",
				"type": "GET",
				"dataSrc": "",
				"beforeSend": function() {
					$('#instansiTable').after('<div id="loadingMessage" style="text-align: center; padding: 10px;">⏳ Memuat data...</div>');
				},
				"complete": function() {
					$('#loadingMessage').remove();
				},
				"error": function(xhr, status, error) {
					$('#loadingMessage').remove();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Gagal mengambil data, periksa koneksi Anda!',
						confirmButtonText: 'Oke, Mengerti'
					});
				}
			},
			"columns": [
				{ "data": "induk" },
				{ "data": "nama" },
				{ "data": "tipe" }
			],
			"language": {
				"search": "",
				"searchPlaceholder": "Cari Instansi...",
				"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "›",
					"previous": "‹"
				},
				"lengthMenu": "Tampilkan _MENU_ data per halaman",
				"zeroRecords": "Tidak ada data yang ditemukan",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
				"infoEmpty": "Tidak ada data yang tersedia",
				"infoFiltered": "(disaring dari _MAX_ total data)"
			},
			dom: `
				<'row mb-3'
					<'col-sm-12 col-md-6'l>
					<'col-sm-12 col-md-6 d-flex justify-content-end'f>
				>
				<'table-responsive't>
				<'row mt-3'
					<'col-sm-12 col-md-6'i>
					<'col-sm-12 col-md-6 d-flex justify-content-end'p>
				>
			`
		});

		// Customizing Search Input
		// 🔽 Tambahkan baris ini setelah DataTable dibuat
		$('#instansiTable_filter').addClass('text-end');
		// Buat search input lebih responsif
		$('#instansiTable_filter input')
			.addClass('form-control shadow-sm mb-2')
			.css({
				"width": "100%",
				"padding": "8px 12px",
				"font-size": "16px",
				"border-radius": "8px"
			});

		// Styling Pagination
		$('#instansiTable_paginate').addClass('pagination-sm');
	});
	</script>
	<!-- Hitung Instansi -->
	<script>
		$(document).ready(function() {
			function animateNumbers() {
				$(".instansi-item .count").each(function() {
					let $this = $(this);
					let target = parseInt($this.text()); // Ambil angka tujuan
					let count = 0;
					let speed = Math.ceil(target / 50); // Kecepatan bertambah

					let interval = setInterval(function() {
						count += speed;
						if (count >= target) {
							count = target;
							clearInterval(interval);
						}
						$this.text(count);
					}, 20);
				});
			}

			function updateInstansiCounts() {
				$.ajax({
					url: "/api/instansi",
					type: "GET",
					dataType: "json",
					beforeSend: function() {
						$(".instansi-item .count").text("...");
					},
					success: function(data) {
						let counts = {
							"Dinas": 0,
							"Lembaga": 0,
							"Kecamatan": 0,
							"Desa": 0
						};

						data.forEach(function(item) {
							if (counts.hasOwnProperty(item.tipe)) {
								counts[item.tipe]++;
							}
						});

						// Update angka dan mulai animasi
						$(".instansi-item").each(function() {
							let tipe = $(this).attr("data-tipe");
							if (counts.hasOwnProperty(tipe)) {
								$(this).find(".count").text(counts[tipe]);
							}
						});

						// Panggil animasi setelah angka diperbarui
						animateNumbers();
					},
					error: function(xhr, status, error) {
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Gagal memuat data instansi, periksa koneksi!",
							confirmButtonText: "OKE"
						});
					}
				});
			}

			updateInstansiCounts();
		});
	</script>
	<!-- End Instansi-->
	<!-- Begin Pengaduan-->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			flatpickr("#tglLaporanPengaduan", {
				dateFormat: "d-m-Y", // Format tanggal: 24-02-2025
				allowInput: true, // Pengguna bisa mengetik manual
				maxDate: "today", // Hanya bisa memilih tanggal sebelum atau sama dengan hari ini
				defaultDate: "", // Tidak ada tanggal default
			});
		});
	</script>
	<!-- Pngaduan Form -->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Menambahkan event listener ke body dengan event delegation
			document.body.addEventListener("click", async function (event) {
				// Periksa apakah target event adalah elemen dengan ID 'simpanLapor'
				if (event.target && event.target.id === "simpanLapor") {
					event.preventDefault(); // ✅ Mencegah pengiriman form secara tradisional

					let formElement = document.getElementById("formLaporan");
					let nik = document.querySelector("input[name='nik']").value.trim();
					let nama = document.querySelector("input[name='nama']").value.trim();
					let telp = document.querySelector("input[name='telp']").value.trim();
					let email = document.querySelector("input[name='email']").value.trim();
					let alamat = document.querySelector("textarea[name='alamat']").value.trim();
					let jenisLaporan = document.getElementById("jenis").value;
					let judul = document.querySelector("input[name='judul']").value.trim();
					let isi = document.querySelector("textarea[name='editorPengaduan']").value.trim();
					let tglKejadian = document.querySelector("input[name='tglKejadian']").value.trim();
					let instansi = document.querySelector("#selectInstansi").value;
					let fileBukti = document.getElementById("filePengaduan").files[0];

					// ✅ Cek jika semua input kosong KECUALI tglKejadian
					if (!nik || !nama || !telp || !email || !alamat || !judul || !isi || !instansi || !fileBukti) {
						Swal.fire({
							title: "Peringatan!",
							text: "Form tidak boleh kosong. Harap isi semua data!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
						});
						return;
					}

					// ✅ Validasi Data Individu
					if (nik.length !== 16 || isNaN(nik)) {
						Swal.fire({
							title: "Peringatan!",
							text: "NIK harus 16 digit angka!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
						});
						return;
					}
					if (!/^[a-zA-Z\s]+$/.test(nama) || nama.length < 10) {
						Swal.fire({
							title: "Peringatan!",
							text: "Nama hanya boleh mengandung huruf dan spasi serta harus Nama Lengkap!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}

					if ( !(telp.startsWith("0")) || telp.length < 12 || telp.length > 13 || isNaN(telp)) {
						Swal.fire({
							title: "Peringatan!",
							text: "Nomor telepon harus diawali dengan 0 dan terdiri dari 12-13 digit angka!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}

					if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
						Swal.fire({
							title: "Peringatan!",
							text: "Format email tidak valid!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
						});
						return;
					}
					
					if (!/^(?=.*\d)[A-Za-z0-9\s,./]{10,50}$/.test(alamat)) {
						Swal.fire({
							title: "Peringatan!",
							text: "Alamat harus lengkap, Harus ada Nomor Jalan atau Nomor Rumah, RT/RW, Dan Desan/Kelurahan.",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}
					
					// Validasi: hanya huruf dan spasi, panjang 12–35 karakter
					if (!/^[A-Za-z\s]{10,35}$/.test(judul)) {
						Swal.fire({
							title: "Peringatan!",
							text: "Judul hanya boleh berisi huruf dan spasi, dengan panjang minimal 12 dan maksimal 20 karakter!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}
					
					// Validasi isi pengaduan
					if (
					  isi === '' ||
					  isi.length < 35 ||
					  isi.length > 255 ||
					  /[<>#^*|~`{}\[\]=\\\/]/.test(isi)
					) {
					  let pesan = "";

					  if (isi === '') {
						pesan = "Isi laporan tidak boleh kosong!";
					  } else if (isi.length < 35) {
						pesan = "Isi laporan minimal 35 karakter agar lebih jelas.";
					  } else if (isi.length > 255) {
						pesan = "Isi laporan terlalu panjang, maksimal 255 karakter saja.";
					  } else {
						pesan = "Isi laporan tidak boleh mengandung karakter aneh seperti <, >, {, }, #, atau simbol lainnya.";
					  }

					  Swal.fire({
						title: "Peringatan!",
						text: pesan,
						icon: "warning",
						confirmButtonText: "Oke, Mengerti",
					  });
					  return;
					}
					
					if (!instansi) {
						Swal.fire({
							title: "Peringatan!",
							text: "Harap pilih instansi terkait!",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti", // ✅ Tombol custom
						});
						return;
					}

					if (!fileBukti) {
						Swal.fire({
							title: "Peringatan!",
							text: "Harap masukkan File Bukti yang sesuai",
							icon: "warning",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}

					// Validasi format file
					let allowedExtensions = ["jpg", "jpeg", "png", "mp4", "pdf"];
					let fileExtension = fileBukti.name.split(".").pop().toLowerCase();

					if (!allowedExtensions.includes(fileExtension)) {
						Swal.fire({
							title: "Peringatan!",
							text: "Format file tidak didukung! Harap unggah gambar, video, atau PDF.",
							icon: "error",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}

					// Validasi ukuran file (opsional, contoh: max 5MB)
					let maxSize = 5 * 1024 * 1024; // 5MB
					if (fileBukti.size > maxSize) {
						Swal.fire({
							title: "Peringatan!",
							text: "Ukuran file terlalu besar! Maksimal 5MB.",
							icon: "error",
							confirmButtonText: "Oke, Mengerti",
						});
						return;
					}
					
					// Tampilkan loading sebelum proses login
					Swal.fire({
						title: "Sedang Memproses...",
						text: "Mohon tunggu sebentar",
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});

					// ✅ Cek Pengaduan Harian per NIK
					try {
						// ✅ Kirim Data ke Laravel
						let formData = new FormData();
						formData.append("nik", nik);
						formData.append("nama", nama);
						formData.append("telp", telp);
						formData.append("email", email);
						formData.append("alamat", alamat);
						formData.append("jenis_laporan", jenisLaporan);
						formData.append("judul", judul);
						formData.append("isi", isi);
						formData.append("tgl_kejadian", tglKejadian);
						formData.append("id_instansi", instansi);
						if (fileBukti) {
							formData.append("bukti", fileBukti);
						}

						let response = await fetch("/api/pengaduan", {
							method: "POST",
							body: formData,
						});

						let data = await response.json();
						
						Swal.close(); // Tutup loading setelah mendapatkan respons

						if (response.status === 422) {
							Swal.fire({
								title: "Validasi Gagal!",
								html: `<b>Terjadi kesalahan validasi!</b><br> ${JSON.stringify(data.errors)}`,
								icon: "error",
							});
							return;
						}

						if (response.status === 403) {
							let tgl_buat = data.tgl_buat 
								? new Date(data.tgl_buat).toLocaleDateString("id-ID", { day: '2-digit', month: 'long', year: 'numeric' }) 
								: "Tidak tersedia";
							let kode_formulir = data.kode_formulir ? data.kode_formulir : "Tidak tersedia";

							Swal.fire({
								title: "Laporan Ditolak!",
								html: `NIK <b>${nik}</b> dengan Nama <b>${nama}</b> sudah mengajukan pengaduan pada <b>${tgl_buat}</b><br> 
									   dengan Kode <b>${kode_formulir}</b>.<br><br>
									   Silakan ajukan kembali besok, Terima Kasih. 🙏<br>`,
								icon: "warning",
								confirmButtonText: "Oke, Mengerti",
							}).then(() => {
								location.reload(); // reload halaman setelah user klik tombol konfirmasi
							});

							return;
						}

						if (data.status === "error") {
							Swal.fire({
								title: "Error!",
								html: `<b>Terjadi kesalahan server!</b><br> ${data.message}`,
								icon: "error",
								confirmButtonText: "Oke, Mengerti",
							});
							return;
						}

						let kategori = data.kategori; 
						let statusPengaduan = data.status; 
						let kodeFormulir = data.kode_formulir;
						let tanggalPengaduan = data.tgl_buat 
							? new Date(data.tgl_buat).toLocaleDateString("id-ID", { day: '2-digit', month: 'long', year: 'numeric' }) 
							: new Date().toLocaleDateString("id-ID", { day: '2-digit', month: 'long', year: 'numeric' });

						if (kategori === "Spam") {
							Swal.fire({
								title: "Pengaduan Anda <br> Terdeteksi Spam!",
								html: `Pengaduan Yang Anda Ajukan dengan NIK <b>${nik}</b> <br> Nama <b>${nama}</b><br>
									   masuk kategori <b>${kategori}</b>.<br><br>
									   Maka pengaduan Anda <b>${statusPengaduan}</b><br>
									   <b>Silahkan Ajukan Pengaduan Dengan Baik & Benar!</b><br>
									   <b>Ikuti Panduan Pengisian Pengaduan!</b><br>
									   <b>Terima Kasih. 🙏</b>`,
								icon: "warning",
								confirmButtonText: "Oke, Mengerti",
							}).then(() => {
								location.reload(); // reload halaman setelah klik "Oke, Mengerti"
							});
						} else {
							Swal.fire({
								title: "Pengaduan Berhasil!",
								html: `
									Pengaduan Anda dengan Kode <b>${kodeFormulir}</b> telah <b>${statusPengaduan}</b><br>
									pada tanggal <b>${tanggalPengaduan}</b><br>
									<b>Silahkan Cetak Kode Untuk Konfirmasi!</b><br><br>
									<a id="downloadKode" href="#" class="btn btn-primary">Cetak Kode</a><br>
									<b>Terima Kasih Atas Pengaduan Anda 🙏</b>
								`,
								icon: "success",
								confirmButtonText: "Oke, Mengerti",
								customClass: {
									confirmButton: "btn btn-success",
								},
								didOpen: () => {
									document.getElementById("downloadKode").addEventListener("click", function () {
										let strukWindow = window.open("", "", "width=400,height=600");
										strukWindow.document.write(`
											<html>
											<head>
												<title>Bukti Pengaduan</title>
												<style>
													body { font-family: Arial, sans-serif; }
													.struk { width: 350px; padding: 10px; border: 1px solid #000; }
													.judul { text-align: center; font-size: 16px; font-weight: bold; }
													.item { display: flex; justify-content: space-between; }
													.footer { text-align: center; margin-top: 10px; font-size: 12px; }
												</style>
											</head>
											<body>
												<div class="struk">
													<div class="judul">Bukti Pengajuan Pengaduan</div>
													<hr>
													<div class="item"><span>Kode Formulir:</span><span>${kodeFormulir}</span></div>
													<div class="item"><span>Tanggal Pengajuan:</span><span>${tanggalPengaduan}</span></div>
													<hr>
													<div class="footer">Terima kasih atas pengaduan Anda!</div>
												</div>
												<script>
													window.print();
												<\/script>
											</body>
											</html>
										`);
										strukWindow.document.close();
									});
								}
							}).then((result) => {
								// Jika user menekan tombol "Oke, Mengerti"
								if (result.isConfirmed) {
									location.reload(); // Reload halaman
								}
							});
						}
					} catch (error) {
						Swal.fire({
							title: "Error!",
							text: `Terjadi kesalahan dalam pengiriman data: ${error.message}`,
							icon: "error",
							confirmButtonText: "Oke, Mengerti",
						});
					}
				}
			});
		});
	</script>
	<!-- Pngaduan Form -->
	<!-- File Preview Pngaduan -->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			let fileInput = document.getElementById('filePengaduan');
			
			if (fileInput) {
				fileInput.addEventListener('change', function (event) {
					let file = event.target.files[0];

					let fileLabel = document.getElementById('fileLabel'); // Label untuk input file
					let fileNameDisplay = document.getElementById('fileNameDisplay'); // Teks di bawah preview
					let previews = document.querySelectorAll('.file-preview'); // Ambil semua elemen preview
					let imagePreview = document.getElementById('imagePreview');
					let videoPreview = document.getElementById('videoPreview');
					let pdfPreview = document.getElementById('pdfPreview');

					// Reset semua preview
					previews.forEach(preview => {
						preview.style.display = 'none';
						preview.src = ''; // Hapus sumber agar tidak terus terbuka
					});

					if (file) {
						fileLabel.textContent = file.name; // Ubah label input
						fileNameDisplay.textContent = file.name; // Ubah teks di bawah preview
						fileNameDisplay.style.display = 'block'; // Tampilkan tulisan setelah file dipilih

						let fileType = file.type;
						let fileURL = URL.createObjectURL(file);

						if (fileType.startsWith('image/')) {
							imagePreview.src = fileURL;
							imagePreview.style.display = 'block';
						} else if (fileType.startsWith('video/')) {
							videoPreview.src = fileURL;
							videoPreview.style.display = 'block';
						} else if (fileType === 'application/pdf') {
							pdfPreview.src = fileURL;
							pdfPreview.style.display = 'block';
						}
					} else {
						fileLabel.textContent = "Pilih File";
						fileNameDisplay.textContent = "Tidak ada file yang dipilih";
						fileNameDisplay.style.display = 'none'; // Sembunyikan kembali
					}
				});
			}

			// Menampilkan modal fullscreen saat file di klik
			document.querySelectorAll('.file-preview').forEach(preview => {
				preview.addEventListener('click', function () {
					let modal = document.createElement('div');
					modal.classList.add('preview-modal');
					modal.innerHTML = `<div class="preview-content">
											<span class="close-btn">&times;</span>
											<${this.tagName.toLowerCase()} src="${this.src}" ${this.tagName.toLowerCase() === 'video' ? 'controls' : ''}></${this.tagName.toLowerCase()}>
									   </div>`;
					document.body.appendChild(modal);

					// Tutup modal saat tombol close diklik
					modal.querySelector('.close-btn').addEventListener('click', function () {
						modal.remove();
					});

					// Tutup modal saat klik di luar konten preview
					modal.addEventListener('click', function (e) {
						if (e.target === modal) {
							modal.remove();
						}
					});
				});
			});
		});
	</script>
	<!-- File Preview Pngaduan -->
	<!-- Pngaduan Harian -->
	<script>
		$(document).ready(function() {
			function animateCountUp(element, target, duration = 2000) {
				let start = 0;
				let increment = target / (duration / 10);
				let interval = setInterval(() => {
					start += increment;
					element.innerText = Math.floor(start).toLocaleString("id-ID");
					if (start >= target) {
						element.innerText = target.toLocaleString("id-ID");
						clearInterval(interval);
					}
				}, 10);
			}

			function updateLaporanHarian() {
				const jumlahElement = document.querySelector(".jumlah");

				// ✅ Cek apakah elemen ada sebelum lanjut
				if (!jumlahElement) {
					//console.warn("Element dengan class '.jumlah' tidak ditemukan. Melewati pembaruan jumlah.");
					return;
				}

				$.ajax({
					url: "/api/pengaduan-harian",
					type: "GET",
					dataType: "json",
					beforeSend: function() {
						jumlahElement.innerText = "...";
					},
					success: function(response) {
						let targetValue = response.jumlah || 0;
						jumlahElement.innerText = "0";
						animateCountUp(jumlahElement, targetValue);
					},
					error: function(xhr, status, error) {
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Gagal memuat data laporan harian, periksa koneksi!",
							confirmButtonText: "Oke, Mengerti"
						});
					}
				});
			}

			// ✅ Panggil hanya jika elemen ada
			updateLaporanHarian();
		});
	</script>
	<!-- Pngaduan Harian -->
	<!-- Lacak Pngaduan -->
	<script>
		$(document).ready(function() {
			$("#lacakPengaduanTable").hide(); // Sembunyikan tabel saat pertama kali halaman dimuat
			$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();

			let table = $("#lacakPengaduanTable").DataTable({
				autoWidth: false, // Mencegah lebar otomatis
				searching: false, // Menonaktifkan fitur pencarian
				paging: true, // Mengaktifkan pagination
				pageLength: 10, // Menampilkan 10 data per halaman
				lengthChange: false, // Menonaktifkan dropdown lengthMenu
				responsive: true, // ✅ Tambahkan ini!
				language: {
					zeroRecords: "Tidak ada data yang ditemukan",
					info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
					infoEmpty: "",
					infoFiltered: "(difilter dari total _MAX_ data)",
					paginate: {
						first: "Pertama",
						last: "Terakhir",
						next: "›",
						previous: "‹"
					}
				},
				columnDefs: [
					{ width: "20%", targets: 0 }, // Kode Formulir
					{ width: "20%", targets: 1 }, // Judul
					{ width: "10%", targets: 2 }, // Status
					{ width: "15%", targets: 3 }, // Tanggal Pengajuan
					{ width: "35%", targets: 4 }, // Tanggapan
				],
				
				initComplete: function () {
					// ini penting biar pagination tidak muncul setelah init
					$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();
					$('#lacakPengaduanTable').hide(); // pastikan juga table-nya disembunyikan
				}
			});
			
			let typingTimer;
			const doneTypingInterval = 2000; // 1 detik setelah berhenti mengetik

			$("#search-input").on("keyup", function () {
				clearTimeout(typingTimer);
				const kodeFormulir = $(this).val().trim();

				if (kodeFormulir === "") {
					$("#lacakPengaduanTable").fadeOut();
					$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();
					return;
				}

				// Tampilkan spinner loading sebelum debounce selesai
				let spinnerRow = '<tr id="spinner-row"><td colspan="6" class="text-center text-secondary">🔍 Memeriksa kode formulir...</td></tr>';
				$("#lacakPengaduanTable tbody").html(spinnerRow);
				$("#lacakPengaduanTable").fadeIn();

				typingTimer = setTimeout(function () {
					if (!/^FORM-\d{8}-\d{3}$/.test(kodeFormulir)) {
						$("#lacakPengaduanTable").fadeOut(); // sembunyikan kembali jika format salah
						$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();
						Swal.fire({
							icon: "warning",
							title: "Format Kode Salah!",
							text: "Kode formulir harus sesuai format: FORM-20250215-XXX",
							confirmButtonText: "Oke, Mengerti"
						});
						return;
					}

					// Spinner berubah menjadi loading fetch data
					let loadingRow = '<tr id="loading-row"><td colspan="6" class="text-center">⏳ Mengambil data...</td></tr>';
					$("#lacakPengaduanTable tbody").html(loadingRow);

					$.ajax({
						url: "/api/cari",
						type: "GET",
						data: { kode: kodeFormulir },
						dataType: "json",
						success: function (response, status, xhr) {
							$("#loading-row").remove();
							table.clear().draw();
							
							// Sembunyikan pagination & info secara default
							$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();

							if (xhr.status === 200) {
								let pengaduan = response.data;

								let formatTanggalJam = (tanggal) => {
									return new Date(tanggal).toLocaleString('id-ID', {
										day: '2-digit',
										month: 'long',
										year: 'numeric',
										hour: '2-digit',
										minute: '2-digit',
										second: '2-digit',
										hour12: false // format 24 jam
									});
								};

								function getStatusBadge(status) {
									switch (status) {
										case 'Diajukan': return '<span class="badge bg-info">Diajukan</span>';
										case 'Diproses': return '<span class="badge bg-success">Diproses</span>';
										case 'Selesai': return '<span class="badge bg-primary">Selesai</span>';
										case 'Tidak diproses': return '<span class="badge bg-danger">Tidak Diproses</span>';
										default: return '<span class="badge bg-secondary">Status Tidak Dikenal</span>';
									}
								}

								let row = [
									pengaduan.kode_formulir,
									pengaduan.judul,
									getStatusBadge(pengaduan.status),
									formatTanggalJam(pengaduan.tgl_buat),
									pengaduan.tanggapan.length > 0 ? pengaduan.tanggapan.map(t => `
										<div class="border p-2 mb-1">
											<strong>Admin: ${t.nama_pengguna}</strong><br><br>
											<strong>Tanggapan :<br> ${t.isi_tanggapan}</strong><br><br>
											<small>Tanggal: ${formatTanggalJam(t.tgl_ditanggapi)}</small>
										</div>
									`).join("") : "Belum ada tanggapan"
								];

								table.row.add(row).draw();
								$("#lacakPengaduanTable").fadeIn();
								
								$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').show();
								
								// Tambahkan styling agar pagination ada di kanan
								$('#lacakPengaduanTable_paginate').addClass('d-flex justify-content-end mt-3');
								$('#lacakPengaduanTable_info').addClass('text-start mt-3');

							}
						},
						error: function (xhr) {
							$("#loading-row").remove();

							if (xhr.status === 404) {
								Swal.fire({
									icon: "warning",
									title: "Data Tidak Ditemukan",
									text: "Pastikan kode formulir yang Anda masukkan benar.",
									confirmButtonText: "Oke, Mengerti"
								});
								$("#lacakPengaduanTable").fadeOut();
								$('#lacakPengaduanTable_paginate, #lacakPengaduanTable_info').hide();
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "Terjadi kesalahan saat mengambil data.",
									confirmButtonText: "Oke, Mengerti"
								});
							}
						}
					});
				}, doneTypingInterval);
			});
		});
	</script>
	<!-- Lacak Pngaduan -->
	<script>
        document.addEventListener("DOMContentLoaded", function () {
			initPengaduanChart(); // Panggil fungsi untuk inisialisasi grafik
		});

		function initPengaduanChart() {
			const canvas = document.getElementById('pengaduanChart');

			if (!canvas) {
				//console.warn("Element dengan id 'pengaduanChart' tidak ditemukan. Melewati inisialisasi Chart.");
				return;
			}

			const ctx = canvas.getContext('2d');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['2020', '2021', '2022', '2023'],
					datasets: [{
						label: 'Jumlah Pengaduan',
						data: [550, 750, 490, 1250],
						backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4caf50'],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
		}
    </script>
	<!-- End Pengaduan-->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const itemsPerPage = 4; // misalnya 2 laporan per halaman
			const cards = document.querySelectorAll("#laporan-container .card");
			const totalPages = Math.ceil(cards.length / itemsPerPage);
			const pagination = document.getElementById("pagination");
			
			if (!pagination) return; // 💡 stop eksekusi jika pagination tidak ditemukan

			function showPage(page) {
				const start = (page - 1) * itemsPerPage;
				const end = start + itemsPerPage;
				cards.forEach((card, index) => {
					card.style.display = (index >= start && index < end) ? "block" : "none";
				});
			}

			// Generate pagination buttons
			for (let i = 1; i <= totalPages; i++) {
				const li = document.createElement("li");
				li.classList.add("page-item");
				li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
				li.addEventListener("click", function (e) {
					e.preventDefault();
					document.querySelectorAll(".page-item").forEach(p => p.classList.remove("active"));
					this.classList.add("active");
					showPage(i);
				});
				pagination.appendChild(li);
			}

			// Tampilkan halaman pertama
			pagination.querySelector("li").classList.add("active");
			showPage(1);
		});
	</script>
</body>
</html>