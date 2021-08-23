<?php

namespace App\Model\WilayahProduk;

use Illuminate\Database\Eloquent\Model;

class KabupatenProduk extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_districts_product';

    public function Districts()
    {
        return $this->belongsTo('App\Model\Wilayah\Kabupaten');
    }
}
