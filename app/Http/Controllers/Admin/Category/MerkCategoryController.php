<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\BrandCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class MerkCategoryController extends Controller
{
    public function index()
    {
        $subcategory = SubCategory::all();

        $Brandcategory = BrandCategory::latest()->paginate(4);

        return view('Pages.Admin.Category.BrandCategoryProduk.Index',compact('subcategory','Brandcategory'));
    }

    public function store(request $request)
    {
        $validateData = $request->validate([
            'sub_category_id' => 'required',
            'name' => 'required|unique:brands|max:255',
        ]);

        $sub_category_id = $request->sub_category_id;
        $name = $request->name;

        $product = BrandCategory::updateOrCreate([
            'sub_category_id' => $sub_category_id,
            'name' => $name,
            'slug' => Str::slug($request->get('name'))
        ]);

        $notification = Toastr::success('Berhasil Menambahkan Merk Category','Success');

        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $brandcategory = BrandCategory::findOrFail($id); 
        
        return view('Pages.Admin.Category.BrandCategoryProduk.Update',compact('brandcategory'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);
  
        $data=array();
        $data['sub_category_id'] = $request->sub_category_id;
        $data['name']  = $request->name;
        $data['slug']  = Str::slug($request->get('name'));

        $update = BrandCategory::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Berhasil Update Merk Category','Success');
                    return Redirect()->route('merkcategory_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Merk Category','Error');
                    return Redirect()->route('merkcategory_admin')->with($notification);
            }
    }

    public function delete($id)
    {
        BrandCategory::findOrFail($id)->delete();

        $notification = Toastr::success(' Merk Category Berhasil diHapus','Success');

        return Redirect()->back()->with($notification);
    }
}
