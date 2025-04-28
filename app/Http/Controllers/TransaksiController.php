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

    // Transaksi.php

    public function store(Request $request)
    {
   // In the store method
$request->validate([
    'tanggal' => 'required|date',
    'kategori_id' => 'required|exists:kategoris,id',
    'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
    'jumlah_transaksi' => 'required|numeric|min:1000|max:1000000000', // Adding min and max values
], [
    'tanggal.required' => 'Bagian ini belum diisi',
    'kategori_id.required' => 'Bagian ini belum diisi',
    'jenis_transaksi.required' => 'Bagian ini belum diisi',
    'jumlah_transaksi.required' => 'Bagian ini belum diisi',
    'jumlah_transaksi.numeric' => 'Jumlah transaksi harus berupa angka',
    'jumlah_transaksi.min' => 'Jumlah transaksi minimal Rp 1.000',
    'jumlah_transaksi.max' => 'Jumlah transaksi maksimal Rp 1.000.000.000',
]);     // Tambahkan user_id dari user yang sedang login
        $data = $request->all();
        $data['user_id'] = auth()->id();

        Transaksi::create($data);
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
            'jumlah_transaksi' => 'required|numeric|min:1000|max:1000000000', // Adding min and max values
        ], [
            'tanggal.required' => 'Bagian ini belum diisi',
            'kategori_id.required' => 'Bagian ini belum diisi',
            'jenis_transaksi.required' => 'Bagian ini belum diisi',
            'jumlah_transaksi.required' => 'Bagian ini belum diisi',
            'jumlah_transaksi.numeric' => 'Jumlah transaksi harus berupa angka',
            'jumlah_transaksi.min' => 'Jumlah transaksi minimal Rp 1.000',
            'jumlah_transaksi.max' => 'Jumlah transaksi maksimal Rp 1.000.000.000',
        ]);
        $transaksi = Transaksi::findOrFail($id);
    
        // Update data dan simpan user_id original (jangan sampai hilang)
        $data = $request->all();
        // Pertahankan user_id asli (pembuat transaksi)
        // Jika ini diupdate oleh admin, tetap simpan user_id asli
        
        $transaksi->update($data);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
       }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
