@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Laporan Semua Penjualan</h1>

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
                        Data Penjualan Seluruh Karyawan
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.penjualan_harian.create') }}" class="btn btn-primary btn-sm">Tambah Penjualan</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penjualan</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Karyawan</th>
                                <th>Waktu Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $key => $sale)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sale->sale_date->format('d/m/Y') }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td><strong>{{ number_format($sale->quantity, 0, ',', '.') }}</strong> pcs</td>
                                <td>Rp {{ number_format($sale->product->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($sale->product->price * $sale->quantity, 0, ',', '.') }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.penjualan_harian.edit', $sale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.penjualan_harian.destroy', $sale->id) }}" method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                            data-id="{{ $sale->id }}"
                                            data-tanggal="{{ $sale->sale_date->format('d/m/Y') }}"
                                            data-produk="{{ $sale->product->name }}"
                                            data-jumlah="{{ number_format($sale->quantity, 0, ',', '.') }}"
                                            data-user="{{ $sale->user->name }}">Hapus</button>
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

    <!-- SweetAlert untuk Hapus -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('tbody').addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-btn')) {
                    const button = e.target;
                    const tanggal = button.getAttribute('data-tanggal');
                    const produk = button.getAttribute('data-produk');
                    const jumlah = button.getAttribute('data-jumlah');
                    const user = button.getAttribute('data-user');
                    const form = button.closest('.delete-form');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Yakin ingin menghapus penjualan <strong>${produk}</strong> tanggal <strong>${tanggal}</strong> oleh <strong>${user}</strong> sebanyak <strong>${jumlah} pcs</strong>?`,
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
        });
    </script>

    @include('admin.admin_partials.footer')
</div>