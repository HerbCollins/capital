<?php

namespace App\Http\Controllers\User;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\CoinLog;
use App\Models\Miner;
use App\Models\Order;
use App\Models\Sign;
use App\Models\User;
use App\Models\UserMiner;
use App\Models\UserOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public $coin_name;

    const COIN_NAME = 'coin_name';

    const INVITER_USERS_PAGE_COUNT = 10;

    public function __construct()
    {
        $this->coin_name = Settings::get(self::COIN_NAME);
    }

    public function index()
    {
        $user = Auth::user();
        $coin_name = $this->coin_name;
        $sign = Sign::where(['date' => Carbon::today()->toDateString() , 'user_id' => $user->id])->first();

        $is_signed = isset($sign->id) ? true : false;
        return view('users.index' , compact('user' , 'coin_name' , 'is_signed'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit' , compact('user'));
    }

    public function update(Request $request)
    {

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
        return view('users.myorder_type' , compact('orders'));
    }


    public function getbought()
    {
        $user = Auth::user();

        $orders = UserOrder::where(['user_id' => $user->id, 'type' => "2"])->orderBy('created_at' , 'desc')->get();
        return view('users.myorder_type' , compact('orders'));
    }

    public function mycash()
    {

    }

    public function myminer()
    {
        $user = Auth::id();
        $working = UserMiner::where(['user_id' => $user , 'status' => 'working'])->orderBy('created_at','desc')->get();

        $finished = UserMiner::where(['user_id' => $user , 'status' => 'over'])->orderBy('created_at','desc')->get();

        return view('users.myminer' , compact('working' , 'finished'));
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
