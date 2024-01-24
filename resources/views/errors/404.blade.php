<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="CRMS">
        <meta name="robots" content="noindex, nofollow">
        <title>Error 404</title>
		
		<!-- Favicon -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/font-awesome.min.css') }}">
    
        <!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/feather.css') }}">
    
        <!-- Ionic CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/plugins/icons/ionic/ionicons.css') }}">
    
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/line-awesome.min.css') }}">

    
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/style.css') }}" class="themecls">
    </head>
    <body class="error-page">
		<!-- Main Wrapper -->
        <div class="main-wrapper text-center">
			
			<div class="error-box">
				<h1>404</h1>
				<h3><i class="fa fa-warning"></i> Oops! Page not found!</h3>
				<p>The page you requested was not found.</p>
				<a href="{{ route('login') }}" class="btn btn-custom btn-gradient-primary btn-rounded">Back to Home</a>
			</div>
		
        </div>
		<!-- /Main Wrapper -->
		
        <!-- jQuery -->
        <script src="{{ url('panel/assets/js/jquery-3.6.0.min.js') }}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{ url('panel/assets/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>