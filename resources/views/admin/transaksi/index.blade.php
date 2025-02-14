@extends('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Transaksi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Daftar Transaksi
                    <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm float-end">Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah Transaksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->tanggal }}</td>
                                <td>{{ $transaksi->kategori->nama_kategori }}</td>
                                <td>{{ ucfirst($transaksi->jenis_transaksi) }}</td>
                                <td>Rp {{ number_format($transaksi->jumlah_transaksi, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var form = $(this).closest('.delete-form');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</div>
@include('admin.admin_partials.footer')

