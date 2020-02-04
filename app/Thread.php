<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    protected $with = [ 'creator', 'channel' ];

    protected static function boot ()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope( 'replyCount', function ( $builder ) {
            $builder->withCount( 'replies' );
        } );
        static::deleting(function ($thread) {
            $thread->replies()->delete();
        });
    }

    public function path ()
    {
        return url( 'threads', [ $this->channel->slug, $this ] );
    }

    public function creator ()
    {
        return $this->belongsTo( 'App\User', 'user_id' );
    }

    public function addReply ( $reply )
    {
        $this->replies()->create( $reply );
    }

    public function replies ()
    {
        return $this->hasMany( 'App\Reply' );
    }


    public function channel ()
    {
        return $this->belongsTo( 'App\Channel' );
    }

    public function scopeFilter ( $query, $filters )
    {
        return $filters->apply( $query );
    }
}