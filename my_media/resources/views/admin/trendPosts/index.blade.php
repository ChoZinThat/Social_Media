@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Posts Page</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Title</th>
              <th>Image</th>
              <th>View</th>

              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($post as $item)
            <tr>
                <td>{{$item->post_id}}</td>
                <td>{{$item->title}}</td>
                <td>
                    <img @if ($item->image != NULL)
                        src = "{{asset('postImage/'.$item->image)}}"
                    @else
                        src = "{{asset('postImage/empty_image.png')}}"
                    @endif alt="Post Image" width="100px">
                </td>
                <td><i class="fas fa-eye mr-2"></i>{{$item->post_count}}</td>
                <td>
                  <a href="{{route('admin#trendPostDetails',$item->post_id)}}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-file"></i></button>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{-- <div class="mx-5">{{$post->links()}}</div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
