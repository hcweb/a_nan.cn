<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->comment('菜单标题');
            $table->string('route', 100)->comment('菜单路由名称');
            $table->string('target', 50)->default('_self')->comment('菜单打开方式');
            $table->string('icon_class', 50)->nullable()->comment('菜单图标');
            $table->string('color', 50)->nullable()->comment('菜单颜色');
            $table->string('height_url', 50)->nullable()->comment('菜单高亮');
            $table->integer('parent_id')->default(0)->comment('父类id');
            $table->integer('order')->unsigned()->default(0)->comment('菜单排序');
            $table->boolean('is_show')->default(true)->comment('是否显示');
//            $table->foreign('parent_id')
//                ->references('id')
//                ->on('menus')
//                ->onDelete('cascade');
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
        Schema::dropIfExists('menus');
    }
}
