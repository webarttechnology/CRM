@section('title', 'All Notifications')
@extends('admin.master.layout')

@section('content')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap);

        .section-50 {
            padding: 50px 0;
        }

        .m-b-50 {
            margin-bottom: 50px;
        }

        .dark-link {
            color: #333;
        }

        .heading-line {
            position: relative;
            padding-bottom: 5px;
        }

        .heading-line:after {
            content: "";
            height: 4px;
            width: 75px;
            background-color: #29B6F6;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .notification-ui_dd-content {
            margin-bottom: 30px;
        }

        .notification-lists {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 20px;
            margin-bottom: 7px;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .notification-list--unread {
            border-left: 2px solid #29B6F6;
        }

        .notification-lists .notification-list_contents {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .notification-lists .notification-list_contents .notification-list_img img {
            height: 48px;
            width: 48px;
            border-radius: 50px;
            margin-right: 20px;
        }

        .notification-lists .notification-list_contents .notification-list_details p {
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .notification-lists .notification-list_feature-img img {
            height: 48px;
            width: 48px;
            border-radius: 5px;
            margin-left: 20px;
        }
    </style>
    <div class="page-wrapper" style="min-height: 333px;">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="feather-check-square"></i>
                        </span> Notification <i class="fa fa-bell text-muted"></i>
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Notification</li>
                    </ul>
                </div>
            </div>

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <section class="section-50">
                                <div class="container">

                                    <div class="notification-ui_dd-contents">
                                        @foreach ($notify as $notification)
                                            @php
                                                // Calculate the time difference
                                                $timeDifference = $notification->created_at->diffForHumans();
                                            @endphp
                                            <div class="notification-lists notification-list--unread">
                                                <div class="notification-list_contents">
                                                    <div class="notification-list_img">
                                                        @if ($notification->user->user_image)
                                                            <img alt="" src="{{ url($notification->user->user_image) }}">
                                                        @else
                                                            <img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
                                                        @endif
                                                    </div>
                                                    <div class="notification-list_details">
                                                        <p><b>{{ optional($notification->user)->name ?? '' }}</b> ({{ $role[@$notification->user->role_id] }})</p>
                                                        <p class="text-muted"> {{ $notification->message }}</p>
                                                        <p class="text-muted"><small>{{ $timeDifference }}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /Content End -->
        </div>


        <!-- /Page Content -->
    </div>
@endsection
