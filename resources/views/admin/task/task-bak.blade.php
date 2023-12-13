<x-header-component/> 
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("Task") }}</h4>
        <div class="card">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-header px-0">{{ __("Task List") }}</h5>
                    </div>          
                    <div class="col-md-4">
                        <form action="{{ route('sales.client.list.success') }}" method="post" class="align-items-center d-flex justify-content-center">
                            @csrf
                            <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                            <input type="submit" value="Search" class="btn ms-2 btn-info">
                        </form>                  
                    </div>         
                </div>
                <div class="text-nowrap table-responsive">
                    <span class="text-success">{{ Session::get('successmsg') }}</span>
                    <span class="text-danger">{{ Session::get('errmsg') }}</span>
                    <table class="table table-striped">
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
                    <tbody class="table-border-bottom-0">
                        @foreach($task as $val)               
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val -> project_name }}</strong></td>
                            <td>{{ $projectType[$val -> project_type] }}</td>
                            <td>{{ $val -> assign_by }}</td>
                            <td>{{ $val -> remarks }}</td>
                            <td>{{ date("d/m/Y", strtotime($val -> assign_date)) }}</td>   
                            <td>
                                <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('sales.view', ['salesid' => $val -> id ]) }}"
                                        ><i class="fa fa-eye"></i>Show</a>  
                                    <a class="dropdown-item" href="{{ route('comment.index', ['taskid' => $val -> id ]) }}"
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
<x-footer-component/>