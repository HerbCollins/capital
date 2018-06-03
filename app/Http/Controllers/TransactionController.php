<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Cash;
use App\Models\CoinLog;
use App\Models\Price;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


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

        $yestoday = Price::whereDate('created_at' , '=' , Carbon::yesterday()->toDateString())->orderBy('day' , 'desc')->first();

        $max = sprintf("%.2f" , Order::max('price'));
        $min = sprintf("%.2f" , Order::min('price'));

        $increase = sprintf("%.4f" , ( $present->price - $yestoday->price ) / $yestoday->price);

        $coin_name = $this->coin_name . '币';

        $bought = Order::where(['type' => 1 , 'status' => 1])->count();
        $sell = Order::where(['type' => 2 , 'status' => 1])->count();

        $user = Auth::user();

        return view('transaction.index' , compact('bought','sell','present' , 'max' , 'min' , 'coin_name' , 'user' , 'increase'));
    }

    public function ajaxData()
    {
        $count =  Price::count();
        $prices = Price::select('price' , 'day')->offset($count-6)->take(5)->get();
        return $prices;
    }

    public function boughtOrder(Request $request)
    {

        try{
            $page = $request['page'] ? : 1 ;
            $orders = Order::where(['type' => 1 , 'status' => "1"])->with('user')->orderBy('updated_at' , 'desc')->offset(($page-1) * self::PAGE_NUMBER)->take(self::PAGE_NUMBER)->get()->toArray();
            $next = Order::where(['type' => 1 , 'status' => "1"])->orderBy('updated_at' , 'desc')->offset($page * self::PAGE_NUMBER)->take(1)->get()->toArray();

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

    public function wantsell(Request $request)
    {
        DB::beginTransaction();
        $user = Auth::user();

        try{
            $count = $request['number'];
            $price = $request['price'];

            if($count <= 0 || !is_numeric($count) || !$count){
                throw new \Exception('出售数量错误' , 10001);
            }

            if($count > $user->coin){
                throw new \Exception($this->coin_name.'币不足', 10003);
            }

            if($price <= 0 || !is_numeric($price) || !$price){
                throw new \Exception('出售价格错误' , 10002);
            }

            $order = new Order();
            $order->hash_no = generateOrderId();
            $order->coins = $count;
            $order->price = $price;
            $order->user_id = Auth::id();
            $order->type = "2";
            $order->status = "1";
            $order->save();

            $coin_log = new CoinLog();
            $coin_log->user_id = Auth::id();
            $coin_log->coin = $count;
            $coin_log->type = 2;
            $coin_log->save();

            $user = User::find(Auth::id());
            $user->coin = $user->coin - $count;
            $user->save();

            DB::commit();
            return response()->json([
                'code' =>0,
                'message' => 'success'
            ]);

        }catch (\Exception $e){
            DB::rollback();

            Log::error("[TransactionController@wantsell] error code : ".$e->getCode() . '; error message :' .$e->getMessage());

            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function wantbuy(Request $request)
    {
        DB::beginTransaction();
        $user = Auth::user();

        try{
            $count = $request['number'];
            $price = $request['price'];

            if($count <= 0 || !is_numeric($count) || !$count){
                throw new \Exception('求购数量错误' , 10001);
            }

            if($user->rmb < $count * $price){
                throw new \Exception('RMB不足' , 10003);
            }


            if($price <= 0 || !is_numeric($price) || !$price){
                throw new \Exception('求购价格错误' , 10002);
            }

            $order = new Order();
            $order->hash_no = generateOrderId();
            $order->coins = $count;
            $order->price = $price;
            $order->user_id = Auth::id();
            $order->type = "1";
            $order->status = "1";
            $order->save();

            $rmb_log = new Cash();
            $rmb_log->cash_no = $order->hash_no;
            $rmb_log->user_id = Auth::id();
            $rmb_log->rmb = $count * $price;
            $rmb_log->type = "buycoin";
            $rmb_log->status = "dealing";
            $rmb_log->save();

            $user = User::find(Auth::id());
            $user->rmb = $user->rmb - $count * $price;
            $user->save();

            DB::commit();
            return response()->json([
                'code' =>0,
                'message' => 'success'
            ]);

        }catch (\Exception $e){
            DB::rollback();

            Log::error("[TransactionController@wantsell] error code : ".$e->getCode() . '; error message :' .$e->getMessage());

            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function buyinto(Request $request)
    {
        DB::beginTransaction();
        $user= Auth::user();
        try{
            $payment_password = $request['payment_password'] ;
            $order_id = $request['order_id'];
            $order = Order::find($order_id);


            if(! $user->payment_password){
                throw new \Exception('支付密码未设置' , 10001);
            }


            if(!Hash::check($payment_password , $user->payment_password)){
                throw new \Exception('支付密码错误' , 10002);
            }

            $rmb = sprintf("%.2f" , $order->coins * $order->price);

            if($user->rmb < $rmb){
                throw new \Exception('RMB不足' , 10003);
            }

            $order->status = "2";
            $order->save();

            $new_user = User::find($user->id);
            $new_user->rmb = $new_user->rmb - $rmb;
            $new_user->coin =  $new_user->coin + $order->coins;
            $new_user->save();

            $rmb_log = new Cash();
            $rmb_log->user_id = $user->id;
            $rmb_log->rmb = $rmb;
            $rmb_log->cash_no = generateOrderId();
            $rmb_log->type = "buycoin";
            $rmb_log->status = 'finished';
            $rmb_log->save();

            $coin_log = new CoinLog();
            $coin_log->user_id = $user->id;
            $coin_log->coin = $order->coins;
            $coin_log->type = 4;
            $coin_log->save();

            DB::commit();

            return response()->json([
                'code' =>0,
                'message' => 'success'
            ]);

        }catch (\Exception $e){
            DB::rollback();

            Log::error("[TransactionController@buyinto] error code : ".$e->getCode() . '; error message :' .$e->getMessage());

            return response()->json([
                'code' => 10001,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function sellout(Request $request)
    {
        DB::beginTransaction();
        $user= Auth::user();
        try{
            $payment_password = $request['payment_password'];
            $order_id = $request['order_id'];
            $order = Order::findOrFail($order_id);

            if(! $user->payment_password){
                throw new \Exception('支付密码未设置' , 10001);
            }

            if(!Hash::check($payment_password , $user->payment_password)){
                throw new \Exception('支付密码错误' , 10002);
            }

            $rmb = sprintf("%.2f" , $order->coins * $order->price);

            if($user->coin < $order->coin){
                throw new \Exception($this->coin_name .'币不足' , 10003);
            }

            $order->status = "2";
            $order->save();

            $new_user = User::find($user->id);
            $new_user->rmb = $new_user->rmb + $rmb;
            $new_user->coin =  $new_user->coin - $order->coins;
            $new_user->save();

            $rmb_log = new Cash();
            $rmb_log->user_id = $user->id;
            $rmb_log->rmb = $rmb;
            $rmb_log->cash_no = generateOrderId();
            $rmb_log->type = "sellcoin";
            $rmb_log->status = 'finished';
            $rmb_log->save();

            $coin_log = new CoinLog();
            $coin_log->user_id = $user->id;
            $coin_log->coin = $order->coins;
            $coin_log->type = 2;
            $coin_log->save();

            DB::commit();
            return response()->json([
                'code' =>0,
                'message' => 'success'
            ]);

        }catch (\Exception $e){
            DB::rollback();

            Log::error("[TransactionController@sellout] error code : ".$e->getCode() . '; error message :' .$e->getMessage());

            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
