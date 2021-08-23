<?php

namespace App\Model\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_districts';

    public function Provinsi()
    {
    	return $this->belongsTo('App\Model\Wilayah\Provinsi');
    }

    public function IndexProvinsi()
    {
    	return $this->hasOne('App\Model\Wilayah\Provinsi');
    }

    public function KabupatenProduk()
    {
        return $this->belongsTo('App\Model\WilayahProduk\KabupatenProduk');
    }
}
