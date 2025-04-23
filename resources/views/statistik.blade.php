@extends('templates.baseUser')
@section('title','Lapor Mase!')
@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('img/back.png');">
		<h2 class="ltext-105 cl0 txt-center animated-text">
			Statistik Pengaduan
		</h2>
	</section>

	<section class="bg0 p-t-30">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="card shadow-lg mb-4">
						<div class="card-body">
							<div class="container mt-4">
								<!-- Judul -->
								<div class="text-center mb-4">
									<h2 class="fw-bold">Statistik Pengaduan Pelayanan Publik</h2>
									<p class="text-muted">Jumlah pengaduan yang diterima per tahun</p>
								</div>

								<!-- Canvas untuk Chart -->
								<div class="card shadow-sm p-4">
									<canvas id="pengaduanChart"></canvas>
								</div>

								<!-- Keterangan dalam Card -->
								<div class="card shadow-sm mt-4">
									<div class="card-body">
										<h5 class="fw-bold">📊 Keterangan Statistik</h5>
										<div class="row">
											<div class="col-6">
												<ul class="list-group list-group-flush">
													<li class="list-group-item"><b>2022:</b> 190 pengaduan</li>
													<li class="list-group-item"><b>2020:</b> 180 pengaduan</li>
												</ul>
											</div>
											<div class="col-6">
												<ul class="list-group list-group-flush">
													<li class="list-group-item"><b>2023:</b> 250 pengaduan</li>
													<li class="list-group-item"><b>2021:</b> 220 pengaduan</li>
												</ul>
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
	</section>
@endsection