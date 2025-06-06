@include('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Transaksi</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.transaksi.store') }}" method="POST">
                        @csrf

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Transaksi -->
                        <div class="mb-3">
                            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                            <select class="form-control @error('jenis_transaksi') is-invalid @enderror" id="jenis_transaksi" name="jenis_transaksi">
                                <option value="">-- Pilih Jenis Transaksi --</option>
                                <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('jenis_transaksi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jumlah Transaksi -->
                        <div class="mb-3">
                            <label for="jumlah_transaksi" class="form-label">Jumlah Transaksi</label>
                            <input type="number" class="form-control @error('jumlah_transaksi') is-invalid @enderror" id="jumlah_transaksi" name="jumlah_transaksi" value="{{ old('jumlah_transaksi') }}">
                            @error('jumlah_transaksi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
</div>
@include('admin.admin_partials.footer')