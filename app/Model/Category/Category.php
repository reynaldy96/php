<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $table = 'category';
    
    public function SubCategory()
    {
    	return $this->belongsTo('App\Model\Category\SubCategory');
    }

    public function IndexSubCategory()
    {
    	return $this->belongsTo('App\Model\Category\SubCategory');
    }
}
