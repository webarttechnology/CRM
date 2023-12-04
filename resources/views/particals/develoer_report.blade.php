<div class="col-xl-12 dasboardTeb">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
           Tasks
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
        <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                    <th>Sales name</th>
                    <th>Assign By</th>
                    <th>Task title</th>
                    <th>Start date & time</th>             
                    <th>end date & time</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($task as $val)
                <tr>
                    <td>{{ $val->project_name }}</td>
                    <td>{{ $val->assign_by_name }}</td>
                    <td>{{ $val -> title }}</td>
                    <td>{{ date("d/m/Y h:i:s A", strtotime($val -> start_date)) }}</td>
                    <td>{{ date("d/m/Y h:i:s A", strtotime($val -> end_date)) }}</td>
                     <td>{{ date("d/m/Y", strtotime($val -> created_at)) }}</td>
                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if($isEdit == 1)
                            <a class="dropdown-item clickEdit" href="javascript:void(0)" data-id="{{ $val -> id }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>                               
                            @endif
                            @if($isDelete == 1)
                            <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')" href="{{ route('developer.task.delete', ['deleteid' => $val -> id]) }}"
                            ><i class="bx bx-trash me-1"></i> Delete</a>
                            @endif
                            @if($isShow == 1)
                            <a class="dropdown-item" href="{{ route('developer.task.show', ['id' => $val -> id]) }}"
                                ><i class="bx bx-trash me-1"></i> Show</a>
                            @endif
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
    </div>
  </div>
</div>