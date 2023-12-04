<div class="col-xl-12 dasboardTeb">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
           Sales
          </button>
        </li>
       
        @if(Auth::user() -> role_id == 1 || Auth::user() -> role_id == 2)
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
           Upsales
          </button>
        </li>
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
            <div class="table-responsive text-nowrap">
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
        </div>
        <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
            <div class="table-responsive text-nowrap">
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