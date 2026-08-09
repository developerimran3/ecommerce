<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;


class InvoiceController extends Controller
{
    public function download($id)
    {

        $order = Order::with([
            'items.product'
        ])->findOrFail($id);


        // Load the blade view and pass data
        $pdf = PDF::loadView('livewire.frontend.invoice-page', $order);

        // Stream the PDF file in browser or download it
        return $pdf->stream($order->invoice_no . '.pdf');


        // $pdf = Pdf::loadView(
        //     'livewire.frontend.invoice-page',
        //     compact('order')
        // );
        // $pdf->setPaper('A4');

        // return $pdf->download(
        //     $order->invoice_no . '.pdf'
        // );
    }
}
