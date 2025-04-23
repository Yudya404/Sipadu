@extends('templates.base')
@section('title','Halaman Log | Lapor !')
@section('breadcrumb','Halaman Log !')
@section('sidebar')
@include('includes.sidebar')
@endsection
@section('content')
<div class="app-container container-fluid">
	<!--begin::Row-->
	<div class="card shadow-sm ">
		<div class="card shadow-sm rounded-4 border border-gray-300">
			<div class="card-header py-4 bg-light d-flex justify-content-between align-items-center">
				<h3 class="card-title fw-bold text-dark mb-0">📜 Log Aplikasi</h3>

				<!-- Tombol Refresh -->
				<button type="button" class="btn btn-sm btn-light-primary hover-scale" onclick="document.getElementById('logViewerIframe').contentWindow.location.reload();">
					<i class="fas fa-sync-alt"></i> Muat Ulang
				</button>
			</div>

			<div class="card-body p-0" style="height: 500px;">
				<iframe 
					src="{{ request()->isSecure() ? secure_url('logs') : url('logs') }}" 
					style="width: 100%; height: 100%; border: none; border-radius: 0 0 1rem 1rem;" 
					title="Laravel Log Viewer"
					id="logViewerIframe">
				</iframe>
			</div>
		</div>

@endsection