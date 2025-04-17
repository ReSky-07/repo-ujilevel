<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminDaftarKaryawanController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserPresensiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/api/auth-status', function (Request $request) {
    return response()->json([
        'isAuthenticated' => Auth::check(),
        'user' => Auth::user(),
        'loginUrl' => route('login'),
        'registerUrl' => Route::has('register') ? route('register') : null,
        'dashboardUrl' => url('/dashboard'),
    ]);
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contacts', [ContactController::class, 'store']);

// User Route
Route::middleware(['auth', 'UserMiddleware'])->group(function () {
    // dashboard
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    // presensi
    Route::prefix('presensi')->group(function () {
        Route::get('/', [UserPresensiController::class, 'index'])->name('presensi.index');
        Route::get('/create', [UserPresensiController::class, 'create'])->name('presensi.create');
        Route::post('/store', [UserPresensiController::class, 'store'])->name('presensi.store');
    });
    // Kelola Barang
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/`store', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Kelola Kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // Kelola Transaksi
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        Route::put('/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    });
});

// Admin Route
Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    // Tambahkan di dalam middleware group
    Route::get('/admin/export-excel', [AdminDashboardController::class, 'exportExcel'])->name('admin.export.excel');
    // dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // daftar karyawan
    Route::prefix('/admin/daftar_karyawan')->group(function () {
        Route::get('/', [AdminDaftarKaryawanController::class, 'index'])->name('admin.daftar_karyawan.index');
        Route::get('/create', [AdminDaftarKaryawanController::class, 'create'])->name('admin.daftar_karyawan.create');
        Route::post('/store', [AdminDaftarKaryawanController::class, 'store'])->name('admin.daftar_karyawan.store');
        Route::get('/{id}/edit', [AdminDaftarKaryawanController::class, 'edit'])->name('admin.daftar_karyawan.edit');
        Route::put('/{id}', [AdminDaftarKaryawanController::class, 'update'])->name('admin.daftar_karyawan.update');
        Route::delete('/{id}', [AdminDaftarKaryawanController::class, 'destroy'])->name('admin.daftar_karyawan.destroy');
    });
    // daftar barang
    Route::prefix('admin/barang')->group(function () {
        Route::get('/', [AdminBarangController::class, 'index'])->name('admin.barang.index');
        Route::get('/create', [AdminBarangController::class, 'create'])->name('admin.barang.create');
        Route::post('/store', [AdminBarangController::class, 'store'])->name('admin.barang.store');
        Route::get('/{id}/edit', [AdminBarangController::class, 'edit'])->name('admin.barang.edit');
        Route::put('/{id}', [AdminBarangController::class, 'update'])->name('admin.barang.update');
        Route::delete('/{id}', [AdminBarangController::class, 'destroy'])->name('admin.barang.destroy');
    });
    // Daftar Kategori
    Route::prefix('admin/kategori')->group(function () {
        Route::get('/', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/create', [AdminKategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/store', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
        Route::get('/{id}/edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::put('/{id}', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/{id}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    });
    // Rute Transaksi
    Route::prefix('admin/transaksi')->group(function () {
        Route::get('/', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
        Route::get('/create', [AdminTransaksiController::class, 'create'])->name('admin.transaksi.create');
        Route::post('/store', [AdminTransaksiController::class, 'store'])->name('admin.transaksi.store');
        Route::get('/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('admin.transaksi.edit');
        Route::put('/{id}', [AdminTransaksiController::class, 'update'])->name('admin.transaksi.update');
        Route::delete('/{id}', [AdminTransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
    });
    // Rute untuk Admin CRUD Presensi
    Route::prefix('admin/presensi')->group(function () {
        Route::get('/', [PresensiController::class, 'index'])->name('admin.presensi.index');
        Route::delete('/{id}', [PresensiController::class, 'destroy'])->name('admin.presensi.destroy');
    });
    // Rute untuk Admin Contact
    Route::prefix('admin/contacts')->group(function () {
        Route::get('/', [AdminContactController::class, 'index'])->name('admin.contacts.index');
        Route::post('/', [AdminContactController::class, 'store'])->name('admin.contacts.store');
        Route::delete('/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    });
});



require __DIR__ . '/auth.php';
