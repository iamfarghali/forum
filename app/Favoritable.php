<?php


namespace App;


trait Favoritable
{

    public function isFavorited ()
    {
        return !!$this->favorites->where( 'user_id', auth()->id() )->count();
    }

    public function getFavoritesCountAttribute ()
    {
        return $this->favorites->count();
    }

    public function favorites ()
    {
        return $this->morphMany( Favorite::class, 'favorited' );
    }
}
