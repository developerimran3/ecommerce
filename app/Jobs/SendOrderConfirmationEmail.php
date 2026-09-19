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
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Number of attempts
     */
    public int $tries = 5;

    /**
     * Retry delay in seconds
     */
    public array $backoff = [
        30,
        60,
        120,
        300,
    ];

    /**
     * Order ID
     */
    public int $orderId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     */
    public function handle(
        MailConfigService $mailConfigService
    ): void {

        $order = Order::with([
            'items.product',
            'items.size',
            'items.color',
        ])->find($this->orderId);

        /*
        |--------------------------------------------------------------------------
        | Order deleted হলে
        |--------------------------------------------------------------------------
        */

        if (!$order) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Email না থাকলে
        |--------------------------------------------------------------------------
        */

        if (empty($order->email)) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */

        $mailConfigService->send(
            $order->email,
            new OrderConfirmMail($order)
        );
    }
}
