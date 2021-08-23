<?php

namespace App\Http\Controllers\Admin\Wilayah;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Wilayah\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KotaController extends Controller
{
    public function index()
    {
        $kota = Kota::latest()->paginate(100);

        return view('Pages.Admin.Wilayah.WilayahKota.Index',compact('kota'))->with('i', (request()->input('page', 1) - 1) * 4);
    }
}
