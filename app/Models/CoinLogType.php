<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinLogType extends Model
{
    protected $table = 'coin_log_type';

    protected $fillable = [
        'id' , 'type'
    ];
}
