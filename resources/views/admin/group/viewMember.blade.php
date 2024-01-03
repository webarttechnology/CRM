<div class="modal-header">
    <h4 class="modal-title text-center">All Member</h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr role="row">
                        <th>NAME</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group_member as $data)
                        <tr>
                            <td>
                                <strong>{{ $data->user->name }}</strong>
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item  open-module-form" data-id="{{ $data->id }}"
                                            data-type="add_group"
                                            href=""><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
