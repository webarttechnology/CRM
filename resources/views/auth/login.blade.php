<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="CRMS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - CRMS admin template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/feather.css') }}">

    <!--font style-->
    <link href="../css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/style.css') }}" class="themecls">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">

            <div class="container">

                <!-- Account Logo -->
                <div class="account-logo">
                    <a href="index.html"><img src="{{ asset('panel/assets/img/logo.png') }}"
                            alt="Dreamguy's Technologies"></a>
                </div>
                <!-- /Account Logo -->

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login</h3>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <!-- Account Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('Email ') }}</label>
                                <input id="email" type="email" placeholder="Registered Email id"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{ route('password.request') }}">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>
                            <div class="account-footer">
                                {{-- <p>Don't have an account yet? <a href="register.html">Register</a></p> --}}
                            </div>
                        </form>
                        <!-- /Account Form -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('panel/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('panel/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <!-- theme JS -->
    <script src="{{ asset('panel/assets/js/theme-settings.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('panel/assets/js/app.js') }}"></script>

</body>

</html>
