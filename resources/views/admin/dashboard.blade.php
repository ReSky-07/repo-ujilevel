@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5" style="margin-top: 25px; margin-left: -20px;">
            <h1 class="title">Dashboard</h1>
            <div class="row text-danger">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link" href="{{ route('admin.transaksi.index') }}">
                                <h5>Total Pemasukan</h5>
                                <h2 class="text-black">Rp {{ number_format($pemasukan, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link" href="{{ route('admin.transaksi.index') }}">
                                <h5 class="text-danger">Total Pengeluaran</h5>
                                <h2>Rp {{ number_format($pengeluaran, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru dengan Nama Karyawan -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Transaksi Terbaru
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Diinput Oleh</th>
                                        <th>Waktu Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksiTerbaru as $transaksi)
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('admin.admin_partials.footer')
