<?php

namespace App\Model\ProdukCategory;

use Illuminate\Database\Eloquent\Model;

class SubCategoryProduk extends Model
{
    protected $guarded = [];

    protected $table = 'sub_category_product';

    public function SubCategory()
    {
        return $this->belongsTo('App\Model\Category\SubCategory');
    }
}
