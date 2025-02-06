<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- ============== styling bootstrap ============== -->
    <link rel="stylesheet" href="guest/css/bootstrap.min.css">
    <!-- ============== main style ============== -->
    <link rel="stylesheet" href="guest/css/home.css">
</head>
<body>
    <!-- login section -->
     <section class="login-section p-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="card text-center p-lg-5">
                        <h1 class="chesti-head"><img src="guest/images/Group.png" alt="" class="img-fluid">Chesteei</h1>
                        <h1 class="font-weight-bold mt-4 heading-login">Welcome to Chesteei</h1>
                        <div class="card-btn">
                            <a href="{{route('register')}}" class="btn btn-primary px-5 login-section-btn">Sign Up</a>
                            <a href="{{route('login')}}" class="btn btn-primary px-5 login-section-btn btn-2">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
</body>
</html>
