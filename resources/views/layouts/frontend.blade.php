<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} - Genius Shop</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend_responsive.css') }}">
    @livewireStyles
</head>

<body>

    <!-- TOP HEADER  -->

    @include('partials.frontend-navbar')
    {{ $slot }}
    @include('partials.frontend-footer')

    <div class="copyright">
        Copyright © 2026 GENIUS SHOP | All Rights Reserved, Design & Developed By <a style="color: #008e74"
            href="https://developerimran.com"><b>Developer Imran</b></a>
    </div>
    <!-- WhatsApp -->
    <a href="#" class="whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <!-- Scroll -->
    <button id="topBtn">
        <i class="fa fa-arrow-up"></i>
    </button>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
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
    @stack('scripts')
</body>

</html>
