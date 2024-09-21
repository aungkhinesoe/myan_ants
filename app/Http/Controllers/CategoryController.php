<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function Flasher\Toastr\Prime\toastr;

class CategoryController extends Controller
{
    public function view_category()
    {
        $category_items = Category::all();

        return view('admin.category', compact('category_items'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;

        $category->category_name = $request->category;

        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('categories',$imagename);
            $category->image = $imagename;
        }

        // toastr()->success('Category Created Successfully!');

        $category->save();

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $category_item = Category::find($id);

        return view('admin.edit_category',compact('category_item'));
    }

    public function update_category(Request $request,$id)
    {
        $category_item = Category::find($id);

        $category_item->category_name = $request->category;

        toastr()->success('Category Updated Successfully!');

        $category_item->save();

        return redirect('/view_category');
    }

    public function delete_category($id)
    {
        $category_item = Category::find($id);

        $category_item->delete();

        toastr()->success('Category Deleted Successfully!');

        return redirect()->back();
    }

}
