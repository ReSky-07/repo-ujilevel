<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('kategori')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('transaksi.create', compact('kategoris'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah_transaksi' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Bagian ini belum diisi',
            'kategori_id.required' => 'Bagian ini belum diisi',
            'jenis_transaksi.required' => 'Bagian ini belum diisi',
            'jumlah_transaksi.required' => 'Bagian ini belum diisi',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();
        return view('transaksi.edit', compact('transaksi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah_transaksi' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Bagian ini belum diisi',
            'kategori_id.required' => 'Bagian ini belum diisi',
            'jenis_transaksi.required' => 'Bagian ini belum diisi',
            'jumlah_transaksi.required' => 'Bagian ini belum diisi',
        ]);
        
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
