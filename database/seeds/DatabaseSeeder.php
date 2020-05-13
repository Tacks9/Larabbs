<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // 填充用户和粉丝数据
        $this->call(UsersTableSeeder::class);
        $this->call(FollowersTableSeeder::class);

        /// ==== 改为导入sql执行
        // 导入栏目
        system(env('MYSQL_CATEGORIES'));
        // 导入标签
        system(env('MYSQL_TAGS'));

         //  先导出数据 mysqldump -t nyistbbs topics > database/topics.sql
        system(env('MYSQL_TOPICS'));

        // 不使用数据工厂填充数据
            // $this->call(TopicsTableSeeder::class);

            // $this->call(RepliesTableSeeder::class);

        // 使用seed进行填充 校内链接资源
            // $this->call(LinksTableSeeder::class);

        // 使用seed进行填充 特色推荐
            // $this->call(CarouselsTableSeeder::class);


    }
}
