<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique()->comment('标题');
            $table->string('name')->unique()->comment('名称');
            $table->text('content')->nullable()->comment('内容');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('tips')->nullable()->comment('备注');
            $table->string('type')->comment('类型');
            $table->boolean('value')->default(true)->comment('数值');
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
        Schema::dropIfExists('systems');
    }
}
