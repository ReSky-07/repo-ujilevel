<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        // Tampilkan transaksi beserta kategori dan user yang menginputnya
        $transaksis = Transaksi::with(['kategori', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function exportPdf()
    {
        $transaksis = Transaksi::with(['kategori', 'user'])->orderBy('tanggal', 'asc')->get();

        $totalPemasukan = $transaksis->where('jenis_transaksi', 'pemasukan')->sum('jumlah_transaksi');
        $totalPengeluaran = $transaksis->where('jenis_transaksi', 'pengeluaran')->sum('jumlah_transaksi');

        $pdf = PDF::loadView('admin.transaksi.laporan_pdf', compact('transaksis', 'totalPemasukan', 'totalPengeluaran'));
        return $pdf->download('laporan_keuangan.pdf');
    }


    public function create()
    {
        // Ambil data kategori untuk dropdown
        $kategoris = Kategori::all();
        return view('admin.transaksi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
       // In the store method
$request->validate([
    'tanggal' => 'required|date',
    'kategori_id' => 'required|exists:kategoris,id',
    'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
    'jumlah_transaksi' => 'required|numeric|min:1000|max:1000000000|regex:/^\d+(\.\d{1,2})?$/', 
], [
    'tanggal.required' => 'Bagian ini belum diisi',
    'kategori_id.required' => 'Bagian ini belum diisi',
    'jenis_transaksi.required' => 'Bagian ini belum diisi',
    'jumlah_transaksi.required' => 'Jumlah transaksi harus diisi',
    'jumlah_transaksi.numeric' => 'Jumlah transaksi harus berupa angka',
    'jumlah_transaksi.min' => 'Jumlah transaksi minimal Rp 1.000',
    'jumlah_transaksi.max' => 'Jumlah transaksi maksimal Rp 1.000.000.000',
    'jumlah_transaksi.regex' => 'Format jumlah transaksi tidak valid (maksimal 2 angka desimal)',
]);

        // Ambil data request dan tambahkan user_id dari admin yang sedang login
        $data = $request->all();
        $data['user_id'] = Auth::id();  // Menyimpan ID user yang sedang login (admin)

        // Simpan transaksi
        Transaksi::create($data);

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil transaksi yang akan diedit
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.transaksi.edit', compact('transaksi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
      // In the update method
$request->validate([
    'tanggal' => 'required|date',
    'kategori_id' => 'required|exists:kategoris,id',
    'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
    'jumlah_transaksi' => 'required|numeric|min:1000|max:1000000000|regex:/^\d+(\.\d{1,2})?$/',
], [
    'tanggal.required' => 'Bagian ini belum diisi',
    'kategori_id.required' => 'Bagian ini belum diisi',
    'jenis_transaksi.required' => 'Bagian ini belum diisi',
    'jumlah_transaksi.required' => 'Jumlah transaksi harus diisi',
    'jumlah_transaksi.numeric' => 'Jumlah transaksi harus berupa angka',
    'jumlah_transaksi.min' => 'Jumlah transaksi minimal Rp 1.000',
    'jumlah_transaksi.max' => 'Jumlah transaksi maksimal Rp 1.000.000.000',
    'jumlah_transaksi.regex' => 'Format jumlah transaksi tidak valid (maksimal 2 angka desimal)',
]);
        // Ambil data transaksi yang ada
        $transaksi = Transaksi::findOrFail($id);

        // Pertahankan user_id asli jika transaksi diupdate oleh admin
        $data = $request->all();
        $data['user_id'] = $transaksi->user_id; // Jangan hilangkan user_id asli

        // Update transaksi
        $transaksi->update($data);

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        // Hapus transaksi
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
