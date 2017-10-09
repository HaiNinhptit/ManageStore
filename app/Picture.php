<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable = [
        'name', 'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
