<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTotalPemasukanController extends Controller
{
    public function index(Request $request)
    {
        $selectedBulan = $request->get('bulan') ?? Carbon::now()->format('m');
        $selectedTahun = $request->get('tahun') ?? Carbon::now()->format('Y');

        // Ambil pemasukan untuk bulan yang dipilih
        $pemasukanBulanan = Sale::with('product')
            ->whereMonth('sale_date', $selectedBulan)
            ->whereYear('sale_date', $selectedTahun)
            ->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);
        $today = Carbon::today();

        // Total pemasukan
        $totalPemasukan = Sale::with('product')->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        // Pemasukan hari ini
        $pemasukanHarian = Sale::with('product')
            ->whereDate('sale_date', $today)
            ->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        // Grafik 7 hari terakhir
        $chartData = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $sales = Sale::with('product')->whereDate('sale_date', $date)->get();
            $total = $sales->sum(fn($s) => $s->product->price * $s->quantity);

            $chartData->push([
                'tanggal' => $date->format('d M'),
                'pemasukan' => $total,
                'pengeluaran' => 0, // Dummy
            ]);
        }

        // List bulan
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return view('admin.admin_pemasukan.index', [
            'totalPemasukan' => $totalPemasukan,
            'pemasukanHarian' => $pemasukanHarian,
            'pemasukanBulanan' => $pemasukanBulanan,
            'chartData' => $chartData,
            'listBulan' => $listBulan,
            'listTahun' => range(2020, now()->year), // atau generate dari DB
            'selectedBulan' => $selectedBulan,
            'selectedTahun' => $selectedTahun,
        ]);
    }


    public function getPemasukanBulanan(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun') ?? Carbon::now()->format('Y');

        if (!$bulan || !is_numeric($bulan) || $bulan < 1 || $bulan > 12) {
            return response()->json(['pemasukan' => '0,00'], 400);
        }

        $pemasukan = Sale::with('product')
            ->whereMonth('sale_date', $bulan)
            ->whereYear('sale_date', $tahun)
            ->get()
            ->sum(fn($sale) => $sale->product->price * $sale->quantity);

        return response()->json([
            'pemasukan' => number_format($pemasukan, 2, ',', '.')
        ]);
    }
}
