<?php

namespace App\Http\Controllers\Member;

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

class SellerController extends Controller
{
    public function index()
    {
        $user = Sentinel::getUser();
        
        $prodcs = Product::where(['user_id' => $user->id])
        ->paginate(10);

        return view('Pages.Member.Dashboard')->with('prodcs', $prodcs);
    }

    public function create()
    {
        $countries = Provinsi::all();

        $categories = Category::all();

        $cod = Cods::all();
    
        return view('Pages.Member.Seller.Create',compact('countries','categories','cod'));
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

    public function store(Request $request)
    {
        $request->validate([
            'thumb.*' => 'image|mimes:jpg,jpeg,png,gif,bmp',
			'file_name.*' => 'image|mimes:jpg,jpeg,png,gif,bmp'
        ]);
        

        $notification=array(
            'messege'=>'Product Inserted Successfully',
            'alert-type'=>'success'
        );

        DB::transaction(function () use ($request) {
            $user = Sentinel::getUser();
            $province_id = $request->province_id;
            $cities_id = $request->cities_id;
            $districts_id = $request->districts_id;
            $category_id = $request->category_id;
            $sub_category_id = $request->sub_category_id;
            $merk_category_id = $request->merk_category_id;
            $cod_id = $request->cod_id;
            $hands_id = $request->hands_id;
            $price = $request->price;
            $body = $request->body;
            $description = $request->description;
            $name = $request->name;
            $quantity = $request->quantity;
            $thumbnails = $request->thumbnails;
            $images = $request->images;
            $phone_produk = $request->phone_produk;
            
            $product = Product::create([
                'price' => $price,
                'body' => $body,
                'phone_produk' => $phone_produk,
                'description' => $description,
                'name' => $name,
                'quantity' => $quantity,
                'user_id' => $user->id,
                'slug' => Str::slug($request->get('name'))
            ]);

            $productsearch =ProductSearch::create([
                'price' => $price,
                'body' => $body,
                'description' => $description,
                'name' => $name,
                'product_id' => $product->id,
                'user_id' => $user->id,
                'hands_id' => $hands_id,
                'province_id' => $province_id,
                'districts_id' => $districts_id,
                'cities_id' => $cities_id,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'brand_id' => $merk_category_id,
                'cod_id' => $cod_id,
                'slug' => Str::slug($request->get('name'))
            ]);

            UserProduct::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);

            HandsProduk::create([
                'hands_id' => $hands_id,
                'product_id' => $product->id
            ]);

            CodProduk::create([
                'cod_id' => $cod_id,
                'product_id' => $product->id
            ]);

            CategoryProduk::create([
                'category_id' => $category_id,
                'product_id' => $product->id
            ]);

            SubCategoryProduk::create([
                'sub_category_id' => $sub_category_id,
                'product_id' => $product->id
            ]);

            BrandCategoryProduk::create([
                'brand_id' => $merk_category_id,
                'product_id' => $product->id
            ]);

            ProvinsiProduk::create([
                'province_id' => $province_id,
                'product_id' => $product->id
            ]);

            KabupatenProduk::create([
                'districts_id' => $districts_id,
                'product_id' => $product->id
            ]);

            KotaProduk::create([
                'cities_id' => $cities_id,
                'product_id' => $product->id
            ]);

            foreach($images as $image) {
                $imagePath = Storage::disk('produk')->put($user->first_name . '/posts/' . $product->id, $image);
                ProductsImages::create([
                    'product_image_caption' => $name,
                    'product_image_path' => '/produk/' . $imagePath,
                    'product_id' => $product->id
                ]);
            }

            $thumbPath = Storage::disk('thumbnail')->put($user->first_name . '/posts/' . $product->id, $thumbnails);
            ProductsThumbnailImages::create([
                'thumbnail_product_image_caption' => $name,
                'thumbnail_product_image_path' => '/thumbnail/' . $thumbPath,
                'product_id' => $product->id,
                'product_search_user_id' => $productsearch->id
            ]);
        });
        $notification = Toastr::success('Anda Berhasil Menambahkan Barang, Menunggu persetujuan Admin','Success');

        return Redirect()->route('jual')->with($notification);
    }

    public function all()
    {
        $user = Sentinel::getUser();

        $products = DB::table('products')
            ->where(['user_id' => $user->id])
            ->paginate(10);         
        
        $waiting = DB::table('products')
            ->where(['user_id' => $user->id, 'featured' => false])
            ->paginate(10);         
        
        $publish = DB::table('products')
            ->where(['user_id' => $user->id, 'featured' => true])
            ->paginate(10);         

        return view('Pages.User.Seller.status',compact('products','waiting','publish'));
    }

    public function EditProduct($id, $slug )
    {
        $countries = Provinsi::all()->pluck("name","id");

        $categories = Category::all()->pluck("name","id");

        $product = Product::where(['id' => $id, 'slug' => $slug])->first(); 
        
        $cod = CodProduk::where(['product_id' => $id])->first(); 

        $hand = HandsProduk::where(['product_id' => $id])->first(); 

        $cate = CategoryProduk::where(['product_id' => $id])->first(); 

        $subcate = SubCategoryProduk::where(['product_id' => $id])->first(); 

        $brand = BrandCategoryProduk::where(['product_id' => $id])->first(); 

        $prov = ProvinsiProduk::where(['product_id' => $id])->first(); 

        $kab = KabupatenProduk::where(['product_id' => $id])->first(); 

        $kota = KotaProduk::where(['product_id' => $id])->first(); 
        
        return view('Pages.Member.Seller.Edit',compact('countries','categories','product','cod','hand','cate','subcate','brand','prov','kab','kota'));
    }

    public function UpdateProduct(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->get('name'));
        $data['price'] = $request->price;
        $data['body'] = $request->body;
        $data['description'] = $request->description;
        
        $product = Product::where('id' , $id)->update($data);

        HandsProduk::where('product_id' , $id)->update(['hands_id'=> $request->hands_id]);

        CodProduk::where('product_id' , $id)->update(['cod_id'=> $request->cod_id]);

        CategoryProduk::where('product_id' , $id)->update(['category_id'=> $request->category_id]);

        SubCategoryProduk::where('product_id' , $id)->update(['sub_category_id'=> $request->sub_category_id]);

        BrandCategoryProduk::where('product_id' , $id)->update(['merk_category_id'=> $request->merk_category_id]);

        ProvinsiProduk::where('product_id' , $id)->update(['province_id'=> $request->province_id]);

        KabupatenProduk::where('product_id' , $id)->update(['regency_id'=> $request->regency_id]);

        KotaProduk::where('product_id' , $id)->update(['district_id'=> $request->district_id]);

        $notification = Toastr::success('Barang Berhasil diPerbarui, Menunggu persetujuan Admin','Success');

        return Redirect()->route('jual')->with($notification);
    }

    public function EditImageProduct(Request $request, $product_id)
    {  
        $product = DB::table('ProductsImages')->find('product_id',$product_id); 

        $products = DB::table('ProductsThumbnailImages')->find('product_id',$product_id);
        
        return view('Pages.User.Seller.editimage',compact('product','products'));
    }

    public function UpdateImageProduct(Request $request, $id)
    {
        $data = array();
     
        $update = DB::table('products')->where('id',$id)->update($data);
        return Redirect()->route('information_barang');
    }
}
