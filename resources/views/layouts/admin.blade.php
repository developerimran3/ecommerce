<!doctype html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <!-- Site Title -->
    <title>{{ $title ?? 'Dashboard' }} - Genius Shop</title>
    <!-- SEO Description / Tagline -->
    <meta name="description"
        content="GENIUS.SHOP — Your Smart Shopping Destination. Shop quality products at the best prices in Bangladesh.">
    <!-- Browser / SEO -->
    <meta name="author" content="GENIUS.SHOP">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main -->
        <main class="main">
            <!-- Topbar -->
            @include('partials.navbar')

            <!-- Content -->
            <div class="container-fluid p-3">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>
    </div>
    <div id="overlay"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', (event) => {
                toastr.success(event.message);
            });
            Livewire.on('error', (event) => {
                toastr.error(event.message);
            });
        });
    </script>

    {{-- media --}}
    <script>
        function initDashboard() {

            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            const adminToggle = document.querySelector(".admin-toggle");
            const adminMenu = document.querySelector(".admin-menu");

            window.toggleMenu = function() {
                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");
            };

            overlay.onclick = function() {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");

                if (adminMenu) {
                    adminMenu.classList.remove("show");
                }
            };

            // Sidebar submenu

            document.querySelectorAll(".menu-toggle").forEach(function(menu) {

                menu.onclick = function() {

                    const current = this.nextElementSibling;

                    document.querySelectorAll(".submenu").forEach(function(sub) {

                        if (sub !== current) {
                            sub.classList.remove("open");
                        }

                    });

                    document.querySelectorAll(".arrow").forEach(function(icon) {

                        if (icon !== menu.querySelector(".arrow")) {
                            icon.classList.remove("rotate");
                        }

                    });

                    current.classList.toggle("open");

                    menu.querySelector(".arrow").classList.toggle("rotate");
                };
            });

            // Admin dropdown

            if (adminToggle && adminMenu) {

                adminToggle.onclick = function(e) {

                    e.stopPropagation();

                    adminMenu.classList.toggle("show");
                    adminToggle.classList.toggle("active");
                };

                document.onclick = function() {

                    adminMenu.classList.remove("show");
                    adminToggle.classList.remove("active");
                };
            }
        }

        document.addEventListener("DOMContentLoaded", initDashboard);

        document.addEventListener("livewire:navigated", initDashboard);
    </script>


    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('open-modal', () => {
                $('#userModal').modal('show');
                $('#editProfileModal').modal('show');
                $('#brandModal').modal('show');
                $('#categoryModal').modal('show');
                $('#productModal').modal('show');
                $('#couponModal').modal('show');
                $('#shippingModal').modal('show');
                $('#bannerCategoryModal').modal('show');
                $('#bannerIndexModal').modal('show');
                $('#courierModal').modal('show');
                $('#sizeModal').modal('show');
                $('#colorModal').modal('show');
            });

            Livewire.on('close-modal', () => {
                $('#userModal').modal('hide');
                $('#editProfileModal').modal('hide');
                $('#brandModal').modal('hide');
                $('#categoryModal').modal('hide');
                $('#productModal').modal('hide');
                $('#couponModal').modal('hide');
                $('#shippingModal').modal('hide');
                $('#bannerCategoryModal').modal('hide');
                $('#bannerIndexModal').modal('hide');
                $('#courierModal').modal('hide');
                $('#sizeModal').modal('hide');
                $('#colorModal').modal('hide');
            });

        });
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
