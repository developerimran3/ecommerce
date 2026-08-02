<div class="homeproduct main-details-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <section class="product-section">
                    <div class="container">
                        <div class="row">


                            <div class="col-sm-6 position-relative">

                                {{-- Discount Badge --}}
                                @if ($product->price > $product->final_price)
                                    <div class="product-details-discount-badge">
                                        <div class="sale-badge">
                                            <div class="sale-badge-inner">
                                                <div class="sale-badge-box">
                                                    <span class="sale-badge-text">
                                                        {{ round((($product->price - $product->final_price) / $product->price) * 100) }}%
                                                        <br>
                                                        ছাড়
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Main Gallery (Big Image) --}}
                                <div class="details_slider owl-carousel">
                                    @foreach ($product->images as $image)
                                        <div class="item">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid"
                                                alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Thumbnails --}}
                                <div class="indicator_thumb d-flex flex-wrap">
                                    @foreach ($product->images as $key => $image)
                                        <div class="indicator-item" data-id="{{ $key }}">
                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                style="width: 75px; height: 75px; object-fit: cover; cursor: pointer;">
                                        </div>
                                    @endforeach
                                </div>

                            </div>


                            <div class="col-sm-6">
                                <div class="details_right">
                                    <div class="breadcrumb">
                                        <ul>
                                            <li><a href="/">Home</a></li>
                                            <li><span>/</span></li>
                                            <li><a href="">ক্যানভাস</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product">
                                        <div class="product-cart">
                                            <p class="name">{{ $product->name }}</p>
                                            <p class="details-price">
                                                <del>৳ {{ $product->price }}</del>
                                                ৳ {{ $product->final_price }}
                                            </p>
                                            <div class="details-ratting-wrapper">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>

                                                <span>0.00/5</span>
                                                <a class="all-reviews-button" href="#writeReview">See Reviews</a>
                                            </div>
                                            <div class="product-code">
                                                <p><span>প্রোডাক্ট কোড : </span> {{ $product->sku }}</p>
                                            </div>
                                            <form action="https://v3.nexlifyo.com/cart/store" method="POST"
                                                name="formName">
                                                <input type="hidden" name="_token"
                                                    value="2iJULWIcuSvQdkktx3dBNuIkKoHzY4DvJYEzOF1Y"> <input
                                                    type="hidden" name="id" value="38">
                                                <div class="pro-size" style="width: 100%;">
                                                    <div class="size_inner">
                                                        <p>Size - <span class="attibute-name"></span></p>
                                                        <div class="size-container">
                                                            <div class="selector">
                                                                <div class="selector-item">
                                                                    <input type="radio" id="f-option40" value="XL"
                                                                        name="product_size"
                                                                        class="selector-item_radio emptyalert"
                                                                        required="">
                                                                    <label for="f-option40"
                                                                        class="selector-item_label">XL</label>
                                                                </div>
                                                                <div class="selector-item">
                                                                    <input type="radio" id="f-option41" value="L"
                                                                        name="product_size"
                                                                        class="selector-item_radio emptyalert"
                                                                        required="">
                                                                    <label for="f-option41"
                                                                        class="selector-item_label">L</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pro_brand">
                                                    <p>Category :
                                                        {{ $product->category->name }}
                                                    </p>
                                                </div>
                                                <div class="pro_brand">
                                                    <p>Brand :
                                                        {{ $product->brand->name }}
                                                    </p>
                                                </div>

                                                <div class="row">
                                                    <div class="qty-cart col-sm-12">
                                                        <div class="quantity">
                                                            <span class="minus">-</span>
                                                            <input type="text" name="qty" value="1">
                                                            <span class="plus">+</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex single_product col-sm-12">
                                                        <input type="submit" class="btn px-4 add_cart_btn"
                                                            onclick="return sendSuccess();" name="add_cart"
                                                            value="কার্টে যোগ করুন">

                                                        <input type="submit"
                                                            class="btn px-4 order_now_btn order_now_btn_m"
                                                            onclick="return sendSuccess();" name="order_now"
                                                            value="অর্ডার করুন">
                                                    </div>
                                                </div>
                                                <div class="mt-md-2 mt-2">
                                                    <h4 class="font-weight-bold">
                                                        <a class="btn btn-success w-100 call_now_btn"
                                                            href="tel: +8809638365975">
                                                            <i class="fa fa-phone-square"></i>
                                                            +8809638365975
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="mt-md-2 mt-2">
                                                    <h4 class="font-weight-bold">
                                                        <a class="btn btn-success w-100 call_now_btn" href="#"
                                                            target="_blank">
                                                            <i class="fa fa-whatsapp"></i>
                                                            এই পণ্যটি সম্পর্কে জিজ্ঞাসা করুন
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div class="mt-md-2 mt-2">
                                                    <div class="del_charge_area">
                                                        <div class="alert alert-info text-xs">
                                                            <div class="flext_area">
                                                                <i class="fa-solid fa-cubes"></i>
                                                                <div>

                                                                    <span>সারা বাংলাদেশ ১৫০ টাকা ডেলিভারি চার্জ
                                                                        <br></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
