@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Penjualan Harian</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Penjualan Harian
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.penjualan_harian.update', $dailySale->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('sale_date') is-invalid @enderror" 
                                           id="sale_date" 
                                           name="sale_date" 
                                           type="date" 
                                           value="{{ old('sale_date', $dailySale->sale_date->format('Y-m-d')) }}" 
                                           required />
                                    <label for="sale_date">Tanggal Penjualan</label>
                                    @error('sale_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('product_id') is-invalid @enderror" 
                                            id="product_id" 
                                            name="product_id" 
                                            aria-label="Pilih Produk"
                                            required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" 
                                                {{ old('product_id', $dailySale->product_id) == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="product_id">Produk</label>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('quantity') is-invalid @enderror" 
                                           id="quantity" 
                                           name="quantity" 
                                           type="number" 
                                           placeholder="Masukkan jumlah"
                                           value="{{ old('quantity', $dailySale->quantity) }}" 
                                           min="1"
                                           required />
                                    <label for="quantity">Jumlah (pcs)</label>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid gap-2 d-md-flex">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save me-1"></i>
                                    Update
                                </button>
                                <a href="{{ route('admin.penjualan_harian.index') }}" class="btn btn-secondary">
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