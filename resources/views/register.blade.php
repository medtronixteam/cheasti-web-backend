<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- style CSS-->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/logo/cheetsi_fav.svg')}}" />
    <link rel="stylesheet" href="guest/css/style.css" />
    <title>SignUp</title>
</head>

<body>
    <!-- main -->
    <main>
        <section class="register-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 position-relative p-0">
                        <img class="d-none d-md-block img-fluid register-img"
                            src="guest/images/registeration/signup.png" alt="notshow" />
                            {{-- d-none  --}}
                            <div class="card content-card d-none">
                                <div>

                                    <button class="btn btn-secondary mb-2">About Content Manager Platform</button>
                                </div>
                                <p class="text-white">Lorem ipsum dolor sit amet consectetur. Lectus id maecenas aliquet a mattis facilisis vulputate consectetur. Faucibus eget senectus tincidunt et ut orci.</p>
                            </div>

                    </div>
                    <div class="col-md-6">
                        <form class="position-relative" action="{{route('registerUser')}}" method="POST">
                            @csrf
                            <div class="row my-4">
                                <div class="text-center col-12">
                                    <h3 class="text-center chesteei">
                                        Get started with
                                        <span class="text-orange">Chesteei</span>
                                    </h3>
                                    <p class="text-secondary">Sign up to your profile below</p>
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="first_name" id="name" placeholder="First Name"
                                        required />
                                    <img class="form-icon img-fluid" src=" guest/images/registeration/user.png" alt="">
                                    @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        required />
                                        <img class="form-icon img-fluid" src=" guest/images/registeration/user.png" alt="">
                                        @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number"
                                        required />

                                        <img class="form-icon img-fluid" src=" guest/images/registeration/phone.png" alt="">
                                        @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required />

                                    <img class="form-icon img-fluid fix-w" src=" guest/images/registeration/email.png" alt="">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <div class="form-group col-12">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required />
                                    <img class="form-icon img-fluid fix-w" src=" guest/images/registeration/lock.png" alt="">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <div class="form-group col-12">
                                    <input type="password" class="form-control" name="password_confirmation" id="name" placeholder="Confirm Password"
                                        required />
                                        <img class="form-icon img-fluid fix-w" src=" guest/images/registeration/lock.png" alt="">
                                        @error('confirmation_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <div class="check-box col-12 d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id="conditions" value="option2" />
                                    <label class="form-check-label ml-2" for="conditions">I agree to the terms and
                                        conditions.</label>
                                </div>
                                    {{-- <div class="check-box col-12 d-flex align-items-center d-none">
                                        <input class="form-check-input " type="checkbox" id="Robot" value="option2" />
                                        <label class="form-check-label ml-2" for="Robot">I’m not Robot</label>
                                    </div> --}}

                                <div class="text-center col-12">
                                    <button type="submit" class="btn btn-primary mt-4 btn-lg btn-block">
                                        Sign Up
                                    </button>
                                    <p class="mt-3 ml-3 text-secondary">
                                        Alraedy have account?
                                        <a class="font-18px text-orange" href="/login">Log In</a>
                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Bootstrap JS -->
    <script src="guest/js/jquery-3.5.1.js"></script>
    <script src="guest/js/bootstrap.bundle.min.js"></script>
</body>

</html>
