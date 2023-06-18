<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../asset/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../asset/img/favicon.png">
    <title>
        Optima Dashboard
    </title>
    <!-- Mapbox Api -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/asset/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/asset/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="/asset/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
</head>


<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Log In</h4>
                                    <p class="mb-0">Enter your email and password to log in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.process') }}" class>
                                        @csrf
                                        <div class="mb-3 has-validation">
                                            <input type="email" value="{{ old('email') }}" name="email"
                                                class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                placeholder="Email" aria-label="Email">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        </div>
                                        <div class="mb-3 has-validation">
                                            <input type="password" name="password"
                                                class="form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                placeholder="Password" aria-label="Password">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0"
                                                value="Sign in" />
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('signup.form') }}"
                                            class="text-primary text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
