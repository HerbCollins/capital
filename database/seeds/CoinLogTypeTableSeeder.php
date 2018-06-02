<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinLogTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coin_name = \App\Facades\Settings::get('coin_name');
        DB::table('coin_log_type')->insert([
            ['type' =>'购买'.$coin_name],
            ['type' =>'出售'.$coin_name],
            ['type' =>$coin_name .'生产'],
        ]);
    }
}
