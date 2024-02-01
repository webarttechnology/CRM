@section('title', 'Log History Tree')
@extends('admin.master.layout')
@section('content')
    <div class="page-wrapper" style="min-height: 333px;">
        <!-- Page Content -->
        <div class="content container-fluid">

            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="feather-check-square"></i>
                        </span>Log History
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Log History</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-end">
                       
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
           <div>
            <ul class="tree">
                <li>
                    <div class="sticky">{{ $client->name }}</div>
                    <ul>
                        @foreach ($client->sale as $project)
                        <li>
                            <div class="sticky">{{ $project->project_name }}</div>
                            <ul>
                                 @foreach (App\Models\LogHistory::where('sale_id', $project->id)->where('client_id', $client->id)->get()->groupBy('user_id')  as $user_id => $tasks )
                                    <li>
                                        @php
                                        $user = App\Models\User::find($user_id);
                                        @endphp
                                        <div>{{ $user->name }}</div>
                                        <ul>
                                            @foreach ($tasks as $item)
                                            <li>
                                                <div>{{ $item->remark }}
                                                 <span class="d-block">{{ $item->created_at }}</span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                 @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>    
          </div> 
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
@endsection

