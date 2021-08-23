<?php

namespace App\Http\Controllers\Admin\TransaksiCod;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Cods;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CodController extends Controller
{
    public function index()
    {
        $cod = Cods::latest()->paginate(4);

        return view('Pages.Admin.TransaksiCod.Index',compact('cod'));
    }

    public function store(request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:brands|max:255',
        ]);

        $name = $request->name;

        $product = Cods::updateOrCreate([
            'name' => $name,
            'slug' => Str::slug($request->get('name'))
        ]);

        $notification = Toastr::success('Berhasil Menambahkan Status TransaksiCod','Success');

        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $cod = Cods::findOrFail($id); 
        
        return view('Pages.Admin.TransaksiCod.Update',compact('cod'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);
  
        $data=array();
        $data['name']  = $request->name;
        $data['slug']  = Str::slug($request->get('name'));

        $update = Cods::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Berhasil Update Status TransaksiCod','Success');
                    return Redirect()->route('cods_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Status TransaksiCod','Error');
                    return Redirect()->route('cods_admin')->with($notification);
            }
    }

    public function delete($id)
    {
        Cods::findOrFail($id)->delete();

        $notification = Toastr::success(' Status TransaksiCod Berhasil diHapus','Success');

        return Redirect()->back()->with($notification);
    }
}
