<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlyTransactionExport;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pemasukan = Transaksi::where('jenis_transaksi', 'pemasukan')->sum('jumlah_transaksi');
        $pengeluaran = Transaksi::where('jenis_transaksi', 'pengeluaran')->sum('jumlah_transaksi');

        // Ambil transaksi terbaru dengan data user
        $transaksiTerbaru = Transaksi::with(['kategori', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('pemasukan', 'pengeluaran', 'transaksiTerbaru'));
    }

    public function exportExcel()
    {
        return Excel::download(new MonthlyTransactionExport, 'laporan_transaksi_bulanan.xlsx');
    }
}
