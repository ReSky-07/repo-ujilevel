@extends('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kelola Presensi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Presensi</li>
            </ol>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Form Filter berdasarkan Tanggal -->
            <form action="{{ route('admin.presensi.index') }}" method="GET" class="mb-3">
                <label for="tanggal">Pilih Tanggal:</label>
                <select name="tanggal" id="tanggal" class="form-control" onchange="this.form.submit()">
                    <option value="">Semua Tanggal</option>
                    @foreach ($tanggalList as $tgl)
                    <option value="{{ $tgl->tanggal }}" {{ $tgl->tanggal == request('tanggal') ? 'selected' : '' }}>
                        {{ $tgl->tanggal }}
                    </option>
                    @endforeach
                </select>
            </form>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Presensi
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $presensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presensi->nama }}</td>
                                <td>{{ $presensi->tanggal }}</td>
                                <td>{{ $presensi->keterangan }}</td>
                                <td><img src="{{ asset('storage/' . $presensi->foto) }}" width="50"></td>
                                <td>{{ $presensi->catatan ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('admin.presensi.destroy', $presensi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $presensis->links() }}
                </div>
            </div>
        </div>
    </main>

    @include('admin.admin_partials.footer')