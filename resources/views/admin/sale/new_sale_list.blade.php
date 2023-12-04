<x-header-component/> 
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("Sales list") }}</h4>
        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-header">{{ __("Sales list") }}</h5>
                </div>          
                <div class="col-md-3 pt-3">
                    <div class="input-group input-group-merge">
                        <select name="status" id="status" class="form-control">
                            <option value="">Search by status</option>
                            @foreach (projectstatus() as $val)
                            <option value="{{ $val }}" {{ $status == $val?'Selected':'' }}>{{ $val }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('sales.new.list.success') }}" method="post" class="align-items-center d-flex p-3 justify-content-center">
                        @csrf
                        <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Search by project name & client name..." aria-label="Search..." aria-describedby="basic-addon-search31">
                        </div>
                        <input type="submit" value="Search" class="btn ms-2 btn-info">
                    </form>                  
                </div>         
            </div>
            <div class="row">
                <div class="tab-content">
                    <div class="table-responsive text-nowrap">
                        <span class="text-success">{{ Session::get('successmsg') }}</span>
                        <span class="text-danger">{{ Session::get('errmsg') }}</span>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>Client name</th>
                                <th>Project name</th>
                                <th>Assign to</th>
                                <th>Project type</th>
                                <th>Closer name</th>
                                <th>Gross amount</th>
                                <th>Net amount</th>
                                <th>Sale date</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($data as $val)
                                <tr class={{ Auth::user()->id ==1?getcommentstatus($val->id)==0?'text-danger':'':'' }}>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val -> client_name }}</strong></td>
                                <td>{{ $val -> project_name }}</td>
                                <td>{{  assignto($val->id) }}</td>
                                <td>{{ $projectType[$val -> project_type] }}</td>
                                <td>{{ $val -> closer_name }}</td>
                                <td>{{ number_format($val -> gross_amount, 2) }}</td>
                                <td>{{ number_format($val -> net_amount, 2) }}</td>
                                <td>{{ date("d/m/Y", strtotime($val -> sale_date)) }}</td>
                                <td>{{ $val->status }}</td>
                                <td>
                                    <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('sales.update', ['updateid' => $val -> id ]) }}"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('sales.view', ['salesid' => $val -> id ]) }}"
                                            ><i class="fa fa-eye"></i> Show</a>
                                        @if(Auth::user() ->role_id < 3 )
                                        <a class="dropdown-item" href="{{ route('sales.assign', ['taskid' => $val -> id ]) }}"
                                            ><i class="bx bx-edit-alt me-1"></i> Assign</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('comment.index', ['taskid' => $val -> id ]) }}"
                                            ><i class="bx bx-edit-alt me-1"></i>Comment</a> 
                                       
                                        @if(Auth::user() ->role_id == 1)
                                        <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')"  href="{{ route('sales.delete', ['deleteid' => $val -> id]) }}"
                                        ><i class="bx bx-trash me-1"></i> Delete</a>
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
<x-footer-component/>

<script>
    $("#status").change(function(){
        window.location.href = "/sales/list?status="+$("#status").val();
    })
</script>