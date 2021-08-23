<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Model\Product;
use App\Model\UserProduct;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use Sentinel;
use Storage;
use App\Model\Wilayah\Provinsi;
use App\Model\Wilayah\Kota;
use App\Model\Wilayah\Kabupaten;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\BrandCategory;

use App\Model\ProdukCategory\CategoryProduk;
use App\Model\ProdukCategory\SubCategoryProduk;
use App\Model\ProdukCategory\BrandCategoryProduk;

use App\Model\Kepemilikan\HandsProduk;
use App\Model\ProdukCod\CodProduk;

use App\Model\WilayahProduk\ProvinsiProduk;
use App\Model\WilayahProduk\KabupatenProduk;
use App\Model\WilayahProduk\KotaProduk;

use Brian2694\Toastr\Facades\Toastr;
class LandingPageController extends Controller
{
    public function index()
    {
        $prodcs = Product::where('featured', true)->take(8)->get();

        return view('Pages.Guest.Home')->with('prodcs', $prodcs);
    }
}
