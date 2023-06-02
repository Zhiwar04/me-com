<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('adminbackend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('adminbackend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('adminbackend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('adminbackend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/icons.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <title>Admin Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('adminbackend/assets/images/icons/login.svg') }}" alt="IMG" />
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- session message for password update  --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <span class="login100-form-title"> Admin Login </span>

                    <div class="wrap-input100 validate-input @error('email') is-invalid @enderror">
                        <input class="input100" type="text" id="email" name="email" placeholder="Email" />

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        </span>
                        <i class="fa fa-envelope position-absolute" style="bottom: 16px; left:15px;"></i>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="wrap-input100 validate-input @error('password') is-invalid @enderror"
                        data-validate="Password is required" id="show_hide_password">
                        <input type="password" class="input100 border-end-0" id="password" name="password"
                            placeholder="Enter Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"> </span>
                        <i class="fa fa-lock position-absolute" style="bottom: 16px; left:15px;"></i>
                        <a href="javascript:;"
                            class="border-0 bg-none position-absolute end-0 top-0 mt-2 h-100 w-40 pt-2 pe-3 text-center"><i
                                class="bx bx-hide"></i></a>

                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Login</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1"> Forgot </span>
                        <a class="txt2" href="#"> Username / Password? </a>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on("click", function(event) {
                event.preventDefault();
                if ($("#show_hide_password input").attr("type") == "text") {
                    $("#show_hide_password input").attr("type", "password");
                    $("#show_hide_password i").addClass("bx-hide");
                    $("#show_hide_password i").removeClass("bx-show");
                } else if (
                    $("#show_hide_password input").attr("type") == "password"
                ) {
                    $("#show_hide_password input").attr("type", "text");
                    $("#show_hide_password i").removeClass("bx-hide");
                    $("#show_hide_password i").addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>
</body>

</html>
