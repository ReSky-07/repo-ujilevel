<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Daftar Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Input</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Diinput Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $key => $barang)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($barang->tanggal_input)->format('d/m/Y') }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $t->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>