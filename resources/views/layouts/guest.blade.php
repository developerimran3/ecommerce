<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">

</head>

<body>
    {{ $slot ?? '' }}
    @yield('content')

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
</body>

</html>
