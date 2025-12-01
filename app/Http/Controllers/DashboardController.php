<?php

namespace App\Http\Controllers;

use App\Models\Telur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with total stock.
     */
    public function index()
    {
        // Calculate current stock (total production - total sales)
        $totalStok = Telur::getCurrentStock();
        
        // Get total number of production entries
        $totalProduksi = Telur::count();
        
        // Get latest production data
        $produksiTerbaru = Telur::latest('tanggal')->take(5)->get();
        
        return view('pages.dashboard.index', compact('totalStok', 'totalProduksi', 'produksiTerbaru'));
    }
}
