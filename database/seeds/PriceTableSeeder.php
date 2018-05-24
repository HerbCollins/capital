<?php

use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceTableSeeder extends Seeder
{

    const GENERATE_NUMBER = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i =0 ; $i < self::GENERATE_NUMBER ; $i++)
        {
            $begin = self::GENERATE_NUMBER - $i;
            $priceModel = new Price();
            $priceModel->price = random_int(100 , 999) / 100;
            $priceModel->day = date('Y-m-d' , strtotime("-$begin days"));
            $priceModel->created_at = date('Y-m-d H:i:s' , strtotime("-$begin days"));
            $priceModel->updated_at = date('Y-m-d H:i:s' , strtotime("-$begin days"));
            $priceModel->save();
        }
    }
}
