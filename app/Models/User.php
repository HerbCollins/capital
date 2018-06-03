<?php

namespace App\Models;

use App\Traits\Admin\ActionButtonTrait;
use Illuminate\Foundation\Auth\User as AuthUser;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends AuthUser implements Transformable
{
    use TransformableTrait;
    use ActionButtonTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'username' , 'rmb' , 'phone' , 'email', 'password', 'payment_password', 'hash' , 'inviter' , 'coin' , 'wechat' , 'alipay' ,'bankcard' , 'bank'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function miner()
    {
        return $this->belongsToMany(Miner::class , 'user_miners');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function cointype()
    {
        return $this->hasMany(CoinLog::class);
    }
}
