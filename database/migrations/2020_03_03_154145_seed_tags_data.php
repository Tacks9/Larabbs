<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedTagsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tags = [
            [
                'name'        => '前端',
                'description' => 'Front Web',
            ],
            [
                'name'        => '后端',
                'description' => 'Back Web',
            ],
            [
                'name'        => '数据库',
                'description' => 'Database',
            ],
            [
                'name'        => '服务器',
                'description' => 'Server',
            ],
            [
                'name'        => '网络',
                'description' => 'NetWork',
            ],
            [
                'name'        => '操作系统',
                'description' => 'Operating System',
            ],
            [
                'name'        => '算法',
                'description' => 'Algorithm',
            ],
            [
                'name'        => '学习路线',
                'description' => 'Learning route',
            ],
            [
                'name'        => '学习笔记',
                'description' => 'Learning Notes',
            ],
            [
                'name'        => '踩坑排错',
                'description' => 'DeBug',
            ],
            [
                'name'        => '吐槽',
                'description' => 'Discuss',
            ],
            [
                'name'        => '人生感悟',
                'description' => 'Life Perception',
            ],
            [
                'name'        => '面经',
                'description' => 'Interview Experience',
            ],
            [
                'name'        => '内推',
                'description' => 'Internal Recommendation',
            ],
            [
                'name'        => '校招',
                'description' => 'Campus Recruitment',
            ],
            [
                'name'        => '社招',
                'description' => 'Social Recruitment',
            ],
            [
                'name'        => '开源推荐',
                'description' => 'Open Source Recommend',
            ]
        ];

        // DB::table('tags')->insert($tags);
        // 转为sql导入
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::table('tags')->truncate();
    }
}
