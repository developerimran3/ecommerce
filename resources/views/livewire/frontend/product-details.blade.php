<div class="container py-5">

    <div class="row">

        <div class="col-md-5">

            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid border rounded">

            <div class="row mt-3">

                @foreach ($product->images as $image)
                    <div class="col-3 mb-3">

                        <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid border rounded">

                    </div>
                @endforeach

            </div>

        </div>

        <div class="col-md-7">

            <h2>{{ $product->name }}</h2>

            <p>

                Category:
                <strong>{{ $product->category?->name }}</strong>
            </p>

            <p>

                Brand:
                <strong>{{ $product->brand?->name }}</strong>
            </p>

            <h3 class="text-success">

                ৳ {{ number_format($product->final_price, 2) }}

            </h3>

            <p>

                Stock:
                {{ $product->stock }}
            </p>

            <hr>

            <div class="d-flex align-items-center mb-3">

                <button class="btn btn-danger" wire:click="decreaseQty">

                    -

                </button>

                <input type="text" class="form-control mx-2 text-center" value="{{ $qty }}"
                    style="width: 80px" readonly>

                <button class="btn btn-success" wire:click="increaseQty">

                    +

                </button>

            </div>

            <button class="btn btn-primary" wire:click="addToCart">

                <i class="fa fa-shopping-cart"></i>

                Add To Cart

            </button>

        </div>

    </div>

</div>
