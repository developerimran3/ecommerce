<div class="container py-5">

    <h2 class="mb-4">

        Shopping Cart

    </h2>

    @if ($cart && $cart->items->count())

        <div class="card shadow">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead class="thead-dark">

                            <tr>

                                <th>Image</th>

                                <th>Product</th>

                                <th>Price</th>

                                <th width="180">Quantity</th>

                                <th>Subtotal</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($cart->items as $item)
                                <tr>

                                    <td>

                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}" width="70">

                                    </td>

                                    <td>

                                        {{ $item->product->name }}

                                    </td>

                                    <td>

                                        ৳ {{ number_format($item->price, 2) }}

                                    </td>

                                    <td>

                                        <div class="d-flex">

                                            <button class="btn btn-sm btn-danger"
                                                wire:click="decreaseQty({{ $item->id }})">

                                                -

                                            </button>

                                            <input type="text" class="form-control text-center mx-2"
                                                value="{{ $item->qty }}" readonly>

                                            <button class="btn btn-sm btn-success"
                                                wire:click="increaseQty({{ $item->id }})">

                                                +

                                            </button>

                                        </div>

                                    </td>

                                    <td>

                                        ৳ {{ number_format($item->subtotal, 2) }}

                                    </td>

                                    <td>

                                        <button class="btn btn-danger btn-sm"
                                            wire:click="removeItem({{ $item->id }})">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="text-right mt-4">

                    <h3>

                        Total:

                        ৳ {{ number_format($total, 2) }}

                    </h3>

                    <a href="{{ route('checkout') }}" wire:navigate class="btn btn-success mt-2">

                        Checkout

                    </a>

                </div>

            </div>

        </div>
    @else
        <div class="alert alert-warning">

            Cart is empty.

        </div>

    @endif

</div>
