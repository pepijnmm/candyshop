<?php

namespace App\Http\Controllers;


use App\Product;

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
}
