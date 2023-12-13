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

        @if(Auth::user() -> role_id == 1)
          @include('particals.admin_summary')
        @endif  

        @if(Auth::user() -> role_id == 2)
          @include('particals.account_summary')
        @endif 

        @if(Auth::user() -> role_id == 6)
          @include('particals.task_summary')
        @endif 

        @if(Auth::user() -> role_id == 7)
           @include('particals.task_summary')
        @endif 
        
        
        
      </div>

      <div class="row"> 
        @if(Auth::user() -> role_id == 1)   
        @include('particals.admin-sale-report');
        @endif  

        @if(Auth::user() -> role_id == 2)   
        @include('particals.accounts_sale_report');
        @endif

        @if(Auth::user() -> role_id == 3)   
        @include('particals.admin-sale-report');
        @endif

        @if(Auth::user() -> role_id == 4)   
        @include('particals.admin-sale-report');
        @endif

        @if(Auth::user() -> role_id == 5)   
        @include('particals.admin-sale-report');
        @endif

        @if(Auth::user() -> role_id == 6)   
        @include('particals.develoer_report');
        @endif

        @if(Auth::user() -> role_id == 7)   
        @include('particals.develoer_report');
        @endif
        
      </div> 
 

<x-footer-component/>