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
    public function search($category){
        $products = [];
            $good=[];
        if($category > 0){
            $category = Category::find($category);
            
            foreach($category->Products as $productinfo){
                array_push($products,$productinfo->id);
            }
            foreach($category->Children as $childeren){
                foreach($childeren->Products as $productinf){
                    array_push($products,$productinf->id);
                }
            }
            $products = array_unique($products);
        }
        else{
            foreach(Product::all() as $productinfo){
                array_push($products,$productinfo->id);
            }
        }
        foreach($products as $product){
            $oneproduct = Product::find($product);
            if(strpos($oneproduct->name,$_GET['search'])!==false){
                array_push($good,$oneproduct->id);
            }
            else{unset($products[array_search($product,$products)]);}
        }
        return view('public.showSearch', ['products' => Product::findMany($good),'category' => $category]);
    }
}
