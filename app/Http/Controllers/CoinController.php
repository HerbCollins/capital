<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\CoinLog;
use App\Models\Miner;
use App\Repositories\Eloquent\UserMinerRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoinController extends Controller
{
    private $userMinerRepositoryEloquent;

    private $user;

    const COIN_NAME = 'coin_name';

    private $coin_name;


    public function __construct(UserMinerRepositoryEloquent $userMinerRepositoryEloquent)
    {
        $this->middleware('auth:users');

        $this->userMinerRepositoryEloquent = $userMinerRepositoryEloquent;

        $this->user = Auth::user();

        $this->coin_name = Settings::get(self::COIN_NAME);
    }

    public function index()
    {
        $miners = Miner::all();
        $coin_name = $this->coin_name;
        return view('coin.index' , compact('miners' , 'coin_name'));
    }

    public function buyOrder(Request $request)
    {
        $input = $request->except('_token');

        $miner_id = $input['miner_id'];
        $number = $input['number'];

        $miner = Miner::find($miner_id);

        if(!isset($miner->id)){
            abort(404 , '未找到对应矿机');
        }

        $bought = $this->userMinerRepositoryEloquent->userBought($miner_id , $this->user->id);

        if($number + $bought >= $miner->max){
            flash( '此次购买累计数量已超过限购最大量' , 'error');
            $number = $miner->max - $bought;
        }



        $working = $this->userMinerRepositoryEloquent->workingNumber($miner_id , $this->user->id);

        if($number + $working >= $miner->exist_max)
        {
            flash('此次购买累计数量已超过同时存在最大量' , 'error');

            $number = $miner->exist_max - $working;
        }


        if($number > $miner->day_max)
        {
            flash('此次购买累计数量已超过每天限购最大量' , 'error');

            $number = $miner->day_max;
        }


        $order_no = generateOrderId();

        $coin_name = $this->coin_name . '币';

        return view('coin.buyorder' , compact('miner' , 'number' , 'bought' , 'working' , 'order_no' , 'coin_name'));

    }

    public function payment(Request $request)
    {
        DB::beginTransaction();
        try{
            $miner_id = $request['miner_id'];
            $user_id = $this->user->id;
            $number = $request['number'];
            $order_no = $request['order_no'];
            $this->userMinerRepositoryEloquent->payment($miner_id , $user_id, $order_no , $number );



            Log::info("[CoinController@payment] user [".$this->user->name . "] bought [" . $number ."] miner [".$miner_id."]");

            DB::commit();

            return response()->json([
                'code' => 0,
                'message' => 'success'
            ]);
        }catch (\Exception $e){
            DB::rollback();
            Log::error("[CoinController@payment] code ".$e->getCode() . "message :" .$e->getMessage());
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
