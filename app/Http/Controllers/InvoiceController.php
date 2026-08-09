<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Mpdf\MpdfException;



class InvoiceController extends Controller
{
    public function download($id)
    {
        $order = Order::with([
            'items.product'
        ])->findOrFail($id);

        $pdf = PDF::loadView('livewire.frontend.invoice-page', [
            'order' => $order
        ]);
        return $pdf->stream($order->invoice_no . '.pdf');
    }
}
