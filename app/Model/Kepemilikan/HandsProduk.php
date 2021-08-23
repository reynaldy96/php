<?php

namespace App\Model\Kepemilikan;

use Illuminate\Database\Eloquent\Model;

class HandsProduk extends Model
{
    protected $guarded = [];

    protected $table = 'hands_product';

    public function Hands()
    {
        return $this->belongsTo('App\Model\Hands');
    }
}
