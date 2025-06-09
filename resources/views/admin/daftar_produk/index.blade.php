@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Produk</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-box me-1"></i>
                        Data Produk
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.daftar_produk.create') }}" class="btn btn-primary btn-sm m-0">Tambah Produk</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->formatted_price }}</td>
                                <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.daftar_produk.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.daftar_produk.destroy', $product->id) }}" method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                            data-id="{{ $product->id }}"
                                            data-nama="{{ $product->name }}">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Script untuk SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Use event delegation by attaching the listener to the table body
            document.querySelector('tbody').addEventListener('click', function(e) {
                // Check if the clicked element is a delete button
                if (e.target.classList.contains('delete-btn')) {
                    const button = e.target;
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');
                    const form = button.closest('.delete-form');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Anda yakin ingin menghapus produk <strong>${nama}</strong>?`,
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
            });
        });
    </script>

    @include('admin.admin_partials.footer')
</div>