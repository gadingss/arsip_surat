@extends('layout')

@section('content')
<h4>{{ $kategori ? 'Edit Kategori' : 'Tambah Kategori' }}</h4>
<form action="{{ $kategori ? route('kategori.update',$kategori->id) : route('kategori.store') }}" method="post">
  @csrf
  @if($kategori) @method('PUT') @endif

  {{-- ID Auto Increment hanya tampil, tidak bisa diinput --}}
  @if(!$kategori && isset($nextId))
  <div class="mb-3">
    <label>ID (Auto Increment)</label>
    <input type="text" class="form-control" value="{{ $nextId }}" disabled>
  </div>
  @elseif($kategori)
  <div class="mb-3">
    <label>ID</label>
    <input type="text" class="form-control" value="{{ $kategori->id }}" disabled>
  </div>
  @endif
  <div class="mb-3">
    <label>Nama Kategori</label>
    <input class="form-control" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required>
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
  </div>

  <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary">Simpan</button>
</form>
@endsection
