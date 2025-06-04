<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDaftarProdukController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); // Tanpa paginate untuk DataTables
        return view('admin.daftar_produk.index', compact('products'));
    }

    public function create()
    {
        return view('admin.daftar_produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        Product::create($request->only('name', 'price'));

        return redirect()->route('admin.daftar_produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.daftar_produk.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price'));

        return redirect()->route('admin.daftar_produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.daftar_produk.index')->with('success', 'Produk berhasil dihapus');
    }
}