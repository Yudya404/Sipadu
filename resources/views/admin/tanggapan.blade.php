@extends('templates.base')
@section('title','Halaman Tanggapan | Lapor !')
@section('breadcrumb','Tanggapan')
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
					<h3>Data Pengaduan</h3>
				</div>
			</div>
			<!--begin::Body-->
			<div class="card-body p-0">
				<!--begin::Table wrapper-->
				<div class="table-responsive">
					<!--begin::Table-->
					<table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
						<!--begin::Thead-->
						<thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
							<tr>
								<th class="text-center">Kode Formulir</th>
								<th class="text-center">Judul Laporan</th>
								<th class="text-center">Isi</th>
								<th class="text-center">Bukti</th>
							</tr>
						</thead>
						<!--end::Thead-->
						<!--begin::Tbody-->
						<tbody class="border-gray-200 fs-5 fw-semibold bg-lighten">
							<tr>
								<td class="text-center">{{ $pengaduan->kode_formulir }}</td>
								<td class="text-center">{{ $pengaduan->judul }}</td>
								<td class="text-center">{{ $pengaduan->isi }}</td>
								<td class="text-center">
									@foreach ($pengaduan->bukti as $index => $file)
										@php
											$extension = pathinfo($file, PATHINFO_EXTENSION);
										@endphp

										@if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
											<!-- Tombol untuk Memperbesar Gambar -->
											<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $index }}">
												<img src="{{ asset('storage/bukti/' . $file) }}" alt="Bukti" class="img-thumbnail hover-scale" style="max-width: 80px;">
											</a>

											<!-- Modal untuk Perbesar Gambar -->
											<div class="modal fade" id="imageModal-{{ $index }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $index }}" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Pratinjau Bukti</h5>
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
															<img src="{{ asset('storage/bukti/' . $file) }}" alt="Bukti" class="img-fluid">
														</div>
													</div>
												</div>
											</div>

										@elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
											<!-- Tampilkan Video -->
											<video width="200" controls>
												<source src="{{ asset('storage/' . $file) }}" type="video/{{ $extension }}">
												Your browser does not support the video tag.
											</video>

										 @elseif($extension === 'pdf')
											<!-- Tombol Lihat PDF (tanpa download) -->
											<a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-primary">Lihat PDF</a>
										
										@else
											<!-- File selain gambar, video, atau PDF -->
											<a href="{{ asset('storage/' . $file) }}" class="btn btn-sm btn-secondary" target="_blank">Download File</a>
										@endif
									@endforeach
								</td>
							</tr>
						</tbody>
						<!--end::Tbody-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Table wrapper-->
			</div>
			<!--end::Body-->
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
										<h3>Form Tanggapan</h3>
									</div>
									<!--end::Title-->
								</div>
								<!--end::Header-->
								<div class="card-body p-0">
									<div class="row g-5">
										<div class="col-lg-12">
											<div class="mb-5">
												<!-- Form Tanggapan -->
												<form id="formTanggapan" novalidate>
													@csrf
													<input type="hidden" id="idPengaduan" name="id_pengaduan" value="{{ $pengaduan->id }}">
													<input type="hidden" id="kodeFormulir" name="kode_formulir" value="{{ $pengaduan->kode_formulir }}">
													<input type="hidden" id="idUser" name="id_users" value="{{ auth()->user()->id }}">

													<div class="card-body p-0">
														<div class="row g-5">
															<div class="col-lg-12">
																<div class="mb-5">
																	<textarea id="kt_docs_tinymce_hidden" name="isi_tanggapan" class="tox-target" placeholder="Isi Tanggapan" required></textarea>
																</div>
															</div>
														</div>
													</div>
													<div class="card-footer text-end">
														<button type="submit" class="btn btn-primary hover-scale">Kirim Tanggapan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
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