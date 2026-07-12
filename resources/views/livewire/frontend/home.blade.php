<div class="container py-5">

    <h2 class="mb-4">

        Latest Products

    </h2>

    <div class="row">

        @foreach ($products as $product)
            <div class="col-md-3 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="card-img-top"
                        style="height: 220px; object-fit: cover;">

                    <div class="card-body">

                        <h5>

                            {{ $product->name }}

                        </h5>

                        <p class="text-muted">

                            {{ $product->category?->name }}

                        </p>

                        <h5>

                            ৳ {{ number_format($product->final_price, 2) }}

                        </h5>

                    </div>

                    <div class="card-footer bg-white">

                        <a href="{{ route('product.details', $product->slug) }}" class="btn btn-outline-primary btn-sm">

                            Details

                        </a>

                        <button class="btn btn-primary btn-sm" wire:click="addToCart({{ $product->id }})">

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

    <div class="mt-4">

        {{ $products->links() }}

    </div>

</div>
