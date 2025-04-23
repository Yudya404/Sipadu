@extends('templates.baseUser')
@section('title','Lapor Mase!')
@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('img/back.png');">
		<h2 class="ltext-105 cl0 txt-center animated-text">
			<i class="fas fa-search"></i> Lacak Pengaduan Anda
		</h2>
	</section>

	<section class="bg0 p-t-30">
		<div class="container">
			<div class="card shadow-lg mb-4">
				<div class="card-body">
					<div class="container mt-4">
						<!-- Keterangan dalam Card -->
						<div class="card shadow-sm mt-4">
							<div class="card-body">
								<div class="container mt-4">
									<!-- Input untuk Pencarian -->
									<div class="mb-3">
										<label for="search-input" class="form-label fs-5"><b><i class="fas fa-search"></i> Lacak Pengaduan Anda</b></label>
										<input class="form-control mb-1" placeholder="Masukkan Kode Formulir" id="search-input"/>
										<!-- Petunjuk format -->
										<small class="form-text fw-bold animate-scale">
											Format: FORM-YYYYMMDD-XXX (Contoh: FORM-20250404-001)
										</small>
									</div>

									<!-- Tabel Data -->
									<div class="table-responsive nowrap">
										<table id="lacakPengaduanTable" class="table table-bordered" width="100%">
											<thead class="table-light">
												<tr>
													<th>Kode Formulir</th>
													<th>Judul</th>
													<th>Status</th>
													<th>Tanggal</th>
													<th class="text-center">Tanggapan</th>
												</tr>
											</thead>
											<tbody></tbody> <!-- Dikosongkan untuk diisi oleh DataTables -->
										</table>
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