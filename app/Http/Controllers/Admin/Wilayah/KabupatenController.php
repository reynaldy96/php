<?php

namespace App\Http\Controllers\Admin\Wilayah;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Wilayah\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupaten = Kabupaten::latest()->paginate(100);

        return view('Pages.Admin.Wilayah.WilayahKabupaten.Index',compact('kabupaten'))->with('i', (request()->input('page', 1) - 1) * 4);
    }
}
