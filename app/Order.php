<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function totalPrice()
    {
        $total = 0;
        foreach($this->orderProducts as $orderProduct)
        {
            $total += $orderProduct->price * $orderProduct->quantity;
        }
        return $total;
    }
}
