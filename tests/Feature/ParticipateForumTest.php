<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @return void
     */
    public function authenticated_user_may_participate_in_forum_threads ()
    {
        $this->signIn();
        $thread = factory( 'App\Thread' )->create();
        $reply = factory( 'App\Reply' )->make();
//        dd($thread->path().'/replies');
        $this->post( $thread->path() . '/replies', $reply->toArray() );
        $this->get( $thread->path() )
             ->assertSee( $reply->body );
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_add_reply ()
    {
        $response = $this->post( 'threads/test/1/replies', [] );
        $this->assertEquals( 'Unauthenticated.', $response->exception->getMessage() );
    }

    /**
     * @test
     */
    public function a_reply_requires_a_body()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body'=>null]);
        $this->post($thread->path() . "/replies", $reply->toArray())
            ->assertSessionHasErrors('body');
    }

}
