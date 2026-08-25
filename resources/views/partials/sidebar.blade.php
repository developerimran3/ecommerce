<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="logo d-flex align-items-center">
        <div class="logo-icon">
            <img src="{{ asset('assets/img/dashboard-logo.jpg') }}" alt="">
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
                $ordersActive = request()->routeIs('admin.orders*');
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
                    <li>
                        <a href="{{ route('admin.orders') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">

                            <i class="fas fa-list"></i>
                            <span>All Orders</span>

                        </a>
                    </li>

                    {{-- Pending Orders --}}
                    <li>
                        <a href="{{ route('admin.orders.pending') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}">

                            <i class="fas fa-clock"></i>
                            <span>Pending Orders</span>

                        </a>
                    </li>

                    {{-- Completed Orders --}}
                    <li>
                        <a href="{{ route('admin.orders.completed') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.completed') ? 'active' : '' }}">

                            <i class="fas fa-check-circle"></i>
                            <span>Completed Orders</span>

                        </a>
                    </li>

                    {{-- Cancelled Orders --}}
                    <li>
                        <a href="{{ route('admin.orders.cancelled') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.cancelled') ? 'active' : '' }}">

                            <i class="fas fa-times-circle"></i>
                            <span>Cancelled Orders</span>

                        </a>
                    </li>

                </ul>
            </li>
            {{-- Product --}}
            @php
                $productsActive =
                    request()->routeIs('admin.products*') ||
                    request()->routeIs('admin.categories*') ||
                    request()->routeIs('admin.brands*') ||
                    request()->routeIs('admin.colors*') ||
                    request()->routeIs('admin.coupon*') ||
                    request()->routeIs('admin.sizes*');
            @endphp

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $productsActive ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span class="flex-grow-1"> Products </span>
                    <i class="fas fa-chevron-down arrow {{ $productsActive ? 'rotate' : '' }}"></i>
                </a>
                <ul class="submenu {{ $productsActive ? 'open' : '' }}">
                    {{-- Products --}}
                    <li>
                        <a href="{{ route('admin.products') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                            <i class="fas fa-box-open"></i>
                            <span>Products Manage</span>
                        </a>
                    </li>

                    {{-- Categories --}}
                    <li>
                        <a href="{{ route('admin.categories') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    {{-- Brands --}}
                    <li>
                        <a href="{{ route('admin.brands') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                            <i class="fas fa-copyright"></i>
                            <span>Brands</span>
                        </a>
                    </li>

                    {{-- Colors --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.colors*') ? 'active' : '' }}">
                            <i class="fas fa-palette"></i>
                            <span>Colors</span>
                        </a>
                    </li>
                    {{-- Sizes --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.sizes*') ? 'active' : '' }}">
                            <i class="fas fa-ruler-combined"></i>
                            <span>Sizes</span>
                        </a>
                    </li>

                    {{-- Coupons --}}
                    <li>
                        <a href="{{ route('admin.coupon') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.coupon*') ? 'active' : '' }}">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Coupons</span>

                        </a>
                    </li>

                </ul>
            </li>

            {{-- Reviews --}}
            @php
                $reviewsActive = request()->routeIs('admin.reviews*') || request()->routeIs('admin.review*');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $reviewsActive ? 'active' : '' }}">

                    <i class="fas fa-star"></i>

                    <span class="flex-grow-1">
                        Reviews
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $reviewsActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $reviewsActive ? 'open' : '' }}">

                    {{-- Pending Reviews --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reviews.pending') ? 'active' : '' }}">

                            <i class="fas fa-hourglass-half"></i>
                            <span>Pending Reviews</span>

                        </a>
                    </li>

                    {{-- Create Review --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reviews.create') ? 'active' : '' }}">

                            <i class="fas fa-plus-circle"></i>
                            <span>Create Review</span>

                        </a>
                    </li>

                    {{-- All Reviews --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}">

                            <i class="fas fa-comments"></i>
                            <span>All Reviews</span>

                        </a>
                    </li>

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

                    <span class="flex-grow-1">
                        Landing Page
                    </span>

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
                    request()->routeIs('admin.roles*') ||
                    request()->routeIs('admin.customers.manage') ||
                    request()->routeIs('users.profile*') ||
                    request()->routeIs('admin.role-permissions');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $usersActive ? 'active' : '' }}">

                    <i class="fas fa-users"></i>

                    <span class="flex-grow-1">
                        Users
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $usersActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $usersActive ? 'open' : '' }}">

                    {{-- Users --}}
                    <li>
                        <a href="{{ route('admin.users') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">

                            <i class="fas fa-user"></i>
                            <span>User</span>

                        </a>
                    </li>

                    {{-- Roles --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.roles*') ? 'active' : '' }}">

                            <i class="fas fa-user-tag"></i>
                            <span>Role</span>

                        </a>
                    </li>



                    {{-- Customers --}}
                    <li>
                        <a href="{{ route('admin.customers.manage') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.customers.manage') ? 'active' : '' }}">

                            <i class="fas fa-user-friends"></i>
                            <span>Customers</span>

                        </a>
                    </li>

                    {{-- Profile --}}
                    <li>
                        <a href="{{ route('users.profile') }}" wire:navigate.hover
                            class="{{ request()->routeIs('users.profile*') ? 'active' : '' }}">

                            <i class="fas fa-user-circle"></i>
                            <span>Profile</span>

                        </a>
                    </li>

                    {{-- Permissions --}}
                    <li>
                        <a href="{{ route('admin.role-permissions') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.role-permissions') ? 'active' : '' }}">

                            <i class="fas fa-key"></i>
                            <span>Permission</span>

                        </a>
                    </li>

                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Site Setting --}}
            {{-- ========================================================= --}}
            @php
                $settingsActive =
                    request()->routeIs('admin.settings*') ||
                    request()->routeIs('admin.shipping*') ||
                    request()->routeIs('admin.payment*') ||
                    request()->routeIs('admin.smpt.server*') ||
                    request()->routeIs('admin.smtp.server*');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $settingsActive ? 'active' : '' }}">

                    <i class="fas fa-cog"></i>

                    <span class="flex-grow-1">
                        Site Setting
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $settingsActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $settingsActive ? 'open' : '' }}">

                    {{-- General Setting --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.settings.general*') ? 'active' : '' }}">

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

                    {{-- Shipping --}}
                    <li>
                        <a href="{{ route('admin.shipping') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.shipping*') ? 'active' : '' }}">

                            <i class="fas fa-truck"></i>
                            <span>Shipping Charge</span>

                        </a>
                    </li>

                    {{-- Payment --}}
                    <li>
                        <a href="{{ route('admin.payment') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.payment*') ? 'active' : '' }}">

                            <i class="fas fa-credit-card"></i>
                            <span>Payment</span>

                        </a>
                    </li>

                    {{-- SMTP --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.smtp.server*') ? 'active' : '' }}">

                            <i class="fas fa-envelope"></i>
                            <span>SMTP Setup</span>

                        </a>
                    </li>

                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- API Integration --}}
            {{-- ========================================================= --}}
            @php
                $apiActive =
                    request()->routeIs('admin.api*') ||
                    request()->routeIs('admin.courier*') ||
                    request()->routeIs('admin.smtp*') ||
                    request()->routeIs('admin.gateway*') ||
                    request()->routeIs('admin.sms*');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $apiActive ? 'active' : '' }}">

                    <i class="fas fa-plug"></i>

                    <span class="flex-grow-1">
                        API Integration
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $apiActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $apiActive ? 'open' : '' }}">

                    {{-- Courier API --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.courier*') ? 'active' : '' }}">

                            <i class="fas fa-shipping-fast"></i>
                            <span>Couriers API</span>

                        </a>
                    </li>

                    {{-- Mail SMTP --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.smtp*') ? 'active' : '' }}">

                            <i class="fas fa-envelope"></i>
                            <span>Mail SMTP</span>

                        </a>
                    </li>

                    {{-- Payment Gateway --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.gateway*') ? 'active' : '' }}">

                            <i class="fas fa-credit-card"></i>
                            <span>Payment Gateway</span>

                        </a>
                    </li>

                    {{-- SMS Gateway --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.sms*') ? 'active' : '' }}">

                            <i class="fas fa-sms"></i>
                            <span>SMS Gateway</span>

                        </a>
                    </li>

                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Banner & Ads --}}
            {{-- ========================================================= --}}
            @php
                $bannerActive = request()->routeIs('admin.banner*') || request()->routeIs('admin.ads*');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $bannerActive ? 'active' : '' }}">

                    <i class="fas fa-images"></i>

                    <span class="flex-grow-1">
                        Banner & Ads
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $bannerActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $bannerActive ? 'open' : '' }}">

                    {{-- Banner Categories --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.banner.categories*') ? 'active' : '' }}">

                            <i class="fas fa-folder"></i>
                            <span>Banner Categories</span>

                        </a>
                    </li>

                    {{-- Banners & Ads --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.banner*') ? 'active' : '' }}">

                            <i class="fas fa-ad"></i>
                            <span>Banners & Ads</span>

                        </a>
                    </li>

                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Reports --}}
            {{-- ========================================================= --}}
            @php
                $reportsActive =
                    request()->routeIs('admin.reports*') ||
                    request()->routeIs('admin.stock.report*') ||
                    request()->routeIs('admin.ip*');
            @endphp

            <li class="nav-item">

                <a href="javascript:void(0)" class="nav-link menu-toggle {{ $reportsActive ? 'active' : '' }}">

                    <i class="fas fa-chart-bar"></i>

                    <span class="flex-grow-1">
                        Reports
                    </span>

                    <i class="fas fa-chevron-down arrow {{ $reportsActive ? 'rotate' : '' }}"></i>

                </a>

                <ul class="submenu {{ $reportsActive ? 'open' : '' }}">

                    {{-- Stock Report --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.stock.report*') ? 'active' : '' }}">

                            <i class="fas fa-boxes"></i>
                            <span>Stock Report</span>

                        </a>
                    </li>

                    {{-- Sales Report --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reports.sales*') ? 'active' : '' }}">

                            <i class="fas fa-chart-line"></i>
                            <span>Sales Report</span>

                        </a>
                    </li>

                    {{-- Order Report --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reports.orders*') ? 'active' : '' }}">

                            <i class="fas fa-file-invoice"></i>
                            <span>Order Report</span>

                        </a>
                    </li>

                    {{-- Customer Report --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.reports.customers*') ? 'active' : '' }}">

                            <i class="fas fa-users"></i>
                            <span>Customer Report</span>

                        </a>
                    </li>

                    {{-- IP --}}
                    <li>
                        <a href="#" wire:navigate.hover
                            class="{{ request()->routeIs('admin.ip*') ? 'active' : '' }}">

                            <i class="fas fa-globe"></i>
                            <span>IP</span>

                        </a>
                    </li>

                </ul>
            </li>


            {{-- ========================================================= --}}
            {{-- Media --}}
            {{-- ========================================================= --}}
            @php
                $mediaActive = request()->routeIs('admin.media*');
            @endphp

            <li class="nav-item">

                <a href="{{ route('admin.media') }}" wire:navigate.hover
                    class="nav-link {{ $mediaActive ? 'active' : '' }}">

                    <i class="fas fa-photo-video"></i>
                    <span>Media</span>

                </a>

            </li>

        </ul>
    </div>

</aside>
