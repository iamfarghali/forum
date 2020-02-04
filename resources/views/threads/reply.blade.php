<div class="card my-2">
    <div class="card-header text-muted d-flex justify-content-between">
        <div>
            <span><a href="{{$reply->owner->profilePath()}}">{{$reply->owner->name}}</a></span>
            <span class="ml-2">{{$reply->created_at->diffForHumans()}}</span>
        </div>
        <form action="{{'/replies/' . $reply->id . '/favorites'}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm" {{!$reply->isFavorited() ?: 'disabled'}}>
                {{$reply->favorites_count}} {{\Str::plural('Favorite', $reply->favorites_count)}}
            </button>
        </form>
    </div>
    <div class="card-body">{{$reply->body}}</div>
</div>
