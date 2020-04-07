<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('picture')->nullable();
            $table->longtext('content');
            $table->unsignedBigInteger( 'profile_id' )->nullable();
            $table->integer( 'likes_count' )->default(0);
            $table->timestamps(); // will grab post and updated by default
        //     $table->foreign('profile_id')
        //    ->references('id')
        //    ->on('profiles')
        //   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

