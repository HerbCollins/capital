<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = 'cashs';

    protected $fillable = [
        'id' , 'user_id' , 'cash_no' , 'coin' , 'price' , 'type' , 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
