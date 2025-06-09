@include ('partials.header')
@include ('partials.navbar')
@include ('partials.sidebar')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Penjualan</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Filter Tanggal -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-filter me-1"></i>
                    Filter Periode
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('penjualan.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Tanggal Mulai:</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate}}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">Tanggal Akhir:</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate  }}">
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('penjualan.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Penjualan
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Pemasukan -->
            @if(isset($summary) && is_array($summary))
            <div class="row mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Produk Terjual</h6>
                                    <h3>{{ number_format($summary['total_quantity'] ?? 0) }}</h3>
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
                                    <h3>Rp {{ number_format($summary['total_revenue'] ?? 0) }}</h3>
                                    <small>dari {{ $summary['total_items_sold'] ?? 0 }} transaksi</small>
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
                                    <h3>Rp {{ ($summary['total_items_sold'] ?? 0) > 0 ? number_format(($summary['total_revenue'] ?? 0) / $summary['total_items_sold']) : 0 }}</h3>
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
            @endif

            <!-- Detail Penjualan dengan CRUD -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Penjualan Periode {{ isset($startDate) ? date('d/m/Y', strtotime($startDate)) : date('01/m/Y') }} - {{ isset($endDate) ? date('d/m/Y', strtotime($endDate)) : date('d/m/Y') }}
                    </div>
                </div>
                <div class="card-body">
                    @php
                        // Gunakan $sales jika tersedia, kalau tidak gunakan $salesData
                        $displayData = isset($sales) ? $sales : (isset($salesData) ? $salesData : collect([]));
                        $hasData = $displayData->count() > 0;
                    @endphp
                    
                    @if($hasData)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="datatablesSimple">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Pemasukan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($displayData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if(isset($data['sale_date']))
                                            {{ $data['sale_date']->format('d/m/Y') }}
                                        @else
                                            {{ $data->sale_date->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        <strong>
                                            @if(isset($data['product_name']))
                                                {{ $data['product_name'] }}
                                            @else
                                                {{ $data->product->name }}
                                            @endif
                                        </strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            @if(isset($data['quantity']))
                                                {{ $data['quantity'] }}
                                            @else
                                                {{ $data->quantity }}
                                            @endif pcs
                                        </span>
                                    </td>
                                    <td>
                                        @if(isset($data['price']))
                                            Rp {{ number_format($data['price']) }}
                                        @else
                                            Rp {{ number_format($data->product->price ?? 0) }}
                                        @endif
                                    </td>
                                    <td>
                                        <strong class="text-success">
                                            @if(isset($data['total_revenue']))
                                                Rp {{ number_format($data['total_revenue']) }}
                                            @else
                                                Rp {{ number_format(($data->quantity * ($data->product->price ?? 0))) }}
                                            @endif
                                        </strong>
                                    </td>
                                    <td>
                                        @if(isset($data['created_at']))
                                            {{ $data['created_at']->format('d/m/Y H:i') }}
                                        @else
                                            {{ $data->created_at->format('d/m/Y H:i') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('penjualan.edit', isset($data['id']) ? $data['id'] : $data->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('penjualan.destroy', isset($data['id']) ? $data['id'] : $data->id) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" 
                                                    data-id="{{ isset($data['id']) ? $data['id'] : $data->id }}" 
                                                    data-nama="{{ isset($data['product_name']) ? $data['product_name'] : $data->product->name }}"
                                                    data-tanggal="{{ isset($data['sale_date']) ? $data['sale_date']->format('d/m/Y') : $data->sale_date->format('d/m/Y') }}"
                                                    data-jumlah="{{ isset($data['quantity']) ? $data['quantity'] : $data->quantity }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <th colspan="3">TOTAL</th>
                                    <th>{{ number_format($summary['total_quantity'] ?? 0) }} pcs</th>
                                    <th>-</th>
                                    <th><strong class="text-success">Rp {{ number_format($summary['total_revenue'] ?? 0) }}</strong></th>
                                    <th colspan="2">-</th>
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

<!-- Scripts -->
@if((isset($salesData) && $salesData->count() > 0) || (isset($sales) && $sales->count() > 0))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart - Grup data berdasarkan tanggal
        const salesByDate = {};
        
        @if(isset($salesData) && $salesData->count() > 0)
        // Untuk data dari controller pemasukan (format array)
        @foreach($salesData as $data)
        const date_{{ $loop->index }} = '{{ $data["sale_date"]->format("d/m") }}';
        if (!salesByDate[date_{{ $loop->index }}]) {
            salesByDate[date_{{ $loop->index }}] = 0;
        }
        salesByDate[date_{{ $loop->index }}] += {{ $data['total_revenue'] ?? 0 }};
        @endforeach
        @elseif(isset($sales) && $sales->count() > 0)
        // Untuk data dari controller penjualan (format object)
        @foreach($sales as $sale)
        const date_{{ $loop->index }} = '{{ $sale->sale_date->format("d/m") }}';
        if (!salesByDate[date_{{ $loop->index }}]) {
            salesByDate[date_{{ $loop->index }}] = 0;
        }
        salesByDate[date_{{ $loop->index }}] += {{ $sale->quantity * ($sale->product->price ?? 0) }};
        @endforeach
        @endif

        const ctx = document.getElementById('salesChart');
        if (ctx && Object.keys(salesByDate).length > 0) {
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: Object.keys(salesByDate),
                    datasets: [{
                        label: 'Pemasukan Harian',
                        data: Object.values(salesByDate),
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Pemasukan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endif

<!-- SweetAlert untuk konfirmasi hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation by attaching the listener to the table body
        const tableBody = document.querySelector('tbody');
        if (tableBody) {
            tableBody.addEventListener('click', function(e) {
                // Check if the clicked element is a delete button
                if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
                    const button = e.target.classList.contains('delete-btn') ? e.target : e.target.closest('.delete-btn');
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');
                    const tanggal = button.getAttribute('data-tanggal');
                    const jumlah = button.getAttribute('data-jumlah');
                    const form = button.closest('.delete-form');
                    
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Anda yakin ingin menghapus penjualan:<br>
                               <strong>Produk:</strong> ${nama}<br>
                               <strong>Tanggal:</strong> ${tanggal}<br>
                               <strong>Jumlah:</strong> ${jumlah} pcs?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        }
    });
</script>