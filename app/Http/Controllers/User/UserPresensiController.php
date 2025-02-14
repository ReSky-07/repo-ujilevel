<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPresensiController extends Controller
{
    // Tampilkan halaman presensi user
    public function index()
    {
        $userId = Auth::id();
        $presensis = Presensi::latest()->paginate(10);
        return view('presensi.index', compact('presensis'));
    }

    // Tampilkan form presensi untuk user
    public function create()
    {
        return view('presensi.create');
    }

    // Simpan data presensi yang dikirim user
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|in:Hadir,Izin,Sakit',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Upload Foto
        $fotoPath = $request->file('foto')->store('presensi', 'public');

        Presensi::create([
            'nama' => Auth::user()->name, // Simpan hanya nama
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil dikirim!');
    }
}
