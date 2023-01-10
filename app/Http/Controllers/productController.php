<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   public function products()
   {
    $products = Product::all();
    $categories = Category::all();
    return view('layouts.products', compact('products','categories'));
   }

   public function getMyProducts()
   {
    $products = Product::all()->where('partner_id',auth()->user()->id);
    $categories = Category::all();
    return view('layouts.products', compact('products','categories'));
   }

   public function getHisProducts($id)
   {

       $products = Product::where('partner_id', $id)->get();
       $categories = Category::all();

       return view('layouts.products',compact('products','categories'));
   }

   public function storeProduct(Request $request)
   {
       $request->validate([
           'name'        => 'required',
           'detail'      => 'required',
           'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
  
       $data = $request->all();
  
       if ($image = $request->file('image')) {
        $destinationPath = 'assets/img';
        $profileImage = $image->getClientOriginalName();
        $image->move($destinationPath, $profileImage);
        $data['image'] = "$profileImage";
    }

        Product::create([
            'name'        =>  $data['name'],
            'partner_id'  =>  Auth::user()->id,
            'detail'      =>  $data['detail'],
            'category_id' =>  $data['category_id'],
            'image'       =>  $data['image']

        ]);
    if(auth()->user()->role == 'Partner'){
        return redirect()->route('myProducts')
        ->with('message','Product added successfully');
    }
    else{
        return redirect()->route('products')
        ->with('message','Product added successfully');
    }
   }
   
   public function editProduct($id)
   {
            $product = Product::find($id);
            return response()->json([
                'status' => 200,
                'product' => $product
            ]);

   }

   public function updateProduct(Request $request)
   {

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'assets/img';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $product->update($input);

        // if (auth()->user()->role == 'Partner') {
        //     return redirect()->route('myProducts')
        //         ->with('success', 'Product Updated successfully');
        // } else {
        //     return redirect()->route('products')
        //         ->with('success', 'Product Updated successfully');
        // }
        return redirect()->back()->with('message','User updated successfully');
   }

   public function deleteProduct(Product $product)
   {
       $product->delete();
     
       if(auth()->user()->role == 'Partner'){
        return redirect()->route('myProducts')
        ->with('message','Product Deleted successfully');
    }
    else{
        return redirect()->route('products')
        ->with('message','Product Deleted successfully');
    }
   }

}

