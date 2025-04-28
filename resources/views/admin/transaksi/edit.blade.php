@include('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Transaksi</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaksi->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $transaksi->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                            <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                                <option value="">-- Pilih Jenis Transaksi --</option>
                                <option value="pemasukan" {{ $transaksi->jenis_transaksi == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ $transaksi->jenis_transaksi == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_transaksi" class="form-label">Jumlah Transaksi</label>
                            <input type="number" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" value="{{ $transaksi->jumlah_transaksi }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@include('admin.admin_partials.footer')
