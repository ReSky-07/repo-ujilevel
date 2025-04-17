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

        $dataBulanan = Transaksi::select(
            DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'pemasukan' THEN jumlah_transaksi ELSE 0 END) as total_pemasukan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'pengeluaran' THEN jumlah_transaksi ELSE 0 END) as total_pengeluaran")
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.dashboard', compact('pemasukan', 'pengeluaran', 'dataBulanan'));
    }

    public function exportExcel()
    {
        return Excel::download(new MonthlyTransactionExport, 'laporan_transaksi_bulanan.xlsx');
    }
}
