@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5" style="margin-top: 25px; margin-left: -20px;">
            <h1 class="title">Dashboard</h1>
            <div class="row g-3 text-danger">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card mb-4" style="max-width: 100%;">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link"
                                href="{{ route('admin.transaksi.index') }}">
                                <h5>Total Pemasukan</h5>
                                <h2 class="text-black text-wrap" style="word-break: break-word; white-space: normal;">
                                    Rp {{ number_format($pemasukan, 2, ',', '.') }}
                                </h2>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card mb-4" style="max-width: 100%;">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link"
                                href="{{ route('admin.transaksi.index') }}">
                                <h5 class="text-danger">Total Pengeluaran</h5>
                                <h2 class="text-black text-wrap" style="word-break: break-word; white-space: normal;">
                                    Rp {{ number_format($pengeluaran, 2, ',', '.') }}
                                </h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('admin.admin_partials.footer')