@extends('templates.base')
@section('title','Halaman Laporan | Lapor !')
@section('breadcrumb','Laporan')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="card shadow-sm ">
		<div class="card-header card-header-stretch">
			<div class="card-title">
				<h3>Pencarian</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="row g-5 align-items-center">
				<!-- Input Pencarian -->
				<div class="col-lg-6">
					<div>
						<label for="basic-url" class="form-label">Kode. Formulir/Judul/Instansi/Tanggal</label>
						<div class="input-group">
							<span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
							<input type="text" class="form-control form-control-solid" placeholder="Masukkan Kode. Formulir/Judul/Instansi/Tanggal" id="search-input" onkeyup="searchTable()">
						</div>
					</div>
				</div>
				<!-- Button Cetak PDF & Cetak Excel -->
				<div class="col-lg-6">
					<div class="text-end">
						<div class="btn-group">
							 <a href="/export/pdf" class="btn btn-primary">
								<i class="fa fa-file-pdf"></i> Cetak PDF
							</a>
							<a href="/export/excel" class="btn btn-success">
								<i class="fa fa-file-excel"></i> Cetak Excel
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!--begin::Tables widget 16-->
	<div class="card card-flush h-xl-100">
		<!--begin::Body-->
		<div class="card-body pt-6">
			<!--begin::Tab Content-->
			<div class="tab-content">
				<!--begin::Tap pane-->
				<div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::API keys-->
						<div class="card">
							<!--begin::Header-->
							<div class="card-header card-header-stretch">
								<!--begin::Title-->
								<div class="card-title">
									<h3>Laporan Daftar Pengaduan</h3>
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body p-0">
								<!--begin::Table wrapper-->
								<div class="table-responsive">
									<!--begin::Table-->
									<table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9" id="myTable">
										<!--begin::Thead-->
										<thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
											<tr>
												<th class="text-center">Kode. Formulir</th>
												<th class="text-center">Judul<br>Laporan</th>
												<th class="text-center">Instansi</th>
												<th class="text-center">Tanggal<br>Diajukan</th>
												<th class="text-center">Tanggal <br>Ditanggapi</th>
												<th class="text-center">Status<br>Laporan</th>
											</tr>
										</thead>
										<!--end::Thead-->
										<!--begin::Tbody-->
										<tbody class="border-gray-200 fs-5 fw-semibold bg-lighten">
											@foreach($report as $data)
											<tr>
												<td class="text-center">{{ $data->kode_formulir }}</td>
												<td class="text-center">{{ $data->judul }}</td>
												<td class="text-center">{{ $data->instansi ? $data->instansi->nama : 'Tidak ada instansi' }}</td>
												<td class="text-center">{{ \Carbon\Carbon::parse($data->tgl_buat)->translatedFormat('d F Y') }}</td>
												<td class="text-center">{{ \Carbon\Carbon::parse($data->tgl_ditanggapi)->translatedFormat('d F Y') }}</td>
												<td class="text-center">
													@if($data->status == 'Selesai')
														<span class="badge badge-primary fs-5">Selesai</span>
													@elseif($data->status == 'Diproses')
														<span class="badge badge-warning  fs-5">Diproses</span>
													@elseif($data->status == 'Diajukan')
														<span class="badge badge-info  fs-5">Diajukan</span>
													@elseif($data->status == 'Tidak diproses')
														<span class="badge badge-danger  fs-5">Tidak Diproses</span>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
										<!--end::Tbody-->
									</table>
									<!--end::Table-->
								</div>
								<!--end::Table wrapper-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::API keys-->
					</div>
					<!--end::Table container-->
				</div>
				<!--end::Tap pane-->
			</div>
			<!--end::API keys-->
		</div>
		<!--end::Table container-->
@endsection