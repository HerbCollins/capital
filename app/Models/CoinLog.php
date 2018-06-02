<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinLog extends Model
{
    protected $table = "coin_log";

    protected $fillable = [
        'id' , 'user_id' , 'coin' , 'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function log_type()
    {
        return $this->belongsTo(CoinLogType::class, 'type' );
    }
}
