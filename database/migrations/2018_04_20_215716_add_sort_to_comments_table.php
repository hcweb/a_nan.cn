<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->nestedSet();
//            $table->integer('_lft')->after('city')->change();
//            $table->integer('_rgt')->after('city')->change();
//            $table->integer('parent_id')->after('city')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropNestedSet();
//            $table->dropColumn('_lft','_rgt','parent_id');
        });
    }
}
