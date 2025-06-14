@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pt-4">
            <h1 class="title mb-4">Dashboard</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                {{-- Total Pemasukan --}}
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('admin.admin_pemasukan.index') }}" class="text-decoration-none text-dark">
                                <h5 class="text-danger">Total Pemasukan</h5>
                                <h2 class="fw-bold text-black">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Total Pengeluaran --}}
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('admin.pengeluaran.index') }}" class="text-decoration-none text-dark">
                                <h5 class="text-danger">Total Pengeluaran</h5>
                                <h2 class="fw-bold">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Karyawan --}}
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('admin.daftar_karyawan.index') }}" class="text-decoration-none text-dark">
                                <h5 class="text-danger">Jumlah Karyawan</h5>
                                <h2 class="fw-bold">{{ $jumlahKaryawan }} Orang</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include ('admin.admin_partials.footer')
</div>
</div>

