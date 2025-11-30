<?php

namespace App\Exports;

use App\Models\Kandang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KandangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kandang::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Kandang',
            'Blok',
            'Jumlah Ayam',
            'Jenis Ayam',
            'Tanggal Dibuat',
        ];
    }

    /**
     * @var Kandang $kandang
     */
    public function map($kandang): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $kandang->nama_kandang,
            $kandang->blok,
            $kandang->jumlah_ayam,
            $kandang->jenis_ayam,
            $kandang->created_at->format('d-m-Y H:i'),
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
        ];
    }
}
