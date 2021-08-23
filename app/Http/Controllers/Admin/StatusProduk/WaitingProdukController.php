<?php

namespace App\Http\Controllers\Admin\StatusProduk;
use App\Model\Product;
use App\Model\ProdukCod\CodProduk;

use App\Model\ProdukCategory\CategoryProduk;
use App\Model\ProdukCategory\SubCategoryProduk;
use App\Model\ProdukCategory\BrandCategoryProduk;

use App\Model\WilayahProduk\ProvinsiProduk;
use App\Model\WilayahProduk\KabupatenProduk;
use App\Model\WilayahProduk\KotaProduk;
use App\Model\ProductSearch;
use App\Model\UserProduct;
use App\Model\Kepemilikan\HandsProduk;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class WaitingProdukController extends Controller
{
    public function index()
    {
        $waiting = Product::where(['status' => false,
        'featured' => false])
        ->paginate(10);

        return view('Pages.Admin.Produk.Waiting.Index',compact('waiting'));
    }

    public function edit($id)
    {
        $waiting = Product::find($id);
    
        $multiple = DB::table('products_images')
        ->join('products','products_images.product_id','products.id')
        ->select('products_images.*','products.*')
        ->where('product_id', $id)
        ->get();

        return view('Pages.Admin.Produk.Waiting.Update',compact('waiting','multiple'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'featured' => 'required',
            'status' => 'required',
        ]);
  
        $data=array();
        $data['featured'] = $request->featured;
        $data['status'] = $request->status;

        $update = Product::findOrFail($id)->update($data);

        ProductSearch::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Product User Berhasil Publish','Success');
                    return Redirect()->route('waiting_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Status Product, Pastikan Product User sudah diPeriksa !!!','Error');
                    return Redirect()->route('waiting_admin')->with($notification);
            }
    }
}
