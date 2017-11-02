<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rules', 'active', 'random_check',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function totalOrderPrice()
    {
        $total = 0;
        foreach($this->orders as $order)
        {
            $total += $order->totalPrice();
        }
        return $total;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
