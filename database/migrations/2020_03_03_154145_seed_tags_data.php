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
                'description' => 'Interview experience',
            ],
            [
                'name'        => '内推',
                'description' => 'Internal recommendation',
            ],
            [
                'name'        => '校招',
                'description' => 'Campus Recruitment',
            ],
            [
                'name'        => '前端',
                'description' => 'Front Web',
            ],
            [
                'name'        => '后端',
                'description' => 'Back Web',
            ],
            [
                'name'        => '吐槽',
                'description' => 'discuss',
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
                'description' => 'Server',
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
