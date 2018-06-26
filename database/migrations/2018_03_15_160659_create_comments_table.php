<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('评论的标题');
            $table->text('content')->comment('评论的内容');
            $table->ipAddress('visitor')->nullable()->comment('地址');
            $table->boolean('state')->default(false)->comment('审核状态');
            $table->text('reply')->nullable()->comment('回复内容');
            $table->integer('reply_id')->comment('回复id主要是记录回复的本次的comment_id');
            $table->integer('member_id')->unsigned()->comment('会员id');
            $table->foreign('member_id')
                ->references('id')->on('members')
                ->onDelete('cascade');
            $table->integer('post_id')->unsigned()->comment('会员id');
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade');

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
        Schema::dropIfExists('comments');
    }
}
