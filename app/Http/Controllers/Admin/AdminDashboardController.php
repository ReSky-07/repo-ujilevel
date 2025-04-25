<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlyTransactionExport;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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

        // Data grafik 7 hari terakhir
        $tanggalRange = collect(range(0, 29))->map(function ($i) {
            return Carbon::now()->subDays($i)->format('Y-m-d');
        })->reverse()->values();

        $chartData = $tanggalRange->map(function ($tanggal) {
            return [
                'tanggal' => Carbon::parse($tanggal)->format('d M'),
                'pemasukan' => Transaksi::whereDate('tanggal', $tanggal)
                    ->where('jenis_transaksi', 'pemasukan')
                    ->sum('jumlah_transaksi'),
                'pengeluaran' => Transaksi::whereDate('tanggal', $tanggal)
                    ->where('jenis_transaksi', 'pengeluaran')
                    ->sum('jumlah_transaksi'),
            ];
        });

        return view('admin.dashboard', compact('pemasukan', 'pengeluaran', 'transaksiTerbaru', 'chartData'));
    }
    public function exportExcel()
    {
        return Excel::download(new MonthlyTransactionExport, 'laporan_transaksi_bulanan.xlsx');
    }
}
