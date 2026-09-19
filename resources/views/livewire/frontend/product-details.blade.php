  <div class="container mt-4">
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

              <div wire:ignore>
                  <div class="details_slider owl-carousel">
                      @foreach ($product->images as $image)
                          <div class="item">
                              <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid"
                                  alt="{{ $product->name }}">
                          </div>
                      @endforeach
                  </div>

                  {{-- Thumbnails --}}
                  <div class="indicator_thumb d-flex flex-wrap mt-2">
                      @foreach ($product->images as $key => $image)
                          <div class="indicator-item mr-2 mb-2" data-id="{{ $key }}">
                              <img src="{{ asset('storage/' . $image->image) }}"
                                  style="width:75px; height:75px; object-fit:cover; cursor:pointer;"
                                  alt="{{ $product->name }}">
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>

          <div class="col-sm-6">
              <div class="details_right">
                  <div class="breadcrumb">
                      <ul>
                          <li><a href="/">Home</a></li>
                          <li><span>/</span></li>
                          <li><a href="{{ route('category.products', $product->category->slug) }}">
                                  {{ $product->category->name }}
                              </a>
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
                          <div class="pro_brand">
                              <p><b>Category :</b> {{ $product->category->name }}</p>
                          </div>
                          <div class="pro_brand">
                              <p><b>Brand :</b> {{ $product->brand?->name }}</p>
                          </div>
                          <br>

                          @if ($product->colors && $product->colors->count() > 0)
                              <div class="product-option-color">
                                  <div class="product-option-title">
                                      <b>Color নির্বাচন করুন</b>
                                  </div>

                                  <div class="product-color-list">
                                      @foreach ($product->colors as $color)
                                          <div class="product-color-item">
                                              <input type="radio" id="product_color_{{ $color->id }}"
                                                  name="product_color" value="{{ $color->id }}"
                                                  class="product-color-radio" wire:model="selectedColor">

                                              <label for="product_color_{{ $color->id }}"
                                                  class="product-color-label" title="{{ $color->name }}">
                                                  <span class="product-color-circle"
                                                      style="background-color: {{ $color->color_code ?? '#000000' }};"></span>
                                                  <span class="product-color-name">
                                                      {{ $color->name }}
                                                  </span>
                                              </label>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          @endif

                          @if ($product->sizes && $product->sizes->count() > 0)
                              <div class="product-option-size">
                                  <div class="product-option-title">
                                      <b>Size নির্বাচন করুন</b>
                                  </div>

                                  <div class="product-size-list">
                                      @foreach ($product->sizes as $size)
                                          <div class="product-size-item">

                                              <input type="radio" id="product_size_{{ $size->id }}"
                                                  name="product_size" value="{{ $size->id }}"
                                                  class="product-size-radio" wire:model="selectedSize">

                                              <label for="product_size_{{ $size->id }}" class="product-size-label">
                                                  {{ $size->name }}
                                              </label>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          @endif
                          @if ($product->stock <= 0)
                              <div class="out-of-stock-signal">
                                  <span>Out of Stock</span>
                              </div>
                          @endif
                          <div class="row">
                              <div class="qty-cart col-sm-12">
                                  <div class="quantity">
                                      <span class="minus" wire:click="decreaseQty"> - </span>
                                      <input type="text" wire:model="qty" readonly>
                                      <span class="plus" wire:click="increaseQty"> + </span>
                                  </div>
                              </div>

                              <div class="d-flex single_product col-sm-12">
                                  <button type="button" wire:click="addToCart" class="btn px-4 add_cart_btn"> কার্টে
                                      যোগ করুন
                                  </button>

                                  <button type="button" wire:click="orderNow" class="btn px-4 order_now_btn"> অর্ডার
                                      করুন
                                  </button>
                              </div>
                          </div>
                          <div class="mt-md-2 mt-2">
                              <h4 class="font-weight-bold">
                                  <a class="btn btn-success w-100 call_now_btn" href="tel: +8801756041512">
                                      <i class="fa fa-phone-square"></i>
                                      +8801756041512
                                  </a>
                              </h4>
                          </div>
                          <div class="mt-md-2 mt-2">
                              <h4 class="font-weight-bold">
                                  <a href="https://wa.me/+8801756041512?text={{ urlencode($product->name) }}"
                                      target="_blank" class="btn btn-success w-100">
                                      <i class="fab fa-whatsapp"></i>
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
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  @push('scripts')
      <script>
          function initProductGallery() {

              let $slider = $('.details_slider');

              if (!$slider.length) {
                  return;
              }

              // Already initialized হলে destroy
              if ($slider.hasClass('owl-loaded')) {
                  $slider.trigger('destroy.owl.carousel');
                  $slider.removeClass('owl-loaded');
                  $slider.find('.owl-stage-outer').children().unwrap();
              }

              $slider.owlCarousel({
                  items: 1,
                  loop: true,
                  margin: 10,
                  nav: true,
                  dots: false,
                  autoplay: false,
                  smartSpeed: 500
              });

              // Thumbnail click
              $('.indicator-item').off('click').on('click', function() {

                  let index = $(this).data('id');

                  $slider.trigger('to.owl.carousel', [index, 500]);

              });
          }


          document.addEventListener('DOMContentLoaded', function() {
              initProductGallery();
          });


          document.addEventListener('livewire:navigated', function() {
              initProductGallery();
          });
      </script>
  @endpush
