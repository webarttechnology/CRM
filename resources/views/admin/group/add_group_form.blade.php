<div class="modal-header">
    <h4 class="modal-title text-center">{{ $group_data ? 'Update Group' : 'Add Group' }} </h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">

            @if ($group_data)
                <form method="post" action="{{ route('group.update.suceess') }}" class="form-save">
                    <input type="hidden" name="update_id" value="{{ $group_data->id }}" />
                @else
                    <form method="post" action="{{ route('group.new.insert.suceess') }}" class="form-save">
            @endif
            @csrf
            <div class="row">

                <div class="col-md-12 mb-3" id="div_group_name">
                    <label class="form-label" for="group_name">{{ __('Group Name') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="group_name" id="group_name" class="form-control"
                        placeholder="Group Name" value="{{ $group_data?->name }}">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="group_type">{{ __('Group Type') }}<span
                        class="text-danger">*</span></label>
                <select name="group_type" id="group_type" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Deal" @if ($group_data?->type === 'Deal') selected @endif>Deal</option>
                    <option value="Work" @if ($group_data?->type === 'Work') selected @endif>Work</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit"
                        class="btn btn-primary mt-5 form-submit">{{ $group_data ? 'Update' : 'Submit' }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script></script>
