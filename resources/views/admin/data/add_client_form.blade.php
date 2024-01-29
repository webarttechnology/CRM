<div class="modal-header">
        <h4 class="modal-title text-center">{{ $client_data  ? 'Update Client' : 'Add Client' }} </h4>
        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <div class="row">
        <div class="col-md-12">
         @if ($client_data)
         <form method="post" action="{{ route('sales.client.update.suceess') }}" class="save">
         <input type="hidden" name="update_id" id="update_id" value="{{ $client_data->id }}"/>
         @else
         <form method="post" action="{{ route('sales.client.insert.suceess') }}" class="save">
         @endif
                @csrf
                <div class="row">
                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="name">Client Name<span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name"
                                placeholder="John Doe" value="{{ $client_data  ?  $client_data->name : null }}" />
                        @if ($errors->has('name'))
                                <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                        @endif
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="country_name">{{ __('Country name') }} <span
                                class="text-danger">*</span></label>
                        <select name="country_name" id="country_name" class="form-control">
                                <option value="">Select</option>
                                @foreach (country() as $val)
                                <option value="{{ $val['name'] }}"  {{ $client_data?->country_name == $val['name'] ? 'Selected' : '' }}>
                                        {{ $val['name'] . ' (' . $val['code'] . ')' }}
                                </option>
                                @endforeach
                        </select>
                        @if ($errors->has('country_name'))
                                <small class="text-danger"
                                id="country_nameerrmsg">{{ $errors->first('country_name') }}</small>
                        @endif
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="email">{{ __('Email ID(Primary)') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                                placeholder="jhon.doe@gmail.com" value="{{ $client_data  ?  $client_data->email : null }}" />
                        @if ($errors->has('email'))
                                <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                        @endif
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="address">{{ __('Address') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address"
                                placeholder="1A, Ho Chi Minh Sarani Rd" value="{{ $client_data  ?  $client_data->address : null }}" />
                        @if ($errors->has('email'))
                                <small class="text-danger"
                                id="addresserrmsg">{{ $errors->first('address') }}</small>
                        @endif
                        </div>
                        <div class="col-md-5 mb-3">
                        <label class="form-label" for="email">{{ __('Email ID') }}</label>
                        <input type="email" class="form-control" id="alteremail" name="alteremail[]"
                                placeholder="xyz@gmail.com" />
                        </div>
                        <div class="col-md-5 mb-3">
                        <label class="form-label" for="address">{{ __('Mobile No') }}</label>
                        <input type="text" class="form-control" id="mobile_no1" name="mobile_no[]" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                placeholder="+998889823" minlength="10"
                                maxlength="10" />
                        </div>



                        <div class="col-md-2 mb-3">
                        <span id="addrow" class="btn btn-primary mt-4"><i class="fa fa-plus"></i></span>
                        </div>
                        <span id="multipleimage">
                                @if ($client_data)
                                @for($i = 1; $i <count($client_data->contact_details); $i++)
                                        <div class="row" id="{{ 'deleterow'.$i }}"> 
                                            <div  class="col-md-5">
                                                <label class="form-label" for="email">{{ __("Email ID") }}</label>
                                                <input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" value="{{ $client_data->contact_details[$i]->email_id }}"/>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label" for="address">{{ __("Mobile No") }}</label>
                                                <input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="9000090909" oninput="this.value = this.value.replace(/\D/g, '')" value="{{ $client_data->contact_details[$i]->mobile_no }}"/>
                                            </div> 
                                            <div class="col-md-2"> 
                                                <span class="btn btn-danger mt-4"  onclick="deleteRow({{ $i }})"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                            </div> 
                                        </div>
                                    @endfor
                                @endif
                        </span>

                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="current_website">{{ __('Current Website') }}</label>
                        <input type="text" class="form-control" id="current_website" name="current_website"
                                placeholder="webart.technology" value="{{ $client_data  ?  $client_data->current_website : null }}" />
                        @if ($errors->has('current_website'))
                                <small class="text-danger"
                                id="current_websiteerrmsg">{{ $errors->first('current_website') }}</small>
                        @endif
                        </div>

                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="agent_name">{{ __('Agent Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="agent_name" id="agent_name" class="form-control"
                                placeholder="Agent name" value="{{ $client_data  ?  $client_data->agent_name : null }}">
                        @if ($errors->has('agent_name'))
                                <small class="text-danger"
                                id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                        @endif
                        </div>

                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="closer_name">{{ __('Closer Name') }}</label>
                        <input type="text" name="closer_name" id="closer_name" class="form-control"
                                placeholder="Closer name" value="{{ $client_data  ?  $client_data->closer_name : null }}">
                        @if ($errors->has('closer_name'))
                                <small class="text-danger"
                                id="closer_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                        @endif
                        </div>

                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="remarks">{{ __('Remarks') }}</label>
                        <textarea class="form-control" id="remarks" name="remarks" placeholder="Your remarks here...">{{ $client_data ? $client_data->remarks : null }}</textarea>
                        @if ($errors->has('remarks'))
                                <small class="text-danger"
                                id="remarkserrmsg">{{ $errors->first('remarks') }}</small>
                        @endif
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-12 text-center">
                        <button type="submit"  class="border-0 btn btn-primary btn-gradient-primary btn-rounded form-submit">{{ $client_data ? 'Update' : 'Save' }}</button>
                        </div>
                </div>
                </form>
        </div>
        </div>
</div>
