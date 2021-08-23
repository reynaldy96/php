<?php

namespace App\Http\Controllers\Admin\Wilayah;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Wilayah\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::latest()->paginate(100);

        return view('Pages.Admin.Wilayah.WilayahProvinsi.Index',compact('provinsi'))->with('i', (request()->input('page', 1) - 1) * 4);
    }
}
