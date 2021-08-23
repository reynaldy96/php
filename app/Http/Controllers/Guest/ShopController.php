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
use App\Model\ProductSearch;
use App\Model\UserProduct;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use App\Model\NotificationQaMessage;
use App\Model\NotificationQaTopic;
use Sentinel;
use Storage;
use App\Model\Wilayah\Provinsi;
use App\Model\Wilayah\Kota;
use App\Model\Wilayah\Kabupaten;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\BrandCategory;
use Response;
use App\Model\ProdukCategory\CategoryProduk;
use App\Model\ProdukCategory\SubCategoryProduk;
use App\Model\ProdukCategory\BrandCategoryProduk;

use App\Model\Kepemilikan\HandsProduk;
use App\Model\ProdukCod\CodProduk;
use App\Model\Cods;

use App\Model\WilayahProduk\ProvinsiProduk;
use App\Model\WilayahProduk\KabupatenProduk;
use App\Model\WilayahProduk\KotaProduk;

use Brian2694\Toastr\Facades\Toastr;

class ShopController extends Controller
{
    public function index()
    {
        $countries = Provinsi::all();

        $categories1 = Category::all();

        $cod = Cods::all();

        $pagination = 8;
        $categories = Category::all();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('Pages.Guest.Shop.Shop')->with([
            'products' => $products,
            'categories' => $categories,
            'countries' => $countries,
            'categories1' => $categories1,
            'categoryName' => $categoryName,
        ]);
    }

    public function getStateList($param)
    {
        $city = Kota::where('province_id','=',$param)->get();

        $options = array();      
            foreach ($city as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }

        return Response::json($options);
    }

    public function getCityList($param)
    {
        $cities = Kabupaten::where('city_id','=',$param)->get();

        $options = array();      
            foreach ($cities as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }
        
        return Response::json($options);                
    }

    public function getSubCategory($param)
    {
        $subcate = SubCategory::where('category_id','=',$param)->get();

        $options = array();      
            foreach ($subcate as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }
        
        return Response::json($options);  
    }

    public function getBrandCategory($param)
    {
        $brand = BrandCategory::where('sub_category_id','=',$param)->get();

        $options = array();      
            foreach ($brand as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }
        
        return Response::json($options);  
    }

    public function search(Request $request)
    {
 
        $query = $request->get('query');

        $products = ProductSearch::where('province_id', 'like', "%$query%")
                        ->orWhere('body', 'like', "%$query%")
                        ->orWhere('description', 'like', "%$query%")
                        ->orWhere('province_id', 'like', "%$query%")
                        ->orWhere('cities_id', 'like', "%$query%")
                        ->orWhere('districts_id', 'like', "%$query%")
                        ->orWhere('brand_id', 'like', "%$query%")
                        ->orWhere('category_id', 'like', "%$query%")
                        ->orWhere('sub_category_id', 'like', "%$query%")
                        ->paginate(10);

        return view('Pages.Guest.Shop.SearchResults')->with('products', $products);
    }

    public function show($slug)
    {
        $pagination = 4;
        $multiple = DB::table('products_images')
        ->join('products','products_images.product_id','products.id')
        ->select('products_images.*','products.*')
        ->where('slug', $slug)
        ->get();

        $komentar = DB::table('member_notification_message')
        ->join('products','member_notification_message.product_id','products.id')
        ->select('member_notification_message.*','products.*')
        ->where('slug', $slug)
        ->paginate($pagination);
        
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        return view('Pages.Guest.Shop.Product')->with([
            'multiple' => $multiple,
            'product' => $product,
            'komentar' => $komentar,
            'mightAlsoLike' => $mightAlsoLike,
        ]);
    }
}
