<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penjualan::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'tanggal', 
            'pelanggan', 
            'jumlah', 
            'harga_satuan', 
            'total', 
            'catatan', 
            'Tanggal Dibuat'
        ];
    }

    /**
     * @var Penjualan $penjualan
     */
    public function map($penjualan): array
    {
        static $no = 0;
        $no++;

        return [
            $no, 
            $penjualan->tanggal, 
            $penjualan->pelanggan, 
            $penjualan->jumlah, 
            $penjualan->harga_satuan, 
            $penjualan->total, 
            $penjualan->catatan, 
            $penjualan->created_at->format('d-m-Y H:i')
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 15,
            'D' => 15,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
        ];
    }
}
