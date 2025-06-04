<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\DailySale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeePenjualanController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')
            ->where('user_id', Auth::id())
            ->latest('sale_date')
            ->get();
        return view('penjualan.index', compact('sales'));
    }

    public function create()
    {
        // Ambil stok yang tersedia untuk hari ini
        $availableStocks = DailySale::with('product')
            ->whereDate('sale_date', today())
            ->get()
            ->map(function ($stock) {
                $totalSold = Sale::where('product_id', $stock->product_id)
                    ->whereDate('sale_date', $stock->sale_date)
                    ->sum('quantity');

                $remaining = $stock->quantity - $totalSold;

                return [
                    'product' => $stock->product,
                    'available_quantity' => $remaining,
                    'daily_sale_id' => $stock->id
                ];
            })
            ->filter(function ($item) {
                return $item['available_quantity'] > 0;
            });

        return view('penjualan.create', compact('availableStocks'));
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

        $totalSold = Sale::where('product_id', $request->product_id)
            ->whereDate('sale_date', today())
            ->sum('quantity');

        $remainingStock = $dailyStock->quantity - $totalSold;

        if ($request->quantity > $remainingStock) {
            return back()->withErrors(['quantity' => "Stok tidak mencukupi. Stok tersisa: {$remainingStock}"]);
        }

        // Simpan penjualan
        Sale::create([
            'sale_date' => today(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dicatat');
    }

    public function edit($id)
    {
        $sale = Sale::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $currentProductId = $sale->product_id; // Simpan product_id dalam variabel terpisah

        $availableStocks = DailySale::with('product')
            ->whereDate('sale_date', $sale->sale_date)
            ->get()
            ->map(function ($stock) use ($sale) {
                $totalSold = Sale::where('product_id', $stock->product_id)
                    ->whereDate('sale_date', $stock->sale_date)
                    ->where('id', '!=', $sale->id) // Exclude current sale
                    ->sum('quantity');

                $remaining = $stock->quantity - $totalSold;

                return [
                    'product' => $stock->product,
                    'available_quantity' => $remaining,
                    'daily_sale_id' => $stock->id
                ];
            })
            ->filter(function ($item) use ($currentProductId) { // Gunakan variabel terpisah
                return $item['available_quantity'] > 0 || $item['product']->id == $currentProductId;
            });

        return view('penjualan.edit', compact('sale', 'availableStocks'));
    }
    public function update(Request $request, $id)
    {
        $sale = Sale::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek stok yang tersedia
        $dailyStock = DailySale::where('product_id', $request->product_id)
            ->whereDate('sale_date', $sale->sale_date)
            ->first();

        if (!$dailyStock) {
            return back()->withErrors(['product_id' => 'Produk tidak tersedia untuk tanggal ini']);
        }

        $totalSold = Sale::where('product_id', $request->product_id)
            ->whereDate('sale_date', $sale->sale_date)
            ->where('id', '!=', $sale->id)
            ->sum('quantity');

        $remainingStock = $dailyStock->quantity - $totalSold;

        if ($request->quantity > $remainingStock) {
            return back()->withErrors(['quantity' => "Stok tidak mencukupi. Stok tersisa: {$remainingStock}"]);
        }

        $sale->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil diupdate');
    }

    public function destroy($id)
    {
        $sale = Sale::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $sale->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dihapus');
    }
}
