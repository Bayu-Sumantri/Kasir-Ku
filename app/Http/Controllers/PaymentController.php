<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::orderBy('nama_produk', 'asc')->simplePaginate(10);
        // $total_travel = Travel_packages::count();
        $allproduk = Product::simplePaginate(10);
        $allpayment = Payment::simplePaginate(10);
        return view('product.index', compact('payment', 'allproduk', 'allpayment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'id_user'                 => ['required'],
            'nama_produk'             => ['required', 'string', 'max:255'],
            'harga_total'             => ['required', 'string', 'max:255'],
            'jumlah_semua_pembelian'  => ['required', 'string', 'max:255'],
            'methode_pembayaran'      => ['required', 'string', 'max:255'],
        ]);

        // Simpan data ke database
        $payment = Payment::create([
            'id_user'                 => $request->id_user,
            'jumlah_semua_pembelian'  => $request->jumlah_semua_pembelian,
            'nama_produk'             => $request->nama_produk,
            'harga_total'             => $request->harga_total,
            'harga_discount'          => $request->harga_discount,
            'persen_discount'         => $request->persen_discount,
            'methode_pembayaran'      => $request->methode_pembayaran,
            'dana'                    => $request->dana,
            'bank'                    => $request->bank,
            'COD'                     => $request->COD,
        ]);

        // Cek apakah data berhasil disimpan
        if ($payment) {
            // Flash message using Laravel Alert package
            Alert::success('Berhasil', 'Success Make a Transaction');

            // Cetak PDF dan tampilkan view jika berhasil
            $pdf = Pdf::loadview('print_resi.print_transaksi', compact('payment'));
            return $pdf->stream();
        } else {
            // Jika gagal menyimpan data
            return redirect(route('Payment.index'))->with('error', 'Failed to make a transaction');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
