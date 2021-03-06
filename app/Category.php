<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'trademark',
    ];
     
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function productsWoman()
    {
        return $this->products()->where('trademark', '=', 'Woman');
    }
}
