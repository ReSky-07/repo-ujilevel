@extends('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.daftar_karyawan.index') }}">Karyawan</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>

            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus me-1"></i>
                        Form Tambah Karyawan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.daftar_karyawan.store') }}" method="POST">
                            @csrf

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gaji -->
                            <div class="mb-3">
                                <label for="gaji" class="form-label">Gaji</label>
                                <input type="number" step="0.01" class="form-control @error('gaji') is-invalid @enderror" id="gaji" name="gaji" value="{{ old('gaji') }}">
                                @error('gaji')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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