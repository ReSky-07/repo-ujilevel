<div id="layoutSidenav" class="d-flex">
    <div id="layoutSidenav_nav">
        <nav class="sidenav sb-sidenav mt-5">
            <div class="sb-sidenav-menu">
                <div class="nav">
                <div class="line mb-1"></div>       
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/home.png') }}">
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('admin/presensi') ? 'active' : '' }}" href="{{ route('admin.presensi.index') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/absensi.png') }}">
                        Presensi
                    </a>
                    <a class="nav-link {{ Request::is('admin/daftar_karyawan') ? 'active' : '' }}" href="{{ route('admin.daftar_karyawan.index') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/karyawan.png') }}">
                        Daftar Karyawan
                    </a>
                    <a class="nav-link {{ Request::is('admin/barang') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/kelolabarang.png') }}">
                        Kelola Barang
                    </a>
                    <a class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/kategori.png') }}">
                        Kelola Kategori
                    </a>
                    <a class="nav-link {{ Request::is('admin/transaksi') ? 'active' : '' }}" href="{{ route('admin.transaksi.index') }}">
                    <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('storage/transaksi.png') }}">
                        Kelola Transaksi
                    </a>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name ?? 'Guest' }}
            </div>
        </nav>