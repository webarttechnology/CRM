<x-header-component/>
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Congratulations {{ Auth::user() ->name }}! 🎉</h5>
                  <p class="mb-4">
                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                    your profile.
                  </p>

                  <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        @if(Auth::user() -> role_id != 3)
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/chart-success.png"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('sales.new.list') }}">View More</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Sales Gross</span>
                  <h3 class="card-title mb-2 fs-5">${{ number_format($sale_gross,2) }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
              </div>
            </div>
            
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/chart-success.png"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt6"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="{{ route('upsale.list') }}">View More</a>
                      </div>
                    </div>
                  </div>
                  <span>Sales net</span>
                  <h3 class="card-title text-nowrap mb-1 fs-5">${{ number_format($sale_net,2) }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/wallet-info.png"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('sales.new.list') }}">View More</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Upsales Gross</span>
                  <h3 class="card-title mb-2 fs-5">${{ number_format($upsale_gross, 2) }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
              </div>
            </div>
            
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/wallet-info.png"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt6"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="{{ route('upsale.list') }}">View More</a>
                      </div>
                    </div>
                  </div>
                  <span>Upsales net</span>
                  <h3 class="card-title text-nowrap mb-1 fs-5">${{ number_format($upsale_net, 2) }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/chart-success.png"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('sales.new.list') }}">View More</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Collection</span>
                  <h3 class="card-title mb-2 fs-5">${{ number_format($collection, 2) }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
              </div>
            </div>
            
           
          </div>
        </div>
        @endif     
      </div>
     
      <div class="row">
      
      <div class="col-xl-12">
          <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3" role="tablist">
              <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                 Sales
                </button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                 Upsales
                </button>
              </li>
              @if(Auth::user() -> role_id != 3)
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
                  Collections
                </button>
              </li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
              <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Client name</th>
                        <th>Project name</th>
                        <th>Gross Amount</th>
                        <th>Net Amount</th>
                        <th>Agent name</th>
                        <th>Closer name</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($sales as $val)
                      <tr>
                        <td>{{ $val -> client_name }}</td>
                        <td>{{ $val -> project_name }}</td>
                        <td>{{ number_format($val -> gross_amount, 2) }}</td>
                        <td>{{ number_format($val -> net_amount, 2) }}</td> 
                        <td>{{ $val -> agent_name }}</td>  
                        <td>{{ $val -> closer_name }}</td>                     
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
              <table class="table">
                    <thead>
                      <tr>
                        <th>Client name</th>
                        <th>Project name</th>
                        <th>Gross Amount</th>
                        <th>Net Amount</th>
                        <th>Due Amount</th>
                        <th>Sale Date</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($upsales as $val)
                      <tr>
                        <td>{{ $val -> client_name }}</td>
                        <td>{{ $val -> project_name }}</td>                      
                        <td>{{ number_format($val -> gross_amount, 2) }}</td>
                        <td>{{ number_format($val -> net_amount, 2) }}</td>
                        <td>{{ number_format($val -> gross_amount - $val -> net_amount, 2) }}</td>
                        <td>{{ date("d/m/Y", strtotime($val -> sale_date)) }}</td>  
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
              <table class="table">
                    <thead>
                      <tr>
                        <th>Client name</th>
                        <th>Project name</th>
                        <th>Currency</th>
                        <th>Net Amount</th>
                        <th>Instalment</th>
                        <th>Payment Mode</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($collections as $val)
                      <tr>
                        <td>{{ $val -> client_name}}</td>
                        <td>{{ $val -> project_name }}</td>
                        <td>{{ $currency[$val -> currency] }}</td>
                        <td>{{ number_format($val -> net_amount, 2) }}</td>
                        <td>{{ $isntalment[$val -> instalment]}}</td>
                        <td>{{ $val -> payment_mode != 6?$paymentmode[$val -> payment_mode]:$val -> other_payment_mode }}</td>
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
 

<x-footer-component/>