<?php

namespace App\Jobs;

use App\Mail\OrderConfirmMail;
use App\Models\Order;
use App\Services\MailConfigService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of attempts.
     */
    public $tries = 5;

    /**
     * Retry delays.
     */
    public $backoff = [
        30,
        60,
        120,
        300,
    ];

    /**
     * Order ID.
     */
    public $orderId;

    /**
     * Create job.
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute job.
     */
    public function handle(
        MailConfigService $mailConfigService
    ): void {

        $order = Order::with([
            'items.product',
            'items.size',
            'items.color',
            'shippingArea',
        ])->find($this->orderId);

        /*
        |--------------------------------------------------------------------------
        | Order not found
        |--------------------------------------------------------------------------
        */

        if (!$order) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Customer email missing
        |--------------------------------------------------------------------------
        */

        if (empty($order->email)) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Send email
        |--------------------------------------------------------------------------
        */

        $mailConfigService->send(
            $order->email,
            new OrderConfirmMail($order)
        );
    }
}
