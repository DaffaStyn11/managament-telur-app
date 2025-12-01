<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Telur extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kuantitas',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Statistics methods
    public static function getTodayTotal()
    {
        return self::whereDate('tanggal', Carbon::today())->sum('kuantitas');
    }

    public static function getWeeklyAverage()
    {
        $weekAgo = Carbon::now()->subDays(7);
        $total = self::where('tanggal', '>=', $weekAgo)->sum('kuantitas');
        return round($total / 7);
    }

    public static function getMonthlyTotal()
    {
        return self::whereMonth('tanggal', Carbon::now()->month)
                   ->whereYear('tanggal', Carbon::now()->year)
                   ->sum('kuantitas');
    }

    public static function getYearlyProjection()
    {
        $monthlyAvg = self::getMonthlyTotal();
        return $monthlyAvg * 12;
    }

    /**
     * Get current stock (total production - total sales)
     */
    public static function getCurrentStock()
    {
        $totalProduction = self::sum('kuantitas');
        $totalSales = \App\Models\Penjualan::sum('jumlah');
        return $totalProduction - $totalSales;
    }
}
