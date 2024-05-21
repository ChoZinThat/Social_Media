@extends('admin.layouts.app')

@section('content')
<div class="col-4 mt-2">
    <form action="{{route('admin#categoryUpdate',$updateData->category_id)}}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <label for="title" class="">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter category title" value="{{old('title',$updateData->title)}}">
                @error('title')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                <label for="description" class="mt-3">Description</label>
                <textarea name="description" id="" cols="30" rows="7" class="form-control"
                            placeholder="Enter category description"> {{old('description',$updateData->description)}}</textarea>
                @error('description')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                <input type="submit" value="Update" class="btn btn-secondary mt-2">
                <a href="{{route('admin#category')}}">
                    <input type="button" value="Create" class="btn btn-dark mt-2">
                </a>
            </div>
        </div>
    </form>
</div>
<div class=" col-8 mt-2" >
    @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
                {{Session::get('deleteSuccess')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

    @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category Table</h3>
            <div class="card-tools">
                <form action="{{route('admin#categorySearch')}}" method="post">
                    @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search">

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
              <th>Title</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->category_id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>
                    <a href="{{route('admin#categoryUpdatePage',$item->category_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                      </a>
                  <a href="{{route('admin#deleteCategory',$item->category_id)}}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a>
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
