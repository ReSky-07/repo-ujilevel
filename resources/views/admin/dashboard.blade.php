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
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link" href="{{ route('admin.daftar_karyawan.index') }}">
                                <h5 class="text-primary">Jumlah Karyawan</h5>
                                <h2>{{ $jumlahKaryawan }} Orang</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Grafik Pemasukan dan Pengeluaran (7 Hari Terakhir)
                        </div>
                        <div class="card-body">
                            <canvas id="transaksiChart" height="100"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('transaksiChart').getContext('2d');

        const labels = chartData.map(item => item.tanggal);
        const pemasukanData = chartData.map(item => item.pemasukan);
        const pengeluaranData = chartData.map(item => item.pengeluaran);

        const transaksiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Pemasukan',
                        data: pemasukanData,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 128, 0, 0.1)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaranData,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    </script>


    @include ('admin.admin_partials.footer')