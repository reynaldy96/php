<?php

namespace App\Http\Controllers\Admin\Kepemilikan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Hands;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class HandController extends Controller
{
    public function index()
    {
        $hands = Hands::latest()->paginate(4);

        return view('Pages.Admin.Kepemilikan.Index',compact('hands'));
    }

    public function store(request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:brands|max:255',
        ]);

        $name = $request->name;

        $product = Hands::updateOrCreate([
            'name' => $name,
            'slug' => Str::slug($request->get('name'))
        ]);

        $notification = Toastr::success('Berhasil Menambahkan Status Kepemilikan','Success');

        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $hands = Hands::findOrFail($id); 
        
        return view('Pages.Admin.Kepemilikan.Update',compact('hands'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);
  
        $data=array();
        $data['name']  = $request->name;
        $data['slug']  = Str::slug($request->get('name'));

        $update = Hands::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Berhasil Update Status Kepemilikan','Success');
                    return Redirect()->route('merkcategory_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Status Kepemilikan','Error');
                    return Redirect()->route('merkcategory_admin')->with($notification);
            }
    }

    public function delete($id)
    {
        Hands::findOrFail($id)->delete();

        $notification = Toastr::success(' Status Kepemilikan Berhasil diHapus','Success');

        return Redirect()->back()->with($notification);
    }
}
