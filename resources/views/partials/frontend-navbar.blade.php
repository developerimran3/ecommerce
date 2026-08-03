{{-- <div class="sticky-header">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <img src="{{ asset('assets/img/logo.webp') }}" class="logo" alt="Logo">
                </div>
                <div class="col-lg-7">
                    <div class="search-box">
                        <input type="text" placeholder="Search Product...">
                        <button>
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header-right">
                        <a href="#">
                            <i class="fa fa-truck"></i> Track Order
                        </a>
                        <livewire:frontend.cart-count />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg main-nav">
        <div class="container">
            <button class="navbar-toggler bg-white" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="#" class="nav-link"> ALL CATEGORIES <i class="fa-solid fa-list"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" wire:navigate class="nav-link"> Home </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> Offers </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link"> Contact </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-user"></i>
                            Login / Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div> --}}

<header id="navbar_top">
    <div class="mobile-header sticky">
        <div class="mobile-logo">
            <div class="menu-bar">
                <a class="toggle">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
            <div class="menu-logo">
                <a href="{{ route('home') }}" wire:navigate><img src="{{ asset('assets/img/logo.webp') }}"
                        alt=""></a>
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
                                <a href="{{ route('home') }}" wire:navigate><img
                                        src="{{ asset('assets/img/logo.webp') }}" alt=""></a>
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
                                        <li><a href="#" wire:navigate>Offers</a></li>
                                    </div>

                                    <div class="contact__menu">
                                        <li><a href="#" wire:navigate>Contact</a></li>
                                    </div>
                                    <div class="right__menu__top">
                                        <li class="for_order">
                                            <p>
                                                <a href="" wire:navigate>
                                                    <i class="fa-regular fa-user"></i>
                                                    Login / Sign Up
                                                </a>
                                            </p>
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
