<?php

namespace App\Model\WilayahProduk;

use Illuminate\Database\Eloquent\Model;

class ProvinsiProduk extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_provinces_product';

    public function Province()
    {
        return $this->belongsTo('App\Model\Wilayah\Provinsi');
    }
}
