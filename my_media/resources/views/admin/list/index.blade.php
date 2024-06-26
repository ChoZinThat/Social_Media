@extends('admin.layouts.app')

@section('content')
<div class="col-12">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible offset-7" role="alert">
     {{session('success')}}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List Page</h3>

        <div class="card-tools">
          <form action="{{route('admin#search')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="adminSearchKey" class="form-control float-right" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

       <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $u)
            <tr >
              <td>{{$u->id}}</td>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->gender}}</td>
              <td>{{$u->phone}}</td>
              <td>{{$u->address}}</td>
              <td>
                {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                @if($u->id == Auth::user()->id)
                @else
                <a class="btn btn-sm bg-danger text-white" href="{{route('admin#delete',$u->id)}}">
                    <i class="fas fa-trash-alt"></i>
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
