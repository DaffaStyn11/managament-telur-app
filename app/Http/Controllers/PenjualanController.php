<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Exports\PenjualanExport;
use Illuminate\Http\Request;
use App\Models\Telur;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Penjualan::query();

        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('tanggal', 'like', '%' . $search . '%')
                  ->orWhere('pelanggan', 'like', '%' . $search . '%')
                  ->orWhere('jumlah', 'like', '%' . $search . '%')
                  ->orWhere('harga_satuan', 'like', '%' . $search . '%')
                  ->orWhere('total', 'like', '%' . $search . '%')
                  ->orWhere('catatan', 'like', '%' . $search . '%');
            });
        }

        $penjualans = $query->latest('tanggal')->paginate(10)->withQueryString();

        $stats = [
            'today' => Penjualan::getTodayTotal(),
            'weekly_avg' => Penjualan::getWeeklyAverage(),
            'monthly' => Penjualan::getMonthlyTotal(),
        ];

        return view('pages.penjualan.index', compact('penjualans', 'stats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pelanggan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'pelanggan.required' => 'Nama pelanggan wajib diisi',
            'pelanggan.max' => 'Nama pelanggan maksimal 255 karakter',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'harga_satuan.required' => 'Harga satuan wajib diisi',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        // Check stock availability
        $currentStock = Telur::getCurrentStock();
        if ($validated['jumlah'] > $currentStock) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . number_format($currentStock) . ' butir')
                ->withInput();
        }

        try {
            // Calculate total
            $validated['total'] = $validated['jumlah'] * $validated['harga_satuan'];
            
            Penjualan::create($validated);
            
            return redirect()->route('penjualan.index')
                ->with('success', 'Data penjualan berhasil ditambahkan! Stok telur berkurang ' . number_format($validated['jumlah']) . ' butir');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pelanggan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'pelanggan.required' => 'Nama pelanggan wajib diisi',
            'pelanggan.max' => 'Nama pelanggan maksimal 255 karakter',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'harga_satuan.required' => 'Harga satuan wajib diisi',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        // Check stock availability (add back old quantity, then check new quantity)
        $currentStock = Telur::getCurrentStock() + $penjualan->jumlah;
        if ($validated['jumlah'] > $currentStock) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . number_format($currentStock) . ' butir')
                ->withInput();
        }

        try {
            // Calculate total
            $validated['total'] = $validated['jumlah'] * $validated['harga_satuan'];
            
            $penjualan->update($validated);
            
            return redirect()->route('penjualan.index')
                ->with('success', 'Data penjualan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        try {
            $jumlah = $penjualan->jumlah;
            $penjualan->delete();
            
            return redirect()->route('penjualan.index')
                ->with('success', 'Data penjualan berhasil dihapus! Stok telur bertambah ' . number_format($jumlah) . ' butir');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function exportPDF()
    {
        $penjualans = Penjualan::all();
        
        $pdf = PDF::loadView('pages.penjualan.pdf', compact('penjualans'));
        
        return $pdf->download('penjualan.pdf');
    }

    public function exportExcel()
    {
        $penjualans = Penjualan::all();
        
        return Excel::download(new Penjualan($penjualans), 'penjualan.xlsx');
    }
}
