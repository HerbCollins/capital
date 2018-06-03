<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\User;

class UserOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = app(Faker\Generator::class);

        $hash_nos = Order::where('status' , "2")->pluck('hash_no')->toArray();
        $user_ids = User::all()->pluck('id')->toArray();

        $userorders = factory(UserOrder::class)->times(count($hash_nos))->make()->each(function ($order , $index) use ($factory , $user_ids , $hash_nos) {
            $order->order_hash_id = $hash_nos[$index];
            $order->user_id = $factory->randomElement($user_ids);
            $order->status = mt_rand(1,2);
            $order->type = mt_rand(1,2);
            $order->created_at = mktime(mt_rand(1,24),mt_rand(0,59),mt_rand(0,59),'6',mt_rand(1,3),'2018');
            $order->updated_at = mktime(mt_rand(1,24),mt_rand(0,59),mt_rand(0,59),'6',mt_rand(1,3),'2018');
        })->toArray();

        UserOrder::insert($userorders);
    }
}
