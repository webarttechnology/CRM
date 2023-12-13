<x-header-component/> 
<x-nav-component/>

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{{ __('Update profile' )}}</h4>
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                        <span class="text-success">{{ Session::get('successmsg') }}</span>
                        <span class="text-danger">{{ Session::get('errmsg') }}</span>
                      <form method="post" action="{{ route('user.add.success') }}"  autocomplete="off" id="editprofile" enctype="multipart/form-data">
                        <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">Full name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ $userDetails->name }}" />
                                    <small class="text-danger" id="name_errmsg"></small>
                                </div>
                            
                                <div class="col-md-6">
                                    <label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ $userDetails->email }}"/>
                                    <small class="text-danger" id="email_errmsg">{{ $errors->first('email') }}</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="mobile_no">{{ __('Mobile No') }}</label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="+998889823" value="{{ $userDetails->mobile_no }}"/>
                                    <small class="text-danger" id="mobile_no_errmsg">{{ $errors->first('mobile_no') }}</small>
                                </div>   
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="image">{{ __('Image') }}</label>
                                    <input type="file" class="form-control" id="image" name="image"/>
                                </div> 

                                <div class="col-md-12">
                                    <label class="form-label" for="bio">{{ __('Personal Details') }}</label>
                                    <textarea class="form-control" id="bio" name="bio" placeholder="Personal Details">{{ $userDetails->bio }}</textarea>
                                    <small class="text-danger" id="bio_errmsg">{{ $errors->first('bio') }}</small>
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
            </div>
<x-footer-component/>

<script>
$(document).ready(function(){
    $("#editprofile").on("submit", function(){      
             
            event.preventDefault();
            $('[id*=_errmsg]').text('');
            if($("#name").val() == ""){
                $('#name_errmsg').text("Name is a required field");
                $('#name_errmsg').focus();
                return false;
            }else if($("#email").val() == ""){
                $('#email_errmsg').text("Email is a required field");
                return false;
            }else if($("#mobile_no").val() == ""){
                $('#mobile_no_errmsg').text("Moile no is a required field");
                return false;
            }else if($("#bio").val() == ""){
                $('#bio_errmsg').text("Personal details is a required field");
                return false;
            }else{               
                const xCsrfToken = "{{ csrf_token() }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': xCsrfToken
                    }
                });

                var myformData = new FormData();
                var photo = $('#image').prop('files')[0];
                myformData.append('name', $("#name").val());
                myformData.append('email', $("#email").val());
                myformData.append('mobile_no', $("#mobile_no").val());
                myformData.append('bio', $("#bio").val());
                myformData.append('image', photo);

                $.ajax({
                  url: "{{ route('user.profile.success') }}",
                  type:"POST",
                  enctype: 'multipart/form-data',
                  processData: false, // tell jQuery not to process the data
                  contentType: false, // tell jQuery not to set contentType
                  data:myformData,
                    success:function(response){
                        if(response.status == 1){
                            $(".text-success").text(response.successmsg)
                            $('#exampleModal').modal('hide');
                            window.location.href = "/developer/task";                          
                        }else{
                            $(".text-err").text(response.errmsg)
                        }
                    },
                    error: function(response) {  
                        $('#sale_id_formerrmsg').text(response.responseJSON.errors.sale_id);
                        $('#assignto_formerrmsg').text(response.responseJSON.errors.assign_to);
                        $('#title_formerrmsg').text(response.responseJSON.errors.title);
                        $('#details_formerrmsg').text(response.responseJSON.errors.details);
                        $('#start_date_formerrmsg').text(response.responseJSON.errors.start_date);
                        $('#end_date_formerrmsg').text(response.responseJSON.errors.end_date);
                    },
                })
            }


          

        })
})
</script>