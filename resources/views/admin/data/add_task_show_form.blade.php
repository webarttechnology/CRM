
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
                                        <div class="btn btn-info">
                                            <time id="timer"
                                                class="text-white countdown{{ $data->id }}">{{ taskTime($taskid)['timeformat'] }}</time>
                                        </div>
                                    </div>

                                    <input type="hidden" id="job_id" value="{{ $data->id }}">
                                    <input type="hidden" id="running" value="{{ $running }}">
                                    <input type="hidden" id="paused" value="{{ $paused }}">

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
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-center">
                    <div class="px-1 clonebtn">
                        @if ($jobStatus?->final_status == '')
                            <button class="btn btn-warning text-white timer-btn" data-id="{{ $data->id }}"
                                data-type="start">Start Task</button>
                        @elseif($jobStatus?->final_status == 'start')
                            <button class="btn btn-danger text-white timer-btn" data-id="{{ $data->id }}"
                                data-type="stop">Stop Task</button>
                        @elseif($jobStatus?->final_status == 'stop')
                            <button class="btn btn-warning text-white timer-btn" data-id="{{ $data->id }}"
                                data-type="start">Start Task</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="chat">

          <div class="chat-history">
              <ul class="m-b-0" id="message">

              </ul>
          </div>
          <div class="chat-message clearfix">
              <div class="input-group mb-0">
                  <input type="hidden" value="{{ $taskid }}" id="task_id">
                  <input type="text" class="form-control textmessage" placeholder="Enter text here...">
                  <div class="input-group-prepend">
                      <span class="input-group-text py-3"><i class="fa fa-send sendmessage"></i></span>
                  </div>
              </div>
          </div>
      </div> --}}

        <div class="card p-3 shadow" style="max-width: 1000px;">
            {{-- <h2 class="text-center p-3">Card with Tabs</h2> --}}
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Comments</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Details</button>
                </div>
            </nav>
            <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="chat">

                        <div class="chat-history">
                            <div id="message"></div>
                            {{-- <ul class="m-b-0" id="message">

                          </ul> --}}
                            <div id="filePreview"></div>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <input type="file" id="fileInput" style="display: none;">
                                    <span class="input-group-text py-3 file-send" id="uploadButton">
                                        <i class="fas fa-sync fa-spin d-none"></i>
                                        <i class="fas fa-paperclip"></i>
                                    </span>
                                </div>
                                <input type="hidden" value="{{ $taskid }}" id="task_id">
                                <input type="text" class="form-control textmessage" id="myInputMessage"
                                    placeholder="Enter text here...">
                                <div class="input-group-prepend">
                                    <span class="input-group-text py-3"><i class="fa fa-send sendmessage"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table
                                class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                                id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                @php
                                    $startDateEntry = null;
                                    $endDateEntry = null;
                                @endphp
                                <thead>
                                    <tr>
                                        @if (Auth::user()->role_id == 1)
                                            <th>User</th>
                                        @endif
                                        <th>Date</th>
                                        <th>Start</th>
                                        <th>Stop</th>
                                        <th>Time Elapsed</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($workhistory as $key => $entries)
                                        @if ($entries->final_status == 'start')
                                            @php
                                                $startDateEntry = $entries->created_at;
                                            @endphp
                                        @else
                                            @php
                                                $endDateEntry = $entries->created_at;
                                            @endphp
                                        @endif
                                        @if ($startDateEntry && $endDateEntry)
                                            <tr>
                                                @if (Auth::user()->role_id == 1)
                                                    <td>{{ @$entries->users->name }}</td>
                                                @endif
                                                <td>{{ $entries->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $startDateEntry->format('H:i:s') }}</td>
                                                <td>{{ $endDateEntry->format('H:i:s') }}</td>
                                                <td>{{ TaskTimeTotal($startDateEntry, $endDateEntry)['timeformat'] }}
                                                </td>
                                            </tr>

                                            @php
                                                $startDateEntry = null;
                                                $endDateEntry = null;
                                            @endphp

                                        @endif
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
