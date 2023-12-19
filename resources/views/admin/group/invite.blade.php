<div class="modal-header">
    <h4 class="modal-title text-center">Invite</h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('group.new.invite') }}" class="form-save">
                @csrf
                <div class="row">
                    <input type="hidden" value="{{$groupid}}" name="groupid" id="groupid">
                    <div class="col-md-12 mb-3" id="div_email">
                        <label class="form-label" for="group_name">{{ __('Email') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="email" id="email" class="form-control"
                            placeholder="email" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit"
                            class="btn btn-primary mt-5 form-submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script></script>
