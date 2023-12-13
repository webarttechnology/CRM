@section('title', 'Sales details')
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
                        </span>Sales details
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales details</li>
                    </ul>
                </div>
            </div>

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row justify-content-center">
                               <div class="col-md-12 row">
                               <h4 class="fw-bold py-3 mb-4 text-left">{{ __('Sales details' )}}</h4>
                                 <div class="col-md-2">Client Name :</div> <div class="col-md-4"> <span>{{ $data->client->name }}</span></div>  
                                 <div class="col-md-2">Project Name :</div> <div class="col-md-4"> <span>{{ $data ->project_name }}</span></div>  
                                 <div class="col-md-2">Project Type :</div> <div class="col-md-4"> <span>{{ $project_type[$data ->project_type] }}</span></div>
                                 @if($data ->technology)
                                 <div class="col-md-2">Technology :</div> <div class="col-md-4"> <span>{{ $technology[$data ->technology] }}</span></div>
                                 @endif
                                 @if($data ->type)
                                 <div class="col-md-2">Type:</div> <div class="col-md-4"> <span>{{ $technology_type[$data ->type] }}</span></div>
                                 @endif
                                 @if($data ->others)
                                 <div class="col-md-2">Others Details :</div> <div class="col-md-4"> <span>{{ $data ->others }}</span></div>
                                 @endif
                                 @if($data ->marketing_plan)
                                 <div class="col-md-2">Marketing Plan :</div> <div class="col-md-4"> <span>{{ $data ->marketing_plan. ' '. $data->smo_on }}</span></div>
                                 @endif
                                 @if($data ->start_date)
                                 <div class="col-md-2">Start Date :</div> <div class="col-md-4"> <span>{{ date('d/m/Y', strtotime($data ->start_date)) }}</span></div>
                                 @endif
                                 @if($data ->end_date)
                                 <div class="col-md-2">End Date :</div> <div class="col-md-4"> <span>{{ date('d/m/Y', strtotime($data ->end_date)) }}</span></div>
                                 @endif
                                 @if($data ->platform_name)
                                 <div class="col-md-2">Platform Name :</div> <div class="col-md-4"> <span>{{ $mobile[$data->platform_name] }}</span></div>
                                 @endif
       
                                 @if($data ->prefer_technology)
                                 <div class="col-md-2">Prefer Technology :</div> <div class="col-md-4"> <span>{{ $t_preferred[$data->prefer_technology] }}</span></div>
                                 @endif
       
                                 @if($data ->description)
                                 <div class="col-md-2">Description :</div><div class="col-md-4"> <span>{{ $data->description }}</span></div>
                                 @endif
       
                                 <div class="col-md-2">Business Name :</div> <div class="col-md-4"> <span>{{ $data -> business_name }}</span></div>
                                 <div class="col-md-2">Closer Name  :</div> <div class="col-md-4"> <span>{{ $data -> closer_name }}</span></div>
                                 <div class="col-md-2">Agent Name   :</div> <div class="col-md-4"> <span>{{ $data -> agent_name }}</span></div>
                                 <div class="col-md-2">Reference Site   :</div> <div class="col-md-4"> <span>{{ $data -> reference_sites }}</span></div>
                                 <div class="col-md-2">Remarks   :</div> <div class="col-md-4"> <span>{{ $data -> remarks }}</span></div>
                                 <div class="col-md-2">Gross Amount   :</div> <div class="col-md-4"> <span>{{ number_format($data -> gross_amount, 2) }}</span></div>
                                 <div class="col-md-2">Net Amount   :</div> <div class="col-md-4"> <span>{{ number_format($data -> net_amount, 2) }}</span></div>
                                 <div class="col-md-2">Due Amount  :</div> <div class="col-md-4"> <span>{{ number_format(($data -> gross_amount - saleDueamountCalculation($data ->id)), 2) }}</span></div>
                                 <div class="col-md-2">Sale Date  :</div> <div class="col-md-4"><span>{{ date('d/m/Y', strtotime($data -> sale_date) )}}</span></div>
                                 <div class="col-md-2">Payment Mode  :</div> <div class="col-md-4"><span>@foreach($payment as $i =>$val){{ $data -> payment_mode == $i?$val:'' }} @endforeach</span></div>
                                 @if($data ->other_payment_mode)
                                 <div class="col-md-2">Other Payment Mode  :</div> <div class="col-md-4"> <span>{{ $data->other_payment_mode }}</span></div>
                                 @endif
                                 <div class="col-md-3">Upsale Opportunities   :</div> <div class="col-md-8"> <span>{{ $data -> upsale_opportunities == ''?"-":$data -> upsale_opportunities }}</span></div>   
                               </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-4">                  
                        <div class="card-body">
                         <div class="row">
                            <div class="col-md-12 row">
                            <h4 class="fw-bold text-left">{{ __('Comemnt History' )}}</h4>
                            <section class="gradient-custom">
                              <div class="container">
                                <div class="row">
                                  <div class="col-md-12 col-lg-10 col-xl-12">
                                    @foreach($comment as $val)
                                    <div class="card mb-3">
                                      <div class="card-body p-4">                 
                                          <div class="row">
                                            <div class="col">
                                            <div class="d-flex flex-start">
                                              {{-- <img class="rounded-circle shadow-1-strong me-3"
                                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65"
                                                height="65" /> --}}
                                              <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                  <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                      {{ $val -> name }} <span class="small">- {{ date('d/m/Y h:i:s', strtotime($val -> date)) }}</span>
                                                    </p>
                                                  </div>
                                                  <p class="small mb-0">
                                                    It is a long established fact that a reader will be distracted by
                                                    the readable content of a page.
                                                  </p>
                                                </div>
                                              </div>
                                            </div>   
                                          </div> 
                                        </div>                                                            
                                      </div>
                                    </div>
                                    @endforeach  
                                  </div>
                                </div>
                              </div>
                            </section>
                            </div>
                         </div>   
                        </div>
                      </div>
                    </div>
                    
              </div>
            </div>
        </div>
        <!-- /Page Content -->
  </div>
@endsection
@section('script')
<script>
$("#status").change(function(){
    window.location.href = "/sales/list?status="+$("#status").val();
});
</script>
@endsection