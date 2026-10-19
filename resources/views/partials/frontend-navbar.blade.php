<header id="navbar_top">
    <div class="mobile-header sticky">
        <div class="mobile-logo">
            <div class="menu-bar">
                <a class="toggle">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
            <div class="menu-logo">
                <a href="{{ route('home') }}" wire:navigate>

                    <img src="{{ !empty($setting?->white_logo) ? asset('storage/' . $setting->white_logo) : asset('assets/img/logo.png') }}"
                        alt="Logo">
                </a>
            </div>
            <div class="menu-bag">
                <p class="margin-shopping">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="mobilecart-qty">0</span>
                </p>
            </div>
        </div>
    </div>

    <div class="mobile-search">
        <form action="" wire:submit.prevent="search">
            <input type="text" placeholder="Search Product ... " value="" class="msearch_keyword msearch_click"
                name="keyword">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-search">
                </svg>
            </button>
        </form>
        <div class="search_result"></div>
    </div>

    <div class="main-header">
        <!-- header to end -->
        <div class="logo-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo-header">
                            <div class="main-logo">
                                <a href="{{ route('home') }}" wire:navigate>
                                    <img src="{{ !empty($setting?->white_logo) ? asset('storage/' . $setting->white_logo) : asset('assets/img/logo.png') }}"
                                        alt="Logo">
                                </a>
                            </div>
                            <div class="main-search">
                                <form action="#">
                                    <input type="text" placeholder="Search Product..."
                                        class="search_keyword search_click" name="keyword">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </form>
                                <div class="search_result"></div>
                            </div>
                            <div class="header-list-items">
                                <ul>
                                    <li class="track_btn">
                                        <a href="{{ route('order.track') }}" wire:navigate> <i
                                                class="fa fa-truck"></i>Track Order</a>
                                    </li>
                                    <li class="cart-dialog" id="cart-qty">
                                        <livewire:frontend.cart-count />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="catagory_menu">
                            <div class="mobile-menu">
                                <ul class="heder__category">
                                    <div>
                                        <li class="all__category__list">
                                            <a href="#">ALL CATEGORIES <i class="fa-solid fa-list"></i>
                                            </a>
                                            <div></div>
                                        </li>
                                    </div>


                                    <div>
                                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                                    </div>
                                    <div>
                                        <li><a href="{{ route('hot.dales.products') }}" wire:navigate>Offers</a></li>
                                    </div>

                                    <div class="contact__menu">
                                        <li><a href="#" wire:navigate>Contact</a></li>
                                    </div>
                                    <div class="right__menu__top">
                                        <li class="for_order">
                                            @if (Auth::check())
                                                @if (Auth::user()->role == 'Customer')
                                                    <a href="{{ route('account') }}" wire:navigate>
                                                        <i class="fa-regular fa-user"></i>
                                                        {{ ucwords(Str::limit(Auth::user()->name, 10)) }}
                                                    </a>
                                                @else
                                                    <a href="{{ route('users.profile') }}">
                                                        <i class="fa-regular fa-user"></i>
                                                        {{ Str::limit(Auth::user()->name, 10) }}
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('customer.login') }}" wire:navigate>
                                                    <i class="fa-regular fa-user"></i>
                                                    Login / Sign Up
                                                </a>
                                            @endif
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-header end -->
</header>
<script>
    $(document).ready(function() {

        $('.toggle').click(function() {
            $('.mobile-menu').toggleClass('active');
        });
    });
</script>
