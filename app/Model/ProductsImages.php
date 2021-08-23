<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    protected $guarded = [];

    protected $table = 'products_images';

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
