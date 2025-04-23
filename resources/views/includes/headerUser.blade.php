		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">					
					<!-- Logo desktop -->		
					<a href="/" class="logo">
						<img src="img/Lapor_Mase.png" style="width: 200px;" alt="IMG-LOGO">
					</a>
					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li><a href="tentangLapor">Tentang Lapor Mase!</a></li>
							<li><a href="laporan">Laporan</a></li>
							<li><a href="statistik">Statistik</a></li>
							<li><a href="lacakPengaduan">Lacak Pengaduan</a></li>
						</ul>
					</div>	
					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<!-- Ikon untuk membuka modal login -->
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" data-bs-toggle="modal" data-bs-target="#loginModal">
							<i class="zmdi zmdi-account"></i>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="/"><img src="img/Lapor_Mase.png" alt="IMG-LOGO"></a>
			</div>
			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<!-- Ikon untuk membuka modal login -->
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" data-bs-toggle="modal" data-bs-target="#loginModal">
					<i class="zmdi zmdi-account"></i>
				</div>
			</div>
			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="tentangLapor">
						<i class="fas fa-info-circle"></i> Tentang Lapor Mase!
					</a>
				</li>
				<li>
					<a href="laporan">
						<i class="fas fa-clipboard-list"></i> Laporan
					</a>
				</li>
				<li>
					<a href="statistik">
					<i class="fas fa-chart-line"></i> Statistik
					</a>
				</li>
			</ul>
		</div>
		
		<!-- Modal Login -->
		<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content p-4 text-center">
					<!-- Header dengan garis pembatas -->
					<div class="modal-header border-bottom">
						<h5 class="modal-title w-100 text-center fw-bold">Informasi</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" autofocus></button>
					</div>
					<div class="modal-body text-center">
						<!-- Spinner saat loading -->
						<div id="loadingSpinner1" class="my-3">
							<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<p class="mt-2">Memuat informasi...</p>
						</div>
						
						<img id="maafImg" src="img/maaf.png" alt="Belum Tersedia" width="300" class="mb-3 mx-auto d-block" style="display:none;">
						<h6 class="fw-bold text-danger">Mohon maaf, fitur belum tersedia.</h6>
						<p class="text-muted mb-0">Silakan kembali lagi nanti.</p>
					</div>
				</div>
			</div>
		</div>




