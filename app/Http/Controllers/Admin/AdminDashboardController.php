<?php

namespace App\Http\Controllers\Admin;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pemasukan = Transaksi::where('jenis_transaksi', 'pemasukan')->sum('jumlah_transaksi');
        $pengeluaran = Transaksi::where('jenis_transaksi', 'pengeluaran')->sum('jumlah_transaksi');

        return view('admin.dashboard', compact('pemasukan', 'pengeluaran'));
    }
}
