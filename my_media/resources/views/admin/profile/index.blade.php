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

                @if (Session::has('updated'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{Session::get('updated')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @endif

                <form class="form-horizontal" method="POST" action="{{route('admin#accountUpdate')}}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"
                           id="inputName" name="adminName" placeholder="Enter Your Name"
                           value="{{old('adminName',$user->name)}}">
                    @error('adminName')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control"
                           id="inputEmail" name="adminEmail" placeholder="Enter Your Email"
                           value="{{old('adminEmail',$user->email)}}">
                    @error('adminEmail')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control"
                             id="inputPhone" name="adminPhone" placeholder="Enter Your Phone"
                             value="{{old('adminPhone',$user->phone)}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="adminAddress" class="form-control"
                                id="inputAddress" cols="30" rows="5" placeholder="Enter Your Address">{{old('adminAddress',$user->address)}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="adminGender" class="form-control">
                        <option value="" @if ($user->gender == null)selected @endif>Choose your option...</option>
                        <option value="male" @if ($user->gender == "male")selected @endif>Male</option>
                        <option value="female" @if ($user->gender == "female")selected @endif>Female</option>
                      </select>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{route('admin#PWchange')}}">Change Password</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
