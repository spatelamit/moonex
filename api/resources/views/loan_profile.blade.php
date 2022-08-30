@include('includes.header')

<?php 

//SELECT `user_id`, `mobile`, `PAN`, `aadhar`, `firstname`, `lastname`, `fathername`, `dob`, `address`, `city`, `state`, `pincode`, `aadhar_f`, `aadhar_b`, `AccountNumber`, `IFSC`, `BranchName`, `NameAsAccount`, `amount`, `LastOTP`, `PAN_image`, `office_address`, `office_company_name`, `office_city`, `office_state`, `office_country`, `office_pincode`, `office_email`, `office_contact`, `kyc_status`, `loan_status`, `gender`

?>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kyc  User Profile</h4>
                  <form class="form-sample" action="{{ url('save_profile') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                   <!--  <p class="card-description">
                      Personal info
                    </p> -->
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->firstname}}" name="firstname" />
                             <input type="hidden"  value="{{ $user->id}}" name="id" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->lastname}}"  name="lastname" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->mobile}}" name="mobile" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="male" checked>
                                Male
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="female">
                                Female
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">PAN</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $user->PAN}}" name="PAN"  />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">PAN Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="form-control" name="PAN_image"  />
                              </div>
                            </div>
                              <img src="/documents/{{ $user->PAN_image}}"  class="img-responsive" width="90%">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Aadhar </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->aadhar}}" name="aadhar" />
                          </div>
                        </div>
                      </div>
                          <div class="row">
                            <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-12 col-form-label">Aadhar front side</label>
                              <div class="col-sm-9">
                                <input type="file" class="form-control" name="aadhar_f" />
                              </div>
                            </div>
                            <img src="/documents/{{ $user->aadhar_f}}"  class="img-responsive" width="90%">

                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-12 col-form-label">Aadhar Back side</label>
                              <div class="col-sm-9">
                                <input type="file" class="form-control"  name="aadhar_b" />
                              </div>
                            </div>
                            <img src="/documents/{{ $user->aadhar_b}}"  class="img-responsive" width="90%">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Father Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->fathername}}" name="fathername"  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">DOB</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" value="{{ $user->dob}}" name="dob" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address Name</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="address" >{{ $user->address }}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">city</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->city}}" name="city" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->state}}" name="state" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pin</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->pincode}}"  name="pincode" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">AccountNumber</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->AccountNumber}}" name="AccountNumber"  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">   IFSC  </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->   IFSC }}" name="IFSC" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">BranchName</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->BranchName}}" name="BranchName"  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">NameAsAccount </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->NameAsAccount}}" name="NameAsAccount" />
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_address </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_address}}" name="office_address" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_company_name </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_company_name }}" name="office_company_name"  />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_city  </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_city}}" name="office_city" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_state </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_state }}" name="office_state"  />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_country </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_country}}" name="office_country" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_pincode </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_pincode }}" name="office_pincode"  />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">office_email </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_email}}" name="office_email" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> office_contact  </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->office_contact }}" name="office_contact"  />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">

                         <label class="col-sm-3 col-form-label">Kyc Status</label>
                          <div class="col-sm-9">
                            <select class="form-control" required name="kyc_status">
                              <option disabled>Change Kyc Status </option>
                              <option <?php echo $user->kyc_status==1? "selected=true": "" ?> value="1">Approved</option>
                              <option  <?php echo $user->kyc_status==2? "selected=true": "" ?> value="2">Rejected</option>
                              <option  <?php echo $user->kyc_status==0? "selected=true": "" ?> value="0">Pending</option>
                            </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Loan Amount </label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $user->amount }}" name="amount"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group row">

                         <label class="col-sm-4 col-form-label">Loan Status</label>
                          <div class="col-sm-8">
                            <select class="form-control" required name="loan_status">
                              <option disabled>Change Loan Status </option>
                              <option <?php echo $user->loan_status==1? "selected=true": "" ?> value="1">Approved</option>
                              <option <?php echo $user->loan_status==2? "selected=true": "" ?> value="2">Rejected</option>
                              <option <?php echo $user->loan_status==0? "selected=true": "" ?> value="0">Pending</option>
                            </select>
                          </div>

                        </div>
                      </div>

                    </div> 
                    <input type="submit" name="" >

                   <!--  
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control">
                              <option>Category1</option>
                              <option>Category2</option>
                              <option>Category3</option>
                              <option>Category4</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Membership</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked>
                                Free
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
                                Professional
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Address
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select class="form-control">
                              <option>America</option>
                              <option>Italy</option>
                              <option>Russia</option>
                              <option>Britain</option>
                            </select>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>

                @include('includes.footer')