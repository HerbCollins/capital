<?php

namespace App\Models;

use App\Traits\Admin\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;
    use ActionButtonTrait;

    protected $table = "orders";

    protected $fillable = [
        'id' , 'hash_no' , 'user_id' , 'coins' , 'price' , 'type' , 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
