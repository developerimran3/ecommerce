<div class="topbar d-flex justify-content-between align-items-center">
    <div class="topbar-left">
        <button class="menu-btn" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="topbar-buttons">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-purple btn-none">
                <i class="fas fa-globe mr-2"></i>
                Visit Website
            </a>

            <a href="#" class="btn btn-purple ml-2">
                <i class="fas fa-headset mr-2"></i>
                <span class="btn-text btn-none">Support</span>
            </a>
        </div>
    </div>

    <div class="topbar-right d-flex align-items-center">
        <div class="dropdown admin-dropdown">
            <button class="btn p-0 bg-transparent admin-toggle d-flex align-items-center">
                <div class="user-avatar d-flex align-items-center justify-content-center">

                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}">
                    @else
                        <i class="fa fa-user"></i>
                    @endif
                </div>

                <div class="ml-2 text-left">
                    <div class="font-weight-bold text-capitalize">{{ Auth::user()->name }}</div>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>

                <i class="fas fa-chevron-down ml-3"></i>
            </button>

            <div class="admin-menu">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>

                <a href="{{ route('users.profile') }}">
                    <i class="fas fa-user mr-2"></i>
                    Profile
                </a>

                <a href="{{ route('logout') }}" class="text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
