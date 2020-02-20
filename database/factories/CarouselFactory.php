<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Carousel::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time; // 当前时间
    return [
        'title' => $faker->name,
        'link'  => $faker->url,
        'status'=> 1,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
