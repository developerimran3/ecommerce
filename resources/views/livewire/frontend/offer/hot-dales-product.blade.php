<div class="container mt-3">

    {{-- HEADER --}}

    <div class="category-header">

        {{-- Breadcrumb --}}
        <div class="breadcrumb-area">

            <a href="{{ url('/') }}">
                Home
            </a>

            <span>/</span>

            <strong>
                Hot Deals
            </strong>

        </div>


        {{-- Sort --}}
        <div class="category-sort">

            <span>
                Showing
                {{ $products->firstItem() ?? 0 }}
                -
                {{ $products->lastItem() ?? 0 }}

                of

                {{ $products->total() }}

                Results
            </span>


            <select wire:model.live="sort" class="form-control">

                <option value="latest">
                    Product: Latest
                </option>

                <option value="oldest">
                    Product: Oldest
                </option>

                <option value="price_low">
                    Price: Low to High
                </option>

                <option value="price_high">
                    Price: High to Low
                </option>
            </select>
        </div>
    </div>


    <div class="row">
        {{--  PRODUCTS --}}
        @forelse ($products as $product)
            <div class="col-lg-2-5 p-1">
                <div class="product-card">
                    <div class="discount">
                        {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                        <br>
                        ছাড়
                    </div>

                    <a href="{{ route('product.details', $product->slug) }}">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                    </a>
                    @if ($product->stock <= 0)
                        <div class="out-of-stock">
                            <span>Out of Stock</span>
                        </div>
                    @endif
                    <div class="product-body">
                        <a href="{{ route('product.details', $product->slug) }}">
                            {{ Str::limit($product->name, 25) }}

                        </a>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="price">
                            <del>৳ {{ $product->price }}</del>
                            <span>৳ {{ $product->discount_price }}</span>
                        </div>
                        <button wire:click="addToCart({{ $product->id }})">
                            অর্ডার করুন
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-product">
                <h5>
                    কোনো Product পাওয়া যায়নি।
                </h5>
                <button type="button" wire:click="clearFilters" class="btn btn-sm btn-success mt-2">
                    Clear Filter
                </button>
            </div>
        @endforelse
    </div>
</div>
