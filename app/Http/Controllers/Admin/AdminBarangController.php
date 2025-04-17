<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); // Ambil semua data barang
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_input' => 'required|date',
            'nama_barang' => 'required|string',
            'stok' => 'required|integer',
        ], [
            'tanggal_input.required' => 'Tanggal input wajib diisi.',
            'tanggal_input.date' => 'Format tanggal tidak valid.',

            'nama_barang.required' => 'Nama barang tidak boleh kosong.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang terlalu panjang, maksimal 255 karakter.',

            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
        ]);

        Barang::create($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_input' => 'required|date',
            'nama_barang' => 'required|string',
            'stok' => 'required|integer',
        ], [
            'tanggal_input.required' => 'Tanggal input wajib diisi.',
            'tanggal_input.date' => 'Format tanggal tidak valid.',

            'nama_barang.required' => 'Nama barang tidak boleh kosong.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang terlalu panjang, maksimal 255 karakter.',

            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
