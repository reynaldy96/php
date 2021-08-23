<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    protected $table = 'sub_category';

    public function Category()
    {
    	return $this->belongsTo('App\Model\Category\Category');
    }

    public function IndexCategory()
    {
    	return $this->hasOne('App\Model\Category\Category');
    }

    public function SubCategoryProduk()
    {
        return $this->belongsTo('App\Model\ProdukCategory\SubCategoryProduk');
    }
}
