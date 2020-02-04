<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create( 'threads', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'user_id' );
            $table->unsignedBigInteger( 'channel_id' );
            $table->string( 'title' );
            $table->string( 'excerpt' );
            $table->text( 'body' );
            $table->timestamps();
        } );
        Schema::table('threads', function (Blueprint $table) {
            $table->foreign( 'user_id' )
                  ->references( 'id' )
                  ->on( 'users' )
                  ->onDelete( 'cascade' );

            $table->foreign( 'channel_id' )
                  ->references( 'id' )
                  ->on( 'channels' )
                  ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists( 'threads' );
    }
}
