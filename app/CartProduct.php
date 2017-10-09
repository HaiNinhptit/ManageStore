<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    //
    protected $fillable = [
        'cart_id', 'product_id', 'quantity',
    ];

    protected $table = 'cart_product';

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
