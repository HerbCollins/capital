<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        Admin::create([
            'name' => 'Editor',
            'email' => 'editor@editor.com',
            'password' => 'editor',
        ]);

        $hash = generateOrderId();
        User::create([
            'name' => 'username',
            'phone' => '13812345678',
            'password' => '123456',
            'coin' => 1000,
            'hash' => $hash,
        ]);

        $users = factory(User::class)->times(10)->make()->each(function ($user , $index) use ($hash){
            $user->phone = 1 . mt_rand(1000000000 , 9999999999);
            $user->coin = mt_rand(100 , 1000);
            $user->inviter = $hash;
            $user->hash = generateOrderId();
        });

        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($user_array);
    }
}
