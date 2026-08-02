<div>

    <!--=========================
    HERO
    ==========================-->
    <section class="hero">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="category-menu">
                        <ul>

                            <li>👩 নারী ও মেয়েদের ফ্যাশন</li>

                            <li>👨 পুরুষ ফ্যাশন</li>

                            <li>👶 বেবি</li>

                            <li>🛏 হোম ডেকোর</li>

                            <li>🍔 ফুড</li>

                            <li>🧴 কসমেটিকস</li>

                            <li>💊 স্বাস্থ্য</li>

                            <li>🎁 গিফট</li>

                            <li>📱 ইলেকট্রনিক্স</li>

                            <li>🏠 হোম অ্যাপ্লায়েন্স</li>

                        </ul>

                    </div>

                </div>

                <!-- Slider -->

                <div class="col-lg-9">

                    <div id="slider" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">

                            <div class="carousel-item active">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png">

                            </div>

                            <div class="carousel-item">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500185%20(3).png">

                            </div>

                            <div class="carousel-item">

                                <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png">

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

    <!--=========================
    PROMO
    ==========================-->

    <section class="promo">

        <div class="container">

            <div class="row">

                <div class="col-lg-4">

                    <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500185%20(3).png">

                </div>

                <div class="col-lg-4">

                    <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png">

                </div>

                <div class="col-lg-4">

                    <img src="https://v3.nexlifyo.com/public/uploads/banner/17507500035%20(2).png">

                </div>

            </div>

        </div>

    </section>
    <!--=========================
    CATEGORIES
    ==========================-->

    <section class="category-section py-4">

        <div class="container">

            <h5 class="section-title mb-3">
                Categories
            </h5>

            <div class="row">

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img
                            src="https://v3.nexlifyo.com/public/uploads/product/1750753430-photo_2025-06-24_14-22-07.jpg">
                        <span>নারী ফ্যাশন</span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img src="images/c2.png">
                        <span>বেডশীট</span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img src="images/c3.png">
                        <span>কুশন</span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img src="images/c4.png">
                        <span>ফুড</span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img src="images/c5.png">
                        <span>স্বাস্থ্য</span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-3">
                    <div class="category-card">
                        <img src="images/c6.png">
                        <span>হোম ডেকোর</span>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!--=========================
    HOT DEAL
    ==========================-->

    <section class="products">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Hot Deal</h4>
                <a href="#" class="btn btn-success btn-sm">
                    View More
                </a>
            </div>

            <div class="row">

                <!-- PRODUCT -->
                @foreach ($products as $product)
                    <div class="col-lg-2-5 p-1">
                        <div class="product-card">
                            <div class="discount">
                                {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                <br>
                                ছাড়
                            </div>

                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">

                            <div class="product-body">

                                <a href="{{ route('product.details', $product->slug) }}">
                                    {{ Str::limit($product->name, 28) }}

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
                @endforeach
            </div>
        </div>
    </section>

</div>
