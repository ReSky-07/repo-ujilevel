<!-- Wrapper layout -->
<div id="layoutSidenav" class="d-flex sidebar-hidden">
    <!-- Sidebar -->
    <div id="layoutSidenav_nav">
        <nav class="sidenav sb-sidenav mt-5">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="line mb-1"></div>
                    <a class="nav-link {{ Request::is('/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('storage/home.png') }}">
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('/presensi') ? 'active' : '' }}" href="{{ route('presensi.index') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('storage/absensi.png') }}">
                        Presensi
                    </a>
                    <a class="nav-link {{ Request::is('/barang') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('storage/kelolabarang.png') }}">
                        Kelola Barang
                    </a>
                    <a class="nav-link {{ Request::is('/kategori') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('storage/kategori.png') }}">
                        Kelola Kategori
                    </a>
                    <a class="nav-link {{ Request::is('/transaksi') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('storage/transaksi.png') }}">
                        Kelola Transaksi
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name ?? 'Guest' }}
            </div>
        </nav>
    </div>

<!-- Overlay -->
<div id="overlay" class="overlay"></div>