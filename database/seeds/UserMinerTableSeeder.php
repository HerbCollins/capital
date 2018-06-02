<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Miner;
use App\Models\UserMiner;

class UserMinerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();

        $factory = app(Faker\Generator::class);

        $minier_ids = Miner::all()->pluck('id')->toArray();

        $userminers = factory(UserMiner::class)->times(20)->make()->each(
            function ($userminer , $index) use ($user_ids , $minier_ids , $factory){

                $userminer->user_id = $factory->randomElement($user_ids);
                $userminer->miner_id = $factory->randomElement($minier_ids);

                $miner = Miner::find($userminer->miner_id);
                $userminer->finished = mt_rand(0 , $miner->cycle - 5);
                $userminer->number = mt_rand(1,200);
                $userminer->order_no = generateOrderId();
                $userminer->status = "working";
                $userminer->created_at = \Carbon\Carbon::now();
                $userminer->updated_at = \Carbon\Carbon::now();
            })->toArray();

        UserMiner::insert($userminers);
    }
}
