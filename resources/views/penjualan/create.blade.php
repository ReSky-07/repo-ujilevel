@include ('partials.header')
@include ('partials.navbar')
@include ('partials.sidebar')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Penjualan</h1>

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus me-1"></i>
                    Form Tambah Penjualan
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualan.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                    <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($availableStocks as $stock)
                                            <option value="{{ $stock['product']->id }}" 
                                                    data-stock="{{ $stock['available_quantity'] }}"
                                                    {{ old('product_id') == $stock['product']->id ? 'selected' : '' }}>
                                                {{ $stock['product']->name }} (Stok: {{ $stock['available_quantity'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" 
                                           class="form-control @error('quantity') is-invalid @enderror" 
                                           value="{{ old('quantity') }}" min="1" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <span id="stock-info" class="text-muted">Pilih produk terlebih dahulu</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Simpan
                            </button>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const stockInfo = document.getElementById('stock-info');
            
            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const stock = selectedOption.dataset.stock;
                
                if (stock && stock > 0) {
                    stockInfo.innerHTML = `<i class="fas fa-info-circle me-1"></i>Stok tersedia: <strong>${stock}</strong>`;
                    stockInfo.className = 'form-text text-success';
                    quantityInput.max = stock;
                    quantityInput.disabled = false;
                } else if (stock == 0) {
                    stockInfo.innerHTML = `<i class="fas fa-exclamation-triangle me-1"></i>Stok habis`;
                    stockInfo.className = 'form-text text-danger';
                    quantityInput.max = '';
                    quantityInput.disabled = true;
                    quantityInput.value = '';
                } else {
                    stockInfo.innerHTML = `<i class="fas fa-info-circle me-1"></i>Pilih produk terlebih dahulu`;
                    stockInfo.className = 'form-text text-muted';
                    quantityInput.max = '';
                    quantityInput.disabled = false;
                }
            });
            
            // Trigger change event if there's a selected value (for form validation errors)
            if (productSelect.value) {
                productSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
    
    @include('partials.footer')
</div>