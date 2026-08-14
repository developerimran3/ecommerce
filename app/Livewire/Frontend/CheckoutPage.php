<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $name;

    public $phone;

    public $email;

    public $address;

    public  $order;

    public $payment_method = 'cod';



    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'payment_method' => 'required',
    ];

    public function increaseQty($id)
    {
        $item = CartItem::findOrFail($id);

        $item->qty++;
        $item->subtotal = $item->qty * $item->price;
        $item->save();

        $this->dispatch('cartUpdated');
    }

    public function decreaseQty($id)
    {
        $item = CartItem::findOrFail($id);

        if ($item->qty > 1) {

            $item->decrement('qty');

            $item->update([
                'subtotal' => $item->qty * $item->price
            ]);
        }

        $this->dispatch('cartUpdated');
    }

    public function removeItem($id)
    {
        CartItem::findOrFail($id)->delete();

        $this->dispatch('cartUpdated');

        $this->dispatch(
            'success',
            message: 'Item removed from cart.'
        );
    }

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

        $userId = auth()->id();

        if (!$userId) {

            $user = User::where('email', $this->email)->first();

            if (!$user) {

                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'password' => Hash::make('12345678'),
                ]);
            }

            Auth::login($user);

            $userId = $user->id;
        }

        $order = DB::transaction(function () use ($cart, $userId) {

            $subtotal = $cart->items->sum('subtotal');

            $order = Order::create([
                'user_id' => $userId,
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
            return $order;
        });

        return redirect()->route(
            'order.success',
            $order->id
        );
    }

    private function generateInvoice()
    {
        return 'INV-' . str_pad(
            Order::count() + 1,
            10,
            '0',
            STR_PAD_LEFT
        );
    }

    public function mount()
    {
        if (Auth::check()) {

            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
            $this->address = Auth::user()->address;

            // যদি user table এ payment_method থাকে
            // $this->payment_method = Auth::user()->payment_method ?? 'cod';
        }
    }
    public function render()
    {
        $cart = Cart::with('items.product')
            ->where('session_id', session()->getId())
            ->first();

        $total = $cart
            ? $cart->items->sum('subtotal')
            : 0;

        return view('livewire.frontend.checkout-page', [
            'cart' => $cart,
            'total' => $total,
        ])->layout('layouts.frontend', [
            'title' => 'Checkout',
        ]);
    }
}
