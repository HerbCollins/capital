<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table = "user_orders";

    protected $fillable = [
        'id' , 'order_no' , 'user_id' , 'type' , 'status'
    ];
}
