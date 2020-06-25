@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($threads as $thread)
                    <div class="card my-2">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3><a href="{{$thread->path()}}">{{substr($thread->title, 0, 50)}}</a></h3>
                                <a href="{{$thread->path()}}" class="btn">
                                    <span class="badge badge-primary p-2">
                                         {{$thread->replies_count}}
                                        {{\Str::plural('reply', $thread->replies_count)}}
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{$thread->body}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
