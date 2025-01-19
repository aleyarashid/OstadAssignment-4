<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Image;
use Str;

class ProductController extends Controller
{
    public function productList(Request $request){

        if ($request->has('sortBy')) {
            $sortBy = $request->get('sortBy');
        }
        else {
            $sortBy = $request->get('sortBy', 'name');
        }
       
        $sortOrder = $request->get('sort', 'asc');
        if ($sortOrder === 'asc') {
            $sortOrder = 'desc';
        }
        else {
            $sortOrder = 'asc';
        }

        $products = Product::orderBy($sortBy, $sortOrder)->latest()->paginate(5);
        return view('index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function productCreate(){
        return view('create');
    }

    public function productStore(Request $request){
         $validated = $request->validate([
             
             'name' => 'required',  
             'price' => 'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    
     $product_id = Str::lower(str_replace(' ', '-', $request->name)).'-'.random_int(1000000, 99999999);

     $image = $request->file('image');
     $destinationPath = 'images/';
     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
     $image->move($destinationPath, $profileImage);

     Product::insert([
         'product_id' => $product_id,
         'name' => $request->name,
         'description' => $request->description,
         'price' => $request->price,
         'stock' => $request->stock,
         'image' => $profileImage,
         'created_at' => Carbon::now(),

     ]);

     return redirect()->route('products.list')->with('success', 'Product Added Successfully');
    }

    public function productSearch(Request $request){
        $query = $request->input('query');
        $products = Product::where('product_id', 'like', "%{$query}%")
                            ->orWhere('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhere('price', 'like', "%{$query}%")
                            ->get();
        return view('search_rows', compact('products'));
    }
    
    public function productShow(Product $product){
        
        return view('show', compact('product'));
    }
    public function productEdit(Product $product){
       
        return view('edit', compact('product'));
    }

    public function productUpdate(Request $request, Product $product){

        $request->validate([
            'name' => 'required',  
            'price' => 'required',
        ]);

        if($image = $request->file('image'))
        {
            if($product->image && file_exists(public_path('images/'.$product->image)))
            {
                unlink(public_path('images/'.$product->image));
            }
            $image = $request->file('image');
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            Product::where('id', $product->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $profileImage,
                
            ]);
        }
        else
        {
            Product::where('id', $product->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                
            ]);

        }

        return redirect()->route('products.list')->with('success', 'Product Updated Successfully');


    }

    public function productDelete(Product $product){

        if($product->image && file_exists(public_path('images/'.$product->image)))
        {
            unlink(public_path('images/'.$product->image));
        }
        Product::where('id', $product->id)->delete();
        return redirect()->route('products.list')->with('success', 'Product Deleted Successfully');
    }
}   
