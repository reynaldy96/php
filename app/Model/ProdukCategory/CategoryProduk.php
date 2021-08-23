<?php

namespace App\Model\ProdukCategory;

use Illuminate\Database\Eloquent\Model;

class CategoryProduk extends Model
{
    protected $guarded = [];

    protected $table = 'category_product';

    public function Category()
    {
        return $this->belongsTo('App\Model\Category\Category');
    }
}
