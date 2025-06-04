<!-- Wrapper layout -->
<div id="layoutSidenav" class="d-flex sidebar-hidden">
    <!-- Sidebar -->
    <div id="layoutSidenav_nav">
        <nav class="sidenav sb-sidenav mt-5">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="line mb-1"></div>
                    <a class="nav-link {{ Request::is('/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('assets/home.png') }}">
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('/penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">
                        <img style="padding-right: 10px;" class="navbar-img" src="{{ asset('assets/kelolabarang.png') }}">
                        Penjualan harian
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