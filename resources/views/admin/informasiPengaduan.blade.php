@extends('templates.base')
@section('title','Halaman Informasi Pengaduan | Lapor !')
@section('breadcrumb','Informasi Pengaduan')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="row g-5">
		<!--begin::Nav-->
		<div class="card shadow-sm ">
			<div class="card-header card-header-stretch">
				<div class="card-title">
					<h3>Pencarian</h3>
				</div>
			</div>
			<div class="card-body ">
				<div class="row g-5">
					<div class="col-lg-12">
						<div class="mb-3">
							<label for="basic-url" class="form-label">Kode. Formulir/Judul/Instansi</label>
							<div class="input-group">
								<span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan Kode. Formulir/Judul/Instansi" id="search-input" onkeyup="searchTable()">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end::Nav-->
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
										<h3>Daftar Pengaduan</h3>
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
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<!--end::Thead-->
											<!--begin::Tbody-->
											<tbody class="border-gray-200 fs-5 fw-semibold bg-lighten">
											 @foreach($pengaduan as $data)
												<tr>
													<td class="text-center">{{ $data->kode_formulir }}</td>
													<td class="text-center">{{ $data->judul }}</td>
													<td class="text-center">{{ $data->instansi ? $data->instansi->nama : 'Tidak ada instansi' }}</td>
													<td class="text-center">{{ \Carbon\Carbon::parse($data->tgl_buat)->translatedFormat('d F Y') }}</td>
													<td class="text-center">
														@if($data->status == 'Selesai')
															<span class="badge badge-primary fs-5">Selesai</span>
														@elseif($data->status == 'Diproses')
															<span class="badge badge-success  fs-5">Diproses</span>
														@elseif($data->status == 'Diajukan')
															<span class="badge badge-info  fs-5">Diajukan</span>
														@elseif($data->status == 'Tidak diproses')
															<span class="badge badge-danger  fs-5">Tidak Diproses</span>
														@endif
													</td>
													<td class="text-center">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-info btnDetailPengaduan" data-toggle="modal" data-bs-target="#modalDetailPengaduan" data-id="{{ $data->id }}">
																<i class="fa fa-eye"></i>
															</button>
															<!--Begin Modal Detail-->
															<div class="modal fade" tabindex="-1" id="modalDetailPengaduan" aria-hidden="true">
																<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
																	<div class="modal-content">
																		<!--Begin Modal-->
																		<div class="modal-header">
																			<h3 class="modal-title">Detail Pengaduan</h3>
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
																				<div class="col-lg-6">
																					<div class="card shadow-sm mb-5">
																						<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
																							<div class="row g-5">
																								<div class="col-lg-10">
																									<div class="mb-5">
																										<h3 class="card-title">Data Formulir Pengaduan</h3>
																									</div>
																								</div>
																								<div class="col-lg-2">
																									<div class="mb-5">
																										<h3 class="card-title">
																											<div id="detailStatusPengaduan"></div>
																										</h3>
																									</div>
																								</div>
																							</div>
																							<div class="card-toolbar rotate-180">
																								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-03-24-172858/core/html/src/media/icons/duotune/arrows/arr072.svg-->
																								<span class="svg-icon svg-icon-muted svg-icon-2hx">
																									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																									</svg>
																								</span>
																								<!--end::Svg Icon-->
																							</div>
																						</div>
																						<div id="kt_docs_card_collapsible" class="collapse show">
																							<div class="card-body">
																								<div class="table-responsive">
																									<table class="table table-bordered table-striped">
																										<tbody>
																											<tr>
																												<td class="fw-bold">Kode Formulir</td>
																												<td class="fw-bold" id="detailKodeFormulirPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">NIK</td>
																												<td class="fw-bold" id="detailNikPengaduan"></td>
																											</tr>
																											 <tr>
																												<td class="fw-bold">Nama</td>
																												<td class="fw-bold" id="detailNamaPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">No Telp</td>
																												<td class="fw-bold" id="detailTelpPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Email</td>
																												<td class="fw-bold" id="detailEmailPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Alamat</td>
																												<td class="fw-bold" id="detailAlamatPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Tanggal Diajukan</td>
																												<td class="fw-bold" id="detailTglDiajukanPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Tanggal Kejadian</td>
																												<td class="fw-bold" id="detailTglKejadianPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Instansi Tujuan</td>
																												<td class="fw-bold" id="detailInstansiPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Kategori Pengaduan</td>
																												<td class="fw-bold" id="detailKategoriPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Judul Pengaduan</td>
																												<td class="fw-bold" id="detailJudulPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Uraian</td>
																												<td class="fw-bold" id="detailIsiPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Platform Pengaduan</td>
																												<td class="fw-bold" id="detailPlatformPengaduan"></td>
																											</tr>
																											<tr>
																												<td class="fw-bold">Bukti Pendukung</td>
																												<td>
																													<div id="file-container"></div> <!-- Tempat menampilkan file -->
																												</td>
																											</tr>
																										</tbody>
																									</table>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-lg-6">
																					<div class="card shadow-sm mb-5">
																						<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible1">
																							<div class="row g-5">
																								<div class="col-lg-12">
																									<div class="mb-5">
																										<h3 class="card-title">Tanggapan</h3>
																									</div>
																								</div>
																							</div>
																							<div class="card-toolbar rotate-180">
																								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-03-24-172858/core/html/src/media/icons/duotune/arrows/arr072.svg-->
																								<span class="svg-icon svg-icon-muted svg-icon-2hx">
																									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																									</svg>
																								</span>
																								<!--end::Svg Icon-->
																							</div>
																						</div>
																						<div id="kt_docs_card_collapsible1" class="collapse show">
																							<div class="card-body">
																								<table class="table table-bordered table-striped">
																									<tbody>
																										<tr>
																											<td class="fw-bold">Tanggal Ditanggapi</td>
																											<td class="fw-bold" id="detailTglDitanggapiPengaduan"></td>
																										</tr>
																										<tr>
																											<td class="fw-bold">Isi Tanggapan</td>
																											<td class="fw-bold" id="detailIsiTanggapanPengaduan"></td>
																										</tr>
																										 <tr>
																											<td class="fw-bold">Pegawai Yang Menggapi</td>
																											<td class="fw-bold" id="detailPegawaiPengaduan"></td>
																										</tr>
																									</tbody>
																								</table>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!--end:: Modal Detail Pengaduan-->
															@if ($data->status == 'Diajukan')
																@if (auth()->user()->role == 'Super user' || auth()->user()->role == 'Admin')
																	<a href="{{ route('tanggapan.show', $data->id) }}" 
																	   class="btn btn-success">
																		<i class="fa fa-edit"></i>
																	</a>
																@endif
															@endif

															@if (auth()->user()->role == 'Super user')
																<button type="button" class="btn btn-danger deletePengaduan" data-id="{{ $data->id }}">
																	<i class="fa fa-trash"></i>
																</button>
															@endif
														</div>
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