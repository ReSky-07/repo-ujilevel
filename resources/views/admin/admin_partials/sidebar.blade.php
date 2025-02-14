<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('admin/presensi') ? 'active' : '' }}" href="{{ route('admin.presensi.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Presensi
                    </a>
                    <a class="nav-link {{ Request::is('admin/daftar_karyawan') ? 'active' : '' }}" href="{{ route('admin.daftar_karyawan.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Daftar Karyawan
                    </a>
                    <a class="nav-link {{ Request::is('admin/barang') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Barang
                    </a>
                    <a class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Kategori
                    </a>
                    <a class="nav-link {{ Request::is('admin/transaksi') ? 'active' : '' }}" href="{{ route('admin.transaksi.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kelola Transaksi
                    </a>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name ?? 'Guest' }}
            </div>
        </nav>