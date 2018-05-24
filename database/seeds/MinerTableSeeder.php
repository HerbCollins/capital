<?php

use Illuminate\Database\Seeder;
use App\Models\Miner;

class MinerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $miner = new Miner();
        $miner->title = "矿机（20%）";
        $miner->img = "images/miner.jpg";
        $miner->price = 10.00;
        $miner->max = 500;
        $miner->day_max = 500;
        $miner->exist_max = 500;
        $miner->income = 1.00;
        $miner->timelong = 0.02;
        $miner->cycle = 12;
        $miner->save();

        $miner = new Miner();
        $miner->title = "矿机（30%）";
        $miner->img = "images/miner.jpg";
        $miner->price = 20.00;
        $miner->max = 60;
        $miner->day_max = 60;
        $miner->exist_max = 60;
        $miner->income = 2.00;
        $miner->timelong = 0.02;
        $miner->cycle = 13;
        $miner->save();

        $miner = new Miner();
        $miner->title = "矿机（36%）";
        $miner->img = "images/miner.jpg";
        $miner->price = 50.00;
        $miner->max = 70;
        $miner->day_max = 70;
        $miner->exist_max = 70;
        $miner->income = 4.00;
        $miner->timelong = 0.02;
        $miner->cycle = 17;
        $miner->save();

        $miner = new Miner();
        $miner->title = "矿机（40%）";
        $miner->img = "images/miner.jpg";
        $miner->price = 100.00;
        $miner->max = 80;
        $miner->day_max = 80;
        $miner->exist_max = 80;
        $miner->income = 7.00;
        $miner->timelong = 0.02;
        $miner->cycle = 20;
        $miner->save();
    }
}
