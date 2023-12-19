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
    <title>Register - CRMS admin template</title>

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
                        <h3 class="account-title">Register</h3>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <!-- Account Form -->
                        <form method="post" action="{{ url('/userRegister') }}" class="save" autocomplete="off">
                            @csrf
                            <input type="hidden" name="uniqid" value="{{ $uniqid }}">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="E.g: John Smith" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $email }}" placeholder="johnsmith@hotmail.com" readonly required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" id="mobile_no"
                                    name="mobile_no" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="********" id="password"
                                    name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <input type="password" class="form-control" placeholder="********" id="confirm_password"
                                    name="confirm_password" required>
                                <div id="passwordError" style="display: none; color: red;">Passwords do not match</div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" id="submitbtn"
                                    type="submit">Register</button>
                            </div>
                            <div class="account-footer">
                                {{-- <p>Already have an account? <a href="login.html">Login</a></p> --}}
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->


    <div class="sidebar-contact">
        <div class="toggle" data-bs-toggle="modal" data-bs-target="#settings"><i
                class="fa fa-cog fa-w-16 fa-spin fa-2x"></i></div>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('panel/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('panel/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <!-- theme JS -->
    <script src="{{ asset('panel/assets/js/theme-settings.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('panel/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to check if passwords match
            function checkPasswordMatch() {
                var password = $("#password").val();
                var confirmPassword = $("#confirm_password").val();
                var passwordError = $("#passwordError");

                if (password === confirmPassword) {
                    $("#submitbtn").prop("disabled", false);
                    passwordError.hide();
                } else {
                    $("#submitbtn").prop("disabled", true);
                    passwordError.show();
                }
            }

            // Check on keyup or change in the password fields
            $("#confirm_password").on("keyup change", function() {
                checkPasswordMatch();
            });
        });
    </script>

</body>

</html>
