<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMiner extends Model
{
    protected $table = "user_miners";

    protected $fillable = [
        'id' , 'user_id' , 'miner_id' , 'finished' , 'number' , 'created_at' , 'updated_at' , 'order_no' , 'status'
    ];

    public function miner()
    {
        return $this->belongsTo(Miner::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
