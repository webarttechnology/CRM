<div class="modal-header">
    <h4 class="modal-title text-center">{{ $upsale_data ? 'Update Upsales' : 'Add Upsales' }} </h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            @if ($upsale_data)
                <form method="post" action="{{ route('upsale.update.success') }}" class="form-save save">
                    <input type="hidden" name="update_id" id="update_id" value="{{ $upsale_data->id }}">
                @else
                    <form method="post" action="{{ route('upsale.add.success') }}" class="form-save save">
            @endif

            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="client_name">{{ __('Client name') }} <span
                            class="text-danger">*</span></label>
                    <select name="client_id" id="client_id" class="form-control" onchange="getproject();">
                        <option value="">--Select--</option>
                        @foreach ($getClients as $val)
                            <option value="{{ $val['id'] }}"
                                {{ $val['id'] == $upsale_data?->client_id ? 'Selected' : '' }}>
                                {{ $val['name'] . ' (' . $val['client_code'] . ')' }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('client_id'))
                        <small class="text-danger" id="client_iderrmsg">{{ $errors->first('client_id') }}</small>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="project_id">{{ __('Project Name') }} <span
                            class="text-danger">*</span></label>
                    <select name="project_id" id="project_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($project as $val)
                            <option value="{{ $val->id }}"
                                {{ $val->id == $upsale_data?->sale_id ? 'Selected' : '' }}>{{ $val->project_name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('project_id'))
                        <small class="text-danger">{{ $errors->first('project_id') }}</small>
                    @endif
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="upsale_type">{{ __('Upsale Product') }} <span
                            class="text-danger">*</span></label>
                    <select name="upsale_type" id="upsale_type" class="form-control"
                        onchange="projectTypechangeEvent()">
                        <option value="">--Select--</option>
                        @foreach (upsale_type() as $key => $val)
                            <option value="{{ $key }}"
                                {{ $key == $upsale_data?->upsale_type ? 'Selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('upsale_type'))
                        <small class="text-danger" id="upsale_typeerrmsg">{{ $errors->first('upsale_type') }}</small>
                    @endif
                </div>
            </div>
            <div class="row" id="div_hosting">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="start_date">{{ __('Start Date') }} <span
                            class="text-danger">*</span></label>
                    @if ($upsale_data?->start_date)
                        <input type="date" name="start_date" id="start_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime($upsale_data?->start_date)) }}">
                    @else
                        <input type="date" name="start_date" id="start_date" class="form-control" min="{{ date('Y-m-d') }}">
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="end_date">{{ __('End Date') }}</label>
                    @if ($upsale_data?->end_date)
                        <input type="date" name="end_date" id="end_date" class="form-control"  min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime($upsale_data?->end_date)) }}">
                    @else
                        <input type="date" name="end_date" id="end_date" class="form-control" min="{{ date('Y-m-d') }}">
                    @endif
                </div>
            </div>

            <div class="row" id="div_other">
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="other">{{ __('Others Description') }}</label>
                    <textarea name="other" id="other" class="form-control" placeholder="Other Description">{{ $upsale_data?->others }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="gross_amt">{{ __('Gross Amount') }} </label>
                    <input type="number" name="gross_amt" id="gross_amt" class="form-control pendingamount" min="1"
                        placeholder="$" value="{{ $upsale_data?->gross_amount }}">
                    @if ($errors->has('gross_amt'))
                        <small class="text-danger">{{ $errors->first('gross_amt') }}</small>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="net_amt">{{ __('Net Amount') }} </label>
                    <input type="number" name="net_amt" id="net_amt" class="form-control pendingamount" min="1"
                        placeholder="$" value="{{ $upsale_data?->net_amount }}">
                    @if ($errors->has('net_amt'))
                        <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="due_amt">{{ __('Due Amount') }} </label>
                    <input type="text" readonly name="due_amt" id="due_amt" class="form-control"
                        placeholder="$" value="{{ $upsale_data?->gross_amount - $upsale_data?->net_amount }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="sale_date">{{ __('Sale Date') }} <span
                            class="text-danger">*</span></label>
                    @if ($upsale_data?->sale_date)
                        <input type="date" name="sale_date" id="sale_date" class="form-control"  min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime($upsale_data?->sale_date)) }}">
                    @else
                        <input type="date" name="sale_date" id="sale_date" class="form-control"
                            min="{{ date('Y-m-d') }}">
                    @endif
                    @if ($errors->has('sale_date'))
                        <small class="text-danger">{{ $errors->first('sale_date') }}</small>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="payment_mode">{{ __('Payment Mode') }}</label>
                    <select name="payment_mode" id="payment_mode" class="form-control"
                        onchange="paymentonchangeevent()">

                        <option value="">--Select--</option>
                        @php
                            $payment = payment_mode();
                        @endphp
                        @foreach ($payment as $i => $val)
                            <option value="{{ $i }}"
                                {{ $i == $upsale_data?->payment_mode ? 'Selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('payment_mode'))
                        <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                    @endif
                </div>
                <div class="col-md-12 mb-3" id="div_other_pay">
                    <label class="form-label" for="other_pay">{{ __('Payment Description') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="other_payment_mode" id="other_payment_mode" class="form-control"
                        placeholder="Description" vlaue="{{ $upsale_data?->other_payment_mode }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit"
                        class="btn btn-primary mt-5 form-submit">{{ $upsale_data ? 'Update' : 'Submit' }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#div_other_pay").hide();
        // $("#div_hosting").hide();
        $("#div_other").hide();
    });


    $(".pendingamount").keyup(function() {
        const grossAmount = $("#gross_amt").val() ? parseInt($("#gross_amt").val()) : '0'
        const netAmount = $("#net_amt").val() ? parseInt($("#net_amt").val()) : '0'

        if (grossAmount >= netAmount) {
            const pendingAmount = grossAmount - netAmount;
            $("#due_amt").val(pendingAmount);
        } else {
            toastr.error('Net amount must be lower than gross amount!');
            $("#net_amt").focus();
            $("#net_amt").css({
                "border-color": "red",
                "border-width": "1px",
                "border-style": "solid"
            });
            $("#due_amt").val(0);
        }
    })


    function projectTypechangeEvent() {
        if ($("#upsale_type").val() == 1) {
            $("#div_hosting").show();
            $("#div_other").hide();
        } else if ($("#upsale_type").val() == 2) {
            $("#div_hosting").show();
            $("#div_other").hide();
        } else if ($("#upsale_type").val() == 3) {
            $("#div_hosting").show();
            $("#div_other").hide();
        } else if ($("#upsale_type").val() == 4) {
            $("#div_hosting").hide();
            $("#div_other").show();
        }

    }


    function customerOnchangeEvent() {
        if ($("#technology_type").val() == 5) {
            $('#div_customer_requirment').show();
        } else {
            $('#div_customer_requirment').hide();
        }
    }


    function smonclickEvent() {
        if ($("#smo").is(":checked")) {
            $('.div_smo').show();
        } else if ($("#seo_smo").is(":checked")) {
            $('.div_smo').show();
        } else {
            $('.div_smo').hide();
        }
    }


    function paymentonchangeevent() {
        if ($("#payment_mode").val() == 6) {
            $("#div_other_pay").show();
        } else {
            $("#div_other_pay").hide();
        }
    }

    function getproject() {
        $.ajax({
            type: 'GET',
            url: "/upsales/get-project",
            data: {
                client_id: $("#client_id").val()
            },
            cache: false,
            success: function(response) {
                $("#project_id").html(response);
            }
        });
    }
</script>
