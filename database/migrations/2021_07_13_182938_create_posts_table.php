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
            $table->string('title');
           $table->text('content');
 
            $table->dateTime('date_written');
 
            $table->String('post_imge')->nullable();
             $table->integer('votes_up') ->nullable();
             $table->integer('votes_down')->nullable();
             $table->text('voters_up')->nullable();
             $table->text('voters_down')->nullable();

 
             //Relationships
             $table->bigInteger('user_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users');
             $table->bigInteger('category_id')->unsigned();
             $table->foreign('category_id')->references('id')->on('categories');
             $table->timestamps();
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
