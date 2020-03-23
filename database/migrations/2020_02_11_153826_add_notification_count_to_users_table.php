<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationCountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用来跟踪用户有多少未读通知，如果未读通知大于零的话，就在站点的全局顶部导航栏显示红色的提醒
        Schema::table('users', function (Blueprint $table) {
            $table->integer('notification_count')->unsigned()->default(0)->comment('未读通知数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('notification_count');
        });
    }
}
