<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
	@include('includes.head')
</head>
@section('title','Halaman Masuk | Lapor !')
<!--end::Head-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-lg-row-fluid w-lg-40 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url('/assets/media/misc/bg.png')">
			<!--begin::Body-->
			<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
				<!--begin::Wrapper-->
				<div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
					<!--begin::Content-->
					<div class="w-md-400px">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
							@csrf
							<!--begin::Heading-->
							<div class="px-10 text-center mb-10">
								<img class="hover-scale mt-5" src="/img/img/laporMaseBaru.png" height="50px">
								<br>
								<img class="hover-scale" src="/img/img/logoPemkabBaru.png" height="50px">
							</div>
							<!--begin::Input group=-->
							<div class="fv-row mb-8">
								<!--begin::NIP/NIPTT-PK	-->
								<label for="basic-url" class="form-label fs-6 fw-bolder text-primary">NIP/NIPTT-PK</label>
								<input type="text" placeholder="NIP/NIPTT-PK" name="nip" autocomplete="username" class="form-control" />
								<!--end::NIP/NIPTT-PK-->
							</div>
							<!--begin::Input group-->
							<div class="fv-row mb-3">
								<!--begin::Sandi-->
								<label for="password" class="form-label fs-6 fw-bolder text-primary">Sandi</label>
								<div class="input-group position-relative">
									<input type="password" placeholder="Sandi" name="password" id="passwordField" autocomplete="current-password" class="form-control" />
									<span class="input-group-text">
										<i id="eyeIcon" class="fas fa-eye-slash cursor-pointer text-primary hover-scale" onclick="togglePasswordVisibility()"></i>
									</span>
								</div>

								<!-- Error message from FormValidation will show up here -->
							</div>
							<!--end::Input group-->
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
							<!--begin::Link-->
								<div class="flex-container">
									<td class="text-start"><a href="#" class="ps-0 btn-danger" data-bs-toggle="modal" data-bs-target="#bantuan">Bantuan Lainnya?</a>
								</div>
								<!--end::Link-->
							</div>
							<!--end::Wrapper-->
							<div class="modal fade" tabindex="-1" id="bantuan">
								<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-primary fw-bold">Butuh Bantuan</h5>
											<!--begin::Close-->
											<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
												<span class="svg-icon svg-icon-1">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
														<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
														<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
													</svg>
												</span>
											</div>
											<!--end::Close-->
										</div>
										<div class="modal-body center-align">
											<img src="/img/img/bantuan.png" style="width:100%; height:80%; display:block; margin:auto;" alt="Helpdesk" />
										</div>
									</div>
								</div>
							</div> 
							<!--begin::Submit button-->
							<div class="d-grid mb-10">
								<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
									<!--begin::Indicator label-->
									<span class="indicator-label">Masuk</span>
									<!--end::Indicator label-->
									<!--begin::Indicator progress-->
									<span class="indicator-progress">Mohon Tunggu...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
									<!--end::Indicator progress-->
								</button>
							</div>
							<!--end::Submit button-->
							<!--begin::Footer-->
							<div>
								<!--begin::Links-->
								<div class="px-5 text-center">
									<div class="text-gray-600 fs-base text-center fw-semibold">
										<div class="text-dark order-2 order-md-1">
											<span class="text-gray-800">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Pemerintah Kabupaten Pasuruan </span>
											<a href="#" target="_blank" class="text-gray-800 text-hover-primary"><b>Semua Hak Dilindungi.</b></a>
										</div>
									</div>
								</div>
								<!--end::Links-->
							</div>
							<!--end::Footer-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Body-->
			
			<!--begin::Aside-->
			<div>
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-10 w-100">
					<!--begin::Image-->
					<img class="d-none d-lg-block mx-auto center-align w-500px w-md-50 w-xl-500px mb-5 mb-lg-0 hover-scale" src="/img/img/bg.png" alt="Gambar Icon" />
					<br>
					<!--end::Image-->
					<!--begin::Title-->
					<h1 class="d-none d-lg-block text-white fs-1qx fw-bolder text-center mb-2">VISI LAPOR !</h1>
					<!--end::Title-->
					<!--begin::Text-->
					<div class="d-none d-lg-block text-white fs-base text-center fw-semibold">"Berani LAPOR! Untuk Pelayanan Publik yang Lebih Baik"
						<br>
					</div>
					<!--end::Text-->
					<!--begin::Title-->
					<h1 class="d-none d-lg-block text-white fs-1qx fw-bolder text-center mb-2">VALUE</h1>
					<!--end::Title-->
					<!--begin::Text-->
					<div class="d-none d-lg-block text-white fs-base text-center fw-semibold">ETIKA&#10020;INTEGRITAS&#10020;PROFESIONALISME&#10020;RAHASIA
						<br/>
					</div>
					<!--end::Text-->
				</div>
				<!--end::Text-->
			</div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
    </div>
	<!--end::Root-->
	<!--begin::Javascript-->
	<script>var hostUrl = "/assets/";</script>

	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="/assets/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->

	<!--begin::Custom Javascript(used by this page)-->
	<script src="/assets/js/custom/authentication/sign-in/general.js"></script>
	<!--end::Custom Javascript-->
	<!-- Tambahkan script ini di bagian bawah sebelum </body> -->
	<script>
		function togglePasswordVisibility() {
			const passwordInput = document.getElementById("passwordField");
			const eyeIcon = document.getElementById("eyeIcon");
			
			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				eyeIcon.classList.remove("fa-eye-slash");
				eyeIcon.classList.add("fa-eye");
			} else {
				passwordInput.type = "password";
				eyeIcon.classList.remove("fa-eye");
				eyeIcon.classList.add("fa-eye-slash");
			}
		}
	</script>
	<!--end::Javascript-->
</body>
</html>