<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view_category(Request $request){
        $data = category::all();
        $id = $request->id;
        $name = '';
        if(isset($id) && $id > 0) {
            $item = category::find($id);

            if ($item) {
                $name = $item->name;
            }
        }

        return view('admin.category', compact('data','id','name'));
    }

    public function add_category(Request $request){
        $id = $request->id;
        if (isset($id) && $id > 0) {
            $category = Category::find($id);

                $category->name = $request->category;
                $category->save();
                return redirect('view_category')->with('message','Category updated successfully');
        }else{
            $category = new Category();
            $category->name = $request->category;
            $category->save();
            return redirect()->back()->with('message','Category added successfully');
        }
    }


    public function delete_category($id){
            $category = Category::find($id);
            $category->delete();
            
            return redirect()->back()->with('message', 'Category deleted successfully');
    }

}
