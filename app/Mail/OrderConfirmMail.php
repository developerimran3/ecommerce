<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order->load([
            'items.product',
            'items.size',
            'items.color',
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation - ' .
                $this->order->invoice_no,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.customer.order-confirm',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
