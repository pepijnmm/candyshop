<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;

class PublicController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', ['products' => $products]);
    }

    public function about()
    {
        return view('public.about');
    }

    public function showProducts($category){
        $category = Category::find($category);
        if (!empty($category)) {
            return view('public.showProducts', ['category' => $category]);
        }
        Session::flash('alert-warning', 'Category kon niet worden gevonden');
        return redirect()->action('CategoryController@index');
    }
}
