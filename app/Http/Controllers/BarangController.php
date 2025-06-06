<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); // Ambil semua data barang
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_input' => 'required|date',
            'nama_barang' => 'required|string',
            'stok' => 'required|integer',
        ],  [
            'tanggal_input.required' => 'Bagian ini belum diisi',
            'nama_barang.required' => 'Bagian ini belum diisi',
            'stok.required' => 'Bagian ini belum diisi',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Ini penting!!


        Barang::create($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_input' => 'required|date',
            'nama_barang' => 'required|string',
            'stok' => 'required|integer',
        ],  [
            'tanggal_input.required' => 'Bagian ini belum diisi',
            'nama_barang.required' => 'Bagian ini belum diisi',
            'stok.required' => 'Bagian ini belum diisi',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
