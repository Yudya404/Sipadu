@extends('templates.base')
@section('title','Halaman Informasi User | Lapor !')
@section('breadcrumb','Informasi Pegawai')
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
							<label for="basic-url" class="form-label">NIP/NIPTT-PK/Nama</label>
							<div class="input-group">
								<span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan NIP/NIPTT-PK/Nama" id="search-input" onkeyup="searchTable()">
							</div>
						</div>
					</div>
					<div class="col-lg-3 d-flex align-items-end">
						<div class="text-end">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
								<i class="fa fa-plus"></i> Tambah Pegawai
							</button>
							<div class="modal fade" tabindex="-1" id="modalTambahPegawai" data-bs-backdrop="static" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title">Tambah Pegawai</h3>
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
																<form id="pegawaiFormTambah" enctype="multipart/form-data">
																	@csrf
																	<div class="row g-5">
																		<div class="col-lg-6">
																			<div class="mb-5">
																				<label class="required d-block fw-semibold fs-6 mb-5">Foto</label>
																				<div class="image-input image-input-outline" data-kt-image-input="true">
																					<div class="image-input-wrapper w-125px h-125px"></div>
																					<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Gambar">
																						<i class="fa fa-pencil fs-7"></i>
																							<input type="file" name="foto" accept=".png, .jpg, .jpeg">
																							<input type="hidden" name="avatar_remove">
																					</label>
																					<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
																						<i class="fa fa-trash fs-2"></i>
																					</span>
																				</div>
																				<div class="form-text">Jenis file yang diperbolehkan: png, jpg, jpeg.</div>
																			</div>
																		</div>
																		<div class="col-lg-6"> 
																			<div class="mb-5">
																				<label class="required form-label fs-5">Hak Akses</label>
																				<div class="row form-check form-check-custom form-check-solid form-check-primary">
																					<div class="col-6">
																						<input class="form-check-input" type="radio" id="roleKepalaTambah" name="role" value="Kepala">
																						<label class="form-check-label" for="roleKepalaTambah">Kepala</label>
																					</div>
																					<div class="col-6">
																						<input class="form-check-input" type="radio" id="roleAdminTambah" name="role" value="Admin">
																						<label class="form-check-label" for="roleAdminTambah">Admin</label>
																					</div>
																				</div>
																			</div>
																		</div>
																		<!-- Kolom Kiri -->
																		<div class="col-lg-6">
																			<div class="mb-5">
																				<label class="required form-label fs-5">NIP/NIPTT-PK</label>
																				<input type="text" id="nipTambah" name="nip" class="form-control form-control-solid" placeholder="NIP/NIPTT-PK Anda" required>
																			</div>
																			<div class="mb-5">
																				<label class="required form-label fs-5">Nama</label>
																				<input type="text" id="namaTambah" name="nama" class="form-control form-control-solid" placeholder="Nama Anda" autocomplete="name" required>
																			</div>
																			<div class="mb-5">
																				<label class="form-label fs-5">No. Telp</label>
																				<input type="text" id="telpTambah" name="telp" class="form-control form-control-solid" placeholder="No. Telp Anda" autocomplete="tel" required>
																			</div>
																			<div class="mb-5">
																				<label class="required fw-semibold fs-6 mb-2">Email</label>
																				<input type="email" id="emailTambah" name="email" class="form-control form-control-solid" placeholder="Email Anda" autocomplete="email" required>
																			</div>
																			<div class="mb-5">
																				<label class="required form-label fs-5">Alamat</label>
																				<textarea class="form-control form-control-solid" placeholder="Alamat" name="alamat" rows="3" autocomplete="street-address"></textarea>
																			</div>
																		</div>
																		<!-- Kolom Kanan -->
																		<div class="col-lg-6">
																			<div class="mb-5">
																				<label class="required form-label fs-5">Instansi</label>
																				<select id="instansiSelectTambah" name="id_instansi" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Instansi">
																					<option value="" disabled selected>Pilih Instansi</option>
																				</select>
																			</div>
																			<div class="mb-5">
																				<label class="required form-label fs-5">Jabatan</label>
																				<select id="jabatanSelectTambah" name="jabatan" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Jabatan">
																					<option value="" disabled selected>Pilih Jabatan</option>
																					<option value="Kepala">Kepala Unit/Bagian</option>
																					<option value="Admin">Staf</option>
																				</select>
																			</div>
																			<div class="mb-5">
																				<label class="required fw-semibold fs-6 mb-2">Username</label>
																				<input type="text" id="usernameTambah" name="username" class="form-control form-control-solid" placeholder="Username" autocomplete="username" required>
																			</div>
																			<!--begin::Input group-->
																			<div class="mb-10 fv-row" data-kt-password-meter="true">
																				<!--begin::Wrapper-->
																				<div class="mb-1">
																				<!--begin::Label-->
																					<label class="required fw-semibold fs-6 mb-2">Password</label>
																					<!--end::Label-->
																					<!--begin::Input wrapper-->
																					<div class="position-relative mb-3">
																						<input type="password" id="passwordTambah" name="password" class="form-control form-control-lg form-control-solid" placeholder="Password Anda" autocomplete="new-password" />
																						<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
																							<i class="ki-duotone ki-eye-slash fs-2"></i>
																							<i class="ki-duotone ki-eye fs-2 d-none"></i>
																						</span>
																					</div>
																					<!--end::Input wrapper-->
																					<!--begin::Meter-->
																					<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
																						<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																						<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																						<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																						<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
																					</div>
																					<!--end::Meter-->
																				</div>
																				<!--end::Wrapper-->
																			</div>
																			<!--end::Input group=-->
																			<!--begin::Input group-->
																			<div class="fv-row mb-5">
																				<label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
																				<input type="password" id="passwordConfirmationTambah" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Ulangin Password" autocomplete="new-password" />
																			</div>
																			<!--end::Input group-->
																		</div>
																		<div class="text-center">Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.</div>
																	</div>
																	<div class="separator border-dark my-10"></div>
																	<div class="modal-footer">
																		<button type="button" id="saSimpanTambahPegawai" class="btn btn-primary">Simpan</button>
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
										<h3>Daftar Pegawai</h3>
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
													<th class="text-center">NIP/NIPTT-PK</th>
													<th class="text-center">Nama</th>
													<th class="text-center">No, Telp</th>
													<th class="text-center">Jabatan</th>
													<th class="text-center">Hak Akses</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<!--end::Thead-->
											<!--begin::Tbody-->
											<tbody class="border-gray-200 fs-5 fw-semibold bg-lighten">
											@foreach($users as $data)
												<tr>
													<td class="text-center">{{ $data->nip }}</td>
													<td class="text-center">{{ $data->nama }}</td>
													<td class="text-center">{{ $data->telp }}</td>
													<td class="text-center">
														@if($data->jabatan == 'Super user')
															<span class="badge badge-success">Administrator</span>
															@elseif($data->jabatan == 'Bot')
															<span class="badge badge-danger">Bot Sistem</span>
															@elseif($data->jabatan == 'Kepala')
															<span class="badge badge-primary">Kepala Unit</span>
															@elseif($data->jabatan == 'Admin')
															<span class="badge badge-info">Staf</span>
														@endif
													</td>
													<td>
														@if($data->role == 'Super user')
															<span class="badge badge-success">Administrator</span>
														@elseif($data->role == 'Kepala')
															<span class="badge badge-primary">Kepala Unit</span>
														@elseif($data->role == 'Admin')
															<span class="badge badge-info">Admin</span>
														@endif
													</td>
													<td class="text-center">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-info btnDetailPegawai" data-toggle="modal" data-bs-target="#modalDetailPegawai" data-id="{{ $data->id }}">
																<i class="fa fa-eye"></i>
															</button>
															<div class="modal fade" tabindex="-1" id="modalDetailPegawai" data-bs-backdrop="static" aria-hidden="true">
																<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
																	<div class="modal-content">
																		<!--Begin Modal-->
																		<div class="modal-header">
																			<h3 class="modal-title">Detail Pegawai</h3>
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
																						<div class="card-body row">
																							<div class="col-lg-6 d-flex flex-column">
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">NIP/NIPTT-PK</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailNipPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Nama</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailNamaPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">No. Telp</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailTelpPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Email</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailEmailPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Alamat</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailAlamatPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Jabatan</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailJabatanPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-3">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Instansi</label>
																										</div>
																									</div>
																									<div class="col-lg-9">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailInstansiPegawai"></label>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-lg-6 d-flex flex-column">
																								<div class="row g-5">
																									<div class="col-lg-6">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Foto</label>
																										</div>
																									</div>
																									<div class="col-lg-6">
																										<div class="col-lg-8">
																											<div class="image-input image-input-outline" data-kt-image-input="true">
																												<div class="image-input-wrapper w-125px h-125px" id="user-foto"></div>
																											</div>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Tanggal Daftar</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailTglDaftarPegawai"></span></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Username</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailUsernamePegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-4">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Hak Akses</label>
																										</div>
																									</div>
																									<div class="col-lg-8">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailHakAksesPegawai"></label>
																										</div>
																									</div>
																								</div>
																								<div class="row g-5">
																									<div class="col-lg-3">
																										<div class="mb-5">
																											<label for="exampleFormControlInput1" class="form-label fs-5">Aktivitas Login</label>
																										</div>
																									</div>
																									<div class="col-lg-9">
																										<div>:
																											<label for="exampleFormControlInput1" class="form-label fs-5" id="detailAktivitasLoginPegawai"></label>
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
																</div>
															</div>
															<!-- End Modal Detail-->
															<button type="button" class="btn btn-success" data-toggle="modal" data-bs-target="#modalEditPegawai" data-id="{{ $data->id }}">
																<i class="fa fa-edit"></i>
															</button>
															<div class="modal fade" tabindex="-1" id="modalEditPegawai" data-bs-backdrop="static" aria-label="Close">
																<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
																	<div class="modal-content">
																		<!--Begin Modal-->
																		<div class="modal-header">
																			<h3 class="modal-title">Edit Pegawai</h3>
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
																								<form id="pegawaiFormEdit" enctype="multipart/form-data">
																									@csrf
																									<div class="row g-5">
																										<div class="col-lg-6">
																											<div class="mb-5">
																												<label class="required d-block fw-semibold fs-6 mb-5">Foto</label>
																												<div class="image-input image-input-outline" data-kt-image-input="true">
																													<div class="image-input-wrapper w-125px h-125px" id="foto_preview"></div>
																													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
																														   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Gambar">
																														<i class="fa fa-pencil fs-7"></i>
																														<input type="file" name="foto" id="fotoEdit" accept=".png, .jpg, .jpeg">
																													</label>

																													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
																														  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
																														<i class="fa fa-trash fs-2"></i>
																													</span>
																												</div>
																												<div class="form-text">Jenis file yang diperbolehkan: png, jpg, jpeg.</div>
																											</div>
																										</div>
																										<div class="col-lg-6"> 
																											<div class="mb-5">
																												<label class="required form-label fs-5">Hak Akses</label>
																												<div class="row form-check form-check-custom form-check-solid form-check-primary">
																													<div class="col-6">
																														<input class="form-check-input" type="radio" id="roleKepalaEdit" name="role" value="Kepala">
																														<label class="form-check-label" for="roleKepalaEdit">Kepala</label>
																													</div>
																													<div class="col-6">
																														<input class="form-check-input" type="radio" id="roleAdminEdit" name="role" value="Admin">
																														<label class="form-check-label" for="roleAdminEdit">Admin</label>
																													</div>
																												</div>
																											</div>
																										</div>
																										<!-- Kolom Kiri -->
																										<div class="col-lg-6">
																											<div class="mb-5">
																												<input type="hidden" id="idPegawaiEdit" name="idPegawai">
																												<label class="required form-label fs-5">Nip</label>
																												<input type="text" id="nipEdit" name="nip" class="form-control form-control-solid" placeholder="Nip" required>
																											</div>
																											<div class="mb-5">
																												<label class="required form-label fs-5">Nama</label>
																												<input type="text" id="namaEdit" name="nama" class="form-control form-control-solid" placeholder="Nama" autocomplete="name" required>
																											</div>
																											<div class="mb-5">
																												<label class="required form-label fs-5">No. Telp</label>
																												<input type="text" id="telpEdit" name="telp" class="form-control form-control-solid" placeholder="No Telp" autocomplete="tel" required>
																											</div>
																											<div class="mb-5">
																												<label class="required fw-semibold fs-6 mb-2">Email</label>
																												<input type="email" id="emailEdit" name="email" class="form-control form-control-solid" placeholder="Email" autocomplete="email" required>
																											</div>
																											<div class="mb-5">
																												<label class="required form-label fs-5">Alamat</label>
																												<textarea id="alamatEdit" name="alamat" class="form-control form-control-solid" rows="3" placeholder="Alamat" autocomplete="street-address" required></textarea>
																											</div>
																										</div>
																										<!-- Kolom Kanan -->
																										<div class="col-lg-6">
																											<div class="mb-5">
																												<label class="required form-label fs-5">Instansi</label>
																												<select id="instansiSelectEdit" name="instansi" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Instansi">
																													<option value="" disabled>Pilih Instansi</option>
																												</select>
																											</div>
																											<div class="mb-5">
																												<label class="required form-label fs-5">Jabatan</label>
																												<select id="jabatanSelectEdit" name="jabatan" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Jabatan">
																													<option value="">Pilih Jabatan</option>
																													<option value="Kepala">Kepala Unit/Bagian</option>
																													<option value="Admin">Staf</option>
																												</select>
																											</div>
																											<div class="mb-5">
																												<label class="required fw-semibold fs-6 mb-2">Username</label>
																												<input type="text" id="usernameEdit" name="username" class="form-control form-control-solid" placeholder="Username" autocomplete="username" required>
																											</div>
																											<!--begin::Input group-->
																											<div class="mb-10 fv-row" data-kt-password-meter="true">
																												<!--begin::Wrapper-->
																												<div class="mb-1">
																												<!--begin::Label-->
																													<label class="required fw-semibold fs-6 mb-2">Password</label>
																													<!--end::Label-->
																													<!--begin::Input wrapper-->
																													<div class="position-relative mb-3">
																														<input type="password" id="passwordEdit" name="password" class="form-control form-control-lg form-control-solid" placeholder="******" autocomplete="new-password" />
																														<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
																															<i class="ki-duotone ki-eye-slash fs-2"></i>
																															<i class="ki-duotone ki-eye fs-2 d-none"></i>
																														</span>
																													</div>
																													<!--end::Input wrapper-->
																													<!--begin::Meter-->
																													<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
																														<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																														<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																														<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																														<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
																													</div>
																													<!--end::Meter-->
																												</div>
																												<!--end::Wrapper-->
																											</div>
																											<!--end::Input group=-->
																											<!--begin::Input group-->
																											<div class="fv-row mb-5">
																												<label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
																												<input type="password" id="passwordConfirmationEdit" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="******" autocomplete="new-password" />
																											</div>
																											<!--end::Input group-->
																										</div>
																										<div class="text-center">Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.</div>
																									</div>
																									<div class="separator border-dark my-10"></div>
																									<div class="modal-footer">
																										<button type="button" id="saSimpanEditPegawai" class="btn btn-primary" data-id="{{ $data->id }}">Simpan</button>
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
															<button type="button" class="btn btn-danger deleteUser" data-id="{{ $data->id }}">
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