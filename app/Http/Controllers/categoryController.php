<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'image'       => 'required'
        ]);
   
        $data = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'assets/img';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
 
        Category::create([
             'name'        =>  $data['name'],
             'image'       =>  $data['image']
                        ]);


    return redirect()->back()->with('message','Category added successfully');
     
    }

    public function showByCategory($id)
    {   

        $products = Product::all()->where('category_id', $id);
        $categories = Category::all();

        return view('layouts.products', compact('products','categories'));
    }

}
