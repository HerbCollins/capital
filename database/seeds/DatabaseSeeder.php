<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(MinerTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(CoinLogTypeTableSeeder::class);
        $this->call(CoinLogTableSeeder::class);
        $this->call(UserMinerTableSeeder::class);
        $this->call(UserOrderTableSeeder::class);
    }
}
