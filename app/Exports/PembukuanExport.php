<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembukuanExport implements FromArray, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $monthlyData;

    public function __construct(array $monthlyData)
    {
        $this->monthlyData = $monthlyData;
    }

    public function array(): array
    {
        return $this->monthlyData;
    }

    public function headings(): array
    {
        return [
            'No',
            'Periode',
            'Penjualan',
            'Pengeluaran',
            'Saldo',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $row['month_name'] . ' ' . now()->year,
            $row['penjualan'],
            $row['pengeluaran'],
            $row['saldo'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 20,
            'D' => 20,
            'E' => 20,
        ];
    }
}
