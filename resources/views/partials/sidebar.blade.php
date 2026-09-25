<aside class="sidebar" id="sidebar">
    {{-- Logo --}}
    <div class="logo d-flex align-items-center">
        <div class="logo-icon">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
        </div>
    </div>

    <div class="p-4">
        <ul class="nav flex-column">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" wire:navigate.hover
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            {{-- Orders --}}
            @php
                $ordersActive = request()->routeIs('admin.orders*') || request()->routeIs('admin.payment*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $ordersActive ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="flex-grow-1">
                        Orders
                    </span>
                    <i class="fas fa-chevron-down arrow {{ $ordersActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $ordersActive ? 'open' : '' }}">
                    {{-- All Orders --}}
                    @if (auth()->user()->hasPermission('orders.view'))
                        <li>
                            <a href="{{ route('admin.orders') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>All Orders</span>
                            </a>
                        </li>
                    @endif

                    {{-- Payment --}}
                    @if (auth()->user()->hasPermission('payments.view'))
                        <li>
                            <a href="{{ route('admin.payment') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.payment*') ? 'active' : '' }}">
                                <i class="fas fa-credit-card"></i>
                                <span>Payment</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            {{-- Product --}}
            @php
                $productsActive =
                    request()->routeIs('admin.products*') ||
                    request()->routeIs('admin.categories*') ||
                    request()->routeIs('admin.brands*') ||
                    request()->routeIs('admin.coupon*') ||
                    request()->routeIs('admin.shipping*') ||
                    request()->routeIs('admin.products.color') ||
                    request()->routeIs('admin.products.size');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $productsActive ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span class="flex-grow-1"> Products </span>
                    <i class="fas fa-chevron-down arrow {{ $productsActive ? 'rotate' : '' }}"></i>
                </a>
                <ul class="submenu {{ $productsActive ? 'open' : '' }}">
                    {{-- Products --}}
                    @if (auth()->user()->hasPermission('products.view'))
                        <li>
                            <a href="{{ route('admin.products') }}"
                                class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                                <i class="fas fa-box-open"></i>
                                <span>Products Manage</span>
                            </a>
                        </li>
                    @endif

                    {{-- Categories --}}
                    @if (auth()->user()->hasPermission('categories.view'))
                        <li>
                            <a href="{{ route('admin.categories') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                                <i class="fas fa-layer-group"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                    @endif

                    {{-- Brands --}}
                    @if (auth()->user()->hasPermission('brands.view'))
                        <li>
                            <a href="{{ route('admin.brands') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                                <i class="fas fa-copyright"></i>
                                <span>Brands</span>
                            </a>
                        </li>
                    @endif

                    {{-- Colors --}}
                    @if (auth()->user()->hasPermission('colors.view'))
                        <li>
                            <a href="{{ route('admin.products.color') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.products.color') ? 'active' : '' }}">
                                <i class="fas fa-palette"></i>
                                <span>Colors</span>
                            </a>
                        </li>
                    @endif

                    {{-- Sizes --}}
                    @if (auth()->user()->hasPermission('sizes.view'))
                        <li>
                            <a href="{{ route('admin.products.size') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.products.size') ? 'active' : '' }}">
                                <i class="fas fa-ruler-combined"></i>
                                <span>Sizes</span>
                            </a>
                        </li>
                    @endif

                    {{-- Coupons --}}
                    @if (auth()->user()->hasPermission('coupons.view'))
                        <li>
                            <a href="{{ route('admin.coupon') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.coupon*') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i>
                                <span>Coupons</span>
                            </a>
                        </li>
                    @endif

                    {{-- Shipping --}}
                    @if (auth()->user()->hasPermission('shipping.view'))
                        <li>
                            <a href="{{ route('admin.shipping') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.shipping*') ? 'active' : '' }}">
                                <i class="fas fa-truck"></i>
                                <span>Shipping Charge</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Reviews --}}
            @php
                $reviewsActive = request()->routeIs('admin.reviews*') || request()->routeIs('admin.review*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $reviewsActive ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    <span class="flex-grow-1"> Reviews </span>
                    <i class="fas fa-chevron-down arrow {{ $reviewsActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $reviewsActive ? 'open' : '' }}">

                    {{-- Pending Reviews --}}
                    @if (auth()->user()->hasPermission('reviews.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.reviews.pending') ? 'active' : '' }}">

                                <i class="fas fa-hourglass-half"></i>
                                <span>Pending Reviews</span>
                            </a>
                        </li>
                    @endif

                    {{-- Create Review --}}
                    @if (auth()->user()->hasPermission('reviews.create'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.reviews.create') ? 'active' : '' }}">
                                <i class="fas fa-plus-circle"></i>
                                <span>Create Review</span>
                            </a>
                        </li>
                    @endif

                    {{-- All Reviews --}}
                    @if (auth()->user()->hasPermission('reviews.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                                <i class="fas fa-comments"></i>
                                <span>All Reviews</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Landing Page --}}
            {{-- ========================================================= --}}
            @php
                $landingActive = request()->routeIs('admin.landing*') || request()->routeIs('admin.campaign*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $landingActive ? 'active' : '' }}">
                    <i class="fas fa-window-maximize"></i>
                    <span class="flex-grow-1"> Landing Page </span>
                    <i class="fas fa-chevron-down arrow {{ $landingActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $landingActive ? 'open' : '' }}">
                    {{-- Create --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.landing.create') ? 'active' : '' }}">
                            <i class="fas fa-plus-square"></i>
                            <span>Create</span>
                        </a>
                    </li>

                    {{-- Campaign --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.campaign*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn"></i>
                            <span>Campaign</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- ========================================================= --}}
            {{-- Users --}}
            {{-- ========================================================= --}}
            @php
                $usersActive =
                    request()->routeIs('admin.users*') ||
                    request()->routeIs('users.profile*') ||
                    request()->routeIs('admin.customers.manage') ||
                    request()->routeIs('admin.role-permissions');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $usersActive ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="flex-grow-1"> Users </span>
                    <i class="fas fa-chevron-down arrow {{ $usersActive ? 'rotate' : '' }}"></i>
                </a>
                <ul class="submenu {{ $usersActive ? 'open' : '' }}">
                    {{-- Users --}}
                    @if (auth()->user()->hasPermission('users.view'))
                        <li>
                            <a href="{{ route('admin.users') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @endif

                    {{-- Profile --}}
                    <li>
                        <a href="{{ route('users.profile') }}" wire:navigate.hover
                            class="{{ request()->routeIs('users.profile*') ? 'active' : '' }}">
                            <i class="fas fa-user-circle"></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    {{-- Customers --}}
                    @if (auth()->user()->hasPermission('customers.view'))
                        <li>
                            <a href="{{ route('admin.customers.manage') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.customers.manage') ? 'active' : '' }}">
                                <i class="fas fa-user-friends"></i>
                                <span>Customers</span>
                            </a>
                        </li>
                    @endif

                    {{-- Permissions --}}
                    @if (auth()->user()->hasPermission('permissions.view'))
                        <li>
                            <a href="{{ route('admin.role-permissions') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.role-permissions') ? 'active' : '' }}">
                                <i class="fas fa-key"></i>
                                <span>Permission</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Site Setting --}}
            {{-- ========================================================= --}}
            @php
                $settingsActive =
                    request()->routeIs('admin.settings*') ||
                    request()->routeIs('admin.smpt.server*') ||
                    request()->routeIs('admin.smtp.server*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $settingsActive ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span class="flex-grow-1"> Site Setting </span>
                    <i class="fas fa-chevron-down arrow {{ $settingsActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $settingsActive ? 'open' : '' }}">
                    {{-- General Setting --}}
                    <li>
                        <a href="{{ route('admin.settings') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h"></i>
                            <span>General Setting</span>
                        </a>
                    </li>

                    {{-- Social Media --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.settings.social*') ? 'active' : '' }}">
                            <i class="fas fa-share-alt"></i>
                            <span>Social Media</span>
                        </a>
                    </li>

                    {{-- Contact --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.settings.contact*') ? 'active' : '' }}">
                            <i class="fas fa-address-book"></i>
                            <span>Contact</span>
                        </a>
                    </li>

                    {{-- Create Page --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.settings.pages*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i>
                            <span>Create Page</span>
                        </a>
                    </li>
                </ul>
            </li>


            {{-- API Integration --}}
            @php
                $apiActive =
                    request()->routeIs('admin.courier.setting') ||
                    request()->routeIs('admin.smtp.settings') ||
                    request()->routeIs('admin.gateway*') ||
                    request()->routeIs('admin.sms*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $apiActive ? 'active' : '' }}">
                    <i class="fas fa-plug"></i>
                    <span class="flex-grow-1"> API Integration </span>
                    <i class="fas fa-chevron-down arrow {{ $apiActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $apiActive ? 'open' : '' }}">

                    {{-- Courier API --}}
                    @if (auth()->user()->hasPermission('couriers.view'))
                        <li>
                            <a href="{{ route('admin.courier.setting') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.courier.setting') ? 'active' : '' }}">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Couriers API</span>
                            </a>
                        </li>
                    @endif

                    {{-- Mail SMTP --}}
                    @if (auth()->user()->hasPermission('smtp.view'))
                        <li>
                            <a href="{{ route('admin.smtp.settings') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.smtp.settings') ? 'active' : '' }}">
                                <i class="fas fa-envelope"></i>
                                <span>Mail SMTP</span>
                            </a>
                        </li>
                    @endif

                    {{-- Payment Gateway --}}
                    @if (auth()->user()->hasPermission('payments_gateway.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.gateway*') ? 'active' : '' }}">
                                <i class="fas fa-credit-card"></i>
                                <span>Payment Gateway</span>
                            </a>
                        </li>
                    @endif

                    {{-- SMS Gateway --}}
                    @if (auth()->user()->hasPermission('sms_gateway.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.sms*') ? 'active' : '' }}">
                                <i class="fas fa-sms"></i>
                                <span>SMS Gateway</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Banner & Ads --}}
            @php
                $bannerActive = request()->routeIs('admin.banner.categories') || request()->routeIs('admin.banner');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $bannerActive ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span class="flex-grow-1"> Banner & Ads </span>
                    <i class="fas fa-chevron-down arrow {{ $bannerActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $bannerActive ? 'open' : '' }}">
                    {{-- Banner Categories --}}
                    @if (auth()->user()->hasPermission('banners_categories.view'))
                        <li>
                            <a href="{{ route('admin.banner.categories') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.banner.categories') ? 'active' : '' }}">
                                <i class="fas fa-folder"></i>
                                <span>Banner Categories</span>
                            </a>
                        </li>
                    @endif

                    {{-- Banners & Ads --}}
                    @if (auth()->user()->hasPermission('banners.view'))
                        <li>
                            <a href="{{ route('admin.banner') }}" wire:navigate.hover
                                class="{{ request()->routeIs('admin.banner') ? 'active' : '' }}">
                                <i class="fas fa-ad"></i>
                                <span>Banners & Ads</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>


            {{-- Reports --}}
            @php
                $reportsActive =
                    request()->routeIs('admin.reports*') ||
                    request()->routeIs('admin.stocks_report*') ||
                    request()->routeIs('admin.sales_report*') ||
                    request()->routeIs('admin.orders_report*') ||
                    request()->routeIs('admin.ip*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $reportsActive ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span class="flex-grow-1"> Reports </span>
                    <i class="fas fa-chevron-down arrow {{ $reportsActive ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ $reportsActive ? 'open' : '' }}">
                    {{-- Stock Report --}}
                    @if (auth()->user()->hasPermission('stocks_report.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.stocks_report*') ? 'active' : '' }}">
                                <i class="fas fa-boxes"></i>
                                <span>Stock Report</span>
                            </a>
                        </li>
                    @endif

                    {{-- Sales Report --}}
                    @if (auth()->user()->hasPermission('sales_report.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.sales_report*') ? 'active' : '' }}">
                                <i class="fas fa-chart-line"></i>
                                <span>Sales Report</span>
                            </a>
                        </li>
                    @endif

                    {{-- Order Report --}}
                    @if (auth()->user()->hasPermission('orders_report.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.orders_report*') ? 'active' : '' }}">
                                <i class="fas fa-file-invoice"></i>
                                <span>Order Report</span>
                            </a>
                        </li>
                    @endif


                    {{-- IP --}}
                    @if (auth()->user()->hasPermission('ip.view'))
                        <li>
                            <a href="#" wire:navigate.hover
                                class="{{ request()->routeIs('admin.ip*') ? 'active' : '' }}">
                                <i class="fas fa-globe"></i>
                                <span>IP</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Media --}}
            @php
                $mediaActive = request()->routeIs('admin.media*');
            @endphp

            @if (auth()->user()->hasPermission('media.view'))
                <li class="nav-item">
                    <a href="{{ route('admin.media') }}" wire:navigate.hover
                        class="nav-link {{ $mediaActive ? 'active' : '' }}">
                        <i class="fas fa-photo-video"></i>
                        <span>Media</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
