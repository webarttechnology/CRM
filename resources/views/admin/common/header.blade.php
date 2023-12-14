<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="CRMS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/font-awesome.min.css') }}">

        <!-- Feathericon CSS -->
		<link rel="stylesheet" href="{{ url('panel/assets/css/feather.css') }}">

        <!--font style-->
        {{-- <link href="../css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet"> --}}
		
		  <!-- Ionic CSS -->
		  <link rel="stylesheet" href="{{ url('panel/assets/plugins/icons/ionic/ionicons.css') }}">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/line-awesome.min.css') }}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ url('panel/assets/css/select2.min.css') }}">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ url('panel/assets/css/bootstrap-datetimepicker.min.css') }}">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ url('panel/assets/css/dataTables.bootstrap4.min.css') }}">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{ url('panel/assets/plugins/morris/morris.css') }}">

		<!-- Theme CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/theme-settings.css') }}">

		<!-- Toastr CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/plugins/toastr/toatr.css') }}">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('panel/assets/css/style.css') }}" class="themecls">
		<style>
			.select2-container--default .select2-selection--single .select2-selection__rendered {
				width: 190px !important;
			}
			.select2-container--default .select2-selection--multiple {
				width: 190px !important;
			}
		</style>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header" id="heading">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="{{ url('/') }}" class="logo">
						<img src="{{ url('panel/assets/img/logo.png') }}" alt="Logo" class="sidebar-logo">
						<img src="{{ url('panel/assets/img/s-logo.png') }}" alt="Logo" class="mini-sidebar-logo">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						
					</li>
					<!-- /Search -->
				
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
							<img src="{{ url('panel/assets/img/flags/us.png') }}" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{ url('panel/assets/img/flags/us.png') }}" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{ url('panel/assets/img/flags/fr.png') }}" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{ url('panel/assets/img/flags/es.png') }}" alt="" height="16"> Spanish
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{ url('panel/assets/img/flags/de.png') }}" alt="" height="16"> German
							</a>
						</div>
					</li>
					<!-- /Flag -->
				
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge rounded-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
													<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
													<p class="noti-time"><span class="notification-time">2 days ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- Message Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i class="fa fa-comment-o"></i> <span class="badge rounded-pill">8</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Messages</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">Richard Miles </span>
													<span class="message-time">12:28 AM</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">John Doe</span>
													<span class="message-time">6 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Tarah Shropshire </span>
													<span class="message-time">5 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">Mike Litorus</span>
													<span class="message-time">3 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Catherine Manseau </span>
													<span class="message-time">27 Feb</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Messages</a>
							</div>
						</div>
					</li>
					<!-- /Message Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img">
							@if (Auth::user()->img)
							<img alt="" src="{{ url(Auth::user()->img) }}">
							@else
							<img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
							@endif
							<span class="status online"></span></span>
							<span>{{ Str::limit(Auth::user()->name, 10, '...') }}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
							<a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
					</div>
				</div>
		<!-- /Mobile Menu -->		
</div>
			<!-- /Header -->