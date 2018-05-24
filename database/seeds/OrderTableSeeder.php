<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;

class OrderTableSeeder extends Seeder
{
    const GENERATE_NUMBER = 100;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();

        for ($i = 0 ; $i < self::GENERATE_NUMBER ; $i++)
        {
            $hash_no = date('ymdHi').rand(100000,999999);
            $order = new Order();
            $order->hash_no = $hash_no;
            $order->user_id = $user_ids[array_rand($user_ids , 1)];
            $order->coins = rand(100 , 999);
            $order->price = rand(100 , 999) / 100;
            $order->type = rand(1,4);
            $order->status = rand(1,3);
            $order->save();
        }

    }
}
