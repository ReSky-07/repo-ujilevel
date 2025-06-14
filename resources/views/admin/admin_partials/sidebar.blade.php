<div id="layoutSidenav" class="d-flex">
    <div id="layoutSidenav_nav">
        <nav class="sidenav sb-sidenav mt-5">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="line mb-1"></div>
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/home.png') }}">
                        Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('admin/daftar_karyawan') ? 'active' : '' }}" href="{{ route('admin.daftar_karyawan.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/karyawan.png') }}">
                        Daftar Karyawan
                    </a>
                    <a class="nav-link {{ Request::is('admin/daftar_produk') ? 'active' : '' }}" href="{{ route('admin.daftar_produk.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kelolabarang.png') }}">
                        Daftar Produk
                    </a>
                    <a class="nav-link {{ Request::is('admin/penjualan_harian') ? 'active' : '' }}" href="{{ route('admin.penjualan_harian.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/absensi.png') }}">
                        Stok Penjualan Harian
                    </a>
                    <a class="nav-link {{ Request::is('admin/pemasukan') ? 'active' : '' }}" href="{{ route('admin.pemasukan.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/transaksi.png') }}">
                        Penjualan Harian
                    </a>
                    <!-- <a class="nav-link {{ Request::is('admin/presensi') ? 'active' : '' }}" href="{{ route('admin.presensi.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/absensi.png') }}">
                        Presensi
                    </a> -->
                    <!-- <a class="nav-link {{ Request::is('admin/barang') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kelolabarang.png') }}">
                        Daftar Produk
                    </a>
                    <a class="nav-link {{ Request::is('admin/barang') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kelolabarang.png') }}">
                        Penjualan Harian
                    </a> -->
                    <!-- <a class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kategori.png') }}">
                        Kelola Kategori
                    </a> -->
                    <a class="nav-link {{ Request::is('admin/admin_pemasukan') ? 'active' : '' }}" href="{{ route('admin.admin_pemasukan.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kategori.png') }}">
                        Pemasukan
                    </a>
                    <a class="nav-link {{ Request::is('admin/pengeluaran') ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/kategori.png') }}">
                        Pengeluaran
                    </a>
                    <a class="nav-link {{ Request::is('admin/contacts') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                        <img style="padding-right: 10px;" class="navbar-brand" src="{{ asset('assets/transaksi.png') }}">
                        Feedback
                    </a>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name ?? 'Guest' }}
                    </div>
        </nav>