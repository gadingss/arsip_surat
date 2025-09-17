@extends('layout')

@section('content')
<h4>Detail Surat</h4>
<div class="mb-3">
  <strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}
</div>
<div class="mb-3">
  <strong>Judul:</strong> {{ $surat->judul }}
</div>
<div class="mb-3">
  <strong>Kategori:</strong> {{ $surat->kategori->nama_kategori ?? '-' }}
</div>
<div class="mb-3">
  <strong>Waktu Unggah:</strong> {{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y H:i') }}
</div>

<div class="mb-3">
  <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-secondary">Unduh</a>
  <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali &lt;&lt;</a>
  <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-secondary">Edit/Ganti File</a>
</div>

<div>
  <h5>Preview</h5>
    <iframe src="{{ asset('uploads/surat/'.$surat->file_path) }}" width="100%" height="600px"></iframe>
</div>
@endsection
