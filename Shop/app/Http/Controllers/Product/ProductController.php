<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
    }
    
    public function show_product(){

        $product = product ::leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->where('products.deleted', 0)
        ->select('products.*', 'categories.name as category')
        ->get();

        return view('admin.show_product', compact('product'));
    }

    public function view_product(Request $request){
        $category= category::all();
        $product=null;
        $id = $request->id;
        if (isset($id) && $id > 0) {
            $product = product::find($id);
        }
        return view('admin.product', compact('category','product'));
    }

    public function add_product(Request $request){
        $id = $request->id;
        $category= category::all();
        if (isset($id) && $id > 0) {
            $product = product::find($id);
            if (!$product) {
                return redirect('product')->with('error', 'User not found.');
            }
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            // $product->category = $request->category;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->image=$request->image;

            $product->save();
            return redirect('show_product')->with('message', 'Product updated successfully');
        } else{
            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->image=$request->image;

            $product->save();
            return redirect()->back()->with('message', 'Product added successfully');
        }
    }

    public function delete_product($id){
        $product = product::find($id);

        $product ->deleted = 1;
        $product ->save();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function searchProduct(Request $request){
        $searchText = $request->search;

        $product = product::leftjoin('categories', 'categories.id','=', 'products.category_id')
                    ->where('products.deleted',0)
                    ->where('products.title', 'LIKE',"%$searchText%")->orwhere('products.quantity', 'LIKE',"%$searchText%")
                    ->orwhere('categories.name', 'LIKE',"%$searchText%")->orwhere('products.price', 'LIKE',"%$searchText%")
                    ->select('products.*', 'categories.name as category')
                    ->get();
        return view('admin.show_product',compact('product'));
    }

}
