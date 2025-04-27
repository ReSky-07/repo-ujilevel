@include ('partials.header')
@include ('partials.navbar')
@include ('partials.sidebar')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5" style="margin-top: 25px; margin-left: -20px;">
            <h1 class="title">Dashboard</h1>
            <div class="row text-danger">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link"
                                href="{{ route('admin.transaksi.index') }}">
                                <h5>Gaji Karyawan</h5>
                                <h2 class="text-black">Rp {{ number_format($gajiKaryawan, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include ('partials.footer')