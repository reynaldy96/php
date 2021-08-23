<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cods extends Model
{
    protected $guarded = [];

    protected $table = 'cod';

    public function CodProduk()
    {
        return $this->belongsTo('App\Model\ProdukCod\CodProduk');
    }
}
