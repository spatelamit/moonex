@include('includes.header')
  <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Reports</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      
                      <thead>
                        <tr>
                          <th>#No.</th>
                          <th>Fullname</th>
                          <th>Mobile</th>
                          <th>Address</th>
                           <th>Amount</th>
                          <th>KYC Status</th>
                          <th>Loan Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr class="table-info">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{$user->firstname}}  {{$user->lastname}}</td>
                          <td>{{$user->mobile}}</td>
                          <td>{{$user->address}}</td>
                          <td>{{$user->amount}}</td>
                          <td>
                            @if($user->kyc_status==0)
                              <button class="btn btn-warning"> Kyc Pending </button>
                            @elseif($user->kyc_status==1)
                            <button class="btn btn-success"> Kyc Completed</button>
                            @elseif($user->kyc_status==2)
                            <button class="btn btn-danger"> Kyc Rejected</button>
                            @endif
                          </td>
                          <td>
                            @if($user->loan_status==0)
                              <button class="btn btn-warning"> Loan Pending </button>
                            @elseif($user->loan_status==1)
                            <button class="btn btn-success"> Loan Completed</button>
                            @elseif($user->loan_status==2)
                            <button class="btn btn-danger"> Loan Rejected</button>
                            @endif
                          </td>
                          <td><a href="loan_profile/{{$user->id}}">View Profile</a></td>
                        </tr>
                        @endforeach
                        
                      </tbody>

                    </table>
                       {!! $users->withQueryString()->links('pagination::bootstrap-4') !!} 

                  </div>
                </div>
              </div>
            </div>
          </div>


  @include('includes.footer')