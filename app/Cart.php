<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CartProduct;
use Product;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function cartProducts()
    {
        return $this->hasMany('App\CartProduct');
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->cartProducts as $cart_product) {
            $total += $cart_product['quantity'] * $cart_product->product->price;
        }
        return $total;
    }

    public function countItem()
    {
        $count = 0;
        foreach ($this->cartProducts as $cart_product) {
            $count += $cart_product['quantity'];
        }
        return $count;
    }
}
