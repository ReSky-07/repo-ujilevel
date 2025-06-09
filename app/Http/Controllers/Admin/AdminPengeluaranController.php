<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expenditure;
use App\Models\Pengeluaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal', 'desc')->get();

        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $pengeluaranHarian = Pengeluaran::whereDate('tanggal', Carbon::today())->sum('jumlah');
        $pengeluaranBulanan = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)->sum('jumlah');

        // Grafik pengeluaran 7 hari terakhir
        $chartData = collect(range(6, 0))->map(function ($day) {
            $date = now()->subDays($day)->toDateString();
            $pengeluaran = Pengeluaran::whereDate('tanggal', $date)->sum('jumlah');

            return [
                'tanggal' => Carbon::parse($date)->translatedFormat('d M'),
                'pengeluaran' => $pengeluaran,
            ];
        });

        return view('admin.pengeluaran.index', compact(
            'pengeluarans',
            'totalPengeluaran',
            'pengeluaranHarian',
            'pengeluaranBulanan',
            'chartData'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->back()->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());

        return redirect()->back()->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->back()->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
