<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; font-size: 12px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Keuangan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Penginput</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $t->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-right">
                        @if($t->jenis_transaksi === 'pemasukan')
                            Rp {{ number_format($t->jumlah_transaksi, 2, ',', '.') }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($t->jenis_transaksi === 'pengeluaran')
                            Rp {{ number_format($t->jumlah_transaksi, 2, ',', '.') }}
                        @endif
                    </td>
                    <td>{{ $t->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th class="text-right">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <small>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</small>
</body>
</html>
