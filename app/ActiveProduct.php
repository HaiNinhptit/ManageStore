<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveProduct extends Model
{
    //
    protected $fillable = [
        'product_id', 'quantity',
    ];    

    protected $table = 'active_product';

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
