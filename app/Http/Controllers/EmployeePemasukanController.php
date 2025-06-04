<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\DailySale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePemasukanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        // Ambil data penjualan untuk pemasukan
        $salesData = Sale::with('product')
            ->where('user_id', Auth::id())
            ->whereBetween('sale_date', [$startDate, $endDate])
            ->get()
            ->map(function ($sale) {
                $totalRevenue = $sale->quantity * $sale->product->price;

                return [
                    'id' => $sale->id,
                    'sale_date' => $sale->sale_date,
                    'product_name' => $sale->product->name,
                    'quantity' => $sale->quantity,
                    'price' => $sale->product->price,
                    'total_revenue' => $totalRevenue
                ];
            });

        // Hitung ringkasan
        $summary = [
            'total_quantity' => $salesData->sum('quantity'),
            'total_revenue' => $salesData->sum('total_revenue'),
            'total_items_sold' => $salesData->count()
        ];


        return view('pemasukan.index', compact('salesData', 'summary', 'startDate', 'endDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek stok yang tersedia
        $dailyStock = DailySale::where('product_id', $request->product_id)
            ->whereDate('sale_date', today())
            ->first();

        if (!$dailyStock) {
            return back()->withErrors(['product_id' => 'Produk tidak tersedia untuk hari ini']);
        }

        // ... validasi stok seperti sebelumnya ...

        // Simpan penjualan dengan harga dari daily_sale
        Sale::create([
            'sale_date' => today(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(),
            'price' => $dailyStock->price // Ambil harga dari daily_sale
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dicatat');
    }
}
