@include('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kelola Presensi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Presensi</li>
            </ol>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Form Filter berdasarkan Tanggal -->
            <form action="{{ route('admin.presensi.index') }}" method="GET" class="mb-3">
                <label for="tanggal">Pilih Tanggal:</label>
                <select name="tanggal" id="tanggal" class="form-control" onchange="this.form.submit()">
                    <option value="">Semua Tanggal</option>
                    @foreach ($tanggalList as $tgl)
                    <option value="{{ $tgl->tanggal }}" {{ $tgl->tanggal == request('tanggal') ? 'selected' : '' }}>{{ $tgl->tanggal }}</option>
                    @endforeach
                </select>
            </form>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Presensi
                </div>
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $presensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presensi->nama }}</td>
                                <td>{{ $presensi->tanggal }}</td>
                                <td>{{ $presensi->keterangan }}</td>
                                <td><img src="{{ asset('storage/' . $presensi->foto) }}" width="50"></td>
                                <td>{{ $presensi->catatan ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" 
                                        data-id="{{ $presensi->id }}"
                                        data-name="{{ $presensi->nama }}"
                                        data-date="{{ $presensi->tanggal }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $presensis->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Script untuk Konfirmasi Delete dengan SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable("#datatablesSimple");
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua tombol hapus
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const date = this.getAttribute('data-date');
                    
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Anda yakin ingin menghapus presensi <strong>${name}</strong> pada tanggal <strong>${date}</strong>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Buat form untuk submit
                            const form = document.createElement('form');
                            form.action = '{{ route("admin.presensi.destroy", "") }}/' + id;
                            form.method = 'POST';
                            form.style.display = 'none';
                            
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            
                            const method = document.createElement('input');
                            method.type = 'hidden';
                            method.name = '_method';
                            method.value = 'DELETE';
                            
                            form.appendChild(csrfToken);
                            form.appendChild(method);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    

    @include('admin.admin_partials.footer')
