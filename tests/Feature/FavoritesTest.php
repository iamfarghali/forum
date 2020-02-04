<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function guest_can_not_favorite_anything ()
    {
        $response = $this->post( 'replies/1/favorites' );
        $this->assertEquals( 'Unauthenticated.', $response->exception->getMessage() );
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_favorite_any_reply ()
    {
        $this->signIn( create( 'App\User' ) );
        $reply = create( 'App\Reply' );
        $this->post( 'replies/' . $reply->id . '/favorites' );
        $this->assertCount( 1, $reply->favorites );
    }

    /**
     * @test
     */
    public function an_authenticated_user_may_only_favorite_a_reply_once ()
    {
        $this->signIn( create( 'App\User' ) );
        $reply = create( 'App\Reply' );
        $this->post( 'replies/' . $reply->id . '/favorites' );
        $this->post( 'replies/' . $reply->id . '/favorites' );
        $this->assertCount( 1, $reply->favorites );
    }
}
