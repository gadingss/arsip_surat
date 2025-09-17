@extends('layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h4>Daftar Kategori</h4>
  <a href="{{ route('kategori.create') }}" class="btn btn-success">Tambah</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Kategori</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($kategoris as $k)
    <tr>
      <td>{{ $loop->iteration + ($kategoris->currentPage()-1)*$kategoris->perPage() }}</td>
      <td>{{ $k->nama_kategori }}</td>
      <td>{{ $k->keterangan }}</td>
      <td>
        <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('kategori.destroy', $k->id) }}" 
              method="POST" 
              class="d-inline form-delete">
          @csrf 
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
    @endforelse
  </tbody>
</table>

{{ $kategoris->links() }}

{{-- SweetAlert untuk konfirmasi hapus --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.form-delete');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin?',
                text: "Kategori ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
