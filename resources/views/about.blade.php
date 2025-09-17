@extends('layout')

@section('content')
<div class="row">
  <div class="col-md-4">
    <img src="{{ asset('uploads/foto/profilku.jpg') }}" class="img-fluid rounded" alt="Foto">
  </div>
  <div class="col-md-8">
    <h3>Aplikasi ini dibuat oleh:</h3>
    <p><strong>Nama:</strong> Gading Seto Satrio</p>
    <p><strong>Prodi:</strong> D3-MI PSDKU KEDIRI</p>
    <p><strong>NIM:</strong> 2331730128</p>
    <p><strong>Tanggal pembuatan aplikasi:</strong> 18-09-2025</p>
  </div>
</div>
@endsection
