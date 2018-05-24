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

        User::create([
            'name' => 'username',
            'phone' => '13812345678',
            'password' => '123456',
            'hash' => time() . rand(10,99),
        ]);
    }
}
