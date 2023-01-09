<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
        ]);
   
        $data = $request->all();
 
        Category::create([
             'name'        =>  $data['name'],
                        ]);


    return redirect()->back()->with('message','Category added successfully');
     
    }

    public function showShirts(Request $request)
    {
        $products = Product::all()->where('category_id', 1);
        $categories = Category::all();

        return view('layouts.products', compact('products','categories'));
    }

    public function showShoes(Request $request)
    {
        $products = Product::all()->where('category_id', 2);
        $categories = Category::all();
        return view('layouts.products', compact('products','categories'));
    }

    public function showPants(Request $request)
    {
        $products = Product::all()->where('category_id', 3);
        $categories = Category::all();
        return view('layouts.products', compact('products','categories'));
    }
}
