<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_delivery_id',
        'total',
        'status_id',
        'cupom_id'
    ];

    public function transform()
    {
        return [
            'order' => $this->id
        ];
    }

    public function cupom(){
        return $this->belongsTo(Cupom::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman(){
        return $this->belongsTo(User::class,'user_delivery_id');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function products(){
        $this->hasMany(Product::class);
    }

}
