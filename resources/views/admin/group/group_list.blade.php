@section('title', 'Group list')
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
                        </span> Group list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Group list</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-end">
                        <a href="#"
                            class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form"
                            data-type="add_group">Create Group</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-md-3">

                                        </div>
                                        <div class="col-md-3 pt-3">

                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('group.search') }}" method="post"
                                                class="align-items-center d-flex p-3 justify-content-center">
                                                @csrf
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="basic-addon-search31"><i
                                                            class="ion-ios7-search" data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="ion-ios7-search"
                                                            aria-label="ion-ios7-search"></i></span>
                                                    <input type="text" class="form-control" name="search"
                                                        placeholder="Search by group name..." aria-label="Search..."
                                                        aria-describedby="basic-addon-search31">
                                                </div>
                                                <input type="submit" value="Search" class="btn ms-2 btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                                                id="DataTables_Table_0" role="grid"
                                                aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Task Name: activate to sort column descending"
                                                            aria-sort="ascending">GROUP NAME</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label=": activate to sort column ascending">STATUS</th>
                                                        <th class="text-end sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Actions: activate to sort column ascending">ACTIONS
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($groupname as $val)
                                                        <tr>
                                                            <td><strong>{{ $val->name }}</strong></td>
                                                            <td>{{ $val->status }}</td>
                                                            <td class="text-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                            class="material-icons">more_vert</i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item  open-module-form"
                                                                            data-id="{{ $val->id }}"
                                                                            data-type="add_group"
                                                                            href="{{ route('group.update', ['updateid' => $val->id]) }}"><i
                                                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                        <a class="dropdown-item open-module-form"
                                                                            data-id="{{ $val->id }}"
                                                                            data-type="add_group" data-sale="invite"
                                                                            href="{{ route('group.invite', ['groupid' => $val->id]) }}"><i
                                                                                class="bx bx-edit-alt me-1"></i>Invite</a>
                                                                        <a class="dropdown-item open-module-forms"
                                                                            data-id="{{ $val->id }}"
                                                                            data-type="add_group" data-sale="viewmember"
                                                                            href="{{ route('group.viewmembers', ['groupid' => $val->id]) }}"><i
                                                                                class="bx bx-edit-alt me-1"></i>View Group
                                                                            Members</a>
                                                                        @if (Auth::user()->role_id == 1)
                                                                            <a class="dropdown-item"
                                                                                onclick="return confirm('Do you really want to delete this data?')"
                                                                                href="{{ route('group.delete', ['deleteid' => $val->id]) }}"><i
                                                                                    class="bx bx-trash me-1"></i>
                                                                                Delete</a>
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
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
@endsection
