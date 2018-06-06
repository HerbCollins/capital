<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\SMSRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;

class SMSController extends Controller
{
    public $sms;

    const SEND_LOCK_TIME = 60; // 1min 内不能再发送

    const SAVE_CODE_TIME = 600;  // 验证码保存10分钟

    const PREFIX_SESSION_LOCK = 'Lock_';

    const PREFIX_SAVE_SESSEION = 'CODE_';

    public function __construct(SMSRepository $repository)
    {
        $this->sms = $repository;
    }


    public function send(Request $request)
    {
        try{
            $phone = $request['phone'];

            if(!isMob($phone)){
                return response()->json([
                    'code' => 10004,
                    'message' =>"手机号格式不对"
                ]);
            }

            $count = User::where('phone' , $phone)->count();
            if($count > 0){
                return response()->json([
                    'code' => 10005,
                    'message' =>"手机已被注册"
                ]);
            }


            if(self::isLock($phone)){
                return response()->json([
                    'code' => 10001,
                    'message' =>"发送过于频繁"
                ]);
            }

            // 10分钟内 发送同一个验证码
            if(!($code = self::hasRemeberCode($phone))){
                $code = mt_rand(100000 , 999999);
            }

            $resp = $this->sms->send($phone , ['code'=>$code]);
            $codes = Config::get('alicode.sms_ecodes');

            if($resp->Code == "OK"){

                // 1分钟锁定
                self::lock($phone);

                // 10分钟保存
                self::remeberCode($phone , $code);

                return response()->json([
                    'code' => 0,
                    'message' => '验证短信已发送'
                ]);
            }elseif(array_key_exists($resp->Code , $codes)){
                return response()->json([
                    'code' => 10002,
                    'message' =>$codes[$resp->Code]
                ]);
            }else{
                return response()->json([
                    'code' => 10003,
                    'message' => "未知错误"
                ]);
            }
        }catch (\Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    private static function lock($phone)
    {
        $key = self::PREFIX_SESSION_LOCK.$phone;
        return Redis::setex($key , self::SEND_LOCK_TIME , 1);
    }

    private static function isLock($phone)
    {
        $key = self::PREFIX_SESSION_LOCK.$phone;
        if(!Redis::exists($key)){
            return false;
        }else{
            return true;
        }
    }

    private static function remeberCode($phone , $code)
    {
        $key = self::PREFIX_SAVE_SESSEION . $phone;
        if(!Redis::exists($key)){
            Redis::setex($key , self::SAVE_CODE_TIME , $code );
        }
    }

    private static function hasRemeberCode($phone)
    {
        $key = self::PREFIX_SAVE_SESSEION . $phone;
        if(Redis::exists($key)){
            return Redis::get($key);
        }else{
            return false;
        }
    }

}
