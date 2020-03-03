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
                'name'        => '面经',
                'description' => 'mianjing',
            ],
            [
                'name'        => '内推',
                'description' => 'neitui',
            ],
            [
                'name'        => '校招',
                'description' => 'xiaozhao',
            ],
            [
                'name'        => '前端',
                'description' => 'qianduan',
            ],
            [
                'name'        => '后端',
                'description' => 'houduan',
            ],
            [
                'name'        => '吐槽',
                'description' => 'tucao',
            ],
            [
                'name'        => 'Linux',
                'description' => 'Linux',
            ],
            [
                'name'        => 'Mysql',
                'description' => 'Mysql',
            ],
            [
                'name'        => '服务器',
                'description' => 'fuwuqi',
            ],
        ];

        DB::table('tags')->insert($tags);
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
