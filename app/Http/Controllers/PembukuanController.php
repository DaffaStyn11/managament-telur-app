<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PengeluaranExport;
use App\Exports\PenjualanExport;
use App\Exports\PembukuanExport;

class PembukuanController extends Controller
{
    public function index()
    {
        // Get monthly totals for current year
        $currentYear = now()->year;
        
        // Get total penjualan (sales)
        $totalPenjualan = Penjualan::whereYear('tanggal', $currentYear)->sum('total');
        
        // Get total pengeluaran (expenses)
        $totalPengeluaran = Pengeluaran::whereYear('tanggal', $currentYear)->sum('total');
        
        // Calculate saldo (balance)
        $saldoAkhir = $totalPenjualan - $totalPengeluaran;
        
        // Get monthly breakdown
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $penjualan = Penjualan::whereYear('tanggal', $currentYear)
                                  ->whereMonth('tanggal', $month)
                                  ->sum('total');
            
            $pengeluaran = Pengeluaran::whereYear('tanggal', $currentYear)
                                      ->whereMonth('tanggal', $month)
                                      ->sum('total');
            
            $saldo = $penjualan - $pengeluaran;
            
            $monthlyData[] = [
                'month' => $month,
                'month_name' => \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F'),
                'penjualan' => $penjualan,
                'pengeluaran' => $pengeluaran,
                'saldo' => $saldo,
            ];
        }
        
        // Filter only months with data
        $monthlyData = array_filter($monthlyData, function($data) {
            return $data['penjualan'] > 0 || $data['pengeluaran'] > 0;
        });

        // Filter based on search query if present
        if (request('search')) {
            $search = strtolower(request('search'));
            $monthlyData = array_filter($monthlyData, function($data) use ($search) {
                return str_contains(strtolower($data['month_name']), $search);
            });
        }
        
        // Re-index array after filtering
        $monthlyData = array_values($monthlyData);
        
        // Prepare chart data (last 6 months with data)
        $chartData = array_slice($monthlyData, -6);
        
        // If less than 6 months, pad with empty months
        while (count($chartData) < 6) {
            array_unshift($chartData, [
                'month_name' => '',
                'penjualan' => 0,
                'pengeluaran' => 0,
            ]);
        }
        
        $chartLabels = array_map(function($data) {
            return $data['month_name'];
        }, $chartData);
        
        $chartPenjualan = array_map(function($data) {
            return $data['penjualan'];
        }, $chartData);
        
        $chartPengeluaran = array_map(function($data) {
            return $data['pengeluaran'];
        }, $chartData);
        
        // Calculate latest month totals for summary cards (from the last month with data)
        $latestMonthPenjualan = $totalPenjualan;
        $latestMonthPengeluaran = $totalPengeluaran;
        
        // if (!empty($monthlyData)) {
        //     $latestMonth = end($monthlyData);
        //     $latestMonthPenjualan = $latestMonth['penjualan'];
        //     $latestMonthPengeluaran = $latestMonth['pengeluaran'];
        // }
        
        return view('pages.pembukuan.index', compact(
            'totalPenjualan',
            'totalPengeluaran',
            'saldoAkhir',
            'monthlyData',
            'chartLabels',
            'chartPenjualan',
            'chartPengeluaran',
            'latestMonthPenjualan',
            'latestMonthPengeluaran'
        ));
    }

    public function exportPDF()
    {
        $currentYear = now()->year;
        
        // Get monthly breakdown
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $penjualan = Penjualan::whereYear('tanggal', $currentYear)
                                  ->whereMonth('tanggal', $month)
                                  ->sum('total');
            
            $pengeluaran = Pengeluaran::whereYear('tanggal', $currentYear)
                                      ->whereMonth('tanggal', $month)
                                      ->sum('total');
            
            $saldo = $penjualan - $pengeluaran;
            
            $monthlyData[] = [
                'month' => $month,
                'month_name' => \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F'),
                'penjualan' => $penjualan,
                'pengeluaran' => $pengeluaran,
                'saldo' => $saldo,
            ];
        }
        
        // Filter only months with data
        $monthlyData = array_filter($monthlyData, function($data) {
            return $data['penjualan'] > 0 || $data['pengeluaran'] > 0;
        });
        
        $monthlyData = array_values($monthlyData);
        
        $pdf = PDF::loadView('pages.pembukuan.pdf', compact('monthlyData', 'currentYear'));
        
        return $pdf->download('pembukuan_' . $currentYear . '.pdf');
    }

    public function exportExcel()
    {
        $currentYear = now()->year;
        
        // Get monthly breakdown
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $penjualan = Penjualan::whereYear('tanggal', $currentYear)
                                  ->whereMonth('tanggal', $month)
                                  ->sum('total');
            
            $pengeluaran = Pengeluaran::whereYear('tanggal', $currentYear)
                                      ->whereMonth('tanggal', $month)
                                      ->sum('total');
            
            $saldo = $penjualan - $pengeluaran;
            
            $monthlyData[] = [
                'month' => $month,
                'month_name' => \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F'),
                'penjualan' => $penjualan,
                'pengeluaran' => $pengeluaran,
                'saldo' => $saldo,
            ];
        }
        
        // Filter only months with data
        $monthlyData = array_filter($monthlyData, function($data) {
            return $data['penjualan'] > 0 || $data['pengeluaran'] > 0;
        });
        
        $monthlyData = array_values($monthlyData);

        return Excel::download(new PembukuanExport($monthlyData), 'pembukuan_' . $currentYear . '.xlsx');
    }
}
