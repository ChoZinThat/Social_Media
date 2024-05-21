@extends('admin.layouts.app')

@section('content')
<div class="col-6 offset-3 mt-3">
    <div class="card">
        <i class="fa fa-solid fa-arrow-left m-3" onclick="history.back()"></i>
        <div class="card-header text-center ">
            <img @if ($post->image != NULL)
                        src = "{{asset('postImage/'.$post->image)}}"
                    @else
                        src = "{{asset('postImage/empty_image.png')}}"
                    @endif alt="Post Image" style="width: 350px">
        </div>
        <div class="card-body">
            <div class="card-title d-flex justify-content-center">
                <h1 class="">{{$post->title}}</h1>
            </div>
            <div class="card-text">
                <p>{{$post->description}}</p>
            </div>
        </div>
    </div>
  </div>
@endsection
