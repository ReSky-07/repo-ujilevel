@include ('admin.admin_partials.header')
@include ('admin.admin_partials.navbar')
@include ('admin.admin_partials.sidebar')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Kontak</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Kontak</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-envelope me-1"></i>
                    Daftar Kontak
                </div>
                <div class="card-body">

                    {{-- Notifikasi Sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Kontak --}}
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key => $contact)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->pesan }}</td>
                                <td>{{ $contact->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" 
                                               data-id="{{ $contact->id }}"
                                               data-name="{{ $contact->name }}"
                                               data-email="{{ $contact->email }}">
                                            Hapus
                                        </button>
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

    {{-- SweetAlert for Delete Confirmation --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var form = $(this).closest('.delete-form');
                var name = $(this).data('name');
                var email = $(this).data('email');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Anda yakin ingin menghapus kontak <strong>${name}</strong> (${email})?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading state
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Sedang menghapus data kontak',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit form
                        form.submit();
                    }
                });
            });
        });
    </script>

@include ('admin.admin_partials.footer')