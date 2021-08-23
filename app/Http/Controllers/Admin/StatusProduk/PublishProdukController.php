<?php

namespace App\Http\Controllers\Admin\StatusProduk;

use App\Model\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PublishProdukController extends Controller
{
    public function index()
    {
        $prodcs = Product::where(['status' => true,
        'featured' => true])
        ->paginate(10);

        return view('Pages.Admin.Produk.Publish.index',compact('prodcs'));
    }

    public function edit()
    {
        return view();
    }

    public function update(Request $request)
    {
        return view();
    }
}
