<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::orderBy('merk', 'asc')->simplePaginate(10);
        // $total_travel = Travel_packages::count();
        $allkategori = Kategori::all();
        return view('product.prodct', compact('Product', 'allkategori'));
    }

    public function master()
    {
        $Product = Product::orderBy('merk', 'asc')->simplePaginate(10);
        // $total_travel = Travel_packages::count();
        $allkategori = Kategori::all();
        return view('product.index', compact('Product', 'allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allkategori = Kategori::all();
        return view('product.form', compact('allkategori'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'id_kategori'   => ['required', 'string'],
            'nama_produk'  => ['required', 'string', 'max:255'],
            'merk'          => ['required', 'string', 'max:255'],
            'harga_beli'    => ['required', 'string', 'max:255'],
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Store the uploaded image in the 'gambar_product' folder
        // $namaFile = $request->file('gambar_produk')->getClientOriginalName();
        // $request->file('gambar_produk')->move(public_path('gambar_produk'), $namaFile);

        $images = $request->file('gambar_produk')->store('gambar_produk');


        Product::create([
            'id_kategori'    => $request->id_kategori,
            'harga_beli'     => $request->harga_beli,
            'nama_produk'   => $request->nama_produk,
            'merk'           => $request->merk,
            'gambar_produk' =>  $images,
        ]);

        // Flash message using Laravel Alert package (you need to install it)
        Alert::success('Berhasil', 'Success Make a Product');

        // Redirect to the correct route (Product.index)
        return redirect(route('Product.index'))->with('success', 'Successfully uploaded your Product');
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
        $product = Product::findOrFail($id);
        $allkategori = Kategori::all();
        return view('product.edit_product', compact('product', 'allkategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'id_kategori'   => ['required', 'string'],
            'nama_produk'   => ['required', 'string', 'max:255'],
            'merk'          => ['required', 'string', 'max:255'],
            'harga_beli'    => ['required', 'string', 'max:255'],
            'gambar_produk' => 'image|mimes:jpeg,png,jpg,gif|max:5048', // Update validation for image (optional)
        ]);

        // Update fields based on validated data
        $product->update([
            'id_kategori'    => $data['id_kategori'],
            'harga_beli'     => $data['harga_beli'],
            'nama_produk'    => $data['nama_produk'],
            'merk'           => $data['merk'],
        ]);

        // Check if a new image is provided and update it
        if ($request->hasFile('gambar_produk')) {
            $newImage = $request->file('gambar_produk')->store('gambar_produk');
            // Delete the old image if needed
            $product->update(['gambar_produk' => $newImage]);
        }

        // Flash message using Laravel Alert package (you need to install it)
        Alert::success('Berhasil', 'Success Update Product');

        // Redirect to the correct route (Product.index)
        return redirect(route('Product.index'))->with('success', 'Successfully updated your Product');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
