<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Your Password</title>

</head>

<body style="
    margin:0;
    padding:0;
    background:#f4f6f8;
    font-family:Arial, Helvetica, sans-serif;
">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f8; padding:40px 15px;">

        <tr>

            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="
                       max-width:600px;
                       width:100%;
                       background:#ffffff;
                       border-radius:12px;
                       overflow:hidden;
                       box-shadow:0 5px 25px rgba(0,0,0,0.08);
                   ">

                    <!-- Header -->

                    <tr>

                        <td
                            style="
                        background:#008e74;
                        padding:30px;
                        text-align:center;
                    ">

                            <h1
                                style="
                            margin:0;
                            color:#ffffff;
                            font-size:26px;
                        ">

                                {{ config('app.name') }}

                            </h1>

                        </td>

                    </tr>

                    <!-- Content -->

                    <tr>

                        <td style="padding:40px 35px;">

                            <h2
                                style="
                            margin-top:0;
                            color:#222222;
                            font-size:24px;
                        ">

                                Reset Your Password

                            </h2>

                            <p
                                style="
                            color:#555555;
                            font-size:15px;
                            line-height:1.7;
                        ">

                                Hello {{ $user->name ?? 'Customer' }},

                            </p>

                            <p
                                style="
                            color:#555555;
                            font-size:15px;
                            line-height:1.7;
                        ">

                                We received a request to reset the password
                                for your account.

                            </p>

                            <p
                                style="
                            color:#555555;
                            font-size:15px;
                            line-height:1.7;
                        ">

                                Click the button below to create a new password.

                            </p>

                            <!-- Button -->

                            <div
                                style="
                            text-align:center;
                            margin:30px 0;
                        ">

                                <a href="{{ $resetUrl }}"
                                    style="
                                   display:inline-block;
                                   background:#008e74;
                                   color:#ffffff;
                                   text-decoration:none;
                                   padding:14px 30px;
                                   border-radius:7px;
                                   font-size:15px;
                                   font-weight:bold;
                               ">

                                    Reset Password

                                </a>

                            </div>

                            <p
                                style="
                            color:#777777;
                            font-size:13px;
                            line-height:1.6;
                        ">

                                This password reset link will expire after
                                60 minutes.

                            </p>

                            <p
                                style="
                            color:#777777;
                            font-size:13px;
                            line-height:1.6;
                        ">

                                If you did not request a password reset,
                                you can safely ignore this email.

                            </p>

                        </td>

                    </tr>

                    <!-- Footer -->

                    <tr>

                        <td
                            style="
                        background:#f8f9fa;
                        padding:20px;
                        text-align:center;
                    ">

                            <p
                                style="
                            margin:0;
                            color:#999999;
                            font-size:12px;
                        ">

                                © {{ date('Y') }}
                                {{ config('app.name') }}.
                                All rights reserved.

                            </p>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>
