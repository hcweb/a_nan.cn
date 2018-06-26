<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->unique()->comment('栏目标题');
            $table->string('route', 100)->comment('栏目路由名称');
            $table->string('target', 50)->default('_self')->comment('栏目打开方式');
            $table->string('icon_class', 50)->nullable()->comment('栏目图标');
            $table->string('color', 50)->nullable()->comment('栏目颜色');
            $table->string('height_url', 50)->nullable()->comment('栏目高亮');
            $table->integer('parent_id')->default(0)->comment('父类id');
            $table->integer('order')->unsigned()->default(0)->comment('栏目排序');
            $table->boolean('is_show')->default(true)->comment('是否显示');


            $table->string('alias',100)->unique()->comment('调用别名');
            $table->string('seo_title',255)->nullable()->comment('SEO标题');
            $table->string('seo_key',255)->nullable()->comment('SEO关健字');
            $table->string('seo_content',255)->nullable()->comment('SEO描述');

            $table->string('url',255)->nullable()->comment('URL链接,填写后直接跳转到该网址');
            $table->string('thumb',255)->nullable()->comment('封面图片');
            $table->text('description')->nullable()->comment('栏目描述');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->comment('所属分类id');
            $table->string('title')->unique()->comment('文章标题');
            $table->string('alias')->unique()->comment('文章标题别名');
            $table->boolean('is_show')->default(true)->comment('是否发布');

            $table->boolean('is_comment')->default(false)->nullable()->comment('推荐类型 允许评论');
            $table->boolean('is_top')->default(false)->nullable()->comment('推荐类型 置顶 ');
            $table->boolean('is_hot')->default(false)->nullable()->comment('推荐类型 热门 ');
            $table->boolean('is_tuijian')->default(false)->nullable()->comment('推荐类型 推荐');
            $table->boolean('is_slide')->default(false)->nullable()->comment('推荐类型 幻灯片');




            $table->string('thumb')->nullable()->comment('封面图片');
            //$table->string('tags')->nullable()->comment('标签');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->integer('views')->unsigned()->default(0)->comment('浏览次数');
            $table->timestamp('push_time')->comment('发布时间');

            $table->string('url')->nullable()->comment('URL链接');
            $table->string('source', 50)->default('本站')->nullable()->comment('信息来源');
            $table->string('author', 50)->default('管理员')->nullable()->comment('文章作者');
            $table->string('summary')->nullable()->comment('内容摘要');
            $table->text('description')->nullable()->comment('内容描述');

            $table->string('seo_title', 255)->nullable()->comment('SEO标题');
            $table->string('seo_key', 255)->nullable()->comment('SEO关健字');
            $table->string('seo_content', 255)->nullable()->comment('SEO描述');



            $table->foreign('category_id')
                ->references('id')
                ->on('categorys')
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

        Schema::dropIfExists('categorys');
        Schema::dropIfExists('posts');
    }
}
