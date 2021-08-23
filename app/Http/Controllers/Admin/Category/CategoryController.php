<?php

namespace App\Http\Controllers\Admin\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Category\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->paginate(4);
      
        return view('Pages.Admin.Category.CategoryProduk.Index',compact('category'))->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function store(request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:category|max:255',
        ]);

        $name = $request->name;

        $product = Category::updateOrCreate([
            'name' => $name,
            'slug' => Str::slug($request->get('name'))
        ]);

        $notification = Toastr::success('Berhasil Menambahkan Category','Success');

        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $category = Category::find($id); 
        
        return view('Pages.Admin.Category.CategoryProduk.Update',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);
  
        $data=array();
        $data['name']  = $request->name;
        $data['slug']  = Str::slug($request->get('name'));

        $update = Category::findOrFail($id)->update($data);

            if ($update) {
                $notification = Toastr::success('Berhasil Update Category','Success');
                    return Redirect()->route('category_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Category','Error');
                    return Redirect()->route('category_admin')->with($notification);
            }
    }

    public function delete($id)
    {
        Category::find($id)->delete();

        $notification = Toastr::success('Category Berhasil diHapus','Success');

        return Redirect()->back()->with($notification);
    }

}
