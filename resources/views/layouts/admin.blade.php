<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $title ?? 'Dashboard' }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
            <div class="container-fluid p-5">

                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>
    </div>
    <div id="overlay"></div>

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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @livewireScripts
</body>

</html>
