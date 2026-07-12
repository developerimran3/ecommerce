<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $name;

    public $phone;

    public $email;

    public $address;

    public $payment_method = 'cod';

    protected $rules = [

        'name' => 'required',

        'phone' => 'required',

        'email' => 'required|email',

        'address' => 'required',

        'payment_method' => 'required',
    ];

    public function placeOrder()
    {
        $this->validate();

        $cart = Cart::with('items.product')
            ->where('session_id', session()->getId())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {

            $this->dispatch(
                'error',
                message: 'Cart is empty.'
            );

            return;
        }

        DB::transaction(function () use ($cart) {

            $subtotal = $cart->items->sum('subtotal');

            $order = Order::create([

                'user_id' => auth()->id(),

                'invoice_no' => $this->generateInvoice(),

                'name' => $this->name,

                'phone' => $this->phone,

                'email' => $this->email,

                'address' => $this->address,

                'subtotal' => $subtotal,

                'shipping' => 0,

                'discount' => 0,

                'grand_total' => $subtotal,

                'payment_method' => $this->payment_method,

                'payment_status' => 'pending',

                'order_status' => 'pending',
            ]);

            foreach ($cart->items as $item) {

                OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item->product_id,

                    'qty' => $item->qty,

                    'price' => $item->price,

                    'subtotal' => $item->subtotal,
                ]);

                $item->product->decrement(
                    'stock',
                    $item->qty
                );
            }

            $cart->items()->delete();

            $cart->delete();

            session()->flash(
                'success',
                'Order placed successfully.'
            );

            $this->redirect(
                route('home'),
                navigate: true
            );
        });
    }

    private function generateInvoice()
    {
        return 'INV-' . now()->format('Ymd') . '-' . str_pad(
            Order::count() + 1,
            5,
            '0',
            STR_PAD_LEFT
        );
    }

    public function render()
    {
        $cart = Cart::with('items.product')
            ->where('session_id', session()->getId())
            ->first();

        $total = $cart
            ? $cart->items->sum('subtotal')
            : 0;

        return view(
            'livewire.frontend.checkout-page',
            compact('cart', 'total')
        )->layout('layouts.frontend');
    }
}
