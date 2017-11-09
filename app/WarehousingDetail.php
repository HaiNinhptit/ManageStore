<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehousingDetail extends Model
{
    //
    protected $fillable = [
        'product_id', 'quantity', 'price', 'date',
    ];

    protected $table = 'warehousing_detail';

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
