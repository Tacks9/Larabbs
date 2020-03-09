<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);

        // $this->call(LinksTableSeeder::class);
        // 使用seed进行填充 校内链接资源

        $this->call(CarouselsTableSeeder::class);
        $this->call(FollowersTableSeeder::class);

    }
}
