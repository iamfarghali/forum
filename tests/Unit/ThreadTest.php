<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;

    /**
     * @test
     */
    public function it_has_a_creator ()
    {
        $this->assertInstanceOf( 'App\User', $this->thread->creator );
    }

    /**
     * @test
     */
    public function it_has_a_path ()
    {
        $this->assertEquals(
            url( 'threads', [ $this->thread->channel->slug, $this->thread->id ] ),
            $this->thread->path()
        );
    }

    /**
     * @test
     */
    public function it_has_replies ()
    {
        $this->assertInstanceOf( 'Illuminate\Database\Eloquent\Collection', $this->thread->replies );
    }

    /**
     * @test
     */
    public function it_can_add_reply ()
    {
        $this->thread->addReply( [
            'body'    => 'foo',
            'user_id' => 1
        ] );
        $this->assertCount( 1, $this->thread->replies );
    }

    /**
     * @test
     */
    public function it_belongs_to_a_channel ()
    {
        $this->assertInstanceOf( 'App\Channel', $this->thread->channel );
    }

    protected function setUp (): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = create( 'App\Thread' );
    }
}
