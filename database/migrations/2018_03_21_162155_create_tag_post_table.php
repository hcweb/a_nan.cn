<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('tag_posts', function (Blueprint $table) {
//
//            $table->integer('post_id')->unsigned();
//            $table->foreign('post_id')
//                ->references('id')
//                ->on('posts');
//
//            $table->integer('tag_id')->unsigned();
//            $table->foreign('tag_id')
//                ->references('id')
//                ->on('tags');
//
//            $table->primary(['post_id', 'tag_id']);
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('tag_posts');
    }
}
