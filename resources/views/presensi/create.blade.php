@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Form Presensi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Presensi</li>
            </ol>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-control" id="keterangan" name="keterangan" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Kirim Presensi</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

@include('partials.footer')
