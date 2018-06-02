<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Price;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    const COIN_NAME = 'coin_name';

    const PAGE_NUMBER = 5;

    public $coin_name;

    public function __construct()
    {
        $this->middleware('auth:users');

        $this->coin_name = Settings::get(self::COIN_NAME);
    }

    public function index()
    {
        $present = Price::orderBy('day' , 'desc')->first();

        $max = sprintf("%.2f" , Order::max('price'));
        $min = sprintf("%.2f" , Order::min('price'));

        $coin_name = $this->coin_name . '币';

        $user = Auth::user();

        return view('transaction.index' , compact('present' , 'max' , 'min' , 'coin_name' , 'user'));
    }

    public function ajaxData()
    {
        $prices = Price::orderBy('day' , 'desc')->select('price' , 'day')->take(5)->get();
        return $prices;
    }

    public function boughtOrder(Request $request)
    {

        try{
            $page = $request['page'] ? : 1 ;
            $orders = Order::where(['type' => 1 , 'status' => 1])->with('user')->orderBy('updated_at' , 'desc')->offset(($page-1) * self::PAGE_NUMBER)->take(self::PAGE_NUMBER)->get()->toArray();
            $next = Order::where(['type' => 1 , 'status' => 1])->orderBy('updated_at' , 'desc')->offset($page * self::PAGE_NUMBER)->take(1)->get()->toArray();

            if($next){
                $is_over = false;
            }else{
                $is_over = true;
            }

            return response()->json([
                'code' => 0,
                'message' => 'success',
                'data' => [
                    'orders' => $orders,
                    'is_over' => $is_over,
                    'next' => $next
                ]
            ]);
        }catch (\Exception $e){
            return response()->json([
                'code' => 1001,
                'message' => 'error'
            ]);
        }

    }

    public function sellOrder(Request $request)
    {
        try{
            $page = $request['page'] ? : 1 ;
            $orders = Order::where(['type' => "2" , 'status' => "1"])->with('user')->orderBy('updated_at' , 'desc')->offset(($page-1) * self::PAGE_NUMBER)->take(self::PAGE_NUMBER)->get()->toArray();
            $next = Order::where(['type' => "2" , 'status' => "1"])->orderBy('updated_at' , 'desc')->offset($page * self::PAGE_NUMBER)->take(1)->get()->toArray();

            if($next){
                $is_over = false;
            }else{
                $is_over = true;
            }

            return response()->json([
                'code' => 0,
                'message' => 'success',
                'data' => [
                    'orders' => $orders,
                    'is_over' => $is_over
                ]
            ]);
        }catch (\Exception $e){
            return response()->json([
                'code' => 1001,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        }
    }
}
