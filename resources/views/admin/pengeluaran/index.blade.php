@include('admin.admin_partials.header')
@include('admin.admin_partials.navbar')
@include('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">

            <h1 class="mb-4">Pengeluaran</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Ringkasan -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white mb-3">
                        <div class="card-body">
                            <h5 style="color: red">Total Pengeluaran</h5>
                            <h3 class="text-black">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" style="color: red;">Pengeluaran Bulanan</h5>
                                <div class="d-flex gap-2">
                                    <select id="bulanSelect" class="form-select form-select-sm w-auto">
                                        @foreach($listBulan as $key => $namaBulan)
                                        <option value="{{ $key }}" {{ $selectedBulan == $key ? 'selected' : '' }}>
                                            {{ $namaBulan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <select id="tahunSelect" class="form-select form-select-sm w-auto">
                                        @foreach($listTahun as $tahun)
                                        <option value="{{ $tahun }}" {{ $selectedTahun == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h3 class="text-black mt-3" id="pengeluaranBulananText">
                                Rp {{ number_format($pengeluaranBulanan, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card text-white  mb-3">
                        <div class="card-body">
                            <h5 style="color: red">Pengeluaran Harian</h5>
                            <h3 class="text-black">Rp {{ number_format($pengeluaranHarian, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="card mb-4">
                <div class="card-header">Grafik Pengeluaran (7 Hari Terakhir)</div>
                <div class="card-body" style="position: relative; height: 400px;">
                    <canvas id="pengeluaranChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>

            <!-- Form Tambah/Edit -->
            <div class="card mb-4">
                <div class="card-header">Tambah Pengeluaran</div>
                <div class="card-body">
                    <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Data dengan DataTables -->
            <div class="card mb-4">
                <div class="card-header">Daftar Pengeluaran</div>
                <div class="card-body">
                    <table id="pengeluaranTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengeluarans as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td data-order="{{ $item->tanggal->format('Y-m-d') }}">{{ $item->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td data-order="{{ $item->jumlah }}">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                    </form>
                                    <!-- Edit modal trigger -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.pengeluaran.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Pengeluaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal->format('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Deskripsi</label>
                                                            <input type="text" name="deskripsi" class="form-control" value="{{ $item->deskripsi }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Jumlah</label>
                                                            <input type="number" name="jumlah" class="form-control" value="{{ $item->jumlah }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery (pastikan dimuat dulu) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('pengeluaranChart').getContext('2d');

        const labels = chartData.map(item => item.tanggal);
        const pengeluaranData = chartData.map(item => item.pengeluaran);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran',
                    data: pengeluaranData,
                    borderColor: 'red',
                    backgroundColor: 'rgba(255,0,0,0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    </script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            // Pastikan jQuery dan DataTables tersedia
            if (typeof $ !== 'undefined' && $.fn.DataTable) {
                var table = $('#pengeluaranTable').DataTable({
                    responsive: true,
                    processing: true,
                    language: {
                        "sProcessing": "Sedang memproses...",
                        "sLengthMenu": "Tampilkan _MENU_ entri",
                        "sZeroRecords": "Tidak ditemukan data yang sesuai",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "sInfoPostFix": "",
                        "sSearch": "Cari:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "Sebelumnya",
                            "sNext": "Selanjutnya",
                            "sLast": "Terakhir"
                        }
                    },
                    order: [
                        [1, 'desc']
                    ], // Sort by tanggal descending
                    columnDefs: [{
                            targets: [0], // Kolom No
                            orderable: false,
                            searchable: false
                        },
                        {
                            targets: [4], // Kolom Aksi
                            orderable: false,
                            searchable: false
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ],
                    searching: true,
                    paging: true,
                    info: true,
                    lengthChange: true,
                    drawCallback: function() {
                        // Re-bind delete button events after table redraw
                        bindDeleteEvents();
                    }
                });

                console.log('DataTable initialized successfully');
            } else {
                console.error('jQuery atau DataTables tidak tersedia');
            }
        });

        // Function to bind delete button events
        function bindDeleteEvents() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.removeEventListener('click', handleDelete); // Remove existing listeners
                button.addEventListener('click', handleDelete);
            });
        }

        // Delete handler function
        function handleDelete(e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Yakin ingin menghapus pengeluaran ini?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Initial binding
        document.addEventListener('DOMContentLoaded', function() {
            bindDeleteEvents();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bulanSelect = document.getElementById('bulanSelect');
            const tahunSelect = document.getElementById('tahunSelect');

            if (bulanSelect && tahunSelect) {
                function updateURL() {
                    const bulan = bulanSelect.value;
                    const tahun = tahunSelect.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('bulan', bulan);
                    url.searchParams.set('tahun', tahun);
                    window.location.href = url.toString();
                }

                bulanSelect.addEventListener('change', updateURL);
                tahunSelect.addEventListener('change', updateURL);
            }
        });
    </script>


    @include('admin.admin_partials.footer')