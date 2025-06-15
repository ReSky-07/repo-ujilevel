<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expenditure;
use App\Models\Pengeluaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $selectedBulan = $request->get('bulan', Carbon::now()->format('m'));
        $selectedTahun = $request->get('tahun', Carbon::now()->format('Y'));

        $pengeluarans = Pengeluaran::orderBy('tanggal', 'desc')->get();

        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $pengeluaranHarian = Pengeluaran::whereDate('tanggal', Carbon::today())->sum('jumlah');

        // Filter bulanan berdasarkan pilihan user
        $pengeluaranBulanan = Pengeluaran::whereMonth('tanggal', $selectedBulan)
            ->whereYear('tanggal', $selectedTahun)
            ->sum('jumlah');

        // Data untuk grafik
        $chartData = collect(range(6, 0))->map(function ($day) {
            $date = now()->subDays($day)->toDateString();
            $pengeluaran = Pengeluaran::whereDate('tanggal', $date)->sum('jumlah');

            return [
                'tanggal' => Carbon::parse($date)->translatedFormat('d M'),
                'pengeluaran' => $pengeluaran,
            ];
        });

        // List bulan dan tahun
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $listTahun = range(Carbon::now()->year - 5, Carbon::now()->year + 1);
        $listTahun = array_reverse($listTahun);

        return view('admin.pengeluaran.index', compact(
            'pengeluarans',
            'totalPengeluaran',
            'pengeluaranHarian',
            'pengeluaranBulanan',
            'chartData',
            'selectedBulan',
            'selectedTahun',
            'listBulan',
            'listTahun'
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
