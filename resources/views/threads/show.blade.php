@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- Thread --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <span><a href="{{$thread->creator->profilePath()}}">{{$thread->creator->name}}</a></span>
                            : <span>{{$thread->title}}</span>
                        </div>
                        @can('update', $thread)
                            <form action="{{$thread->path()}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        @endcan
                    </div>
                    <div class="card-body">
                        <p>{{$thread->body}}</p>
                    </div>
                </div>
                {{-- Replies --}}
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach
                {{$replies->links()}}
                {{-- Relpy Form || Sign im --}}
                @auth()
                    <form class="mt-3" action="{{$thread->path() . '/replies'}}" method="post">
                        @csrf
                        <div class="form-group">
                        <textarea class="form-control" name="body" cols="10" rows="6"
                                  placeholder="Write your reply"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </form>
                @else
                    <h5 class="mt-3 text-center">Please <a href="{{route('login')}}">singin</a> to can participate.</h5>
                @endauth
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This Thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href="#">{{$thread->creator->name}}</a>, and currently has
                            {{ $thread->replies_count . ' ' . \Str::plural('reply', $thread->replies_count) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
@endsection
