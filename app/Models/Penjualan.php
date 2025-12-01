<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'pelanggan',
        'jumlah',
        'harga_satuan',
        'total',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_satuan' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Statistics methods
    public static function getTodayTotal()
    {
        return self::whereDate('tanggal', today())->sum('total');
    }

    public static function getWeeklyAverage()
    {
        $weekAgo = now()->subDays(7);
        $total = self::where('tanggal', '>=', $weekAgo)->sum('total');
        return round($total / 7);
    }

    public static function getMonthlyTotal()
    {
        return self::whereMonth('tanggal', now()->month)
                   ->whereYear('tanggal', now()->year)
                   ->sum('total');
    }
}
