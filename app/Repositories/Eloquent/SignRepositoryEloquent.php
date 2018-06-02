<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/25 0025
 * Time: 20:01
 */

namespace App\Repositories\Eloquent;


use App\Models\Sign;
use App\Repositories\Contracts\SignRepository as SignRepositoryInterface;
use Carbon\Carbon;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class SignRepositoryEloquent
{

    public function model()
    {
        return Sign::class;
    }


    public function sign($user_id)
    {
        $date = Carbon::today()->toDateString();
        $rst = Sign::where(['date' => $date , 'user_id' => $user_id])->first();
        if(isset($rst->id)){
            throw new \Exception('今天已签过' , 20001);
        }else{
            $sign = new Sign();
            $sign->user_id = $user_id;
            $sign->date = $date;
            $sign->save();
        }
    }
}