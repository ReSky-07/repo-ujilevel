@include ('partials.header')
@include ('partials.navbar')
@include ('partials.sidebar')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Penjualan</h1>

            <!-- Filter Tanggal -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('pemasukan.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Tanggal Mulai:</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">Tanggal Akhir:</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Pemasukan -->
            <div class="row mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Produk Terjual</h6>
                                    <h3>{{ number_format($summary['total_quantity']) }}</h3>
                                    <small>pcs</small>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-boxes fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Pemasukan</h6>
                                    <h3>Rp {{ number_format($summary['total_revenue']) }}</h3>
                                    <small>dari {{ $summary['total_items_sold'] }} transaksi</small>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill-wave fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Rata-rata per Transaksi</h6>
                                    <h3>Rp {{ $summary['total_items_sold'] > 0 ? number_format($summary['total_revenue'] / $summary['total_items_sold']) : 0 }}</h3>
                                    <small>per transaksi</small>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Penjualan -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail Pemasukan Periode {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}
                </div>
                <div class="card-body">
                    @if($salesData->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="datatablesSimple">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Pemasukan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data['sale_date']->format('d/m/Y') }}</td>
                                    <td>
                                        <strong>{{ $data['product_name'] }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $data['quantity'] }} pcs</span>
                                    </td>
                                    <td>Rp {{ number_format($data['price']) }}</td>
                                    <td>
                                        <strong class="text-success">Rp {{ number_format($data['total_revenue']) }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <th colspan="3">TOTAL</th>
                                    <th>{{ number_format($summary['total_quantity']) }} pcs</th>
                                    <th>-</th>
                                    <th><strong class="text-success">Rp {{ number_format($summary['total_revenue']) }}</strong></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data penjualan</h5>
                        <p class="text-muted">Belum ada penjualan pada periode yang dipilih</p>
                        <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Penjualan
                        </a>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </main>
    @include('partials.footer')
</div>

@if($salesData->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grup data berdasarkan tanggal
        const salesByDate = {};
        @foreach($salesData as $data)
        const date = '{{ $data["sale_date"]->format("d/m") }}';
        if (!salesByDate[date]) {
            salesByDate[date] = 0;
        }
        salesByDate[date] += {
            {
                $data['total_revenue']
            }
        };
        @endforeach

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(salesByDate),
                datasets: [{
                    label: 'Pemasukan Harian',
                    data: Object.values(salesByDate),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Pemasukan: Rp ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endif