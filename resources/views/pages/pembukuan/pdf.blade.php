<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pembukuan {{ $currentYear }}</title>
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

        .text-green {
            color: #10b981;
        }

        .text-red {
            color: #ef4444;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Pembukuan</h2>
        <p>Tahun {{ $currentYear }}</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Periode</th>
                <th style="width: 15%">Deskripsi</th>
                <th style="width: 20%">Penjualan</th>
                <th style="width: 20%">Pengeluaran</th>
                <th style="width: 25%">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($monthlyData as $index => $data)
                <!-- Penjualan Row -->
                <tr>
                    <td style="text-align: center" rowspan="3">{{ $index + 1 }}</td>
                    <td rowspan="3">{{ $data['month_name'] }} {{ $currentYear }}</td>
                    <td>Penjualan</td>
                    <td class="text-green font-bold">Rp {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                    <td>-</td>
                    <td class="text-green">+ Rp {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                </tr>
                <!-- Pengeluaran Row -->
                <tr>
                    <td>Pengeluaran</td>
                    <td>-</td>
                    <td class="text-red font-bold">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    <td class="text-red">- Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                </tr>
                <!-- Saldo Row -->
                <tr style="background-color: #f3f4f6;">
                    <td class="font-bold">Saldo</td>
                    <td class="text-green">Rp {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                    <td class="text-red">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    <td class="font-bold {{ $data['saldo'] >= 0 ? 'text-green' : 'text-red' }}">
                        Rp {{ number_format($data['saldo'], 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">Tidak ada data pembukuan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ count($monthlyData) }} bulan</p>
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>
</body>

</html>
