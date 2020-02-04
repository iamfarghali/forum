<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;

class FavoritesController extends Controller
{
    public function __construct ()
    {
        $this->middleware( 'auth' );
    }

    public function store ( Reply $reply )
    {
        if ( !$reply->favorites()->where( [ 'user_id' => auth()->id() ] )->exists() ) {
            Favorite::create( [
                'user_id'        => auth()->id(),
                'favorited_id'   => $reply->id,
                'favorited_type' => get_class( $reply )
            ] );
        }
        return back();
    }
}
