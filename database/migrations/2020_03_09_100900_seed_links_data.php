<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedLinksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $links = [
            [
                'title'        => '南阳理工学院官网',
                'link'         => 'http://www.nyist.edu.cn/',
            ],
            [
                'title'        => '南工软件学院',
                'link'         => 'http://soft.nyist.edu.cn/',
            ],
            [
                'title'        => '南工教务管理系统',
                'link'         => 'http://222.139.215.217/jwweb/',
            ],
            [
                'title'        => '南工新闻网',
                'link'         => 'http://news.nyist.edu.cn/',
            ],
            [
                'title'        => '南工图书馆',
                'link'         => 'http://lib.nyist.edu.cn/',
            ],
            [
                'title'        => '南工后勤中心',
                'link'         => 'http://hqzx.nyist.edu.cn/',
            ],
            [
                'title'        => 'LeetCode中文网',
                'link'         => 'https://leetcode-cn.com/',
            ],
            [
                'title'        => 'NowCoder牛客网',
                'link'         => 'https://www.nowcoder.com/',
            ],

        ];

        DB::table('links')->insert($links);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('links')->truncate();
    }
}
