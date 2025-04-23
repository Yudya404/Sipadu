@extends('templates.base')
@section('title','Halaman Edit Media Sosial | Lapor !')
@section('breadcrumb','Edit Media Sosial')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="card shadow-sm ">
		<div class="card-header card-header-stretch">
			<div class="card-title">
				<h3>Form Untuk Edit/Update Media Sosial Website</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="row g-4">
				<!-- WhatsApp -->
				<div class="col-lg-6">
					<label for="whatsapp" class="form-label"><i class="fab fa-whatsapp text-success hover-scale"></i> WhatsApp</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
						<input type="text" class="form-control" id="whatsapp" placeholder="Masukkan No. WhatsApp">
						<button class="btn btn-success hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>

				<!-- Email -->
				<div class="col-lg-6">
					<label for="email" class="form-label"><i class="fas fa-envelope text-warning hover-scale"></i> Email</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						<input type="email" class="form-control" id="email" placeholder="Masukkan Email">
						<button class="btn btn-warning hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>

				<!-- Instagram -->
				<div class="col-lg-6">
					<label for="instagram" class="form-label"><i class="fab fa-instagram text-danger hover-scale"></i> Instagram</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fab fa-instagram"></i></span>
						<input type="text" class="form-control" id="instagram" placeholder="Masukkan Username Instagram">
						<button class="btn btn-danger hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>

				<!-- TikTok -->
				<div class="col-lg-6">
					<label for="tiktok" class="form-label"><i class="fab fa-tiktok text-dark hover-scale"></i> TikTok</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fab fa-tiktok"></i></span>
						<input type="text" class="form-control" id="tiktok" placeholder="Masukkan Username TikTok">
						<button class="btn btn-dark hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>

				<!-- Facebook -->
				<div class="col-lg-6">
					<label for="facebook" class="form-label"><i class="fab fa-facebook text-primary hover-scale"></i> Facebook</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fab fa-facebook"></i></span>
						<input type="text" class="form-control" id="facebook" placeholder="Masukkan Link Facebook">
						<button class="btn btn-primary hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>
				
				<!-- Twitter -->
				<div class="col-lg-6">
					<label for="twitter" class="form-label"><i class="fab fa-twitter text-info hover-scale"></i> Twitter</label>
					<div class="input-group">
						<span class="input-group-text"><i class="fab fa-twitter"></i></span>
						<input type="text" class="form-control" id="twitter" placeholder="Masukkan Link Twitter">
						<button class="btn btn-info hover-scale"><i class="fas fa-edit"></i> Update</button>
					</div>
				</div>
			</div>
		</div>
@endsection