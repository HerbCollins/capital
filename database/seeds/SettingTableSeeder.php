<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coin_name = new Setting();
        $coin_name->key = 'coin_name';
        $coin_name->value = '全球';
        $coin_name->save();
    }
}
