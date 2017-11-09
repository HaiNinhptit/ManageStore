<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'category_id', 'price',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Cart');
    }

    public function cartProducts()
    {
        return $this->hasMany('App\CartProduct');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function countComment()
    {
        return $this->hasMany('App\Comment')->count();
    }

    public function warehousingDetails()
    {
        return $this->hasMany('App\WarehousingDetail');
    }

    public function activeProduct()
    {
        return $this->hasOne('App\ActiveProduct');
    }

    //check active product
    public function checkActive()
    {
        return $this->activeProduct->quantity > 0;
    }
}
