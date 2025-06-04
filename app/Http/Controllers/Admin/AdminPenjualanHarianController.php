<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\DailySale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPenjualanHarianController extends Controller
{
    public function index()
    {
        $sales = DailySale::with('product')->latest('sale_date')->get();
        return view('admin.penjualan_harian.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.penjualan_harian.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        DailySale::create($request->all());

        return redirect()->route('admin.penjualan_harian.index')->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dailySale = DailySale::findOrFail($id);
        $products = Product::all();
        return view('admin.penjualan_harian.edit', compact('dailySale', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $dailySale = DailySale::findOrFail($id);
        $dailySale->update($request->all());

        return redirect()->route('admin.penjualan_harian.index')->with('success', 'Data penjualan berhasil diupdate');
    }

    public function destroy($id)
    {
        $dailySale = DailySale::findOrFail($id);
        $dailySale->delete();

        return redirect()->route('admin.penjualan_harian.index')->with('success', 'Data penjualan berhasil dihapus');
    }
}
