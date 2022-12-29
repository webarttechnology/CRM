<x-header-component/> 
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("New Sales list") }}</h4>
        <div class="card">
        <h5 class="card-header">{{ __("New Sales list") }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
            <thead>
                <tr>
                <th>Client name</th>
                <th>Project name</th>
                <th>Project type</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                <td>Albert Cook</td>
                <td>Laravel</td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
                </tr>                   
            </tbody>
            </table>
        </div>
        </div>             
    </div>    
<x-footer-component/>