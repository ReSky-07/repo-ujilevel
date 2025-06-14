<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTotalPemasukanController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        // Total pemasukan
        $totalPemasukan = Sale::with('product')->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        // Pemasukan hari ini
        $pemasukanHarian = Sale::with('product')
            ->whereDate('sale_date', $today)
            ->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        // Pemasukan bulan ini
        $pemasukanBulanan = Sale::with('product')
            ->whereBetween('sale_date', [$monthStart, $today])
            ->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        // Data untuk grafik 7 hari terakhir
        $chartData = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $sales = Sale::with('product')->whereDate('sale_date', $date)->get();
            $total = $sales->sum(fn($s) => $s->product->price * $s->quantity);

            $chartData->push([
                'tanggal' => $date->format('d M'),
                'pemasukan' => $total,
                'pengeluaran' => 0, // Belum ada model pengeluaran
            ]);
        }

        return view('admin.admin_pemasukan.index', [
            'totalPemasukan' => $totalPemasukan,
            'pemasukanHarian' => $pemasukanHarian,
            'pemasukanBulanan' => $pemasukanBulanan,
            'chartData' => $chartData,
        ]);
    }
}
