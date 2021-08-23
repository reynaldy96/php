<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hands extends Model
{
    protected $guarded = [];

    protected $table = 'hands';

    public function HandsProduk()
    {
        return $this->belongsTo('App\Model\Kepemilikan\HandsProduk');
    }
}
