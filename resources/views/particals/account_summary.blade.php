<div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 mb-4">
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
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 col-md-12 col-12 mb-4">
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
                  <a class="dropdown-item" href="{{ route('sales.new.list') }}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Sales Net</span>
            <h3 class="card-title text-nowrap mb-1 fs-5">${{ number_format($sale_net,2) }}</h3>
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 mb-4">
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
                  <a class="dropdown-item" href="{{ route('upsale.list') }}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Upsales Gross</span>
            <h3 class="card-title mb-2 fs-5">${{ number_format($upsale_gross, 2) }}</h3>
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 col-md-12 col-12 mb-4">
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
            <span class="fw-semibold d-block mb-1">Upsales Net</span>
            <h3 class="card-title text-nowrap mb-1 fs-5">${{ number_format($upsale_net, 2) }}</h3>
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 mb-4">
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
                  <a class="dropdown-item" href="{{ route('collection.list') }}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Collection</span>
            <h3 class="card-title mb-2 fs-5">${{ number_format($collection, 2) }}</h3>
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
          </div>
        </div>
      </div>           
    </div>
  </div>