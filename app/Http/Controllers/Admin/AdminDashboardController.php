<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sale;
use App\Models\Pengeluaran;
use App\Exports\MonthlyTransactionExport;
use App\Models\Transaksi;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total pemasukan
        $totalPemasukan = Sale::with('product')->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $jumlahKaryawan = User::where('usertype', 'user')->count();
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

        return view('admin.dashboard', compact('totalPemasukan', 'totalPengeluaran', 'jumlahKaryawan'));
    }
    public function exportExcel()
    {
        return Excel::download(new MonthlyTransactionExport, 'laporan_transaksi_bulanan.xlsx');
    }
}
