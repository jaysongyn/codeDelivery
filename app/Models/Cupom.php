<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cupom extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'cupoms';

    protected $fillable = [
        'id',
        'code',
        'value'
    ];

}
