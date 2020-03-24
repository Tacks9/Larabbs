<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCarouselsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $url = env('APP_URL');
        $images = [
            $url.'/uploads/default/carousel-segmentfault.jpg',
            $url.'/uploads/default/carousel-php.jpg',
            $url.'/uploads/default/carousel-imooc.jpg',
            $url.'/uploads/default/carousel-collect.jpg',
            $url.'/uploads/default/carousel-ai.jpg',
        ];
        $links = [
            'https://segmentfault.com/',
            'https://www.laruence.com/',
            'https://www.imooc.com/',
            'https://www.chenzhuofan.top/',
            'http://www.studyai.com/',
        ];

        $carousels = [
            [
                'title'        => '思否',
                'link'         => 'https://segmentfault.com/',
                'image'        =>  $url.'/uploads/default/carousel-segmentfault.jpg',
                'status'=> 1,
            ],
            [
                'title'        => 'PHP',
                'link'         => 'https://www.laruence.com/',
                'image'        =>  $url.'/uploads/default/carousel-php.jpg',
                'status'=> 1,

            ],
            [
                'title'        => '慕课网',
                'link'         => 'https://www.imooc.com/',
                'image'        =>  $url.'/uploads/default/carousel-imooc.jpg',
                'status'=> 1,
            ],
            [
                'title'        => '优秀博客',
                'link'         => 'https://www.chenzhuofan.top/',
                'image'        =>  $url.'/uploads/default/carousel-collect.jpg',
                'status'=> 1,

            ],
            [
                'title'        => 'AI学习',
                'link'         => 'http://www.studyai.com/',
                'image'        =>  $url.'/uploads/default/carousel-ai.jpg',
                'status'=> 1,
            ],


        ];

        DB::table('carousels')->insert($carousels);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('carousels')->truncate();
    }
}
