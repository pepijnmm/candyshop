<?php

namespace App\Http\Controllers;


use App\Product;

class WebshopController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('index',['products' =>$products]);
    }
}
