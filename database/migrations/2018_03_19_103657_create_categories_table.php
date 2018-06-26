<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('categorys', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('title', 100)->unique()->comment('栏目标题');
//            $table->string('route', 100)->comment('栏目路由名称');
//            $table->string('target', 50)->default('_self')->comment('栏目打开方式');
//            $table->string('icon_class', 50)->nullable()->comment('栏目图标');
//            $table->string('color', 50)->nullable()->comment('栏目颜色');
//            $table->string('height_url', 50)->nullable()->comment('栏目高亮');
//            $table->integer('parent_id')->default(0)->comment('父类id');
//            $table->integer('order')->unsigned()->default(0)->comment('栏目排序');
//            $table->boolean('is_show')->default(true)->comment('是否显示');
//
//
//            $table->string('alias',100)->unique()->comment('调用别名');
//            $table->string('seo_title',255)->nullable()->comment('SEO标题');
//            $table->string('seo_key',255)->nullable()->comment('SEO关健字');
//            $table->string('seo_content',255)->nullable()->comment('SEO描述');
//
//            $table->string('url',255)->nullable()->comment('URL链接,填写后直接跳转到该网址');
//            $table->string('thumb',255)->nullable()->comment('封面图片');
//            $table->text('description')->nullable()->comment('栏目描述');
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
        //Schema::dropIfExists('categorys');
    }
}
