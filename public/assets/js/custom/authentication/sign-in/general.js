"use strict";

var KTSigninGeneral = (function () {
    var form, submitButton, validator;

    var handleValidation = function () {
        if (!form) return;

        validator = FormValidation.formValidation(form, {
            fields: {
                'nip': {
                    validators: {
                        notEmpty: { message: 'NIP/NIPTT-PK dibutuhkan' },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'NIP/NIPTT-PK hanya boleh berisi angka'
                        }
                    }
                },
                'password': {
                    validators: {
                        notEmpty: { message: 'Sandi dibutuhkan' }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        });
    };

    var handleSubmit = function () {
        if (!submitButton) return;

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
			if (localStorage.getItem('login_lock_until')) {
				const now = Date.now();
				const lockUntil = parseInt(localStorage.getItem('login_lock_until'), 10);

				if (now < lockUntil) {
					Swal.fire({
						html: `Terlalu banyak percobaan login. Silakan coba lagi dalam <strong><span id="countdown">${Math.floor((lockUntil - now) / 1000)}</span></strong> detik.`,
						icon: "error",
						showConfirmButton: false,
						allowOutsideClick: false
					});
					return; // stop kirim form
				}
			}

            if (!validator) return;

            validator.validate().then(function (status) {
                if (status === 'Valid') {
                    var formData = new FormData(form);

                    // Aktifkan indikator loading
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    // Kirim data ke server
                    fetch('/login', {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
							"Accept": "application/json"
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw { status: response.status, data: data };
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;

                        if (data.success) {
                            Swal.fire({
                                text: "Selamat, Anda telah sukses masuk.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Lanjutkan",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(() => {
                                window.location = data.redirect_url;
                            });
                        }
                    })
                    .catch(error => {
						submitButton.removeAttribute('data-kt-indicator');
						submitButton.disabled = false;

						// Pastikan response dan datanya diakses dengan aman
						const status = error.status;
						const data = error.data;

						if (status === 401) {
							Swal.fire({
								text: data?.message || "NIP atau Password salah, silahkan coba lagi.",
								icon: "warning",
								buttonsStyling: false,
								confirmButtonText: "Oke, mengerti!",
								customClass: { confirmButton: "btn btn-primary" }
							});
						} else if (status === 422) {
							let messages = Object.values(data?.errors || {}).flat().join('<br>');
							Swal.fire({
								html: messages,
								icon: "warning",
								buttonsStyling: false,
								confirmButtonText: "Oke, mengerti!",
								customClass: { confirmButton: "btn btn-primary" }
							});
						} else if (status === 429) {
							let countdown = data?.retry_after ?? 60;
							const now = Date.now();
							const unlockTime = now + countdown * 1000;

							// Simpan waktu di localStorage agar tetap disable meski halaman di-refresh
							localStorage.setItem('login_lock_until', unlockTime);

							submitButton.disabled = true;

							Swal.fire({
								html: `Terlalu banyak percobaan login. Silakan coba lagi dalam <strong><span id="countdown">${countdown}</span></strong> detik.`,
								icon: "error",
								showConfirmButton: false,
								allowOutsideClick: false,
								willOpen: () => {
									const countdownEl = Swal.getHtmlContainer().querySelector('#countdown');
									const timer = setInterval(() => {
										countdown--;
										countdownEl.textContent = countdown;

										if (countdown <= 0) {
											clearInterval(timer);
											Swal.close();
											submitButton.disabled = false;
											localStorage.removeItem('login_lock_until');
										}
									}, 1000);
								}
							});
						} else {
							Swal.fire({
								text: "Terjadi kesalahan, coba lagi nanti.",
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Oke, mengerti!",
								customClass: { confirmButton: "btn btn-primary" }
							});
						}
					});
                }
            });
        });
    };

    return {
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            if (form && submitButton) {
                handleValidation();
                handleSubmit();
            }

            if (typeof generateHeader === "function") {
                generateHeader();
            }
			
			const lockUntil = localStorage.getItem('login_lock_until');
			if (lockUntil) {
				const now = Date.now();
				const remaining = Math.floor((lockUntil - now) / 1000);

				if (remaining > 0) {
					submitButton.disabled = true;

					Swal.fire({
						html: `Terlalu banyak percobaan login. Silakan coba lagi dalam <strong><span id="countdown">${remaining}</span></strong> detik.`,
						icon: "error",
						showConfirmButton: false,
						allowOutsideClick: false,
						willOpen: () => {
							const countdownEl = Swal.getHtmlContainer().querySelector('#countdown');
							const timer = setInterval(() => {
								const now = Date.now();
								const diff = Math.floor((lockUntil - now) / 1000);

								if (diff <= 0) {
									clearInterval(timer);
									Swal.close();
									submitButton.disabled = false;
									localStorage.removeItem('login_lock_until');
								} else {
									countdownEl.textContent = diff;
								}
							}, 1000);
						}
					});
				} else {
					localStorage.removeItem('login_lock_until');
				}
			}
        }
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
