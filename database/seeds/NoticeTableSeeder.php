<?php

use Illuminate\Database\Seeder;
use App\Models\Notice;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Notice::class)->times(10)->create();
    }
}
