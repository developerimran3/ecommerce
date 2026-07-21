<aside class="sidebar" id="sidebar">
    <div class="logo d-flex align-items-center">
        <div class="logo-icon d-flex align-items-center justify-content-center">
            G
        </div>

        <h4 class="mb-0 ml-3 font-weight-bold">Genius.shop</h4>
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
            <li class="nav-item">
                <a href="javascript:void(0)"
                    class="nav-link menu-toggle {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">

                    <i class="fas fa-shopping-cart"></i>
                    <span class="flex-grow-1">Orders</span>

                    <i class="fas fa-chevron-down arrow {{ request()->routeIs('admin.orders*') ? 'rotate' : '' }}"></i>
                </a>

                <ul class="submenu {{ request()->routeIs('admin.orders*') ? 'open' : '' }}">

                    <li>
                        <a href="{{ route('admin.orders') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                            All Orders
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{ route('admin.orders.pending') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}">
                            Pending Orders
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.orders.completed') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.completed') ? 'active' : '' }}">
                            Completed Orders
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.orders.cancelled') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.orders.cancelled') ? 'active' : '' }}">
                            Cancelled Orders
                        </a>
                    </li> --}}

                </ul>
            </li>

            {{-- Products --}}
            <li class="nav-item">
                <a href="javascript:void(0)"
                    class="nav-link menu-toggle {{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') ? 'active' : '' }}">

                    <i class="fas fa-box"></i>
                    <span class="flex-grow-1">Products</span>

                    <i
                        class="fas fa-chevron-down arrow {{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') ? 'rotate' : '' }}"></i>
                </a>

                <ul
                    class="submenu {{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') ? 'open' : '' }}">

                    <li>
                        <a href="{{ route('admin.products') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.products') ? 'active' : '' }}">
                            All Products
                        </a>
                    </li>

                    {{-- <li>
                        <a href="#" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                            Add Product
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{ route('admin.categories') }}" wire:navigate.hover
                            class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                            Categories
                        </a>
                    </li>

                    {{-- <li>
                        <a href="#" class="{{ request()->routeIs('admin.stock') ? 'active' : '' }}">
                            Stock
                        </a>
                    </li> --}}

                </ul>
            </li>

            {{-- Reviews --}}
            <li class="nav-item">
                {{-- <a href="{{ route('admin.reviews') }}" wire:navigate.hover
                    class="nav-link {{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">

                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a> --}}
            </li>

            {{-- Users --}}
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" wire:navigate.hover
                    class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">

                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            {{-- Settings --}}
            <li class="nav-item">
                {{-- <a href="{{ route('admin.settings') }}" wire:navigate.hover
                    class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">

                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a> --}}
            </li>

        </ul>
    </div>

</aside>
