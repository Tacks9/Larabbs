<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndTopToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            // 新增两个字段  状态 置顶   after将此字段放置在view_count"之后" (MySQL)
            $table->mediumInteger('status')->after('view_count')->default(0)->comment('状态 1通过/0审核中');
            $table->mediumInteger('top')->after('view_count')->default(0)->comment('置顶1/0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('top');
        });
    }
}
