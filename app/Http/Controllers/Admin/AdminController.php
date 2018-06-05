<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        $out = Order::where(['type' => "1",'status' => "2"])->whereDate('updated_at','=' , Carbon::now()->toDateString())->sum("coins");
        $in = Order::where(['type' => "2",'status' => "2"])->whereDate('updated_at','=' , Carbon::now()->toDateString())->sum("coins");

        $price = Price::orderBy('created_at','desc')->first();

        $coin['in'] = $in;
        $coin['out'] = $out;
        $coin['price'] = $price->price;
        $coin['name'] = Settings::get('coin_name');
        return view('admin.index' , compact('coin'));
    }

    public function system()
    {
        $settings['site_name'] = Settings::get('site_name');
        $settings['coin_name'] = Settings::get('coin_name');
        return view('admin.system' , compact('settings'));
    }

    public function systemsetting(Request $request)
    {
        $attrs = $request->except('_token');
        if($attrs){
            foreach ($attrs as $key => $value){
                Settings::set($key , $value);
            }
        }
        return Redirect::to(url('admin/system'));
    }
}
