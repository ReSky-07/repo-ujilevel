<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Bagian ini belum diisi',
        ]);

        Kategori::create($request->all());
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Bagian ini belum diisi',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
