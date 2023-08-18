<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
    }
    
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
            $category = Category::findOrFail($id);
            // Kiểm tra xem category có sản phẩm liên kết trong bảng product hay không
            $productCount = Product::where('category_id', $id)->count();
            if ($productCount > 0) {
                return redirect()->back()->with('message', 'Cannot delete category. It has associated products.');
            }
    
            // Nếu không có sản phẩm liên kết, thì mới tiến hành xóa category
            $category->delete();
            
            return redirect()->back()->with('message', 'Category deleted successfully');
    }

}
