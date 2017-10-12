<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id', 'product_id', 'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function getTime()
    {
        $time = $this->created_at->format('d M Y - H:i:s');
        return $time;
    }
}
