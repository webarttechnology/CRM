@section('title', 'Task list')
@extends('admin.master.layout')
@section('content')
    <div class="page-wrapper" style="min-height: 333px;">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="feather-check-square"></i>
                        </span>Task list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Task list</li>
                    </ul>
                </div>
            </div>
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-md-4">
                                          
                                        </div>          
                                        <div class="col-md-4 pt-3">
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{ route('sales.client.list.success') }}" method="post" class="align-items-center d-flex justify-content-center">
                                                @csrf
                                                <div class="input-group input-group-merge">
                                                <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                                <input type="text" class="form-control" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                                </div>
                                                <input type="submit" value="Search" class="btn ms-2 btn-primary">
                                            </form> 
                                        </div>         
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid"  aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Project name</th>
                                                        <th>Project Type</th>
                                                        <th>Assign By</th>
                                                        <th>Remarks</th>
                                                        <th>Assign Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($task as $val)               
                                                    <tr>
                                                        <td>{{ ++$loop->index }}</td>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val->project_name }}</strong></td>
                                                        <td>{{ $projectType[$val->project_type] }}</td>
                                                        <td>{{ $val->assign_by }}</td>
                                                        <td>{{ Str::limit($val->remarks, 30, '...') }}</td>
                                                        <td>{{ date("d/m/Y", strtotime($val->assign_date)) }}</td>   
                                                        <td>
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="{{ route('sales.view', ['salesid' => $val->id ]) }}"
                                                                        ><i class="fa fa-eye"></i>Show</a>  
                                                                    <a class="dropdown-item open-module-form" data-id="{{ $val->id }}" data-type="add_sales" data-sale="comment" href="{{ route('comment.index', ['taskid' => $val->id ]) }}"
                                                                    ><i class="bx bx-edit-alt me-1"></i>Comment</a>
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
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
  </div>
@endsection

@section('script')
<script>
$(function(){

    $(document).on("click", '.sendmessage', function(e) {
          $.ajax({
                 type:'GET',
                 url:'{{route("comment.add.success")}}',
                 data: 'message='+$(".textmessage").val()+'&task_id='+$("#task_id").val(),
                 success:function(data) {
                  getMessage();
                  $(".textmessage").val('');
                 }
          });
       });
  
  
      const getMessage = () => {
          $.ajax({
                  type:'GET',
                  url:'{{route("comment.list")}}',
                  data: 'task_id='+$("#task_id").val(),
                  success:function(data) {
                  $("#message").html(data);
                  }
          });
      }

});
</script>
@endsection