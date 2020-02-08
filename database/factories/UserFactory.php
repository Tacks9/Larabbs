<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// Model Factories

// 每个模型工厂定义
// 工厂提供了一种方便的方法来生成新的模型实例 用来生成填充数据


// factory的define(Eloquent 模型类, 闭包函数) 定义模型工厂
$factory->define(User::class, function (Faker $faker) {
    // Faker 方法来生成假数据 => 模型的指定字段赋值
    $date_time = $faker->date . ' ' . $faker->time; // 当前时间
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'introduction' => $faker->sentence(), // 随机生成小段落
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
