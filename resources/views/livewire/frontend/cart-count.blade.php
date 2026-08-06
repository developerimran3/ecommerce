<div class="cart-wrapper ">
    <a href="{{ route('checkout') }}" wire:navigate>
        <p class="margin-shopping">
            <i class="fa-solid fa-cart-shopping"></i>
            <span> {{ $count ?? 0 }}</span>
        </p>
    </a>

    <!-- Mini Cart -->
    <div class="mini-cart">

        <table class="table ">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($cart && $cart->items->count())
                    @foreach ($cart->items as $item)
                        <tr>
                            <td> {{ Str::limit($item->product->name, 20) }} </td>
                            <td> {{ $item->qty }} </td>
                            <td> ৳{{ number_format($item->subtotal) }} </td>
                            <td><a href="javascript:void(0)" wire:click="removeItem({{ $item->id }})"
                                    class="text-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="mini-cart-footer">
            <p class="text-center"><strong> সর্বমোট :
                    ৳{{ number_format($cart ? $cart->items->sum('subtotal') : 0, 2) }}</strong></p>
            <a href="{{ route('checkout') }}" wire:navigate> অর্ডার করুন </a>
        </div>
    </div>
</div>
