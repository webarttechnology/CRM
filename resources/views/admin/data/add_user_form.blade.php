<div class="modal-header">
    <h4 class="modal-title text-center">{{ $user_data ? 'Update User' : 'Add User' }} </h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            @if ($user_data)
                <form method="post" action="{{ route('user.update.success') }}" enctype="multipart/form-data"
                    class="save" autocomplete="off">
                    <input type="hidden" name="update_id" id="update_id" value="{{ $user_data->id }}">
                @else
                    <form method="post" action="{{ route('user.add.success') }}" enctype="multipart/form-data"
                        class="save" autocomplete="off">
            @endif

            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="name">Full name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe"
                        value="{{ $user_data?->name }}" />
                    @if ($errors->has('name'))
                        <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="email">{{ __('Email ID') }} <span
                            class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="jhon.doe@gmail.com" value="{{ $user_data?->email }}" />
                    @if ($errors->has('email'))
                        <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="mobile_no">{{ __('Mobile No') }}</label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="+998889823" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        value="{{ $user_data?->mobile_no }}" />
                </div>


                <div class="col-md-6 mb-3">
                    <label class="form-label" for="role">{{ __('Role') }}<span
                        class="text-danger">*</span></label>
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($role->toArray() as $key => $r)
                            @if (Auth::user()->role_id == 5 && in_array($key, ['6', '7', '8']))
                                <option value="{{ $key }}" {{ $key == $user_data?->role_id ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @elseif (Auth::user()->role_id == 9 && in_array($key, ['3']))
                            <option value="{{ $key }}" {{ $key == $user_data?->role_id ? 'selected' : '' }}>
                                {{ $r }}
                            </option>
                            @elseif (Auth::user()->role_id == 10 && in_array($key, ['4']))
                            <option value="{{ $key }}" {{ $key == $user_data?->role_id ? 'selected' : '' }}>
                                {{ $r }}
                            </option>
                            @elseif(Auth::user()->role_id == 1)
                                <option value="{{ $key }}" {{ $key == $user_data?->role_id ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('role_id'))
                        <small class="text-danger" id="role_id">{{ $errors->first('role_id') }}</small>
                    @endif
                </div>

                @if ($user_data == null)
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="password">{{ __('Password') }}<span
                                class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" />
                            <i class="fa-solid fa-eye position-absolute" id="toggle-password"
                                style="top: 14px; right:10px;"></i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="confirm_password">{{ __('Confirm Password') }}<span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm Password" />
                    </div>
                @endif

                <div class="col-md-6">
                    <label class="form-label" for="role">{{ __('Status') }}</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="">Select</option>
                        <option value="1" {{ $user_data?->is_active == 1 ? 'Selected' : '' }}>Active</option>
                        <option value="0" {{ $user_data?->is_active == 0 ? 'Selected' : '' }}>Inactive</option>
                    </select>
                    @if ($errors->has('is_active'))
                        <small class="text-danger" id="is_active">{{ $errors->first('is_active') }}</small>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="role">{{ __('Profile Image') }}</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" />
                    @if ($user_data?->user_image)
                        <input type="hidden" name="old_image" value="{{ $user_data->user_image }}">
                        <div class="my-3">
                            <img src="{{ url($user_data->user_image) }}" width="100" alt="image">
                        </div>
                    @endif
                    @if ($errors->has('profile_image'))
                        <small class="text-danger" id="profile_image">{{ $errors->first('profile_image') }}</small>
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-5 form-submit">Send</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>


