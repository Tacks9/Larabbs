<?php

use Illuminate\Database\Seeder;

use App\Models\Carousel;

class CarouselsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // 获取实例
        $faker = app(Faker\Generator::class);

         // 轮播图假数据
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

        // 生成数据集合
        // factory()生成模型工厂构造器
        // times()  指定生成模型的数量6个
        // make()   将结果生成为对象
        // each()   处理结果对象，进行迭代集合内容 其传递到回调函数
        // 回调函数利用use使用外部变量
        $carousels = factory(Carousel::class)
                        ->times(5)
                        ->make()
                        ->each(function ($carousel, $index)
                                    use ($links, $images){
            // $carousel->image = $faker->randomElement($images);
            $carousel->image = $images[$index];
            $carousel->link  = $links[$index];
        });

       // 插入数据
        Carousel::insert($carousels->toArray());

    }
}
