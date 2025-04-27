@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Presensi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Presensi</li>
            </ol>

            <a href="{{ route('presensi.create') }}" class="btn btn-primary mb-3">Tambah Presensi</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </main>

@include('partials.footer')
