<?php

namespace App\Http\Controllers\User;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\CoinLog;
use App\Models\Miner;
use App\Models\Order;
use App\Models\Price;
use App\Models\Sign;
use App\Models\User;
use App\Models\UserMiner;
use App\Models\UserOrder;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PaymentRequest;

class UserController extends Controller
{
    public $coin_name;

    const COIN_NAME = 'coin_name';

    const INVITER_USERS_PAGE_COUNT = 10;

    private $userRep;

    public function __construct(UserRepositoryEloquent $repositoryEloquent)
    {
        $this->coin_name = Settings::get(self::COIN_NAME);

        $this->userRep = $repositoryEloquent;
    }

    public function index()
    {
        $user = Auth::user();
        $coin_name = $this->coin_name;
        $sign = Sign::where(['date' => Carbon::today()->toDateString() , 'user_id' => $user->id])->first();

        $working = UserMiner::where(['user_id' => $user->id , 'status' => 'working'])->count();

        $finished = UserMiner::where(['user_id' => $user->id , 'status' => 'over'])->count();

        $order = UserOrder::where(['user_id' => $user->id ])->count();
        $order = $order + Order::where(['user_id' => $user->id ])->count();

        $is_signed = isset($sign->id) ? true : false;
        return view('users.index' , compact('user' , 'coin_name' , 'is_signed' , 'working' , 'finished' , 'order'));
    }

    public function recharge()
    {
        $user = Auth::user();
        $rmb = $user->rmb;
        $price_lastest = Price::orderBy('created_at' , 'desc')->first();
        $price = $price_lastest->price;
        return view('users.recharge' , compact('price' , 'rmb' , 'user'));
    }


    public function withdraw()
    {
        $user = Auth::user();
        $rmb = $user->rmb;
        $price_lastest = Price::orderBy('created_at' , 'desc')->first();
        $price = $price_lastest->price;
        return view('users.withdraw' , compact('rmb' , 'price'));
    }

    public function withdrawresult(Request $request)
    {
        $user = Auth::user();
        $rmb = $request['rmb'];

        if($rmb > $user->rmb){
            abort(404 , '提现金额超出最大值');
        }

        DB::beginTransaction();
        try{

            $cash_no = generateOrderId();

            $cash = new Cash();
            $cash->cash_no = $cash_no;
            $cash->rmb = $rmb;
            $cash->user_id = $user->id;
            $cash->type = "withdraw";
            $cash->status = "dealing";
            $cash->save();

            $user->rmb = $user->rmb - $rmb;
            $user->save();

            DB::commit();
        }catch (\Exception $e){
            DB::collback();

            abort(404 , $e->getMessage());
        }


        return view('users.withdraw_result' , compact('cash_no'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit' , compact('user'));
    }

    public function update(Request $request)
    {
        try{
            $id  = Auth::id();
            $input = $request->except('_token');

            $this->userRep->update($input , $id);

            return response()->json([
                'code' => 0,
                'message' => '保存成功',
                'data' => $input
            ]);

        }catch (\Exception $e)
        {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function reset()
    {
        return view('users.reset');
    }

    public function ajaxreset(Request $request)
    {
        try{

            if($request['pwd'] != $request['rp_pwd']){
                throw new \Exception('两次密码不一致',10002);
            }

            $id  = Auth::id();
            $user = User::find($id);
            $user->password = bcrypt($request['pwd']);
            $user->save();

            return response()->json([
                'code' => 0,
                'message' => $request['pwd']
            ]);
        }catch (\Exception $e){
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function payment()
    {
        return view('users.payment');
    }

    public function ajaxpayment(PaymentRequest $request)
    {
        try{
            $all = $request->except('_token');

            if($all['pwd'] != $all['rp_pwd']){
                throw new \Exception('两次密码不一致',10001);
            }

            $id  = Auth::id();
            $user = User::find($id);
            $user->payment_password = bcrypt($all['pwd']);
            $user->save();

            return response()->json([
                'code' => 0,
                'message' => 'success'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }


    public function myorder()
    {
        return view('users.myorder');
    }

    public function sendsell()
    {
        $user = Auth::user();

        $orders = Order::where(['user_id' => $user->id , 'type' => "1"])->orderBy('created_at' , 'desc')->get();
        return view('users.myorder_type' , compact('orders'));
    }

    public function sendbought()
    {
        $user = Auth::user();

        $orders = Order::where(['user_id' => $user->id , 'type' => "2"])->orderBy('created_at' , 'desc')->get();
        return view('users.myorder_type' , compact('orders'));
    }

    public function getsell()
    {
        $user = Auth::user();

        $orders = UserOrder::where(['user_id' => $user->id, 'type' => "1"])->orderBy('created_at' , 'desc')->get();

        if(count($orders)){
            foreach ($orders as &$order){
                $orderModel = Order::where('hash_no' , $order->order_hash_id)->first();
                $order->hash_no =$orderModel->hash_no;
                $order->price = $orderModel->price;
                $order->coins = $orderModel->coins;
            }
        }


        return view('users.myorder_type' , compact('orders'));
    }


    public function getbought()
    {
        $user = Auth::user();

        $orders = UserOrder::where(['user_id' => $user->id, 'type' => "2"])->orderBy('created_at' , 'desc')->get();

        if(count($orders)){
            foreach ($orders as &$order){
                $orderModel = Order::where('hash_no' , $order->order_hash_id)->first();
                $order->hash_no =$orderModel->hash_no;
                $order->price = $orderModel->price;
                $order->coins = $orderModel->coins;
            }
        }

        return view('users.myorder_type' , compact('orders'));
    }

    public function myminer()
    {
        $user = Auth::id();
        $working = UserMiner::where(['user_id' => $user , 'status' => 'working'])->orderBy('created_at','desc')->get();

        $finished = UserMiner::where(['user_id' => $user , 'status' => 'over'])->orderBy('created_at','desc')->get();

        return view('users.myminer' , compact('working' , 'finished'));
    }

    public function mycash()
    {
        $user = Auth::id();
        $ins = Cash::where(['user_id' => $user , 'type' => "recharge" ])->orWhere(['user_id' => $user , 'type' => "sellcoin" ])->get();
        $outs = Cash::where(['user_id' => $user , 'type' => "withdraw" ])->orWhere(['user_id' => $user , 'type' => "buycoin" ])->get();

        $coin_name = Settings::get('coin_name');
        return view('users.cash' , compact('ins' , 'outs' , 'coin_name'));
    }

    public function mybill()
    {
        $user = Auth::id();
        $outs = CoinLog::where(['user_id' => $user ])->where('type' , '!=' , 3)->get();
        $ins = CoinLog::where(['user_id' => $user , 'type' => 3])->get();

        $coin_name = Settings::get('coin_name');
        return view('users.mybill' , compact('ins' , 'outs' , 'coin_name'));
    }

    public function inviter()
    {
        $user = Auth::user();

        $hash = $user->hash;

        $url = url('user/register/'.$hash);

        return view('users.inviter' , compact('url' , 'hash'));
    }

    public function mygroup()
    {

        $user = Auth::user();

        $hash = $user->hash;
        $users = User::where(['inviter' => $hash])->paginate(self::INVITER_USERS_PAGE_COUNT);

        return view('users.mygroup' , compact('users'));
    }
}
