<?php

namespace App\Model\ProdukCategory;

use Illuminate\Database\Eloquent\Model;

class BrandCategoryProduk extends Model
{
    protected $guarded = [];

    protected $table = 'brands_product';

    public function Brand()
    {
        return $this->belongsTo('App\Model\Category\BrandCategory');
    }

}
