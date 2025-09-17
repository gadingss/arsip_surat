@extends('layout')

@section('content')
<h4>{{ $surat ? 'Edit Surat' : 'Arsipkan Surat' }}</h4>
<form method="post" enctype="multipart/form-data" action="{{ $surat ? route('surat.update',$surat->id) : route('surat.store') }}">
  @csrf
  @if($surat) @method('PUT') @endif

  <div class="mb-3">
    <label>Nomor Surat</label>
    <input class="form-control" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat ?? '') }}">
  </div>

  <div class="mb-3">
    <label>Kategori</label>
    <select name="kategori_id" class="form-select" required>
      <option value="">-- Pilih --</option>
      @foreach($kategori as $k)
        <option value="{{ $k->id }}" {{ (old('kategori_id', $surat->kategori_id ?? '') == $k->id) ? 'selected':'' }}>
          {{ $k->nama_kategori }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label>Judul</label>
    <input class="form-control" name="judul" required value="{{ old('judul', $surat->judul ?? '') }}">
  </div>



  <!-- <div class="mb-3">
    <label>Tanggal</label>
    <input type="date" class="form-control" name="tanggal" required value="{{ old('tanggal', $surat->tanggal ?? '') }}">
  </div> -->

  <div class="mb-3">
    <label>File PDF</label>
    <input type="file" name="file" class="form-control" {{ $surat ? '' : 'required' }} accept="application/pdf">
    @if($surat)
      <small>File saat ini: {{ $surat->file_path }}</small>
    @endif
  </div>

  <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary" type="submit">Simpan</button>
</form>

@if ($errors->any())
  <div class="mt-3">
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
      </ul>
    </div>
  </div>
@endif
@endsection
