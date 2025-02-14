<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('kategori')->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.transaksi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah_transaksi' => 'required|numeric|min:0',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.transaksi.edit', compact('transaksi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah_transaksi' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
