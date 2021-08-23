<?php

namespace App\Model\ProdukCod;

use Illuminate\Database\Eloquent\Model;

class CodProduk extends Model
{
    protected $guarded = [];

    protected $table = 'cod_product';

    public function Cod()
    {
        return $this->belongsTo('App\Model\Cods');
    }

}
