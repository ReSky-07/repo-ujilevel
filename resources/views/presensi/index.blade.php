@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')

</div>
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

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Presensi
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $presensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presensi->tanggal }}</td>
                                <td>{{ $presensi->keterangan }}</td>
                                <td><img src="{{ asset('storage/' . $presensi->foto) }}" width="50"></td>
                                <td>{{ $presensi->catatan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $presensis->links() }}
                </div>
            </div>
        </div>
    </main>

@include('partials.footer')
