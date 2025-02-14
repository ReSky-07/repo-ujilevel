<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    // Tampilkan daftar presensi untuk admin
    public function index(Request $request)
    {
        $tanggalDipilih = $request->input('tanggal');

        // Ambil semua tanggal unik yang tersedia di presensi
        $tanggalList = Presensi::select('tanggal')->distinct()->orderBy('tanggal', 'desc')->get();

        // Query presensi berdasarkan tanggal yang dipilih
        $presensis = Presensi::when($tanggalDipilih, function ($query, $tanggalDipilih) {
            return $query->where('tanggal', $tanggalDipilih);
        })->latest()->paginate(10);

        return view('admin.presensi.index', compact('presensis', 'tanggalList', 'tanggalDipilih'));
    }


    // Hapus data presensi
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        if ($presensi->foto) {
            Storage::delete('public/' . $presensi->foto);
        }
        $presensi->delete();

        return redirect()->route('admin.presensi.index')->with('success', 'Presensi berhasil dihapus!');
    }
}
