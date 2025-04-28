@include('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.daftar_karyawan.index') }}">Karyawan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>

            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit me-1"></i>
                        Form Edit Karyawan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.daftar_karyawan.update', $karyawan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $karyawan->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Opsional)</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $karyawan->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="gaji" class="form-label">Gaji</label>
                                <input type="number" step="0.01" class="form-control" id="gaji" name="gaji" value="{{ $karyawan->gaji }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.daftar_karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('admin.admin_partials.footer')