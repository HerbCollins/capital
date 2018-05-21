<?php

namespace App\Models;

use App\Traits\Admin\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Miner extends Model implements Transformable
{
    use TransformableTrait;
    use ActionButtonTrait;

    public $table = 'miners';

    protected $fillable = [
        'id' , 'title' , 'img' , 'price' , 'max' , 'day_max' , 'exist_max' , 'income' , 'timelong' , 'cycle'
    ];


}
