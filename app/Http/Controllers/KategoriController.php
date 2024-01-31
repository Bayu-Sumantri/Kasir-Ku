<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->simplePaginate(10);
        // $total_travel = Travel_packages::count();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->nama_kategori  = $request->nama_kategori;
        $kategori->save();

        Alert::success('Berhasil', 'Success Make a Kategori');
        return redirect(route('Kategori.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Temukan data kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Update data kategori
        $kategori->update([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        // Redirect atau berikan respons sesuai kebutuhan\
        Alert::success('Berhasil', 'Success Update a Kategori');
        return redirect()->route('Kategori.index')->with('success', 'Kategori berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
