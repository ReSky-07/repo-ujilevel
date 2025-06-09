<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPemasukanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $sales = Sale::with(['product', 'user'])
            ->orderByDesc('sale_date');

        if ($startDate && $endDate) {
            $sales = $sales->whereBetween('sale_date', [$startDate, $endDate]);
        }

        $sales = $sales->get();

        return view('admin.pemasukan.index', compact('sales', 'startDate', 'endDate'));
    }
    public function edit($id)
    {
        $sale = Sale::with('product')->findOrFail($id);
        $products = Product::all();

        return view('admin.pemasukan.edit', compact('sale', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
        ]);

        return redirect()->route('admin.pemasukan.index')->with('success', 'Penjualan berhasil diupdate');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('admin.pemasukan.index')->with('success', 'Penjualan berhasil dihapus');
    }
}
