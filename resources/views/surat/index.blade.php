@extends('layout')

@section('content')
<h4>Arsip Surat</h4>
<p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>

<form method="GET" class="d-flex mb-3">
    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control me-2" placeholder="Cari surat...">
    <button class="btn btn-primary">Cari</button>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nomor Surat</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Waktu Pengarsipan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($surats as $s)
        <tr>
            <td>{{ $s->nomor_surat }}</td>
            <td>{{ $s->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $s->judul }}</td>
            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d-m-Y H:i') }}</td>
            <td>
                <a href="{{ route('surat.show',$s->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                <a href="{{ route('surat.download',$s->id) }}" class="btn btn-sm btn-warning">Unduh</a>
                <form action="{{ route('surat.destroy',$s->id) }}" method="POST" class="d-inline form-delete">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $surats->links() }}

<a href="{{ route('surat.create') }}" class="btn btn-success mt-3">Arsipkan Surat</a>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.form-delete');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah submit langsung

            Swal.fire({
                title: 'Yakin?',
                text: "Surat ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit form kalau user pilih "Ya"
                }
            });
        });
    });
});
</script>

@endsection
