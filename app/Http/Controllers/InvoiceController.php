<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;


class InvoiceController extends Controller
{
    public function download($id)
    {
        $order = Order::with([
            'items.product'
        ])->findOrFail($id);

        $pdf = PDF::loadView('invoice-page', [
            'order' => $order
        ]);
        return $pdf->stream($order->invoice_no . '.pdf');
    }
}
