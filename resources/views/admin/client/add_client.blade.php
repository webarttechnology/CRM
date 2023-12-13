@section('title', 'Client Add')
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
                        </span> Client Add
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Client Add</li>
                    </ul>
                </div>
            </div>
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <span class="text-success">{{ Session::get('successmsg') }}</span>
                          <form method="post" action="{{ route('sales.client.insert.suceess') }}" class="save" onsubmit="return valid();">
                            @csrf
                            <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">Client Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ old('name') }}" />
                                        @if($errors->has('name'))
                                        <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="country_name">{{ __("Country name") }} <span class="text-danger">*</span></label>
                                        <select name="country_name" id="country_name" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($countries as $val)
                                            <option value="{{ $val['name'] }}" {{ (old('country_name') == $val['name'])?'Selected':'' }}>{{ $val['name'].' ('.$val['code'].')' }}</option>
                                            @endforeach    
                                        </select>
                                        @if($errors->has('country_name'))
                                        <small class="text-danger" id="country_nameerrmsg">{{ $errors->first('country_name') }}</small>
                                        @endif
                                    </div>   
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="email">{{ __("Email ID(Primary)") }} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ old('email') }}"/>
                                        @if($errors->has('email'))
                                        <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>  
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="1A, Ho Chi Minh Sarani Rd" value="{{ old('address') }}"/>
                                        @if($errors->has('email'))
                                        <small class="text-danger" id="addresserrmsg">{{ $errors->first('address') }}</small>
                                        @endif
                                    </div>   
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label" for="email">{{ __("Email ID") }}</label>
                                        <input type="email" class="form-control" id="alteremail" name="alteremail[]" placeholder="xyz@gmail.com" />
                                    </div>  
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label" for="address">{{ __('Mobile No') }}</label>
                                        <input type="text" class="form-control" id="mobile_no1" name="mobile_no[]" placeholder="+998889823" />
                                    </div>    
                                    <div class="col-md-2 mb-3">
                                   
                                        <span id="addrow" class="btn btn-primary mt-4" ><i class="fa fa-plus" ></i></span>
                                    </div>   
                                    <span id="multipleimage"></span>  
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="current_website">{{ __('Current Website') }}</label>
                                        <input type="text" class="form-control" id="current_website" name="current_website" placeholder="webart.technology" value="{{ old('current_website') }}"/>
                                        @if($errors->has('current_website'))
                                        <small class="text-danger" id="current_websiteerrmsg">{{ $errors->first('current_website') }}</small>
                                        @endif
                                    </div>  
    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="agent_name">{{ __('Agent Name') }} <span class="text-danger">*</span></label>                                    
                                        <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Agent name" value="{{ old('agent_name') }}">     
                                        @if($errors->has('agent_name'))
                                        <small class="text-danger" id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                                        @endif                             
                                    </div> 
    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="closer_name">{{ __('Closer Name') }} <span class="text-danger">*</span></label>                                    
                                        <input type="text" name="closer_name" id="closer_name" class="form-control" placeholder="Closer name" value="{{ old('closer_name') }}">     
                                        @if($errors->has('closer_name'))
                                        <small class="text-danger" id="closer_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                                        @endif                            
                                    </div> 
    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="remarks">{{ __('Remarks') }} <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="remarks" name="remarks" placeholder="Your remarks here...">{{ old('current_website') }}</textarea>
                                        @if($errors->has('remarks'))
                                        <small class="text-danger" id="remarkserrmsg">{{ $errors->first('remarks') }}</small>
                                        @endif   
                                    </div> 
                            </div>                        
                             <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-5">Send</button>
                                </div>
                             </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
  </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
           let lineNo = 2;     
            $("#addrow").click(function () {         
                markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5"><label class="form-label" for="email">{{ __("Email ID") }}</label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" /></div> <div class="col-md-2"> <span class="btn btn-danger mt-4"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
                tableBody = $("#multipleimage");
                tableBody.append(markup);
                lineNo++;
            }); 
    }); 
    function deleteRow(lineno){
            $("#deleterow"+lineno).click(function () {    
                $('#deleterow'+lineno).remove();
            });
    }
    
    function valid(){
        if($("#name").val() == ""){
            toastr.error('Client name is a require field!');
            $("#name").focus();
            $("#name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#country_name").val() == ""){
            toastr.error('Country name is a require field!');
            $("#country_name").focus();
            $("#country_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#email").val() == ""){
            toastr.error('Email id is a require field!');
            $("#email").focus();
            $("#email").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#address").val() == ""){
            toastr.error('Address is a require field!');
            $("#address").focus();
            $("#address").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#agent_name").val() == ""){
            toastr.error('Agent name is a require field!');
            $("#agent_name").focus();
            $("#agent_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#closer_name").val() == ""){
            toastr.error('Closer name is a require field!');
            $("#closer_name").focus();
            $("#closer_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#remarks").val() == ""){
            toastr.error('Remark is a require field!');
            $("#remarks").focus();
            $("#remarks").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }    
    }
</script>
@endsection