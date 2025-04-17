@extends('partials.header')
@include('partials.navbar')
@include('partials.sidebar')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Kategori</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Kategori</li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')