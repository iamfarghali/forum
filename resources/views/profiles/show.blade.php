@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1">
                <div class="border-bottom">
                    <h1 class="display-5">
                        {{ucwords($profileUser->name)}}
                    </h1>
                    <small class="text-muted">Sienc {{$profileUser->created_at->diffForHumans()}}</small>
                </div>

                @foreach($threads as $thread)
                    <div class="card my-4">
                        <div class="card-header d-flex justify-content-between">
                            <span><a href="{{$thread->path()}}">{{$thread->title}}</a></span>
                            <span class="badge badge-dark px-2 text-light"
                                  style="line-height: 2;">{{$thread->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="card-body">
                            <p>{{$thread->body}}</p>
                        </div>
                    </div>
                @endforeach
                <div class="text-center">
                    {{$threads->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
