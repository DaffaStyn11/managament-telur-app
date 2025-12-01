<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Exports\KandangExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KandangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kandang::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kandang', 'like', '%' . $search . '%')
                  ->orWhere('jenis_ayam', 'like', '%' . $search . '%')
                  ->orWhere('blok', 'like', '%' . $search . '%')
                  ->orWhere('jumlah_ayam', 'like', '%' . $search . '%');
            });
        }

        $kandangs = $query->latest()->paginate(10)->withQueryString();
        
        return view('pages.kandang.index', compact('kandangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kandang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kandang' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'jumlah_ayam' => 'required|integer|min:0',
            'jenis_ayam' => 'required|string|max:255',
        ], [
            'nama_kandang.required' => 'Nama kandang wajib diisi',
            'blok.required' => 'Blok wajib diisi',
            'jumlah_ayam.required' => 'Jumlah ayam wajib diisi',
            'jumlah_ayam.integer' => 'Jumlah ayam harus berupa angka',
            'jumlah_ayam.min' => 'Jumlah ayam tidak boleh kurang dari 0',
            'jenis_ayam.required' => 'Jenis ayam wajib diisi',
        ]);

        try {
            Kandang::create($validated);
            return redirect()->route('kandang.index')
                ->with('success', 'Kandang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan kandang: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kandang $kandang)
    {
        return view('pages.kandang.show', compact('kandang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kandang $kandang)
    {
        return view('pages.kandang.edit', compact('kandang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kandang $kandang)
    {
        $validated = $request->validate([
            'nama_kandang' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'jumlah_ayam' => 'required|integer|min:0',
            'jenis_ayam' => 'required|string|max:255',
        ], [
            'nama_kandang.required' => 'Nama kandang wajib diisi',
            'blok.required' => 'Blok wajib diisi',
            'jumlah_ayam.required' => 'Jumlah ayam wajib diisi',
            'jumlah_ayam.integer' => 'Jumlah ayam harus berupa angka',
            'jumlah_ayam.min' => 'Jumlah ayam tidak boleh kurang dari 0',
            'jenis_ayam.required' => 'Jenis ayam wajib diisi',
        ]);

        try {
            $kandang->update($validated);
            return redirect()->route('kandang.index')
                ->with('success', 'Kandang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui kandang: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kandang $kandang)
    {
        try {
            $kandang->delete();
            return redirect()->route('kandang.index')
                ->with('success', 'Kandang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus kandang: ' . $e->getMessage());
        }
    }

    /**
     * Export kandang data to Excel
     */
    public function exportExcel()
    {
        return Excel::download(new KandangExport, 'data-kandang-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export kandang data to PDF
     */
    public function exportPdf()
    {
        $kandangs = Kandang::all();
        $pdf = Pdf::loadView('pages.kandang.pdf', compact('kandangs'));
        return $pdf->download('data-kandang-' . date('Y-m-d') . '.pdf');
    }
}
