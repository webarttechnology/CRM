
<div class="modal-header">
    <h4 class="modal-title text-center">Task details</h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 row">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <div>
                                            <h4 class="fw-bold py-3 mb-4 text-left">{{ __('Task details') }}</h4>
                                        </div>
                                       
                                    </div>

                                    <input type="hidden" id="job_id" value="{{ $data->id }}">
                             

                                    <div class="col-md-2">Project Name :</div>
                                    <div class="col-md-4"> <span>{{ $data->project_name }}</span></div>
                                    <div class="col-md-2">Task Title :</div>
                                    <div class="col-md-4"> <span>{{ $data->title }}</span></div>
                                    <div class="col-md-2">Task Details :</div>
                                    <div class="col-md-10"> <span>{!! $data->details !!}</span></div>
                                    <div class="col-md-2">Active Date :</div>
                                    <div class="col-md-4">
                                        <span>{{ date('jS M, h:i:s a', strtotime($data->start_date)) }}</span>
                                    </div>
                                    <div class="col-md-2">Deadline :</div>
                                    <div class="col-md-4">
                                        <span>{{ date('jS M, h:i:s a', strtotime($data->end_date)) }}</span>
                                    </div>
                                    <div class="col-md-2">Created By :</div>
                                    <div class="col-md-4"> <span>{{ $data->assign_by_name }}</span></div>
                                    <div class="col-md-2">Created Date :</div>
                                    <div class="col-md-4">
                                        <span>{{ date('d/m/Y h:i:s a', strtotime($data->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <table
                                        class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr>
                                                <th>Created At</th>
                                                <th>Created By</th>
                                                <th>Time Elapsed</th>
                                            </tr>
                                        </thead>    
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($workhistory as $key => $val)
                                            <tr>
                                                <td>{{ $val->created_at->format('d-M-Y') }}</td>
                                                <td>{{ @$val->users->name}}</td>
                                                <td>{{ $val->currenttime}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
