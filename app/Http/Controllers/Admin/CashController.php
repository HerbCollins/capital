<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cash;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CashController extends Controller
{
    public function __construct()
    {
    }

    public function draw()
    {
        $cashs = Cash::where('type' , 'withdraw')->with('user')->orderBy('created_at' , 'desc')->paginate(20);

        return view('admin.cashs.draw' , compact('cashs'));
    }

    /**
     * 驳回
     *
     * @author Maker <maker68@163.com>
     */
    public function reply($id)
    {
        try{
            $cash = Cash::find($id);
            $cash->status = "3";
            $cash->save();

            flash('操作成功' , 'success');

            return Redirect::back();
        }catch (\Exception $e){
            flash($e->getMessage() , 'error');

            return Redirect::back();
        }

    }
    /**
     * 已处理
     *
     * @author Maker <maker68@163.com>
     */
    public function dealed($id)
    {
        try{
            $cash = Cash::find($id);
            $cash->status = "2";
            $cash->save();

            flash('操作成功' , 'success');

            return Redirect::back();
        }catch (\Exception $e){
            flash($e->getMessage() , 'error');

            return Redirect::back();
        }

    }

    public function recharge()
    {
        return view('admin.cashs.recharge');
    }

    public function rechargelist()
    {
        $lists = Cash::where(['type' => 'recharge'])->paginate(20);
        return view('admin.cashs.recharge_list' , compact('lists'));
    }

    public function dealrecharge(Request $request)
    {
        DB::beginTransaction();
        try{
            $rmb = $request['rmb'];

            if($rmb < 0 || !$rmb ){
                throw new \Exception('参数错误' , 10001);
            }

            $user = User::where('hash' , $request['hash_no'])->first();

            $cash = new Cash();
            $cash->cash_no = generateOrderId();
            $cash->type = "recharge";
            $cash->rmb = $rmb;
            $cash->user_id = $user->id;
            $cash->status = "finished";
            $cash->save();

            $user = User::find($user->id);
            $user->rmb = $user->rmb + $rmb;
            $user->save();

            flash('操作成功' , 'success');
            Log::info("[CashController@dealrecharge] success ");
            DB::commit();
            return Redirect::back();
        }catch (\Exception $e){
            DB::rollback();
            flash($e->getMessage() , 'error');
            Log::error("[CashController@dealrecharge] error message : " . $e->getMessage());
            return Redirect::back();
        }
    }

}
