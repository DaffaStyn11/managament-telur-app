<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
            padding: 12px 8px;
            text-align: left;
            border: 1px solid #d1d5db;
        }

        td {
            padding: 10px 8px;
            border: 1px solid #d1d5db;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Data Kandang</h2>
        <p>Laporan Manajemen Kandang Ayam</p>
        <p>Tanggal: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%">No</th>
                <th style="width: 25%">Tanggal</th>
                <th style="width: 15%">Pelanggan</th>
                <th style="width: 17%">Jumlah</th>
                <th style="width: 15%">Harga Satuan</th>
                <th style="width: 15%">Total</th>
                <th style="width: 15%">Catatan</th>
                <th style="width: 15%">Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualans as $index => $penjualan)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $penjualan->tanggal }}</td>
                    <td>{{ $penjualan->pelanggan }}</td>
                    <td style="text-align: center">{{ number_format($penjualan->jumlah) }}</td>
                    <td>{{ $penjualan->harga_satuan }}</td>
                    <td>{{ $penjualan->total }}</td>
                    <td>{{ $penjualan->catatan }}</td>
                    <td>{{ $penjualan->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data Penjualan: {{ $penjualans->count() }}</p>
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>
</body>

</html>
