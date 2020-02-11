<?php

use Illuminate\Database\Seeder;
use App\Models\User; // 引入 用户类

class UsersTableSeeder extends Seeder
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

         // 头像假数据
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
        // 生成数据集合
        // factory()生成模型工厂构造器  => 对应加载 UserFactory.php工厂
        // times()  指定生成模型的数量10个用户
        // make()   将结果生成为对象
        // each()   处理结果对象，进行迭代集合内容 其传递到回调函数
        // 回调函数利用use使用外部变量
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                                    use ($faker, $avatars){
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        // makeVisible() 是 Eloquent 对象提供的方法
        ///可以显示 User 模型 $hidden 属性里指定隐藏的字段，此操作确保入库时数据库不会报错。
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

          // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Admin';
        $user->email = 'admin@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();


          // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }
}
