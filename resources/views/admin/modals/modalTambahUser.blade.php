<!--Begin Modal-->
<div class="modal-header">
	<h3 class="modal-title">Tambah Pengguna</h3>
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
						<form id="userFormTambah" method="POST" action="" enctype="multipart/form-data">
							<div class="row g-5">
								<div class="col-lg-4">
									<div class="mb-5">
										<label class="required d-block fw-semibold fs-6 mb-5">Foto</label>
										<div class="image-input image-input-outline" data-kt-image-input="true">
											<div class="image-input-wrapper w-125px h-125px"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Gambar">
												<i class="fa fa-pencil fs-7"></i>
													<input type="file" name="" accept=".png, .jpg, .jpeg">
													<input type="hidden" name="avatar_remove">
											</label>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
												<i class="fa fa-trash fs-2"></i>
											</span>
										</div>
										<div class="form-text">Jenis file yang diperbolehkan: png, jpg, jpeg.</div>
									</div>
								</div>
								<div class="col-lg-4"> 
									<div class="mb-5">
										<label class="required form-label fs-5">Hak Akses</label>
										<div class="row form-check form-check-custom form-check-solid form-check-primary">
											<div class="col-6">
												<input class="form-check-input" type="radio" id="roleAdminTambah" name="">
												<label class="form-check-label" for="roleAdminTambah">Super user</label>
											</div>
											<div class="col-6">
												<input class="form-check-input" type="radio" id="roleKasirTambah" name="" >
												<label class="form-check-label" for="roleKasirTambah">User</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4"> 
									<div class="mb-5">
										<label class="required form-label fs-5">Jenis Kelamin</label>
										<div class="row form-check form-check-custom form-check-solid form-check-primary">
											<div class="col-6">
												<input class="form-check-input" type="radio" id="roleAdminTambah" name="">
												<label class="form-check-label" for="roleAdminTambah">Laki-laki</label>
											</div>
											<div class="col-6">
												<input class="form-check-input" type="radio" id="roleKasirTambah" name="" >
												<label class="form-check-label" for="roleKasirTambah">Perempuan</label>
											</div>
										</div>
									</div>
								</div>
								<!-- Kolom Kiri -->
								<div class="col-lg-6">
									<div class="mb-5">
										<label class="required form-label fs-5">NIP/NIPTT-PK</label>
										<input type="text" id="namaEdit" name="nama" class="form-control form-control-solid" placeholder="NIP/NIPTT-PK Anda" autocomplete="name" required>
									</div>
									<div class="mb-5">
										<label class="required form-label fs-5">Nama</label>
										<input type="text" id="namaEdit" name="nama" class="form-control form-control-solid" placeholder="Nama Anda" autocomplete="name" required>
									</div>
									<div class="mb-5">
										<label class="form-label fs-5">No. Telp</label>
										<input type="text" id="namaEdit" name="nama" class="form-control form-control-solid" placeholder="No. Telp Anda" autocomplete="name" required>
									</div>
									<div class="mb-5">
										<label class="required fw-semibold fs-6 mb-2">Email</label>
										<input type="email" id="emailEdit" name="email" class="form-control form-control-solid" placeholder="Email Anda" autocomplete="email" required>
									</div>
									<div class="mb-5">
										<label class="required form-label fs-5">Alamat</label>
										<textarea class="form-control form-control-solid" placeholder="Alamat" type="hidden" name="" rows="3" autocomplete="street-address"></textarea>
									</div>
								</div>
								<!-- Kolom Kanan -->
								<div class="col-lg-6">
									<div class="mb-5">
										<label class="required form-label fs-5">Jabatan</label>
										<select id="jabatanSelectTambah" class="form-select form-select-solid" data-control="select2" data-allow-clear="true" data-placeholder="Pilih Jabatan">
											<optgroup label="Pejabat Tinggi">
												<option value="kepala_daerah" selected>Kepala Daerah</option>
												<option value="sekretaris_daerah">Sekretaris Daerah</option>
											</optgroup>
											<optgroup label="Pejabat Menengah">
												<option value="kepala_dinas">Kepala Dinas</option>
												<option value="camat">Camat</option>
											</optgroup>
											<optgroup label="Pejabat Rendah">
												<option value="lurah">Lurah</option>
												<option value="ketua_rt">Ketua RT</option>
											</optgroup>
										</select>
									</div>
									<div class="mb-5">
										<label class="required fw-semibold fs-6 mb-2">Username</label>
										<input type="email" id="emailEdit" name="username" class="form-control form-control-solid" placeholder="Email" autocomplete="username" required>
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
												<input type="password" id="password_u" name="password_u" class="form-control form-control-lg form-control-solid" placeholder="******" autocomplete="new-password" />
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
										<input type="password" id="password_u_confirmation" name="password_u_confirmation" class="form-control form-control-lg form-control-solid" placeholder="******" autocomplete="new-password" />
									</div>
									<!--end::Input group-->
								</div>
								<div class="text-center">Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.</div>
							</div>
							<div class="separator border-dark my-10"></div>
							<div class="modal-footer">
								<button type="button" id="saSimpanTambahUser" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal-->