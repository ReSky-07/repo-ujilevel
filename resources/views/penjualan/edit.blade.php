@include ('partials.header')
@include ('partials.navbar')
@include ('partials.sidebar')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Penjualan</h1>

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
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Penjualan
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualan.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sale_date" class="form-label">Tanggal Penjualan</label>
                                    <input type="text" class="form-control" value="{{ $sale->sale_date->format('d/m/Y') }}" readonly>
                                    <div class="form-text text-muted">Tanggal penjualan tidak dapat diubah</div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                    <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($availableStocks as $stock)
                                            <option value="{{ $stock['product']->id }}" 
                                                    data-stock="{{ $stock['available_quantity'] }}"
                                                    {{ (old('product_id', $sale->product_id) == $stock['product']->id) ? 'selected' : '' }}>
                                                {{ $stock['product']->name }} (Stok: {{ $stock['available_quantity'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" 
                                           class="form-control @error('quantity') is-invalid @enderror" 
                                           value="{{ old('quantity', $sale->quantity) }}" min="1" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <span id="stock-info" class="text-muted">Stok tersedia akan ditampilkan setelah memilih produk</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Info:</strong> Anda sedang mengedit penjualan pada tanggal {{ $sale->sale_date->format('d/m/Y') }}. 
                            Stok yang tersedia sudah diperhitungkan dengan penjualan lain pada tanggal yang sama.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update
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
            
            function updateStockInfo() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
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
                } else {
                    stockInfo.innerHTML = `<i class="fas fa-info-circle me-1"></i>Pilih produk terlebih dahulu`;
                    stockInfo.className = 'form-text text-muted';
                    quantityInput.max = '';
                    quantityInput.disabled = false;
                }
            }
            
            productSelect.addEventListener('change', updateStockInfo);
            
            // Trigger change event on page load to show current stock
            updateStockInfo();
        });
    </script>
    
    @include('partials.footer')
</div>