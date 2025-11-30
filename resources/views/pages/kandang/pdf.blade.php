<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Kandang</title>
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
                <th style="width: 25%">Nama Kandang</th>
                <th style="width: 15%">Blok</th>
                <th style="width: 17%">Jumlah Ayam</th>
                <th style="width: 20%">Jenis Ayam</th>
                <th style="width: 15%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kandangs as $index => $kandang)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $kandang->nama_kandang }}</td>
                    <td>{{ $kandang->blok }}</td>
                    <td style="text-align: center">{{ number_format($kandang->jumlah_ayam) }}</td>
                    <td>{{ $kandang->jenis_ayam }}</td>
                    <td>{{ $kandang->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Kandang: {{ $kandangs->count() }}</p>
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>
</body>

</html>
