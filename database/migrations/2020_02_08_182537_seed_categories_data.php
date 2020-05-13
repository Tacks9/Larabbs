<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '编程技术',
                'description' => '包含C、C++、C#、Java、Python、JS、PHP、SQL、GO等各种编程技术！',
            ],
            [
                'name'        => '笔经面经',
                'description' => '普通实习、应届生春招秋招、毕业生社招等一些经验分享！',
            ],
            [
                'name'        => '资源分享',
                'description' => '学习笔记、有趣开源、软件安利等！',
            ],
            [
                'name'        => '职业发展',
                'description' => '学习路线、认真规划！',
            ],
            [
                'name'        => '生活娱乐',
                'description' => '适当放松、找寻快乐！',
            ],
            [
                'name'        => '站内公告',
                'description' => '一些站内的相关通知！',
            ],
        ];
        // 填充数据
        // DB::table('categories')->insert($categories);
        // 转为sql导入
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 清空数据
        DB::table('categories')->truncate();
    }
}
