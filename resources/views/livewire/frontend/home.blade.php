<div>

    {{-- =========================================================
        HERO SECTION
    ========================================================== --}}

    <section class="hero">

        <div class="container">

            <div class="row">

                {{-- Sidebar --}}
                <div class="col-lg-3">

                    <div class="category-menu">
                        <ul>

                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('category.products', ['slug' => $category->slug]) }}">

                                        {{-- Category Image --}}
                                        <span class="category-menu-img">
                                            @if ($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    alt="{{ $category->name }}">
                                            @else
                                                <i class="fa fa-image"></i>
                                            @endif
                                        </span>

                                        {{-- Category Name --}}
                                        <span class="category-menu-name">
                                            {{ $category->name }}
                                        </span>

                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>


                {{-- Slider --}}
                <div class="col-lg-9">

                    <div id="slider" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">

                            <div class="carousel-item active">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png"
                                    class="d-block w-100" alt="Banner">

                            </div>

                            <div class="carousel-item">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500185%20(3).png"
                                    class="d-block w-100" alt="Banner">

                            </div>

                            <div class="carousel-item">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png"
                                    class="d-block w-100" alt="Banner">

                            </div>

                        </div>


                        <a class="carousel-control-prev" href="#slider" data-slide="prev">

                            <span class="carousel-control-prev-icon"></span>

                        </a>


                        <a class="carousel-control-next" href="#slider" data-slide="next">

                            <span class="carousel-control-next-icon"></span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
        PROMO BANNER
    ========================================================== --}}
    <section class="promo py-3">

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-4 col-12 mb-3">

                    <a href="#">

                        <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500185%20(3).png"
                            class="img-fluid w-100" alt="Promo">

                    </a>

                </div>


                <div class="col-lg-4 col-md-4 col-12 mb-3">

                    <a href="#">

                        <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png"
                            class="img-fluid w-100" alt="Promo">

                    </a>

                </div>


                <div class="col-lg-4 col-md-4 col-12 mb-3">

                    <a href="#">

                        <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png"
                            class="img-fluid w-100" alt="Promo">

                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
        CATEGORY SLIDER
        এখানে ALL ACTIVE CATEGORY আসবে
    ========================================================== --}}
    <section class="category-section py-4">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title mb-0"> Categories </h5>
            </div>

            <div class="category-slider" id="categorySlider">
                @forelse ($categories as $category)
                    <div class="category-slide">
                        <a href="{{ route('category.products', ['slug' => $category->slug]) }}" wire:navigate.hover>
                            <div class="category-card">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                @else
                                    <div class="category-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif

                                <span>
                                    {{ $category->name }}
                                </span>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">

                        <p class="text-center text-muted">
                            No Category Found
                        </p>

                    </div>
                @endforelse

            </div>

        </div>

    </section>



    {{-- =========================================================
        HOT DEALS
    ========================================================== --}}

    <section class="products py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0"> Hot Deal </h4>
                <a href="#" class="btn btn-success btn-sm"> View More </a>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-2-5 col-md-3 col-sm-4 col-6 p-1">
                        <div class="product-card">
                            {{-- Hot Deal Badge --}}
                            @if ($product->price > 0 && $product->discount_price > 0 && $product->discount_price < $product->price)
                                <div class="discount">
                                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    <br> ছাড়
                                </div>
                            @endif

                            {{-- Product Image --}}
                            <a href="{{ route('product.details', $product->slug) }}" wire:navigate.hover>
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                    loading="lazy">
                            </a>

                            {{-- Product Body --}}
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

                                    @if ($product->discount_price > 0 && $product->discount_price < $product->price)
                                        <del> ৳ {{ number_format($product->price, 2) }} </del>
                                        <span> ৳ {{ number_format($product->discount_price, 2) }} </span>
                                    @else
                                        <span> ৳ {{ number_format($product->price, 2) }} </span>
                                    @endif
                                </div>

                                {{-- Order --}}
                                <button type="button" wire:click="addToCart({{ $product->id }})">
                                    অর্ডার করুন </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- IMPORTANT:
        শুধু fontview = 1 category এখানে আসবে --}}
    @foreach ($frontCategory as $category)
        <section class="products category-products py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="section-title mb-0">
                        {{ $category->name }}
                    </h4>
                    <a href="{{ route('category.products', ['slug' => $category->slug]) }}" wire:navigate.hover
                        class="btn btn-success btn-sm"> View More </a>
                </div>

                <div class="row">
                    @foreach ($category->products->take(10) as $product)
                        <div class="col-lg-2-5 col-md-3 col-sm-4 col-6 p-1">
                            <div class="product-card">
                                @if ($product->price > 0 && $product->discount_price > 0 && $product->discount_price < $product->price)
                                    <div class="discount">
                                        {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                        <br>
                                        ছাড়
                                    </div>
                                @endif

                                <a href="{{ route('product.details', $product->slug) }}" wire:navigate.hover>
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        alt="{{ $product->name }}" loading="lazy">
                                </a>

                                <div class="product-body">
                                    <a href="{{ route('product.details', $product->slug) }}" wire:navigate.hover>
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
                                        @if ($product->discount_price > 0 && $product->discount_price < $product->price)
                                            <del>
                                                ৳ {{ number_format($product->price, 2) }}
                                            </del>

                                            <span>
                                                ৳ {{ number_format($product->discount_price, 2) }}
                                            </span>
                                        @else
                                            <span>
                                                ৳ {{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <button type="button" wire:click="addToCart({{ $product->id }})">
                                        অর্ডার করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
</div>
