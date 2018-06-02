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
        'name' , 'phone' , 'email', 'password', 'hash' , 'inviter' , 'coin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
