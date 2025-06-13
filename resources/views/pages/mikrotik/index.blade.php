@extends('layouts.master')

@section('content')
<div class="page-content">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Mikrotik</h4>
    <a href="{{ route('mikrotik.create') }}" class="btn btn-primary">+ Tambah Mikrotik</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>IP Address</th>
              <th>Port</th>
              <th>Koneksi</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($mikrotiks as $m)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->ip_address }}</td>
                <td>{{ $m->port_api }}</td>
                <td>{{ strtoupper($m->koneksi) }}</td>
                <td>
                  @if($m->status)
                    <span class="badge bg-success">Aktif</span>
                  @else
                    <span class="badge bg-secondary">Nonaktif</span>
                  @endif
                </td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('mikrotik.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button type="button" class="btn btn-sm btn-info" onclick="testKoneksi({{ $m->id }})">Test Koneksi</button>
                    <form action="{{ route('mikrotik.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus Mikrotik {{ $m->nama }}?')" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">Belum ada data Mikrotik.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function testKoneksi(id) {
  Swal.fire({
    title: 'Menguji koneksi...',
    text: 'Mohon tunggu',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  fetch(`/mikrotik/test/${id}`)
    .then(response => response.json())
    .then(data => {
      Swal.close();
      if (data.success) {
        Swal.fire('Berhasil!', 'Koneksi Mikrotik berhasil.', 'success');
      } else {
        Swal.fire('Gagal!', data.message ?? 'Gagal koneksi ke Mikrotik', 'error');
      }
    })
    .catch(error => {
      Swal.close();
      Swal.fire('Gagal!', 'Terjadi kesalahan saat menghubungi server', 'error');
    });
}
</script>
@endpush

