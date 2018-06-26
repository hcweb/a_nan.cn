<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('会员名称');
            $table->string('avatar')->nullable()->comment('会员头像');
            $table->string('email')->comment('会员邮箱');
            $table->string('tel')->nullable()->comment('会员手机');
            $table->ipAddress('visitor')->nullable()->comment('最后登录IP');
            $table->boolean('state')->default(true)->comment('会员状态');
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
        Schema::dropIfExists('members');
    }
}
