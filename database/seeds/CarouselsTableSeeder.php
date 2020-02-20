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
        $images = [
            'https://img.zcool.cn/community/01245c5e4cff5ba80120a89558c7b9.jpg@260w_195h_1c_1e_1o_100sh.jpg',
            'https://img.zcool.cn/community/0112255e4a57cea80120a895964803.jpg@260w_195h_1c_1e_1o_100sh.jpg',
            'https://img.zcool.cn/community/0122005e48009ca80120a8953c3b55.jpg@260w_195h_1c_1e_1o_100sh.jpg',
            'https://img.zcool.cn/community/01dffe5e4d0ee9a80120a895074f10.jpg@260w_195h_1c_1e_1o_100sh.jpg',
            'https://img.zcool.cn/community/0121675e4ca532a80120a895d01113.jpg@260w_195h_1c_1e_1o_100sh.jpg',
            'https://img.zcool.cn/community/0137c05e4bcf45a80120a895f90617.jpg@260w_195h_1c_1e_1o_100sh.jpg',
        ];
        // 生成数据集合
        // factory()生成模型工厂构造器
        // times()  指定生成模型的数量6个
        // make()   将结果生成为对象
        // each()   处理结果对象，进行迭代集合内容 其传递到回调函数
        // 回调函数利用use使用外部变量
        $carousels = factory(Carousel::class)
                        ->times(6)
                        ->make()
                        ->each(function ($carousel, $index)
                                    use ($faker, $images){
            // $carousel->image = $faker->randomElement($images);
            $carousel->image = $images[$index];
        });

       // 插入数据
        Carousel::insert($carousels->toArray());

    }
}
