<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        .login-logo {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #4f46e5;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }

        .form-control {
            border-left: none;
            height: 45px;
            box-shadow: none !important;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .btn-login {
            background: #4f46e5;
            color: #fff;
            border-radius: 30px;
            height: 45px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-2px);
        }

        .forgot {
            font-size: 14px;
            color: #4f46e5;
        }

        .forgot:hover {
            text-decoration: none;
        }

        .form-check-label {
            font-size: 14px;
        }

        @media(max-width:576px) {
            .login-card {
                margin: 20px;
                padding: 30px;
            }
        }
    </style>

</head>

<body>
    {{ $slot ?? '' }}
    @yield('content')


</body>

</html>
