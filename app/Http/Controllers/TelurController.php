<?php

namespace App\Http\Controllers;

use App\Models\Telur;
use Illuminate\Http\Request;

class TelurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telurs = Telur::latest('tanggal')->paginate(10);
        

        return view('pages.telur.index', compact('telurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.telur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kuantitas' => 'required|integer|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'kuantitas.required' => 'Kuantitas wajib diisi',
            'kuantitas.integer' => 'Kuantitas harus berupa angka',
            'kuantitas.min' => 'Kuantitas tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        try {
            Telur::create($validated);
            return redirect()->route('telur.index')
                ->with('success', 'Data produksi telur berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Telur $telur)
    {
        return view('pages.telur.show', compact('telur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telur $telur)
    {
        return view('pages.telur.edit', compact('telur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Telur $telur)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kuantitas' => 'required|integer|min:0',
            'catatan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'kuantitas.required' => 'Kuantitas wajib diisi',
            'kuantitas.integer' => 'Kuantitas harus berupa angka',
            'kuantitas.min' => 'Kuantitas tidak boleh kurang dari 0',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ]);

        try {
            $telur->update($validated);
            return redirect()->route('telur.index')
                ->with('success', 'Data produksi telur berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telur $telur)
    {
        try {
            $telur->delete();
            return redirect()->route('telur.index')
                ->with('success', 'Data produksi telur berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
