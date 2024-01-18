@php
    
    // dd(ClockBreakTime());
    
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
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 190px !important;
        }

        .select2-container--default .select2-selection--multiple {
            width: 190px !important;
        }

        .timer-section {
            position: absolute;
            top: 10px;
            left: 50%;
            font-size: 20px;
            color: #000;
            cursor: pointer;
        }

        .timer-section .clock {
            position: relative;
            font-size: 30px;
            color: #fff;
        }

        .am-pm {
            /* position: absolute;
            top: 2px;
            right: -16px; */
            margin-left: -7px;
            top: -18px;
            font-size: 10px;
            color: #fff;
        }

        .timer-section .timer {
            /* position: absolute;
            top: 10px;
            right: -100px; */
        }

        .task-list-section {
            width: 400px;
        }

        a {
            text-decoration: none !important;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        header {
            background: linear-gradient(to right, rgba(40, 123, 200, 1) 0%, rgba(72, 75, 199, 1) 68%, rgba(72, 75, 199, 1) 68%, rgba(119, 62, 200, 1) 100%);
            padding: 10px 0;
            color: #fff;
        }

        .times_track {
            /* background: rgba(255, 255, 255, 0.2); */
            border-radius: 8px;
            max-width: 350px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 0 0 94px;
            align-items: center;
            /* -webkit-box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75); */
            /* box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75); */
            position: relative;
        }

        .times_track a {
            /* color: #fff; */
        }

        header h1 {
            font-weight: 600;
            margin: 0;
            padding: 0;
            font-size: 35px;
        }

        header h1 sup {
            font-weight: 300;
            margin: 0;
            padding: 0;
            font-size: 50%;
        }

        .times_track small span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            margin-left: 8px;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            line-height: 25px;
            display: inline-block;
            text-align: center;
        }

        .time_popups {
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            display: none;
            margin: 0 auto;
            width: 386px;
            padding: 10px 20px;
            background: #fff;
            -webkit-box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 27px -11px rgba(0, 0, 0, 0.75);
        }

        .pop_head {
            background: #464dee;
            border-radius: 20px;
            padding: 45px 15px 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            color: #333;
        }

        .pop_head::before {
            position: absolute;
            left: 10px;
            bottom: 10px;
            top: 25px;
            width: calc(100% - 20px);
            background-color: #fff;
            border-radius: 20px;
            content: "";
            height: calc(100% - 35px);
            z-index: -1;
        }

        header h2 {
            margin: 0 0 12px;
            padding: 0;
            font-size: 40px;
            font-weight: 300;
        }

        header h4 {
            margin: 0;
            padding: 0;
        }

        .dots {
            position: absolute;
            bottom: 100%;
            left: 40%;
            background: #464dee;
            width: 5px;
            height: 10px;
        }

        .dots.right {
            right: 40%;
            left: auto;
        }

        .custom_btn {
            border-radius: 6px;
            padding: 8px 20px;
            color: #fff;
            background: #333;
            font-weight: 600;
            margin: 0 5px;
        }

        .clockout {
            background-color: #464dee;
        }

        .edit {
            position: absolute;
            top: -18px;
            right: -10px;
            color: #fff;
            background: #999;
            border-radius: 50%;
            width: 34px;
            height: 34px;
            line-height: 34px;
            display: inline-block;
            font-size: 13px;
        }

        .modal-full {
            min-width: 100%;
            margin: 0;
        }

        .modal-full .modal-content {
            min-width: 100%;
            min-height: 100vh;
            border: 0;
            border-radius: 0;
        }

        .modal-full .modal-content .modal-body {
            padding: 0px !important;
        }


        .my-toast-container {
            z-index: 99999;
            max-width: 300px;
            position: fixed;
            top: 90px;
            right: 20px;
            background-color: #020202;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
            animation: slideInUp 0.5s ease-in-out forwards;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
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
                        // $starttime = App\Models\TimeLog::where('user_id', Auth::user()->id)
                        //     ->whereDate('created_at', $today)
                        //     ->where('type', 'work')
                        //     ->orderBy('id', 'desc')
                        //     ->first();
                        // $breaktime = App\Models\TimeLog::where('user_id', Auth::user()->id)
                        //     ->whereDate('created_at', $today)
                        //     ->where('type', 'break')
                        //     ->orderBy('id', 'desc')
                        //     ->first();

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

                    {{-- <div class="clock-section mt-2">
							<button id="startButton" class="btn btn-sm btn-success">Clock In</button>
							<button id="breakButton" class="btn btn-sm btn-info" style="display: none;">Take a
								Break</button>
							<button id="continueButton" class="btn btn-sm btn-warning"
								style="display: none;">Continue</button>
							<button id="stopButton" class="btn btn-sm btn-danger" style="display: none;">Clock Out</button>
							<div id="start_timer" style="display: block; background-color: white; color:rgb(3, 10, 10);">
								{{ @$starttime->timer_data ? $starttime->timer_data : '00:00:00' }}</div>
							<div id="break_timer" style="display: none; background-color: white; color:rgb(12, 207, 29);">
								{{ @$breaktime->timer_data ? $breaktime->timer_data : '00:00:00' }}</div>
						</div> --}}


                    <div class="times_track">
                        <small>
                            <a class="text-white" style="margin-right: 38px;">
                                <span class="timer show-task-timer d-none">00:00:00</span>
                            </a>
                        </small>
                        <h1 class="clock add-color" style="color: {{ $addClass }}">
                            <a href="#" class="time add-color" style="color: {{ $addClass }}"></a>
                            <sup class="am-pm add-color" style="color: {{ $addClass }}"></sup>
                        </h1>
                    </div>
                    <div class="time_popups" id="popUp">
                        <div class="pop_head">
                            <span class="dots"></span>
                            <span class="dots right"></span>
                            <h4 id="startduration" class="title-work">Working Day Duration</h4>
                            {{-- <h4 id="breakduration" style="diplay:none;">Break Duration</h4> --}}
							<h2 id="start_timer"  class="clockin_break_timer" style="color:#2dec2d;">00:00:00</h2>
                            {{-- <h2 id="start_timer"  style="display: block; background-color: white; color:#2dec2d;">
                                {{ @$starttime->timer_data ? $starttime->timer_data : '00:00:00' }}
							</h2>
                            <h2 id="break_timer" style="display: none; background-color: white; color:#db0a26;">
                                {{ @$breaktime->timer_data ? $breaktime->timer_data : '00:00:00' }}
							</h2> --}}
							<div class="clock-break-btn">
								<small>
									<button id="startButton" class="custom_btn break clock-btn" data-type="clockin"><i class="fa-solid fa-play"></i>
										Clock In
									</button>
								</small>
								{{-- <small>
									<button id="continueButton" class="custom_btn break clock-btn" data-type="continue" style="display: none;"><i class="fa-solid fa-play"></i>
										Continue
									</button>
									</small> --}}
								{{-- <small>
									<button id="breakButton" style="display: none;" class="custom_btn break clock-btn" data-type="break" ><i class="fa-solid fa-play"></i>
										Break
									</button>
									</small>
								<small>
									<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout" style="display: none;"> <i class="fa-solid fa-play"></i>
										Clock Out
									</button>
								</small> --}}
							</div>
                           
                        </div>
                    </div>
                @endif

                {{-- <div class="timer-section">
						<div class="dropdown">
							<div class="dropdown-toggle" data-bs-toggle="dropdown">
								<span class="clock">
									<span class="time">10:10</span>
									<span class="am-pm"></span>
								</span>
								<span class="text-white timer show-task-timer d-none">00:00:00</span>
							</div>
							<div class="dropdown-menu mt-1 task-list-section">
							</div>
						</div>
					</div> --}}

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
                                                <img alt=""
                                                    src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment
                                                        booking</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Tarah
                                                        Shropshire</span> changed the task name <span
                                                        class="noti-title">Appointment booking with payment
                                                        gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins
                                                        ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ url('panel/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Bernardo
                                                        Galaviz</span> added new task <span class="noti-title">Private
                                                        chat module</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
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
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
        <!-- /Header -->
