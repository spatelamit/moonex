@include("includes.header")

<div class="row">

<div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">My Setting</h4>
              <form class="forms-sample" method="post" action="{{ url('update_setting')}}"> 
                @csrf
                <div class="form-group row">
                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="{{ $setting->username }}" readonly>
                     <input type="hidden" value="{{ $setting->id }}" name="id">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email" value="{{ $setting->email }}"  name="email">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number"  value="{{ $setting->mobile}}" name="mobile">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password" name="confirm_password">
                  </div>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>

              </form>
            </div>
          </div>
        </div>
      </div>

@include("includes.footer");
