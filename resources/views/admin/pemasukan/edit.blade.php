@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Penjualan</h1>
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.penjualan_harian.index') }}">Penjualan Harian</a></li>
                    <li class="breadcrumb-item active">Edit Penjualan</li>
                </ol>
            </nav>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>Form Edit Penjualan
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.penjualan_harian.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sale_date" class="form-label">Tanggal Penjualan <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('sale_date') is-invalid @enderror" 
                                           id="sale_date" name="sale_date" 
                                           value="{{ old('sale_date', $sale->sale_date->format('Y-m-d')) }}" required>
                                    @error('sale_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Karyawan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                        <option value="">Pilih Karyawan</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ (old('user_id', $sale->user_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                    <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" 
                                                    data-price="{{ $product->price }}"
                                                    {{ (old('product_id', $sale->product_id) == $product->id) ? 'selected' : '' }}>
                                                {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
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
                                    <label for="quantity" class="form-label">Jumlah (pcs) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                           id="quantity" name="quantity" 
                                           value="{{ old('quantity', $sale->quantity) }}" min="1" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Harga Satuan</label>
                                    <div class="form-control-plaintext" id="unit_price">
                                        Rp {{ number_format($sale->product->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Total Harga</label>
                                    <div class="form-control-plaintext fw-bold text-success" id="total_price">
                                        Rp {{ number_format($sale->product->price * $sale->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Info:</strong> Data ini dibuat pada {{ $sale->created_at->format('d/m/Y H:i') }}
                            @if($sale->updated_at != $sale->created_at)
                                dan terakhir diperbarui pada {{ $sale->updated_at->format('d/m/Y H:i') }}
                            @endif
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.penjualan_harian.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Penjualan
                            </button>
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
            const unitPriceDiv = document.getElementById('unit_price');
            const totalPriceDiv = document.getElementById('total_price');

            function updatePrices() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const quantity = parseInt(quantityInput.value) || 0;

                if (price && quantity > 0) {
                    const unitPrice = parseInt(price);
                    const totalPrice = unitPrice * quantity;
                    
                    unitPriceDiv.textContent = 'Rp ' + unitPrice.toLocaleString('id-ID');
                    totalPriceDiv.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                } else {
                    unitPriceDiv.textContent = 'Pilih produk terlebih dahulu';
                    totalPriceDiv.textContent = 'Rp 0';
                }
            }

            productSelect.addEventListener('change', updatePrices);
            quantityInput.addEventListener('input', updatePrices);

            // Initialize on page load
            updatePrices();
        });
    </script>

    @include('admin.admin_partials.footer')
</div>