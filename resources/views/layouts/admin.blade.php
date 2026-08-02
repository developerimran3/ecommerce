<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $title ?? 'Dashboard' }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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





    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    @livewireScripts
    {{-- media --}}
    <script>
        function toggleSelect(el) {
            el.classList.toggle('selected');
        }

        function deleteMedia(el) {
            if (confirm("Delete this file?")) {
                el.closest('.col-lg-3').remove();
            }
            event.stopImmediatePropagation();
        }
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
        document.addEventListener('livewire:init', function() {

            $('#sizes').select2({
                theme: 'bootstrap4',
            });

            $('#colors').select2({
                theme: 'bootstrap4',
            });
            $('#sizes').on('change', function() {
                Livewire.first().set('sizes', $(this).val());
            });
            $('#colors').on('change', function() {
                Livewire.first().set('colors', $(this).val());
            });
        });
    </script>




    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('close-modal', () => {

                $('#userModal').modal('hide');
                $('#brandModal').modal('hide');
                $('#categoryModal').modal('hide');
                $('#productdModal').modal('hide');

                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');

                $('#sizes').val([]).trigger('change.select2');
                $('#colors').val([]).trigger('change.select2');
            });

        });
    </script>
</body>

</html>
