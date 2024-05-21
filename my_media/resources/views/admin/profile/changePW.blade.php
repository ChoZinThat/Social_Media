@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">



                @if (Session::has('fail'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{Session::get('fail')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @endif

            <form class="form-horizontal" method="POST" action="{{route('admin#changePassword')}}">
                @csrf
                <div class="form-group row">
                  <label for="oldPassword" class="col-sm-4 col-form-label">Old Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control"
                           id="oldPassword" name="oldPassword" placeholder="Enter Your Old Password"
                           >
                    @error('oldPassword')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="newPassword" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control"
                             id="newPassword" name="newPassword" placeholder="Enter Your New Password"
                             >
                      @error('newPassword')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control"
                             id="confirmPassword" name="confirmPassword" placeholder="Enter Your Confrim Password"
                             >
                      @error('confirmPassword')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-8 ">
                      <input type="submit" value="Change Passwrod" class="btn btn-dark">
                    </div>
                  </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
