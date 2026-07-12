<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>{{ $title ?? 'Admin Panel' }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @livewireStyles
</head>

<body>

    @include('partials.navbar')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 bg-dark p-0">
                @include('partials.sidebar')
            </div>

            <div class="col-md-10 p-4">
                {{ $slot ?? '' }}

                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });

        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
    </script>

    @livewireScripts

</body>

</html>
