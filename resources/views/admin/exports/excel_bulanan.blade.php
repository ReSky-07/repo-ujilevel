<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBulanan as $data)
            <tr>
                <td>{{ $data->bulan }}</td>
                <td>{{ $data->total_pemasukan }}</td>
                <td>{{ $data->total_pengeluaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
