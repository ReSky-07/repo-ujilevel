<?php
namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyTransactionExport implements FromView
{
    public function view(): View
    {
        $dataBulanan = Transaksi::select(
            DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'pemasukan' THEN jumlah_transaksi ELSE 0 END) as total_pemasukan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'pengeluaran' THEN jumlah_transaksi ELSE 0 END) as total_pengeluaran")
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return view('admin.exports.excel_bulanan', compact('dataBulanan'));
    }
}
