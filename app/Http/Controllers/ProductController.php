<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index',['products' =>$products]);
    }
    public function create(){
        return view('product.create');
    }
    public function store(Request $request){
        $product = New Product;
        $validator = Validator::make($request->all(), $product->rules);
        if ($validator->fails()) {
            return redirect()->action('ProductController@create')->withInput()->withErrors($validator);
        }
        Product::create($request->all());
        Session::flash('alert-success', 'product toegevoegd');
        return redirect()->action('ProductController@create');
    }
    public function show($id){
        $product = Product::find($id);
        if ($product) {
        return view('product.show',['product'=>$product]);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
    public function edit($id){
        $product = Product::find($id);
        if ($product) {
            return view('product.edit',['product'=>$product]);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
    public function update(Request $request, $id){
         $product = Product::find($id);
        if ($product) {
            $validator = Validator::make($request->all(), $product->rules);
            if ($validator->fails()) {
                return redirect()->action('ProductController@edit')->withInput()->withErrors($validator);
            }
            $$product->update($request->all());
            Session::flash('alert-success', 'product geupdate');
            return redirect()->action('ProductController@show', $id);
        }
    }
    public function destroy($id){
        $product = Product::find($id);
        if ($product) {
            Product::destroy($id);
            Session::flash('alert-success', 'product verwijderd');
            return redirect()->action('ProductController@index');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
}
