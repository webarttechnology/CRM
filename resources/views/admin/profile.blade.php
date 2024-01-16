@section('title', 'Profile')
@extends('admin.master.layout')
@section('content')
<div class="page-wrapper" style="min-height: 363px;">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="feather-user"></i>
                </span> {{ __('Employee Profile') }} </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Employee Profile') }}</li>
                </ul>
            </div>
        </div>
        <!-- Page Header -->
        <div class="page-header pt-3 mb-0">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                              @if (Auth::user()->user_image)
                                              <img alt="" src="{{ url(Auth::user()->user_image) }}">
                                              @else
                                              <img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
                                              @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Auth::user()->name }}</h3>
                                                <h6 class="text-muted">{{ role()[Auth::user()->role_id] }}</h6>
                                                {{-- <small class="text-muted">Web Designer</small> --}}
                                                {{-- <div class="staff-id">Employee ID : FT-0001</div> --}}
                                                <div class="small doj text-muted">Date of Join : {{ Auth::user()->created_at->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="#">{{ Auth::user()->mobile_no }}</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="#"><span class="__cf_email__" data-cfemail="7d171215131912183d18051c100d1118531e1210">{{ Auth::user()->email }}</span></a></div>
                                                </li>
                                                {{-- <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text">24th July</div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">1861 Bayonne Ave, Manchester Township, NJ, 08759</div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">Male</div>
                                                </li> --}}
                                                {{-- <li>
                                                    <div class="title">Reports to:</div>
                                                    <div class="text">
                                                       <div class="avatar-box">
                                                          <div class="avatar avatar-xs">
                                                             <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                                          </div>
                                                       </div>
                                                       <a href="profile.html">
                                                            Jeffery Lalor
                                                        </a>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a  class="edit-icon open-module-form" data-type="profile"  href="#" title="Profile Edit" ><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
    </div>
    <!-- /Page Content -->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){

        // $(document).on("submit", "#editprofile", function(event) {

        //         event.preventDefault();
                
        //         $('[id*=_errmsg]').text('');

        //         if($("#name").val() == ""){
        //             $('#name_errmsg').text("Name is a required field");
        //             $('#name_errmsg').focus();
        //             return false;
        //         }else if($("#email").val() == ""){
        //             $('#email_errmsg').text("Email is a required field");
        //             return false;
        //         }else if($("#mobile_no").val() == ""){
        //             $('#mobile_no_errmsg').text("Moile no is a required field");
        //             return false;
        //         }else if($("#bio").val() == ""){
        //             $('#bio_errmsg').text("Personal details is a required field");
        //             return false;
        //         }else{               
        //             const xCsrfToken = "{{ csrf_token() }}";
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': xCsrfToken
        //                 }
        //             });
    
        //             var myformData = new FormData();
        //             var photo = $('#image').prop('files')[0];
        //             myformData.append('name', $("#name").val());
        //             myformData.append('email', $("#email").val());
        //             myformData.append('mobile_no', $("#mobile_no").val());
        //             myformData.append('bio', $("#bio").val());
        //             myformData.append('image', photo);

        //             console.log(photo);
    
        //             $.ajax({
        //               url: "{{ route('user.profile.success') }}",
        //               type:"POST",
        //               enctype: 'multipart/form-data',
        //               processData: false, // tell jQuery not to process the data
        //               contentType: false, // tell jQuery not to set contentType
        //               data:myformData,
        //                 success:function(response){
        //                     if(response.status == 1){
        //                         $(".text-success").text(response.successmsg)
        //                         setTimeout(function(){ // wait for 1 secs(1000)
        //                             location.reload(); // then reload the page
        //                         }, 1000);                  
        //                     }else{
        //                         $(".text-err").text(response.errmsg)
        //                     }
        //                 },
        //                 error: function(response) {  
        //                     $('#name_errmsg').text(response.responseJSON.errors.name);
        //                     $('#email_errmsg').text(response.responseJSON.errors.email);
        //                     $('#mobile_no_errmsg').text(response.responseJSON.errors.mobile_no);
        //                 },
        //             })
        //         }
        // });
    });
</script>  
@endsection