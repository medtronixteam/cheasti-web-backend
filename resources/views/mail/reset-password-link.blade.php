<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .button {
            background-color: #04AA6D;
            /* Green */
            border: none;
            color: white !important;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .rest-password {
            background-color: #555555;
        }

    </style>
</head>
<body>
    <section style="background: rgb(255, 255, 255);paddind:40px;">
        <h2>Hello!</h2>
        <h4 class="text-secondary">Reset password link</h4>
        <p style="color: #747070;padding-bottom: 10px;font-size:14px;">You are receiving this email because we received a password reset request for your account .</p>
        <a class="button rest-password" href="{{ route('reset.password', ['token' => $userId]) }}" class="btn btn-primary">Reset password</a>
        <p style="color: #747070;padding-bottom: 10px; font-size:14px;">If you did not request password reset, no further action is required</p>

    </section>


</body>
</html>
