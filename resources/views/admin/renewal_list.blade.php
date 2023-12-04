<x-header-component/> 
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("Renewal list") }}</h4>
        <div class="card">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-header px-0">{{ __("Renewal list") }}</h5>
                    </div>          
                </div>
                <div class="text-nowrap table-responsive">
                    <span class="text-success">{{ Session::get('successmsg') }}</span>
                    <span class="text-danger">{{ Session::get('errmsg') }}</span>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Client name</th>
                        <th>Email ID</th>
                        <th>Project name</th>
                        <th>Renewal for</th>
                        <th>Renewal Data</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($sales as $val)               
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val -> name.' ('. $val -> client_code.' )' }}</strong></td>
                            <td>{{ $val -> email }}</td>
                            <td>{{ $val -> project_name }}</td>
                            <td>{{ $project_type[$val -> project_type] }}</td>
                            <td>{{ date("d/m/Y", strtotime($val -> end_date)) }}</td>                        
                        </tr> 
                        @endforeach

                        @foreach($upsales as $uval)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $uval -> name.' ('. $uval -> client_code.' )' }}</strong></td>
                            <td>{{ $uval -> email }}</td>
                            <td>{{ $uval -> project_name }}</td>
                            <td>{{ $upsale_type[$uval -> upsale_type] }}</td>
                            <td>{{ date("d/m/Y", strtotime($uval -> end_date)) }}</td>                        
                        </tr>
                        @endforeach
                                       
                    </tbody>
                    </table>
                </div>
            </div>
        </div>             
    </div>    
<x-footer-component/>