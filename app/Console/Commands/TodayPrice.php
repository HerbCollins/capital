<?php

namespace App\Console\Commands;

use App\Facades\Settings;
use App\Models\Order;
use App\Models\Price;
use App\Models\UserOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TodayPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto calculate the price of today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $default_price = Settings::get('default_price') ? Settings::get('default_price') : 1;

        $orders = UserOrder::where(['status' => 2])->whereDate('updated_at' , '=' , Carbon::yesterday()->toDateString())->get();
        if(count($orders)){
            $x = 0;
            $y = 0;
            foreach ($orders as $order){
                $order = Order::where('hash_no' , $order->order_hash_id)->first();
                $x += $order->price * $order->coins;
                $y += $order->coins;
            }

            if($y == 0){
                $price_lastest = Price::orderBy('created_at' , 'desc')->first();
                $today_price = isset($price_lastest->price) && $price_lastest->price ? $price_lastest->price : $default_price;
            }else{
                $today_price = sprintf("%.2f",$x / $y);
            }
        }else{
            $price_lastest = Price::orderBy('created_at' , 'desc')->first();
            $today_price = isset($price_lastest->price) && $price_lastest->price ? $price_lastest->price : $default_price;
        }

        $price = new Price();

        $price->price = $today_price;
        $price->day = Carbon::today()->toDateString();
        $price->save();
    }
}
