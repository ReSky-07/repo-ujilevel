@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Produk</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Produk
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.daftar_produk.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        id="inputName"
                                        type="text"
                                        name="name"
                                        value="{{ old('name', $product->name) }}"
                                        placeholder="Masukkan nama produk"
                                        required />
                                    <label for="inputName">Nama Produk</label>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('price') is-invalid @enderror"
                                        id="inputPrice"
                                        type="number"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        placeholder="Masukkan harga produk"
                                        step="0.01"
                                        min="0"
                                        required />
                                    <label for="inputPrice">Harga (Rp)</label>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button class="btn btn-primary me-md-2" type="submit">
                                    <i class="fas fa-save me-1"></i>
                                    Update
                                </button>
                                <a href="{{ route('admin.daftar_produk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('admin.admin_partials.footer')
</div>