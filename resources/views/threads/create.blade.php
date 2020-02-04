@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>
                    <div class="card-body">
                        <form action="{{url('threads')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="channel_id">Channel</label>
                                <select class="form-control" name="channel_id" id="channel_id">
                                    <option value="0" selected disabled>Select Channel</option>
                                    @foreach($channels as $channel)
                                        <option
                                            value="{{$channel->id}}"
                                            {{old('channel_id') == $channel->id ? 'selected' : ''}}>
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('channel_id')
                                <p class="form-text text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                       class="form-control"
                                       name="title" id="title"
                                       placeholder="Thread Title"
                                       value="{{old('title') ?: ''}}">
                                @error('title')
                                <p class="form-text text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <input type="text"
                                       class="form-control"
                                       name="excerpt" id="excerpt"
                                       placeholder="Thread Excerpt"
                                       value="{{old('excerpt') ?: ''}}">
                                @error('excerpt')
                                <p class="form-text text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control"
                                          name="body"
                                          id="body"
                                          rows="6">{{old('body') ?: ''}}</textarea>
                                @error('body')
                                <p class="form-text text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
