<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    // Tampilkan semua data kontak
    public function index()
    {
        $contacts = Contact::latest()->get(); // Bisa juga pakai paginate
        return view('admin.contacts.index', compact('contacts'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Kontak berhasil ditambahkan!');
    }

    // Hapus data kontak
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Kontak berhasil dihapus.');
    }
}
