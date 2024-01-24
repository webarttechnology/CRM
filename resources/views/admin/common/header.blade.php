@php

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="CRMS">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> --}}

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
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <audio id="beepSound" src="{{ asset('panel/assets/beep.mp3') }}"></audio>

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
            <div class="page-title-box d-flex">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#">
                        <input class="form-control" type="text" placeholder="Search here">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                @if (Auth::user()->id !== 1)
                    @php
                        $today = date('Y-m-d');

                        $timerCurrentStatus = App\Models\TimeLog::where('user_id', Auth::user()->id)
                            ->whereDate('created_at', $today)
                            ->orderBy('id', 'desc')
                            ->first();

                        if ($timerCurrentStatus) {
                            if ($timerCurrentStatus->type == 'work') {
                                $addClass = '#2dec2d';
                            } elseif ($timerCurrentStatus->type == 'break') {
                                $addClass = '#db0a26';
                            }
                        } else {
                            $addClass = '#fff';
                        }

                    @endphp


                    <div class="times_track">
                        <small>
                            <a class="text-white" style="margin-right: 38px;">
                                <span class="timer show-task-timer d-none">00:00:00</span>
                            </a>
                        </small>
                        <h1 class="clock">
                            <a href="#" class="time add-color" style="color: {{ $addClass }}"></a>
                            <sup class="am-pm add-color" style="color: {{ $addClass }}"></sup>
                            <sup class="work-type"></sup>
                        </h1>
                    </div>
                    <div class="time_popups" id="popUp">
                        <div class="pop_head">
                            <span class="dots"></span>
                            <span class="dots right"></span>
                            <h4 id="startduration" class="title-work">Working Day Duration</h4>
                            <h2 id="start_timer" class="clockin_break_timer" style="color:#2dec2d;">
                                {{-- 00:00:00 --}}
                                {{-- <div class="timer-loader"></div> --}}
                            </h2>

                            <div class="clock-break-btn">
                                <small>
                                    <button id="startButton" class="custom_btn break clock-btn" data-type="clockin"><i
                                            class="fa-solid fa-play"></i>
                                        Clock In
                                    </button>
                                </small>

                            </div>

                        </div>
                    </div>
                @endif

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
                        <img src="{{ url('panel/assets/img/flags/us.png') }}" alt="" height="20">
                        <span>English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ url('panel/assets/img/flags/us.png') }}" alt="" height="16">
                            English
                        </a>
                    </div>
                </li>
                <!-- /Flag -->

                @php
                    $notify = App\Models\Notification::with('user')
                        ->where('receiver_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $unreadCount = $notify->where('status', 'unread')->count();
                @endphp
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link all_notification" data-bs-toggle="dropdown"
                        id="notificationDropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge rounded-pill"
                            id="unreadCount">{{ $unreadCount }}</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            {{-- <a href="javascript:void(0)" class="clear-noti"> Clear All </a> --}}
                        </div>
                        <div class="noti-content">

                        </div>
                        @if (count($notify) > 0)
                            <div class="topnav-dropdown-footer">
                                <a href="{{ url('/get-allnotification') }}">View all Notifications</a>
                            </div>
                        @endif
                    </div>
                </li>
                <!-- /Notifications -->

                <!-- Message Notifications -->
                {{-- <li class="nav-item dropdown">
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
					</li> --}}
                <!-- /Message Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            @if (Auth::user()->user_image)
                                <img alt="" src="{{ url(Auth::user()->user_image) }}">
                            @else
                                <img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
                            @endif
                            <span class="status {{ Auth::user()->user_status == 'Online' ? 'online' : '' }}"></span>
                        </span>
                        <span>{{ Str::limit(Auth::user()->name, 10, '...') }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                        @if (Auth::user()->role_id != 1)
                            <a class="dropdown-item" href="{{ url('developer/time-log') }}">Time Log</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                    @if (Auth::user()->role_id != 1)
                        <a class="dropdown-item" href="{{ url('developer/time-log') }}">Time Log</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
        <!-- /Header -->
