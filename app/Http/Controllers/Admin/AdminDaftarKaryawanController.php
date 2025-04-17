<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDaftarKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = User::where('usertype', 'user')->get();
        return view('admin.daftar_karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('admin.daftar_karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gaji' => 'required|numeric',
            'password' => 'required|min:6', // Validasi password
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
    
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, coba yang lain.',
    
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
    
            'gaji.required' => 'Gaji wajib diisi.',
            'gaji.numeric' => 'Gaji harus berupa angka.',
            'gaji.min' => 'Gaji tidak boleh kurang dari 0.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt password
            'usertype' => 'user',
            'gaji' => $request->gaji,
        ]);

        return redirect()->route('admin.daftar_karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('admin.daftar_karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'gaji' => 'required|numeric',
            'password' => 'nullable|min:6', // Password opsional
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
    
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, coba yang lain.',
    
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
    
            'gaji.required' => 'Gaji wajib diisi.',
            'gaji.numeric' => 'Gaji harus berupa angka.',
            'gaji.min' => 'Gaji tidak boleh kurang dari 0.',
        ]);

        $karyawan = User::findOrFail($id);

        $data = $request->only(['name', 'email', 'gaji']);

        // Jika password diisi, encrypt dan tambahkan ke $data
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('admin.daftar_karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.daftar_karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
