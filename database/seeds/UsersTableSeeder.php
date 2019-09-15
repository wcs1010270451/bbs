<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://bbs.wcs/uploads/images/avatars/94i2vVGeRIO8H66sAdJ69WpnURFCMvEJ.jpg',
            'http://bbs.wcs/uploads/images/avatars/k82PcXIJpd0tENiJSycndtNBUGIkDowK.jpg',
            'http://bbs.wcs/uploads/images/avatars/OT6NMpFn2k5VeATQJq3pTeYDhwIAKD3v.jpg',
            'http://bbs.wcs/uploads/images/avatars/5XPw6szFHzzJ9u8BDYo0uIzXGnK89iHC.jpg',
            'http://bbs.wcs/uploads/images/avatars/e2MdfUMzCIKOYY9OfGemziA53ilwc545.jpg',
            'http://bbs.wcs/uploads/images/avatars/vRFyaby6LDs6jLQBNFMraAoeJ02Ihjms.jpg',
            'http://bbs.wcs/uploads/images/avatars/jhLJ9xctz73ApVD7oW16jDVYcihYNIRx.jpg',
            'http://bbs.wcs/uploads/images/avatars/lm1EOkeb0mIHy3KxDnbicKT15t61BGhx.jpg',
            'http://bbs.wcs/uploads/images/avatars/r0OkvIW0xyPdh7bk9zR6OuqYqY3X6Di3.jpg',
            'http://bbs.wcs/uploads/images/avatars/A6iq7iMxe8FA4zQNXN5RviGooUXcNM1d.jpg',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Wcs';
        $user->email = 'wcs@example.com';
        $user->avatar = 'http://bbs.wcs/uploads/images/avatars/Qmck9nUAwX6g4PWcH7eCVRQGdv5sAv7S.jpg';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
