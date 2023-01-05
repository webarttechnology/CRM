<x-header-component/> 
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("Client list") }}</h4>
        <div class="card">
        <div class="row">
            <div class="col-md-8">
                <h5 class="card-header">{{ __("Client list") }}</h5>
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
        <div class="text-nowrap">
        <span class="text-success">{{ Session::get('successmsg') }}</span>
        <span class="text-danger">{{ Session::get('errmsg') }}</span>
        <table class="table table-striped table-responsive ">
            <thead>
                <tr>
                <th>ClientId</th>
                <th>Client name</th>
                <th>Email ID</th>
                <th>Address</th>
                <th>Agent name</th>
                <th>Closer name</th>
                <th>Created at</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($data as $val)               
                <tr>
                    <td>{{ $val -> client_code }}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val -> name }}</strong></td>
                    <td>{{ $val -> email }}</td>
                    <td>{{ $val -> address }}</td>
                    <td>{{ $val -> agent_name }}</td>
                    <td>{{ $val -> closer_name }}</td>
                    <td>{{ date("d/m/Y", strtotime($val -> created_at)) }}</td>
                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('sales.client.update', ['updateid' => $val -> id ]) }}"
                            ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                            @if(Auth::user() -> role_id == 1)
                            <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')" href="{{ route('sales.client.delete', ['deleteid' => $val -> id]) }}"
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
<x-footer-component/>