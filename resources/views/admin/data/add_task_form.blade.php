<div class="modal-header">
    <h4 class="modal-title text-center">{{ $task ? 'Update Developer Task' : 'Add Developer Task' }}</h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <form id="taskform" action="{{ route('developer.task.success') }}" class="container save" method="post">
        <div class="row">
            <div class="col-md-12">
                @if ($task)
                    <input type="hidden" name="update_id" id="update_id" value="{{ $task->id }}" />
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="name">Project Name <span class="text-danger">*</span></label>
                        <select name="sale_id" id="sale_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($sales as $key => $item)
                                <option value="{{ $key }}" {{ $key == $task?->sale_id ? 'Selected' : '' }}>{{ $item }} </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="sale_id_formerrmsg"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="assign_type">{{ __('Assign Type') }} <span
                                class="text-danger">*</span></label>
                        <select name="assign_type" id="assign_type" class="form-control">
                            <option value="">Select Type</option>
                            @foreach (role() as $key => $val)
                                <option value="{{ $key }}" {{ $key == $role?->role_id ? 'Selected' : '' }}>
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="assigntype_formerrmsg"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="dynamic_assign_to">
                            <label class="form-label" for="assign_to">{{ __('Assign to') }} <span
                                    class="text-danger">*</span></label> <br>
                            <select name="assign_to[]" id="assign_to" multiple="multiple"
                                class="form-control js-example-basic-multiple">
                                {{-- <option value="">Select</option> --}}
                                @foreach ($developer as $key => $val)
                                    <option value="{{ $key }}"
                                        {{ in_array($key, $array_match) == true ? 'Selected' : '' }}>
                                        {{ $val }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger"
                                id="assignto_formerrmsg">{{ $errors->first('assign_to') }}</small>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="title">{{ __('Title') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Task Title" value="{{ $task?->title }}">
                        <small class="text-danger" id="title_formerrmsg">{{ $errors->first('title') }}</small>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="details">{{ __('Details') }} <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="details" name="details" placeholder="Task Details">{{ $task?->details }}</textarea>
                        <small class="text-danger" id="details_formerrmsg">{{ $errors->first('details') }}</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="start_date">{{ __('Start Date & Time') }} <span
                                class="text-danger">*</span></label>
                        @if ($task?->start_date)
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                value="{{ $task?->start_date }}" />
                        @else
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                min="{{ date('Y-m-d') }}T00:00" />
                        @endif
                        <small class="text-danger"
                            id="start_date_formerrmsg">{{ $errors->first('start_date') }}</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="end_date">{{ __('End Date & Time') }} <span
                                class="text-danger">*</span></label>
                        @if ($task?->end_date)
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                value="{{ $task?->end_date }}" />
                        @else
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                min="{{ date('Y-m-d') }}T00:00" />
                        @endif
                        <small class="text-danger" id="end_date_formerrmsg">{{ $errors->first('end_date') }}</small>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="remarks">{{ __('Remarks') }}</label>
                        <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks">{{ $task?->remarks }}</textarea>
                        <small class="text-danger" id="remarks_formerrmsg">{{ $errors->first('remarks') }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary submit-btn" name="submit" id="submit"
                value="{{ $task ? 'Update' : 'Save' }}">
        </div>
    </form>
    </div>

</div>
</div>
</div>
