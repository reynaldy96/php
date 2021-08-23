<?php

namespace App\Model\WilayahProduk;

use Illuminate\Database\Eloquent\Model;

class KotaProduk extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_cities_product';

    public function Cities()
    {
        return $this->belongsTo('App\Model\Wilayah\Kota');
    }
}
