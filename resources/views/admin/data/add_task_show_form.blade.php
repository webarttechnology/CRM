<style>
  body {
      background-color: #f4f7f6;
      margin-top: 20px;
  }

  .card {
      background: #fff;
      transition: .5s;
      border: 0;
      margin-bottom: 30px;
      border-radius: .55rem;
      position: relative;
      width: 100%;
      box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
  }

  .chat-app .people-list {
      width: 280px;
      position: absolute;
      left: 0;
      top: 0;
      padding: 20px;
      z-index: 7
  }

  .chat-app .chat {
      /* margin-left: 280px; */
      border-left: 1px solid #eaeaea
  }

  .people-list {
      -moz-transition: .5s;
      -o-transition: .5s;
      -webkit-transition: .5s;
      transition: .5s
  }

  .people-list .chat-list li {
      padding: 10px 15px;
      list-style: none;
      border-radius: 3px
  }

  .people-list .chat-list li:hover {
      background: #efefef;
      cursor: pointer
  }

  .people-list .chat-list li.active {
      background: #efefef
  }

  .people-list .chat-list li .name {
      font-size: 15px
  }

  .people-list .chat-list img {
      width: 45px;
      border-radius: 50%
  }

  .people-list img {
      float: left;
      border-radius: 50%
  }

  .people-list .about {
      float: left;
      padding-left: 8px
  }

  .people-list .status {
      color: #999;
      font-size: 13px
  }

  .chat .chat-header {
      padding: 15px 20px;
      border-bottom: 2px solid #f4f7f6
  }

  .chat .chat-header img {
      float: left;
      border-radius: 40px;
      width: 40px
  }

  .chat .chat-header .chat-about {
      float: left;
      padding-left: 10px
  }

  .chat .chat-history {
      padding: 20px;
      border-bottom: 2px solid #fff
  }

  .chat .chat-history ul {
      padding: 0
  }

  .chat .chat-history ul li {
      list-style: none;
      margin-bottom: 30px
  }

  .chat .chat-history ul li:last-child {
      margin-bottom: 0px
  }

  .chat .chat-history .message-data {
      margin-bottom: 15px
  }

  .chat .chat-history .message-data img {
      border-radius: 40px;
      width: 40px
  }

  .chat .chat-history .message-data-time {
      color: #434651;
      padding-left: 6px
  }

  .chat .chat-history .message {
      color: #444;
      padding: 18px 20px;
      line-height: 26px;
      font-size: 16px;
      border-radius: 7px;
      display: inline-block;
      position: relative
  }

  .chat .chat-history .message:after {
      bottom: 100%;
      left: 7%;
      border: solid transparent;
      content: " ";
      height: 0;
      width: 0;
      position: absolute;
      pointer-events: none;
      border-bottom-color: #fff;
      border-width: 10px;
      margin-left: -10px
  }

  .chat .chat-history .my-message {
      background: #efefef
  }

  .chat .chat-history .my-message:after {
      bottom: 100%;
      left: 30px;
      border: solid transparent;
      content: " ";
      height: 0;
      width: 0;
      position: absolute;
      pointer-events: none;
      border-bottom-color: #efefef;
      border-width: 10px;
      margin-left: -10px
  }

  .chat .chat-history .other-message {
      background: #e8f1f3;
      text-align: right
  }

  .chat .chat-history .other-message:after {
      border-bottom-color: #e8f1f3;
      left: 93%
  }

  .chat .chat-message {
      padding: 20px
  }

  .online,
  .offline,
  .me {
      margin-right: 2px;
      font-size: 8px;
      vertical-align: middle
  }

  .online {
      color: #86c541
  }

  .offline {
      color: #e47297
  }

  .me {
      color: #1d8ecd
  }

  .float-right {
      float: right
  }

  .clearfix:after {
      visibility: hidden;
      display: block;
      font-size: 0;
      content: " ";
      clear: both;
      height: 0
  }

  @media only screen and (max-width: 767px) {
      .chat-app .people-list {
          height: 465px;
          width: 100%;
          overflow-x: auto;
          background: #fff;
          left: -400px;
          display: none
      }

      .chat-app .people-list.open {
          left: 0
      }

      .chat-app .chat {
          margin: 0
      }

      .chat-app .chat .chat-header {
          border-radius: 0.55rem 0.55rem 0 0
      }

      .chat-app .chat-history {
          height: 300px;
          overflow-x: auto
      }
  }

  @media only screen and (min-width: 768px) and (max-width: 992px) {
      .chat-app .chat-list {
          height: 650px;
          overflow-x: auto
      }

      .chat-app .chat-history {
          height: 600px;
          overflow-x: auto
      }
  }

  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
      .chat-app .chat-list {
          height: 480px;
          overflow-x: auto
      }

      .chat-app .chat-history {
          height: calc(100vh - 350px);
          overflow-x: auto
      }
  }

  .chat-about ul {
      list-style: none;
      display: grid;
      grid-template-columns: auto auto;
  }
  .zip-pdf-file {
     cursor: pointer;
  }
  .upload-img {
     padding: 8px;
     border-radius: 4px;
     border: 1px solid #dee2e6;
     width: 33%;
     cursor: pointer;
  }

 .file-download {
    cursor: pointer;
 }
</style>
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
                                              class="text-white countdown{{ $data->id }}">{{ $jobStatus?->currenttime ?? '0:00:00' }}</time>
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
                              <input type="text" class="form-control textmessage" id="myInputMessage" placeholder="Enter text here...">
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
                              <thead>
                                  <tr>
                                      <th>Created At</th>
                                      <th>Created By</th>
                                      <th>Time Elapsed</th>
                                  </tr>
                              </thead>    
                              <tbody class="table-border-bottom-0">
                                  @foreach ($workhistory as $key => $val)
                                  <tr>
                                      <td>{{ $val->created_at->format('d-M-Y') }}</td>
                                      <td>{{ @$val->users->name}}</td>
                                      <td>{{ $val->currenttime}}</td>
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