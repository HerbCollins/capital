<?php

use Illuminate\Database\Seeder;
use App\Models\CoinLog;
use App\Models\User;

class CoinLogTableSeeder extends Seeder
{
    const NUMBER = 50;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = app(Faker\Generator::class);

        $user_ids = User::all()->pluck('id')->toArray();

        $logs = factory(CoinLog::class)->times(20)->make()->each(function ($log) use ($factory , $user_ids){
            $types = ["1","2","3"];
            $key = array_rand($types);
            $log->user_id = $factory->randomElement($user_ids);
            $log->coin = mt_rand(10 , 20);
            $log->type = $types[$key];
            $log->created_at = \Carbon\Carbon::now();
            $log->updated_at = \Carbon\Carbon::now();
        })->toArray();

        CoinLog::insert($logs);

    }
}
