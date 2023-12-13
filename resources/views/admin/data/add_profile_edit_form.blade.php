<div class="modal-header">
        <h4 class="modal-title text-center">Profile Update</h4>
        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.add.success') }}"  autocomplete="off" id="editprofile" enctype="multipart/form-data">
              @csrf
            <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="name">Full name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ $userDetails->name }}" />
                        <small class="text-danger" id="name_errmsg"></small>
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ $userDetails->email }}"/>
                        <small class="text-danger" id="email_errmsg">{{ $errors->first('email') }}</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="mobile_no">{{ __('Mobile No') }}</label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="+998889823" value="{{ $userDetails->mobile_no }}"/>
                        <small class="text-danger" id="mobile_no_errmsg">{{ $errors->first('mobile_no') }}</small>
                    </div>   
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="image">{{ __('Image') }}</label>
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div> 

                    <div class="col-md-12 mb-3">
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

<script>

</script>
