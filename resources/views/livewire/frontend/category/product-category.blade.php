<div class="container mt-3">

    {{-- Category Header --}}
    <div class="category-header">
        <div class="breadcrumb-area">
            <a href="{{ url('/') }}">Home</a>
            <span>/</span>
            <strong>{{ $category->name }}</strong>
        </div>

        <div class="category-sort">
            <span>
                Showing
                {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}
                of {{ $products->total() }} Results
            </span>

            <select wire:model.live="sort" class="form-control">
                <option value="latest">Product: Latest</option>
                <option value="oldest">Product: Oldest</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
            </select>
        </div>
    </div>

    <div class="row">

        {{-- LEFT SIDEBAR --}}
        <div class="col-lg-3 col-md-4 mb-3">

            {{-- Category --}}
            <div class="filter-box">
                <div class="filter-title">
                    <span>{{ $category->name }}</span>
                    <i class="fas fa-chevron-up"></i>
                </div>

                <div class="filter-content">
                    <div class="subcategory">
                        {{ $products->total() }} Products
                    </div>
                </div>
            </div>

            {{-- Price Filter --}}
            <div class="filter-box">
                <div class="filter-title">
                    <span>PRICE</span>
                    <i class="fas fa-chevron-up"></i>
                </div>

                <div class="filter-content price-filter">
                    <div class="price-values">
                        <span>৳{{ number_format($minPrice) }}</span>
                        <span>৳{{ number_format($price) }}</span>
                    </div>

                    <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" wire:model.live="price"
                        class="price-slider">
                </div>
            </div>

            {{-- Other Filters --}}
            <div class="filter-box">
                <div class="filter-title">
                    <span>FILTER</span>
                    <i class="fas fa-chevron-up"></i>
                </div>

                <div class="filter-content">
                    <label class="custom-checkbox">
                        <input type="checkbox" wire:model.live="religious">

                        <span class="checkmark"></span>

                        <span class="checkbox-label">
                            Religious Items
                        </span>
                    </label>
                </div>
            </div>

        </div>

        {{-- RIGHT PRODUCT SECTION --}}
        <div class="col-lg-9 col-md-8">

            <div class="row">

                @forelse ($products as $product)
                    <div class="col-lg-3 col-md-6 col-6 p-1">
                        <div class="product-card h-100">

                            {{-- Discount Badge --}}
                            @if ($product->price > 0 && $product->discount_price > 0 && $product->discount_price < $product->price)
                                <div class="discount">
                                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    <br>
                                    ছাড়
                                </div>
                            @endif

                            {{-- Product Image --}}
                            <a href="{{ route('product.details', $product->slug) }}" wire:navigate.hover>
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                    loading="lazy">
                            </a>

                            {{-- Stock Status --}}
                            @if ($product->stock <= 0)
                                <div class="out-of-stock">
                                    <span>Out of Stock</span>
                                </div>
                            @endif

                            {{-- Product Details --}}
                            <div class="product-body">

                                <a href="{{ route('product.details', $product->slug) }}" wire:navigate.hover>
                                    {{ Str::limit($product->name, 25) }}
                                </a>

                                {{-- Rating --}}
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                {{-- Price --}}
                                <div class="price">
                                    @if ($product->price > 0 && $product->discount_price > 0 && $product->discount_price < $product->price)
                                        <del>৳ {{ $product->price }}</del>
                                        <span>৳ {{ $product->discount_price }}</span>
                                    @else
                                        <span>৳ {{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- Order Button --}}
                                <button type="button" wire:click="addToCart({{ $product->id }})"
                                    @if ($product->stock <= 0) disabled @endif>
                                    অর্ডার করুন
                                </button>

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-12">
                        <div class="empty-product">
                            <h5>কোনো Product পাওয়া যায়নি।</h5>

                            <button type="button" wire:click="clearFilters" class="btn btn-sm btn-success mt-2">
                                Clear Filter
                            </button>
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>

    </div>
</div>
