<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
    protected $guarded = [];

    protected $table = 'brands';

    public function SubCategory()
    {
    	return $this->belongsTo('App\Model\Category\SubCategory');
    }

    public function IndexSubCategory()
    {
    	return $this->hasOne('App\Model\Category\SubCategory');
    }

    public function BrandCategoryProduk()
    {
        return $this->belongsTo('App\Model\ProdukCategory\BrandCategoryProduk');
    }
}
