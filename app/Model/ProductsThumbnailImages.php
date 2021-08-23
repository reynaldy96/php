<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsThumbnailImages extends Model
{
    protected $guarded = [];

    protected $table = 'products_thumbnail_images';

    public function products()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
