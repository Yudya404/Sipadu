@extends('templates.base')
@section('title','Halaman Edit Footer | Lapor !')
@section('breadcrumb','Edit Footer')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="card shadow-sm ">
		<div class="card-header card-header-stretch">
			<div class="card-title">
				<h3>Form Untuk Edit/Update Footer Website</h3>
			</div>
		</div>
		<div class="card-body">
			<form id="formFooter" enctype="multipart/form-data">
				@csrf
				<div class="row g-4">
					<!-- Google Maps -->
					<div class="col-lg-12">
						<label class="form-label"><i class="fas fa-map-marker-alt hover-scale text-danger"></i> Embed Google Maps</label>
						<textarea class="form-control" id="maps" name="maps" rows="3" placeholder="Masukkan kode embed Google Maps"></textarea>
					</div>

					<!-- Alamat -->
					<div class="col-lg-6">
						<label class="form-label"><i class="fas fa-map-marked-alt hover-scale text-warning"></i> Alamat</label>
						<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap">
					</div>

					<!-- Telepon -->
					<div class="col-lg-6">
						<label class="form-label"><i class="fas fa-phone-alt hover-scale text-primary"></i> Telepon</label>
						<input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan nomor telepon">
					</div>

					<!-- Gambar Logo 1 -->
					<div class="col-lg-4">
						<label class="form-label"><i class="fas fa-image hover-scale text-info"></i> Gambar Logo 1</label>
						<div class="input-group">
							<input type="file" class="form-control" id="gambar1" name="gambar1" accept="image/*" onchange="previewImage('gambar1')">
						</div>
						<img id="preview-gambar1" class="img-thumbnail mt-2" width="200">
					</div>

					<!-- Gambar Logo 2 -->
					<div class="col-lg-4">
						<label class="form-label"><i class="fas fa-image hover-scale text-info"></i> Gambar Logo 2</label>
						<div class="input-group">
							<input type="file" class="form-control" id="gambar2" name="gambar2" accept="image/*" onchange="previewImage('gambar2')">
						</div>
						<img id="preview-gambar2" class="img-thumbnail mt-2" width="200">
					</div>

					<!-- Gambar Logo 3 -->
					<div class="col-lg-4">
						<label class="form-label"><i class="fas fa-image hover-scale text-info"></i> Gambar Logo 3</label>
						<div class="input-group">
							<input type="file" class="form-control" id="gambar3" name="gambar3" accept="image/*" onchange="previewImage('gambar3')">
						</div>
						<img id="preview-gambar3" class="img-thumbnail mt-2" width="200">
					</div>

					<!-- Tombol Simpan -->
					<div class="col-lg-12 text-center mt-4">
						<button type="submit" id="saSimpanFooter" class="btn btn-primary hover-scale"><i class="fas fa-save"></i> Simpan Perubahan</button>
					</div>
				</div>
			</form>
		</div>
@endsection