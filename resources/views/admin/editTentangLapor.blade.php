@extends('templates.base')
@section('title','Halaman Edit Tentang Lapor | Lapor !')
@section('breadcrumb','Edit Tentang Lapor !')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="card shadow-sm ">
		<div class="card-header card-header-stretch">
			<div class="card-title">
				<h3>Form Untuk Edit/Update Tentang Lapor !</h3>
			</div>
		</div>
		<div class="card-body">
			<form id="formTentangLapor" enctype="multipart/form-data">
				@csrf
				<div class="row g-4">
					<!-- Embed Video Tutorial Lapor -->
					<div class="col-lg-12">
						<label class="form-label"><i class="fas fa-video text-danger hover-scale"></i> Embed Video Tutorial Lapor!</label>
						<textarea class="form-control" id="video" name="video" rows="3" placeholder="Masukkan kode embed video tutorial"></textarea>
					</div>

					<!-- Deskripsi Tentang Kami -->
					<div class="col-lg-12">
						<label class="form-label"><i class="fas fa-info-circle text-warning hover-scale"></i> Deskripsi Tentang Kami</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi tentang kami"></textarea>
					</div>
					
					<!-- Gambar Logo 1 -->
					<div class="col-lg-6">
						<label class="form-label"><i class="fas fa-image text-info hover-scale"></i> Gambar Logo 1</label>
						<div class="input-group">
							<input type="file" class="form-control" id="gambar1" name="gambar1" accept="image/*" onchange="previewImage('gambar1')">
						</div>
						<img id="preview-gambar1" class="img-thumbnail mt-2" width="200">
					</div>

					<!-- Gambar Logo 2 -->
					<div class="col-lg-6">
						<label class="form-label"><i class="fas fa-image text-info hover-scale"></i> Gambar Logo 2</label>
						<div class="input-group">
							<input type="file" class="form-control" id="gambar2" name="gambar2" accept="image/*" onchange="previewImage('gambar2')">
						</div>
						<img id="preview-gambar2" class="img-thumbnail mt-2" width="200">
					</div>
					
					<div class="col-lg-6">
						<label class="form-label">Keterangan Gambar 1</label>
						<input type="text" class="form-control" id="ket_gambar1" name="ket_gambar1" placeholder="Masukkan Keterangan Gambar 1">
					</div>

					<!-- Telepon -->
					<div class="col-lg-6">
						<label class="form-label">Keteranagn Gambar 2</label>
						<input type="text" class="form-control" id="ket_gambar2" name="ket_gambar2" placeholder="Masukkan Keterangan Gambar 1">
					</div>
					
					<!-- Tombol Simpan -->
					<div class="col-lg-12 text-center mt-4">
						<button type="submit"  id="saSimpanTentangLapor" class="btn btn-primary hover-scale"><i class="fas fa-upload"></i>Unggah</button>
					</div>
				</div>
			</form>
		</div>
@endsection