@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Transaksi</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Transaksi
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.transaksi.exportPdf') }}" class="btn btn-success btn-sm me-2">Export PDF</a>
                        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm">Tambah Transaksi</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Diinput Oleh</th>
                                <th>Waktu Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($transaksi->tanggal)) }}</td>
                                <td>{{ $transaksi->kategori->nama_kategori }}</td>
                                <td>
                                    <span class="badge {{ $transaksi->jenis_transaksi == 'pemasukan' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($transaksi->jenis_transaksi) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($transaksi->jumlah_transaksi, 2, ',', '.') }}</td>
                                <td>
                                    @if($transaksi->user)
                                    {{ $transaksi->user->name }}
                                    @else
                                    <em>Tidak tercatat</em>
                                    @endif
                                </td>
                                <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
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
    @include('admin.admin_partials.footer')
</div>