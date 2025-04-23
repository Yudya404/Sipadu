@extends('templates.baseUser')
@section('title','Lapor Mase!')
@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('img/back.png');">
		<h2 class="ltext-105 cl0 txt-center animated-text">
			Daftar Instansi Terhubung
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
									<table id="instansiTable" class="table table-bordered">
										<thead class="table-light">
											<tr>
												<th>Induk Instansi</th>
												<th>Nama Instansi</th>
												<th>Tipe Instansi</th>
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
	</section>
@endsection