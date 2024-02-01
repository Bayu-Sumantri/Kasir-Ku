<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{

    // public function cetakPDF(string $id)
    // {
    //     $Payment = Payment::findOrfail($id);
    //     $pdf = Pdf::loadview('print_resi.print_transaksi', compact('Payment'));

    //     return $pdf->stream();
    // }

    public function cetakPDF(string $id)
    {
        $payment = Payment::findOrFail($id);

        // Ganti 'print_resi.print_transaksi' dengan nama view yang sesuai
        return view('print_resi.print_transaksi', compact('payment'));
    }

    // public function cetakPDF_booking(string $id)
    // {
    //     $booking = Booking::findOrfail($id);
    //     $pdf = Pdf::loadview('admin_master.user_sup.cetak_bukti_resi.cetak_bukti_resi_full', compact('booking'));

    //     return $pdf->stream();
    // }

    // public function cetakPDFanime()
    // {
    //     $R_animeku = Pembayaran::orderby('created_at','DESC')->get();

    //     $pdf = Pdf::loadview('report_animeku.report_animeku', compact('R_animeku'));

    //         // //Set timeout
    //         // $pdf->setTimeout(300);

    //     // return $R_user;
    //     return $pdf->stream();
    // }
}
