<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- style CSS-->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/logo/cheetsi_fav.svg')}}" />
    <link rel="stylesheet" href="{{ url('guest/css/style.css') }}" />
    <title>Login</title>
</head>

<body>
    <!-- main -->
    <main>
        <section class="register-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 position-relative p-0">
                        <img class="d-none d-md-block img-fluid register-img" src="guest/images/registeration/login.png"
                          alt="notshow" />
                          {{-- d-none --}}
                        <div class="card content-card d-none">
                          <div>
                            <button class="btn btn-secondary mb-2">
                              About Content Manager Platform
                            </button>
                          </div>
                          <p class="text-white">
                            Lorem ipsum dolor sit amet consectetur. Lectus id maecenas
                            aliquet a mattis facilisis vulputate consectetur. Faucibus
                            eget senectus tincidunt et ut orci.
                          </p>
                        </div>
                      </div>
                    <div class="col-md-6">
                        <form class="position-relative px-fix" action="{{route('loginPost')}}" method="POST">
                            @csrf
                          <div class="row my-4">
                            <div class="text-center col-12">
                              <h3 class="text-center chesteei">
                                Welcome to
                                <span class="text-orange ">Chesteei</span>
                              </h3>
                              <h4 class="account text-dark-black">Account</h4>
                            </div>
                            <div class="col-12 py-fix">
                                @if (Session::has('error'))
                                <div class="alert alert-warning text-white" style="background-color: #FF6B00">
                                {{Session::get('error')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group col-12">
                              <input type="email" class="form-control" name="email" placeholder="Email" required />
                              <img class="form-icon img-fluid fix-w" src="guest/images/registeration/email.png" alt="" />
                            </div>
                            <div class="form-group col-12 position-relative">
                              <input type="password" class="form-control pr-5" name="password" id="passwordField" placeholder="Password" required />
                              <img class="form-icon img-fluid fix-w" src="guest/images/registeration/lock.png" alt="" />
                              <img class="view-icon img-fluid fix-w" src="guest/images/registeration/view.png" alt="" id="togglePassword" />
                            </div>

                            <div class="col-12 text-right">
                              <a class="pt- text-orange" href="{{ route('forget.password') }}">Forgot password?</a>
                            </div>

                            <div class="text-center col-12">
                              <button type="submit" class="btn btn-primary mt-5 w-100">
                                Sign in
                              </button>
                              <a href="{{ route('auth.redirect.login') }}"
                              style="background: #fff;
                          padding: 10px;
                          color: #eb5042;
                          border:1px solid #eb5042;
                          border-radius: 5px;
                          text-decoration: none;
                          align-items: center;
                          text-align: center;
                          display: flex;
                          margin-right: 5px;
                          width: 100%;justify-content: center;margin-top:10px">
                              <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png"
                                  style="margin-right: 5px;height:15px">
                              <span>@lang('Sign in with Google')</span>
                          </a>
                              <p class="mt-5 ml-3 text-secondary">
                                Don't have an account? Setup now
                              </p>
                            </div>
                            <div class="col-12">
                              <a  href="{{route('register')}}"  class="btn btn-outline-warning w-100">Create Account</a>
                            </div>
                          </div>
                        </form>
                      </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Bootstrap JS -->
    <script src="{{ url('https://cheetsiweb.ihsancrm.com/guest/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ url('https://cheetsiweb.ihsancrm.com/guest/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordField = document.getElementById('passwordField');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Optionally change the icon (e.g., to a "hide" icon)..
            this.src = type === 'password' ? 'guest/images/registeration/view.png' : 'guest/images/registeration/not-view.svg';
        });
      </script>
</body>

</html>
