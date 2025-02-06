<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- style CSS-->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/logo/cheetsi_fav.svg')}}" />
    <link rel="stylesheet" href="{{ url('guest/css/style.css') }}" />
    <title>Reset-password</title>
</head>

<body>
    <!-- main -->
    <main>
        <section class="register-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 position-relative p-0">
                        <img class="d-none d-md-block img-fluid register-img"
                            src="{{ url('guest/images/registeration/signup.png') }}" alt="notshow" />
                            {{-- d-none --}}
                        <div class="card content-card d-none">
                            <div>

                                <button class="btn btn-secondary mb-2">About Content Manager Platform</button>
                            </div>
                            <p class="text-white">Lorem ipsum dolor sit amet consectetur. Lectus id maecenas aliquet a
                                mattis facilisis vulputate consectetur. Faucibus eget senectus tincidunt et ut orci.</p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <form class="position-relative px-fix"
                            action="{{ route('change.password', base64_encode($user->user_id)) }}" method="POST">
                            @csrf
                            <div class="row my-4">
                                <div class="text-center col-12 mb-3">
                                    <h3 class="text-center chesteei text-dark">
                                        Get started with
                                        <span class="text-orange">Chesteei</span>
                                    </h3>
                                    <h5 class="text-secondary">Reset Password</h5>
                                </div>

                                <div class="col-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </symbol>
                                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                        </symbol>
                                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </symbol>
                                    </svg>
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                            aria-label="Success:">
                                            <use xlink:href="#check-circle-fill" />
                                        </svg> {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @elseif (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                            aria-label="Danger:">
                                            <use xlink:href="#exclamation-triangle-fill" />
                                        </svg> {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                {{-- <div class="form-group col-12">

                                    <input id="Email" type="email" class="form-control" name="email" placeholder="Email"
                                        required />
                                    <img class="form-icon img-fluid fix-w"
                                        src="{{ url('guest/images/registeration/email.png') }}" alt="" />
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> --}}
                            <div class="col-12">
                                <label for="passwordField">New Password</label>

                            </div>

                            <div class="form-group col-12 position-relative">
                                <input value="{{ old('password') }}" type="password" class="form-control pr-5"
                                    name="password" id="passwordField" placeholder="Password" required />
                                <img class="form-icon img-fluid fix-w"
                                    src="{{ url('guest/images/registeration/lock.png') }}" alt="" />
                                <img class="view-icon img-fluid fix-w"
                                    src="{{ url('guest/images/registeration/view.png') }}" alt="" id="togglePassword" />
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="confirmPasswordField">Confirm Password</label>

                            </div>
                            <div class="form-group col-12 position-relative">
                                <input value="{{ old('password_confirmation') }}" type="password"
                                    class="form-control pr-5" name="password_confirmation" id="confirmPasswordField"
                                    placeholder="Confirm Password" required />
                                <img class="form-icon img-fluid fix-w"
                                    src="{{ url('guest/images/registeration/lock.png') }}" alt="" />
                                <img class="view-icon img-fluid fix-w"
                                    src="{{ url('guest/images/registeration/view.png') }}" alt=""
                                    id="togglePasswordConfirm" />
                                @error('confirmation_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="text-center col-12">
                                <button type="submit" class="btn btn-primary mt-3 w-100">
                                    Reset password
                                </button>

                            </div>
                            <div class="col-12 mt-5">
                                <a  href="{{route('login')}}"  class="btn btn-outline-warning w-100">Log In</a>
                              </div>

                    </div>
                    </form>
                </div>
            </div>
            </div>
        </section>
    </main>
    <!-- Bootstrap JS -->
    <script src="{{ url('guest/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ url('guest/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordField = document.getElementById('passwordField');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            // Optionally change the icon (e.g., to a "hide" icon)..
            this.src = type === 'password' ? '{{ url('guest/images/registeration/view.png') }}': '{{ url('guest/images/registeration/not-view.svg') }}';
        });
    </script>
    <script>
        document.getElementById('togglePasswordConfirm').addEventListener('click', function(e) {
            const passwordField = document.getElementById('confirmPasswordField');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            // Optionally change the icon (e.g., to a "hide" icon)..
            this.src = type === 'password' ? '{{ url('guest/images/registeration/view.png') }}': '{{ url('guest/images/registeration/not-view.svg') }}';
        });
    </script>
</body>

</html>
