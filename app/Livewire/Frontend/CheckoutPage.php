<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\ShippingArea;
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
    public $order;
    public $coupon_code = '';
    public $coupon = null;
    public $discount = 0;
    public $area = '';
    public $shipping = 0;
    public $payment_method = 'cod';

    public $trx_id = '';

    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'payment_method' => 'required|in:cod,bkash,nagad,sslcommerz',
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

    //coupon
    public function applyCoupon()
    {
        $this->validate([
            'coupon_code' => 'required|string',
        ]);
        $code = strtoupper(trim($this->coupon_code));
        $coupon = Coupon::where('code', $code)
            ->where('status', true)
            ->first();
        if (!$coupon) {
            $this->dispatch(
                'error',
                message: 'Invalid coupon code.'
            );
            return;
        }
        $today = now()->startOfDay();
        if (
            $today->lt($coupon->start_date) ||
            $today->gt($coupon->end_date)
        ) {
            $this->dispatch(
                'error',
                message: 'This coupon is expired or not active.'
            );
            return;
        }

        if (
            !is_null($coupon->limit) &&
            $coupon->used >= $coupon->limit
        ) {
            $this->dispatch(
                'error',
                message: 'Coupon usage limit exceeded.'
            );
            return;
        }

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

        $subtotal = $cart->items->sum('subtotal');
        if ($subtotal < $coupon->minimum_amount) {
            $this->dispatch(
                'error',
                message: 'Minimum order amount is ৳' .
                    number_format($coupon->minimum_amount, 2)
            );
            return;
        }
        if ($coupon->type === 'fixed') {
            $discount = $coupon->value;
        } else {
            $discount =
                ($subtotal * $coupon->value) / 100;
        }
        $discount = min(
            $discount,
            $subtotal
        );
        $this->coupon = $coupon;
        $this->discount = $discount;
        $this->coupon_code = $coupon->code;
        $this->dispatch(
            'success',
            message: 'Coupon applied successfully.'
        );
    }

    //remove coupon
    public function removeCoupon()
    {
        $this->coupon = null;
        $this->coupon_code = '';
        $this->discount = 0;
        $this->dispatch(
            'success',
            message: 'Coupon removed.'
        );
    }

    //Shipping Area set
    public function updatedArea($value)
    {
        $shippingArea = ShippingArea::where('id', $value)
            ->where('status', true)
            ->first();
        $this->shipping = $shippingArea?->charge ?? 0;
    }



    //Place order
    public function placeOrder()
    {
        $this->validate();

        if (
            in_array($this->payment_method, ['bkash', 'nagad'])
            && empty($this->trx_id)
        ) {
            $this->dispatch(
                'error',
                message: 'Transaction ID is required.'
            );
            return;
        }

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

        /*
    |--------------------------------------------------------------------------
    | Guest User
    |--------------------------------------------------------------------------
    */

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

        /*
    |--------------------------------------------------------------------------
    | Create Order
    |--------------------------------------------------------------------------
    */

        $order = DB::transaction(function () use ($cart, $userId) {

            $subtotal = $cart->items->sum('subtotal');

            // Selected shipping charge
            $shipping = (float) $this->shipping;

            // Applied coupon discount
            $discount = (float) $this->discount;

            // Final total
            $grandTotal = $subtotal + $shipping - $discount;

            /*
    |--------------------------------------------------------------------------
    | Order
    |--------------------------------------------------------------------------
    */

            $order = Order::create([
                'user_id'        => $userId,
                'invoice_no'     => $this->generateInvoice(),

                'name'           => $this->name,
                'phone'          => $this->phone,
                'email'          => $this->email,
                'address'        => $this->address,

                'subtotal'       => $subtotal,
                'shipping'       => $shipping,
                'discount'       => $discount,
                'grand_total'    => $grandTotal,
                'shipping_area_id' => $this->area,

                'payment_method' => $this->payment_method,
                'payment_status' => 'pending',
                'order_status'   => 'pending',
            ]);

            /*
    |--------------------------------------------------------------------------
    | Order Items
    |--------------------------------------------------------------------------
    */

            foreach ($cart->items as $item) {

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'qty'        => $item->qty,
                    'price'      => $item->price,
                    'subtotal'   => $item->subtotal,
                ]);

                $item->product->decrement(
                    'stock',
                    $item->qty
                );
            }

            /*
    |--------------------------------------------------------------------------
    | Payment
    |--------------------------------------------------------------------------
    */

            Payment::create([
                'order_id' => $order->id,
                'trx_id'   => $this->trx_id ?: null,
                'method'   => $this->payment_method,
                'amount'   => $grandTotal,
                'status'   => 'pending',
            ]);

            /*
    |--------------------------------------------------------------------------
    | Coupon Used Count
    |--------------------------------------------------------------------------
    */

            if ($this->coupon) {

                $coupon = Coupon::where('id', $this->coupon->id)
                    ->lockForUpdate()
                    ->first();

                if ($coupon) {
                    $coupon->increment('used');
                }
            }

            /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */

            $cart->items()->delete();
            $cart->delete();

            return $order;
        });

        /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */
        return redirect()->route(
            'order.success',
            $order->id
        );
    }


    /**
     * generate Invoice
     *
     * @return void
     */
    private function generateInvoice()
    {
        return 'INV-' . str_pad(
            Order::count() + 1,
            10,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Mount
     *
     * @return void
     */
    public function mount()
    {
        if (Auth::check()) {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
            $this->address = Auth::user()->address;
        }
        // প্রথম Shipping Area automatically select হবে
        $firstArea = ShippingArea::where('status', true)
            ->orderBy('id', 'asc')
            ->first();
        if ($firstArea) {
            $this->area = $firstArea->id;
            $this->shipping = $firstArea->charge;
        }
    }

    /**
     * Render
     *
     * @return void
     */
    public function render()
    {
        $cart = Cart::with('items.product')
            ->where('session_id', session()->getId())
            ->first();

        $shippingAreas = ShippingArea::where('status', true)
            ->orderBy('id', 'asc')
            ->get();

        $subtotal = $cart
            ? $cart->items->sum('subtotal')
            : 0;

        $grandTotal = $subtotal + $this->shipping - $this->discount;
        return view('livewire.frontend.checkout-page', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shippingAreas' => $shippingAreas,
            'shipping' => $this->shipping,
            'grandTotal' => $grandTotal,
        ])->layout('layouts.frontend', [
            'title' => 'Checkout',
        ]);
    }
}
