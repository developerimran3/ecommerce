<section class="features p-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <div class="feature-box">
                    <i class="fas fa-truck"></i>
                    <h6>Free Delivery</h6>
                    <p>On orders over ৳999</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="feature-box">
                    <i class="fas fa-sync-alt"></i>
                    <h6>Easy Return</h6>
                    <p>7 Days Return Policy</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="feature-box">
                    <i class="fas fa-credit-card"></i>
                    <h6>Secure Payment</h6>
                    <p>100% Secure Payment</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="feature-box">
                    <i class="fas fa-headset"></i>
                    <h6>24/7 Support</h6>
                    <p>Always Ready</p>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- ==========================
    FOOTER
    ========================== -->
<footer>

    <div class="container">

        <div class="row">

            <div class="col-md-3">

                <img src="images/logo.png" height="55">

                <p class="mt-3">
                    8050 Goshairhat, Dhaka
                </p>

                <h6>+8801XXXXXXXXX</h6>

            </div>

            <div class="col-md-3">

                <h5>Useful Links</h5>

                <ul>

                    <li><a href="#">Contact</a></li>

                    <li><a href="#">Order Procedure</a></li>

                    <li><a href="#">Privacy Policy</a></li>

                    <li><a href="#">Return Policy</a></li>

                </ul>

            </div>

            <div class="col-md-3">

                <h5>Customer Care</h5>

                <ul>

                    <li><a href="#">My Account</a></li>

                    <li><a href="#">Wishlist</a></li>

                    <li><a href="#">Track Order</a></li>

                    <li><a href="#">Support</a></li>

                </ul>

            </div>

            <div class="col-md-3">

                <h5>Download App</h5>

                <img src="images/google-play.png" width="160">

            </div>

        </div>

    </div>

</footer>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav">

    <a href="#" class="bottom-nav-item">
        <i class="fas fa-bars"></i>
        <span>Category</span>
    </a>

    <a href="#" class="bottom-nav-item">
        <i class="fab fa-whatsapp"></i>
        <span>Message</span>
    </a>

    <a href="{{ url('/') }}" class="bottom-nav-home">
        <div class="home-circle">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </div>
    </a>

    <a href="{{ route('checkout') }}" class="bottom-nav-item cart-nav">
        <i class="fas fa-shopping-cart"></i>

        <span>
            Cart
            <small>(0)</small>
        </span>
    </a>

    @if (Auth::check())
        @if (Auth::user()->role == 'Customer')
            <a href="{{ route('account') }}" wire:navigate class="bottom-nav-item">
                <i class="fas fa-user"></i>
                {{ ucwords(Str::limit(Auth::user()->name, 8)) }}
            </a>
        @else
            <a href="{{ route('users.profile') }}" class="bottom-nav-item">
                <i class="fas fa-user"></i>
                {{ Str::limit(Auth::user()->name, 8) }}
            </a>
        @endif
    @else
        <a href="{{ route('customer.login') }}" wire:navigate class="bottom-nav-item">
            <i class="fas fa-user"></i>
            Login / Sign Up
        </a>
    @endif

</div>
