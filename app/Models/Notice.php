<?php

namespace App\Models;

use App\Traits\Admin\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Notice extends Model implements Transformable
{
    use TransformableTrait;
    use ActionButtonTrait;

    protected $table = "notices";

    protected $fillable = [
        'id' , 'title' , 'content' ,'published_at'
    ];
}
