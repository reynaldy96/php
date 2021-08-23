<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        $subcategory = SubCategory::latest()->paginate(4);

        return view('Pages.Admin.Category.SubCategoryProduk.Index',compact('category','subcategory'));
    }

    
    public function store(request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_category|max:255',
        ]);

        $category_id = $request->category_id;
        $name = $request->name;

        $product = SubCategory::updateOrCreate([
            'category_id' => $category_id,
            'name' => $name,
            'slug' => Str::slug($request->get('name'))
        ]);

        $notification = Toastr::success('Berhasil Menambahkan Jenis Category','Success');

        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id); 
        
        return view('Pages.Admin.Category.SubCategoryProduk.Update',compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);
  
        $data=array();
        $data['category_id'] = $request->category_id;
        $data['name']  = $request->name;
        $data['slug']  = Str::slug($request->get('name'));

        $update = SubCategory::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Berhasil Update Jenis Category','Success');
                    return Redirect()->route('subcategory_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Jenis Category','Error');
                    return Redirect()->route('subcategory_admin')->with($notification);
            }
    }

    public function delete($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = Toastr::success(' Jenis Category Berhasil diHapus','Success');

        return Redirect()->back()->with($notification);
    }
}
