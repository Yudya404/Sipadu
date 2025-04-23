@extends('templates.base')
@section('title','Halaman Informasi Instansi | Lapor !')
@section('breadcrumb','Informasi Instansi')
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
					<div class="col-lg-9">
						<div>
							<label for="basic-url" class="form-label">Nama Instansi</label>
							<div class="input-group">
								<span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan Nama Instansi" id="search-input" onkeyup="searchTable()">
							</div>
						</div>
					</div>
					<div class="col-lg-3 d-flex align-items-end">
						<div class="text-end">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahInstansi">
								<i class="fa fa-plus"></i> Tambah Instansi
							</button>
							<div class="modal fade" tabindex="-1" id="modalTambahInstansi" data-bs-backdrop="static" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title">Tambah Instansi</h3>
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
																<form id="instansiFormTambah" enctype="multipart/form-data">
																	@csrf
																	<div class="row g-5">
																		<!-- Kolom Kiri -->
																		<div class="col-lg-12">
																			<!-- Nama Instansi -->
																			<div class="mb-5">
																				<label class="required form-label fs-5">Nama Instansi</label>
																				<input type="text" id="namaTambah" name="nama" class="form-control form-control-solid" placeholder="Nama Instansi" autocomplete="name" required>
																			</div>
																			<!-- Tipe Instansi -->
																			<div class="mb-5">
																				<label class="required form-label fs-5">Tipe Instansi</label>
																				<select id="instansiTipeSelectTambah" name="tipe" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Tipe Instansi" required>
																					<option value="" disabled selected>Pilih Tipe Instansi</option>
																					<option value="Dinas">Dinas</option>
																					<option value="Lembaga">Lembaga</option>
																					<option value="BUMN">BUMN</option>
																					<option value="BUMD">BUMD</option>
																					<option value="Kecamatan">Kecamatan</option>
																					<option value="Kelurahan/Desa">Kelurahan/Desa</option>
																				</select>
																			</div>
																			<!-- Induk Instansi -->
																			<div class="mb-5">
																				<label class="required form-label fs-5">Induk Instansi</label>
																				<select id="instansiIndukSelectTambah" name="induk" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Induk Instansi" required>
																					<option value="" disabled selected>Pilih Induk Instansi</option>

																					<!-- Kementerian -->
																					<optgroup label="Kementerian">
																						<option value="Kementerian Keuangan">Kementerian Keuangan</option>
																						<option value="Kementerian Kesehatan">Kementerian Kesehatan</option>
																						<option value="Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</option>
																						<option value="Kementerian Dalam Negeri">Kementerian Dalam Negeri</option>
																						<option value="Kementerian Luar Negeri">Kementerian Luar Negeri</option>
																						<option value="Kementerian BUMN">Kementerian BUMN</option>
																						<option value="Kementerian Perhubungan">Kementerian Perhubungan</option>
																						<option value="Kementerian Pertanian">Kementerian Pertanian</option>
																						<option value="Kementerian Pekerjaan Umum & Perumahan Rakyat">Kementerian PUPR</option>
																						<option value="Kementerian Hukum & Hak Asasi Manusia">Kementerian Hukum & Hak Asasi Manusia</option>
																						<option value="Kementerian Sosial">Kementerian Sosial</option>
																						<option value="Kementerian Perindustrian & Perdagangan">Kementerian Perindustrian & Perdagangan</option>
																						<option value="Kementerian Komunikasi & Informatika">Kementerian Komunikasi & Informatika</option>
																						<option value="Kementerian Pariwisata & Ekonomi Kreatif">Kementerian Pariwisata & Ekonomi Kreatif</option>
																						<option value="Kementerian Lingkungan Hidup & Kehutanan">Kementerian Lingkungan Hidup & Kehutanan</option>
																						<option value="Kementerian Kelautan & Perikanan">Kementerian Kelautan & Perikanan</option>
																						<option value="Kementerian Agama">Kementerian Agama</option>
																						<option value="Kementerian Ketenagakerjaan">Kementerian Ketenagakerjaan</option>
																						<option value="Kementerian Energi & Sumber Daya Mineral">Kementerian Energi & Sumber Daya Mineral</option>
																						<option value="Kementerian Investasi/BKPM">Kementerian Investasi/BKPM</option>
																						<option value="Kementerian Pertahanan">Kementerian Pertahanan</option>
																						<option value="Kementerian Agraria & Tata Ruang">Kementerian Agraria & Tata Ruang</option>
																						<option value="Kementrian Perumahan & Kawasan Pemukiman">Kementrian Perumahan & Kawasan Pemukiman</option>
																						<option value="Kementerian Koperasi & Usaha Kecil dan Menengah">Kementerian Koperasi & Usaha Kecil dan Menengah</option>
																						<option value="Kementerian Koordinator Bidang Perekonomian">Kementerian Koordinator Bidang Perekonomian</option>
																						<option value="Kementerian Koordinator Bidang Kemaritiman & Investasi">Kementerian Koordinator Bidang Kemaritiman & Investasi</option>
																						<option value="Kementerian Koordinator Bidang Politik, Hukum, dan Keamanan">Kementerian Koordinator Bidang Politik, Hukum, dan Keamanan</option>
																						<option value="Kementerian Koordinator Bidang Pembangunan Manusia & Kebudayaan">Kementerian Koordinator Bidang Pembangunan Manusia & Kebudayaan</option>
																					</optgroup>

																					<!-- BUMN -->
																					<optgroup label="BUMN">
																						<option value="Bank Mandiri">Bank Mandiri</option>
																						<option value="Bank BRI">Bank BRI</option>
																						<option value="Bank BNI">Bank BNI</option>
																						<option value="Pertamina">Pertamina</option>
																						<option value="PLN">PLN</option>
																						<option value="Telkom Indonesia">Telkom Indonesia</option>
																						<option value="Garuda Indonesia">Garuda Indonesia</option>
																						<option value="PT Kereta Api Indonesia">PT Kereta Api Indonesia</option>
																						<option value="PT Taspen">PT Taspen</option>
																					</optgroup>

																					<!-- BUMD -->
																					<optgroup label="BUMD">
																						<option value="PDAM">PDAM (Perusahaan Daerah Air Minum)</option>
																						<option value="Bank Jatim">Bank Jatim</option>
																					</optgroup>

																					<!-- Lembaga Negara & Lainnya -->
																					<optgroup label="Lembaga & Badan">
																						<option value="BPJS Kesehatan">BPJS Kesehatan</option>
																						<option value="BPJS Ketenagakerjaan">BPJS Ketenagakerjaan</option>
																						<option value="BPOM">BPOM</option>
																						<option value="Pemerintah Provinsi Jawa Timur">Pemerintah Provinsi Jawa Timur</option>
																						<option value="Pemerintah Kabupaten">Pemerintah Kabupaten</option>
																					</optgroup>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="separator border-dark my-10"></div>
																	<div class="modal-footer">
																		<button type="button" id="saSimpanTambahInstansi" class="btn btn-primary">Simpan</button>
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
							<!-- End Modal Tambah-->
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
										<h3>Daftar Instansi</h3>
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
													<th class="text-center">Nama Instansi</th>
													<th class="text-center">Tipe Instansi</th>
													<th class="text-center">Induk Instansi</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<!--end::Thead-->
											<!--begin::Tbody-->
											<tbody class="border-gray-200 fs-5 fw-semibold bg-lighten">
											@foreach($instansi as $data)
												<tr>
													<td class="text-center">{{ $data->nama }}</td>
													<td class="text-center">{{ $data->tipe }}</td>
													<td class="text-center">{{ $data->induk }}</td>
													<td class="text-center">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditInstansi" data-id="{{ $data->id }}">
																<i class="fa fa-edit"></i>
															</button>
															<div class="modal fade" tabindex="-1" id="modalEditInstansi" data-bs-backdrop="static" aria-hidden="true">
																<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
																	<div class="modal-content">
																		<!--Begin Modal-->
																		<div class="modal-header">
																			<h3 class="modal-title">Edit Instansi</h3>
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
																								<form id="instansiFormEdit" enctype="multipart/form-data">
																									@csrf
																									<div class="row g-5">
																										<!-- Kolom Kiri -->
																										<div class="col-lg-12">
																											<div class="mb-5">
																												<input type="hidden" id="idInstansiEdit" name="idInstansi">
																												<label class="required form-label fs-5">Nama Instansi</label>
																												<input type="text" id="namaEdit" name="nama" class="form-control form-control-solid" placeholder="Nama" autocomplete="name" required>
																											</div>
																											<!-- Tipe Instansi -->
																											<div class="mb-5">
																												<label class="required form-label fs-5">Tipe Instansi</label>
																												<select id="instansiTipeSelectEdit" name="tipe" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Tipe Instansi" required>
																													<option value="" disabled selected>Pilih Tipe Instansi</option>
																													<option value="Dinas">Dinas</option>
																													<option value="Lembaga">Lembaga</option>
																													<option value="BUMN">BUMN</option>
																													<option value="BUMD">BUMD</option>
																												</select>
																											</div>
																											<!-- Induk Instansi -->
																											<div class="mb-5">
																												<label class="required form-label fs-5">Induk Instansi</label>
																												<select id="instansiIndukSelectEdit" name="induk" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Induk Instansi" required>
																													<option value="" disabled selected>Pilih Induk Instansi</option>

																													<!-- Kementerian -->
																													<optgroup label="Kementerian">
																														<option value="Kementerian Keuangan">Kementerian Keuangan</option>
																														<option value="Kementerian Kesehatan">Kementerian Kesehatan</option>
																														<option value="Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</option>
																														<option value="Kementerian Dalam Negeri">Kementerian Dalam Negeri</option>
																														<option value="Kementerian Luar Negeri">Kementerian Luar Negeri</option>
																														<option value="Kementerian BUMN">Kementerian BUMN</option>
																														<option value="Kementerian Perhubungan">Kementerian Perhubungan</option>
																														<option value="Kementerian Pertanian">Kementerian Pertanian</option>
																														<option value="Kementerian Pekerjaan Umum & Perumahan Rakyat">Kementerian PUPR</option>
																														<option value="Kementerian Hukum & Hak Asasi Manusia">Kementerian Hukum & Hak Asasi Manusia</option>
																														<option value="Kementerian Sosial">Kementerian Sosial</option>
																														<option value="Kementerian Perindustrian & Perdagangan">Kementerian Perindustrian & Perdagangan</option>
																														<option value="Kementerian Komunikasi & Informatika">Kementerian Komunikasi & Informatika</option>
																														<option value="Kementerian Pariwisata & Ekonomi Kreatif">Kementerian Pariwisata & Ekonomi Kreatif</option>
																														<option value="Kementerian Lingkungan Hidup & Kehutanan">Kementerian Lingkungan Hidup & Kehutanan</option>
																														<option value="Kementerian Kelautan & Perikanan">Kementerian Kelautan & Perikanan</option>
																														<option value="Kementerian Agama">Kementerian Agama</option>
																														<option value="Kementerian Ketenagakerjaan">Kementerian Ketenagakerjaan</option>
																														<option value="Kementerian Energi & Sumber Daya Mineral">Kementerian Energi & Sumber Daya Mineral</option>
																														<option value="Kementerian Investasi/BKPM">Kementerian Investasi/BKPM</option>
																														<option value="Kementerian Pertahanan">Kementerian Pertahanan</option>
																														<option value="Kementerian Agraria & Tata Ruang">Kementerian Agraria & Tata Ruang</option>
																														<option value="Kementrian Perumahan & Kawasan Pemukiman">Kementrian Perumahan & Kawasan Pemukiman</option>
																														<option value="Kementerian Koperasi & Usaha Kecil dan Menengah">Kementerian Koperasi & Usaha Kecil dan Menengah</option>
																														<option value="Kementerian Koordinator Bidang Perekonomian">Kementerian Koordinator Bidang Perekonomian</option>
																														<option value="Kementerian Koordinator Bidang Kemaritiman & Investasi">Kementerian Koordinator Bidang Kemaritiman & Investasi</option>
																														<option value="Kementerian Koordinator Bidang Politik, Hukum, dan Keamanan">Kementerian Koordinator Bidang Politik, Hukum, dan Keamanan</option>
																														<option value="Kementerian Koordinator Bidang Pembangunan Manusia & Kebudayaan">Kementerian Koordinator Bidang Pembangunan Manusia & Kebudayaan</option>
																													</optgroup>

																													<!-- BUMN -->
																													<optgroup label="BUMN">
																														<option value="Bank Mandiri">Bank Mandiri</option>
																														<option value="Bank BRI">Bank BRI</option>
																														<option value="Bank BNI">Bank BNI</option>
																														<option value="Pertamina">Pertamina</option>
																														<option value="PLN">PLN</option>
																														<option value="Telkom Indonesia">Telkom Indonesia</option>
																														<option value="Garuda Indonesia">Garuda Indonesia</option>
																														<option value="PT Kereta Api Indonesia">PT Kereta Api Indonesia</option>
																													</optgroup>

																													<!-- BUMD -->
																													<optgroup label="BUMD">
																														<option value="PDAM">PDAM (Perusahaan Daerah Air Minum)</option>
																														<option value="Bank Jatim">Bank Jatim</option>
																													</optgroup>

																													<!-- Lembaga Negara & Lainnya -->
																													<optgroup label="Lembaga & Badan">
																														<option value="BPJS Kesehatan">BPJS Kesehatan</option>
																														<option value="BPJS Ketenagakerjaan">BPJS Ketenagakerjaan</option>
																														<option value="BPOM">BPOM</option>
																														<option value="Badan Pendapatan Daerah">Badan Pendapatan Daerah</option>
																														<option value="Pemerintah Provinsi Jawa Timur">Pemerintah Provinsi Jawa Timur</option>
																														<option value="Pemerintah Kabupaten">Pemerintah Kabupaten</option>
																													</optgroup>
																												</select>
																											</div>
																										</div>
																									</div>
																									<div class="separator border-dark my-10"></div>
																									<div class="modal-footer">
																										<button type="button" id="saSimpanEditInstansi" class="btn btn-primary" data-id="{{ $data->id }}">Simpan</button>
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
															<!-- Button hapus dengan atribut data-id -->
															<button type="button" class="btn btn-danger deleteInstansi" data-id="{{ $data->id }}">
																<i class="fa fa-trash"></i>
															</button>
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