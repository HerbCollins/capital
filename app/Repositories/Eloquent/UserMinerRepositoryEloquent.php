<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/27 0027
 * Time: 17:57
 */

namespace App\Repositories\Eloquent;


use App\Models\Miner;
use App\Models\User;
use App\Models\UserMiner;

class UserMinerRepositoryEloquent
{

    public function userBought($miner_id , $user_id)
    {
        return UserMiner::where(['miner_id' => $miner_id , 'user_id' => $user_id])->sum('number') ? : 0;
    }

    public function workingNumber($miner_id , $user_id)
    {
        $miner = Miner::find($miner_id);
        if(isset($miner->cycle)){
            return UserMiner::where(['miner_id' => $miner_id , 'user_id' => $user_id])
                ->where('finished' , '<' , $miner->cycle)
                ->sum('number') ? : 0;
        }else{
            return 0;
        }
    }

    public function payment($miner_id , $user_id , $order_no , $number = 0)
    {
        $miner = Miner::find($miner_id);
        $user = User::find($user_id);

        if(isset($miner->cycle)){

            $userBought = $this->userBought($miner_id , $user_id);

            if($userBought + $number > $miner->max){
                throw new \Exception('购买量超出限购最大量' , 10001);
            }

            $working = $this->workingNumber($miner_id , $user_id);

            if($working + $number > $miner->exist_max){
                throw new \Exception('同时存在量超出最大同时存在量' , 10002);
            }

            $payment = $number * $miner->price;

            if($user->coin > $payment){
                $user->coin  = $user->coin - $payment;
                $user->save();
            }else{
                throw new \Exception('金币不足' , 10003);
            }


            $userMiner = new UserMiner();
            $userMiner->user_id = $user_id;
            $userMiner->miner_id = $miner_id;
            $userMiner->number = $number;
            $userMiner->order_no = $order_no;
            $userMiner->save();
        }else{
            throw new \Exception('未找到相关矿机' , 10000);
        }
    }
}