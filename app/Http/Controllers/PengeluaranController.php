<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Exports\PengeluaranExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Pengeluaran::query();

        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('tanggal', 'like', '%' . $search . '%')
                  ->orWhere('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('jumlah', 'like', '%' . $search . '%')
                  ->orWhere('harga_satuan', 'like', '%' . $search . '%')
                  ->orWhere('total', 'like', '%' . $search . '%')
                  ->orWhere('catatan', 'like', '%' . $search . '%');
            });
        }

        $pengeluarans = $query->latest('tanggal')->paginate(10)->withQueryString();

        $stats = [
            'today' => Pengeluaran::getTodayTotal(),
            'weekly_avg' => Pengeluaran::getWeeklyTotal(),
            'monthly' => Pengeluaran::getMonthlyTotal(),
        ];

        return view('pages.pengeluaran.index', compact('pengeluarans', 'stats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter',
            'kategori.max' => 'Kategori maksimal 100 karakter',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'harga_satuan.required' => 'Harga satuan wajib diisi',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        try {
            // Calculate total
            $validated['total'] = $validated['jumlah'] * $validated['harga_satuan'];
            
            Pengeluaran::create($validated);
            
            return redirect()->route('pengeluaran.index')
                ->with('success', 'Data pengeluaran berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter',
            'kategori.max' => 'Kategori maksimal 100 karakter',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'harga_satuan.required' => 'Harga satuan wajib diisi',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        try {
            // Calculate total
            $validated['total'] = $validated['jumlah'] * $validated['harga_satuan'];
            
            $pengeluaran->update($validated);
            
            return redirect()->route('pengeluaran.index')
                ->with('success', 'Data pengeluaran berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
            
            return redirect()->route('pengeluaran.index')
                ->with('success', 'Data pengeluaran berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function exportPDF()
    {
        $pengeluarans = Pengeluaran::all();
        
        $pdf = PDF::loadView('pages.pengeluaran.pdf', compact('pengeluarans'));
        
        return $pdf->download('pengeluaran.pdf');
    }

    public function exportExcel()
    {
        $pengeluarans = Pengeluaran::all();
        
        return Excel::download(new PengeluaranExport($pengeluarans), 'pengeluaran.xlsx');
    }
}
