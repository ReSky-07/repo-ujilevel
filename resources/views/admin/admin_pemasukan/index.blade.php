@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5" style="margin-top: 25px;">
            <h1 class="title">Pemasukan</h1>
            <div class="row text-danger">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link" href="{{ route('admin.admin_pemasukan.index') }}">
                                <h5>Total Pemasukan</h5>
                                <h2 class="text-black">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Pemasukan Bulanan</h5>
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
                            <h2 class="text-black mt-3" id="pemasukanBulananText">
                                Rp {{ number_format($pemasukanBulanan, 2, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a style="text-decoration: none; color: inherit;" class="small stretched-link" href="{{ route('admin.admin_pemasukan.index') }}">
                                <h5>Pemasukan Harian</h5>
                                <h2 class="text-black">Rp {{ number_format($pemasukanHarian, 2, ',', '.') }}</h2>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Grafik Pemasukan dan Pengeluaran (7 Hari Terakhir)
                        </div>
                        <div class="card-body" style="position: relative; height: 400px;">
                            <canvas id="transaksiChart" style="width: 100%; height: auto;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('transaksiChart').getContext('2d');

        const labels = chartData.map(item => item.tanggal);
        const pemasukanData = chartData.map(item => item.pemasukan);
        const pengeluaranData = chartData.map(item => item.pengeluaran);

        const transaksiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Pemasukan',
                        data: pemasukanData,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 128, 0, 0.1)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaranData,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // tambahkan ini
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
    <script>
        document.getElementById('bulanSelect').addEventListener('change', function() {
            const selectedBulan = this.value;

            fetch(`/admin/pemasukan/bulanan?bulan=${selectedBulan}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pemasukanBulananText').textContent = 'Rp ' + data.pemasukan;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
    <script>
        document.getElementById('bulanSelect').addEventListener('change', function() {
            const selectedBulan = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('bulan', selectedBulan);
            window.history.replaceState({}, '', url); // ubah URL tanpa reload
        });
    </script>
    <script>
        function updateURL() {
            const bulan = document.getElementById('bulanSelect').value;
            const tahun = document.getElementById('tahunSelect').value;
            window.location.href = `/admin/admin_pemasukan?bulan=${bulan}&tahun=${tahun}`;
        }

        document.getElementById('bulanSelect').addEventListener('change', updateURL);
        document.getElementById('tahunSelect').addEventListener('change', updateURL);
    </script>




    @include ('admin.admin_partials.footer')