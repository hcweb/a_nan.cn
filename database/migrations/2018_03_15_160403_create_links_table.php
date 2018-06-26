<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('友情链接分类名称');
            $table->timestamps();
        });
        Schema::create('link_items', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->unsignedInteger('link_id')->comment('友情链接分类');
            $table->string('title')->unique()->comment('友情链接标题');
            $table->string('url')->comment('url链接');
            $table->string('logo')->nullable()->comment('链接的logo');
            $table->string('description')->nullable()->comment('链接描述');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->string('user_name')->nullable()->comment('联系人');
            $table->string('user_phone')->nullable()->comment('联系人手机');
            $table->string('user_email')->nullable()->comment('联系人邮箱');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
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
        Schema::dropIfExists('links');
        Schema::dropIfExists('link_items');
    }
}
