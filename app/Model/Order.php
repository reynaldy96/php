<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Model\Product')->withPivot('quantity');
    }

    public function kode()
    {
        return $this->hasOne('App\Model\Order\BankTransferOrderProduct');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }
}

