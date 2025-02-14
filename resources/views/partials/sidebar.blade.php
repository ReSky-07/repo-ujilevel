<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link {{ Request::is('/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('/presensi') ? 'active' : '' }}" href="{{ route('presensi.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Presensi
                    </a>
                    <a class="nav-link {{ Request::is('/barang') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Barang
                    </a>
                    <a class="nav-link {{ Request::is('/kategori') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Kategori
                    </a>
                    <a class="nav-link {{ Request::is('/transaksi') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Transaksi
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name ?? 'Guest' }}
            </div>
        </nav>