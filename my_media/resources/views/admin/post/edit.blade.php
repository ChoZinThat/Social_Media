@extends('admin.layouts.app')

@section('content')
<div class="col-4 mt-2">
    <form action="{{route('admin#editPost',$post->post_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <label for="title" class="">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter category title" value="{{old('title',$post->title)}}">
                @error('title')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                <label for="description" class="mt-3">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Enter category description">{{old('description',$post->description)}}</textarea>
                @error('description')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                <label for="image" class="mt-3">Image</label>
                <img
                @if ($post->image == NULL)
                    src="{{asset('postImage/empty_image.png')}}"
                @else
                    src="{{asset('postImage/'.$post->image)}}"
                @endif
                class="w-100 rounded shadow" alt="">
                <input type="file" name="image" id="image" class="form-control mb-3 " >


                <label for="category" class="">Category</label>
                <select name="category" class="form-control">
                    <option value="">Choose Your Category</option>
                    @foreach ($category as $c)
                    <option value="{{$c->category_id}}"
                         @if ($c->category_id == $post->category_id)  selected   @endif>{{$c->title}}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                <input type="submit" value="Update" class="btn btn-dark mt-2 offset-9">
            </div>
        </div>
    </form>
</div>
<div class=" col-8 mt-2" >
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif

    @if (Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible" role="alert">
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
                <form action="#" method="post">
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
              <th>Image</th>
              <th>Category</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $item)
            <tr>
                <td>{{$item->post_id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>
                    <img @if ($item->image != NULL)
                        src = "{{asset('postImage/'.$item->image)}}"
                    @else
                        src = "{{asset('postImage/empty_image.png')}}"
                    @endif alt="Post Image" width="100px">
                </td>
                <td>{{$item->category_id}}</td>
                <td>
                    <a href="{{route('admin#editPostPage',$item->post_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>
                  <a href="{{route('admin#postDelete',$item->post_id)}}">
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
