<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $table = 'products';

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category\Category');
    }

    public function UserProduct()
    {
        return $this->hasOne('App\Model\UserProduct');
    }

    public function presentPrice()
    {
        return '$'.number_format($this->price / 100, 2);
    }

    public function ProductsThumbnailImages()
    {
        return $this->hasOne('App\Model\ProductsThumbnailImages');
    }

    public function HandsProduk()
    {
        return $this->hasOne('App\Model\Kepemilikan\HandsProduk');
    }

    public function ProductsImages()
    {
        return $this->hasMany('App\Model\ProductsImages');
    }

    public function CodProduk()
    {
        return $this->hasOne('App\Model\ProdukCod\CodProduk');
    }

    public function ProvinsiProduk()
    {
        return $this->hasOne('App\Model\WilayahProduk\ProvinsiProduk');
    }

    public function KabupatenProduk()
    {
        return $this->hasOne('App\Model\WilayahProduk\KabupatenProduk');
    }

    public function KotaProduk()
    {
        return $this->hasOne('App\Model\WilayahProduk\KotaProduk');
    }

    public function CategoryProduk()
    {
        return $this->hasOne('App\Model\ProdukCategory\CategoryProduk');
    }

    public function SubCategoryProduk()
    {
        return $this->hasOne('App\Model\ProdukCategory\SubCategoryProduk');
    }

    public function BrandCategoryProduk()
    {
        return $this->hasOne('App\Model\ProdukCategory\BrandCategoryProduk');
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
