<?php

namespace App\Model\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_provinces';

    public function Kabupaten()
    {
    	return $this->belongsTo('App\Model\Wilayah\Kabupaten');
    }

    public function ProvinsiProduk()
    {
        return $this->belongsTo('App\Model\WilayahProduk\ProvinsiProduk');
    }
}
