<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @return void
     */
    public function a_guest_can_not_create_a_thread ()
    {
        $thread = make( 'App\Thread' );
        $response = $this->post( url( 'threads' ), $thread->toArray() );
        $this->assertEquals( 'Unauthenticated.', $response->exception->getMessage() );
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_thread ()
    {
        $this->signIn();
        $thread = make( 'App\Thread' );
        $response = $this->post( url( 'threads' ), $thread->toArray() );
        $this->get( $response->headers->get( 'location' ) )
             ->assertSee( $thread->title );
    }

    /**
     * @test
     */
    public function a_thread_requires_a_title ()
    {
        $this->publishThread( [ 'title' => null ] )
             ->assertSessionHasErrors( 'title' );
    }

    /**
     * @test
     */
    public function a_thread_requires_an_excerpt ()
    {
        $this->publishThread( [ 'excerpt' => null ] )
             ->assertSessionHasErrors( 'excerpt' );
    }

    /**
     * @test
     */
    public function a_thread_requires_an_body ()
    {
        $this->publishThread( [ 'body' => null ] )
             ->assertSessionHasErrors( 'body' );
    }

    /**
     * @test
     */
    public function a_thread_requires_a_valid_channel ()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread( [ 'channel_id' => null ] )
             ->assertSessionHasErrors( 'channel_id' );
        $this->publishThread( [ 'channel_id' => 3 ] )
             ->assertSessionHasErrors( 'channel_id' );
    }



    private function publishThread ( $overrides = [] )
    {
        $this->signIn();
        $thread = make( 'App\Thread', $overrides );
        return $this->post( 'threads/', $thread->toArray() );
    }

}
