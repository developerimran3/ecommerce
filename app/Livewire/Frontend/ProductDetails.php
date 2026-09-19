<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;

    public $qty = 1;

    public $selectedSize = null;

    public $selectedColor = null;


    /**
     * Mount Product
     */
    public function mount($slug)
    {
        $this->product = Product::with([
            'category',
            'brand',
            'images',
            'sizes',
            'colors',
        ])
            ->where('slug', $slug)
            ->firstOrFail();
    }


    /**
     * Increase Quantity
     */
    public function increaseQty()
    {
        if ($this->qty < $this->product->stock) {
            $this->qty++;
        }
    }


    /**
     * Decrease Quantity
     */
    public function decreaseQty()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }


    /**
     * Validate Size & Color
     */
    private function validateProductOptions()
    {
        // Size আছে কিন্তু select করা হয়নি
        if ($this->product->sizes->count() > 0 && empty($this->selectedSize)) {
            $this->dispatch('error', message: 'Please select a size.');
            return false;
        }

        // Color আছে কিন্তু select করা হয়নি
        if ($this->product->colors->count() > 0 && empty($this->selectedColor)) {
            $this->dispatch('error', message: 'Please select a color.');
            return false;
        }

        return true;
    }


    public function addToCart()
    {
        // Size / Color validation
        if (!$this->validateProductOptions()) {
            return false;
        }

        // Stock check
        if ($this->product->stock <= 0) {
            $this->dispatch('error', message: 'This product is out of stock.');
            return false;
        }

        // Quantity stock-এর চেয়ে বেশি হলে
        if ($this->qty > $this->product->stock) {
            $this->dispatch(
                'error',
                message: 'Only' . $this->product->stock . 'item(s) available in stock.'
            );

            return false;
        }

        // Quantity check
        if ($this->qty > $this->product->stock) {

            $this->dispatch(
                'error',
                message: 'Only' . $this->product->stock . 'items are available.'
            );

            return false;
        }


        // Create / get cart
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);


        // Find same product + size + color
        $itemQuery = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id);


        // Size
        if ($this->selectedSize) {
            $itemQuery->where('size_id', $this->selectedSize);
        } else {
            $itemQuery->whereNull('size_id');
        }


        // Color
        if ($this->selectedColor) {
            $itemQuery->where('color_id', $this->selectedColor);
        } else {
            $itemQuery->whereNull('color_id');
        }


        $item = $itemQuery->first();


        // Existing cart item
        if ($item) {

            $newQty = $item->qty + $this->qty;

            if ($newQty > $this->product->stock) {

                $this->dispatch(
                    'error',
                    message: 'You cannot add more than available stock.'
                );

                return false;
            }

            $item->update([
                'qty' => $newQty,
                'subtotal' => $newQty * $item->price,
            ]);
        }


        // New cart item
        else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'size_id' => $this->selectedSize,
                'color_id' => $this->selectedColor,
                'qty' => $this->qty,
                'price' => $this->product->final_price,
                'subtotal' => $this->product->final_price * $this->qty,
            ]);
        }


        // Cart count update
        $this->dispatch('cartUpdated');

        // Success message
        $this->dispatch(
            'success',
            message: 'Product added to cart.'
        );

        return true;
    }


    public function orderNow()
    {
        // addToCart successful কিনা check
        $added = $this->addToCart();

        // Stock / validation / quantity সমস্যা হলে checkout-এ যাবে না
        if (!$added) {
            return;
        }

        // সফল হলে checkout
        return redirect()->route('checkout');
    }



    /**
     * Render
     */
    public function render()
    {
        return view(
            'livewire.frontend.product-details'
        )->layout('layouts.frontend');
    }
}
