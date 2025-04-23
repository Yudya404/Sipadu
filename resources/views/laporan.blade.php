@extends('templates.baseUser')
@section('title','Lapor Mase!')
@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('img/back.png');">
		<h2 class="ltext-105 cl0 txt-center animated-text"> Laporan Pengaduan </h2>
	</section>

	<section class="bg0 p-t-30">
		<div class="container">
			<div class="card shadow-lg mb-4">
				<div class="card-body">
					<div id="laporan-container" class="container mt-4">
						<!-- Tahun 2023 -->
						<div class="card shadow-sm mb-4">
							<div class="card-body">
								<h5 class="fw-bold">2023</h5>
								<div class="card bg-light p-3 mt-3">
									<div class="d-flex align-items-center">
										<img src="img/pdfIcon.png" alt="PDF" width="80" class="me-3 pdf-icon">
										<div>
											<a href="#" class="text-primary fw-bold">Laporan Pengaduan Pelayanan Publik 2023</a>
											<p class="mb-0">Ukuran: 3.3 MB</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Tahun 2022 -->
						<div class="card shadow-sm mb-4">
							<div class="card-body">
								<h5 class="fw-bold">2022</h5>
								<div class="card bg-light p-3 mt-3">
									<div class="d-flex align-items-center">
										<img src="img/pdfIcon.png" alt="PDF" width="80" class="me-3 pdf-icon">
										<div>
											<a href="#" class="text-primary fw-bold">Laporan Pengaduan Pelayanan Publik 2022</a>
											<p class="mb-0">Ukuran: 1.2 MB</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Tahun 2021 -->
						<div class="card shadow-sm mb-4">
							<div class="card-body">
								<h5 class="fw-bold">2021</h5>
								<div class="card bg-light p-3 mt-3">
									<div class="d-flex align-items-center">
										<img src="img/pdfIcon.png" alt="PDF" width="80" class="me-3 pdf-icon">
										<div>
											<a href="#" class="text-primary fw-bold">Laporan Pengaduan Pelayanan Publik 2021</a>
											<p class="mb-0">Ukuran: 1.2 MB</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Pagination control -->
						<div class="d-flex justify-content-center mt-3">
							<nav>
								<ul class="pagination" id="pagination"></ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
	
	