<div class="sidebar vh-100">

    <h4 class="text-white text-center py-3 border-bottom">
        E-Commerce
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" wire:navigate
                class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-primary' : '' }}">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.categories') }}" wire:navigate
                class="nav-link text-white {{ request()->routeIs('admin.categories') ? 'bg-primary' : '' }}">
                <i class="fa fa-list mr-2"></i> Categories
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.brands') }}" wire:navigate
                class="nav-link text-white {{ request()->routeIs('admin.brands') ? 'bg-primary' : '' }}">

                <i class="fa fa-tags mr-2"></i> Brands
            </a>
        </li>

        <li class="nav-item">

            <a href="{{ route('admin.products') }}" wire:navigate
                class="nav-link text-white {{ request()->routeIs('admin.products') ? 'bg-primary' : '' }}">

                <i class="fa fa-box mr-2"></i>

                Products

            </a>

        </li>



    </ul>

</div>
