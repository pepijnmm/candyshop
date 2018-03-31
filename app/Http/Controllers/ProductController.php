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

    //kijkt of de persoon een admin is en als die dat niet is kan die alleen bij de create en store
    public function __construct()
    {
        $this->middleware('AdminCheck', ['except' => ['show']]);
    }

    //hier kan je alle producten zien
    public function index(){
        $products = Product::all();
        return view('product.index',['products' =>$products]);
    }

    //hier is een form waar producten kunnen worden aangemaakt
    public function create(){
        return view('product.create');
    }

    //hier worden producten en de afbeeldingen mee opgeslagen
    public function store(Request $request){
        $pictureupload = false;
        if(!empty($request->image)){
            $pictureupload = true;
            $request->merge(["image_location" => "/"]);
        }
        $product = New Product;
        $validator = Validator::make($request->except('image'), $product->rules);
        if ($validator->fails()) {
            return redirect()->action('ProductController@create')->withInput()->withErrors($validator);
        }
        if($pictureupload){
            $ExtraController = new ExtraController;
            $request->merge(["image_location" => $ExtraController->fileUpload($request)]);
        }		
        if (empty($request->image_location)) {
			Session::flash('alert-warning', 'Uploaden ging fout.');
            return redirect()->action('ProductController@create')->withInput();
        }
        Product::create($request->except('image'));
        Session::flash('alert-success', 'product toegevoegd');
        return redirect()->action('ProductController@create');
    }

    //hier kan je een product zien
    public function show($id){
        $product = Product::find($id);
        if (!empty($product)) {
        return view('product.show',['product'=>$product]);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
        //hier kan je een product zien
    public function showadmin($id){
        $product = Product::find($id);
        if (!empty($product)) {
        return view('product.showadmin',['product'=>$product]);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }

    //hier kan is een form om een product te bewerken
    public function edit($id){
        $product = Product::find($id);
        if (!empty($product)) {
            return view('product.edit',['product'=>$product]);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }

    //hier word het bewerken gecontroleerd en opgeslagen
    public function update(Request $request, $id){
         $product = Product::find($id);
        if (!empty($product)) {		
			$pictureupload = false;
			if(!empty($request->image)){
				$pictureupload = true;
				$request->merge(["image_location" => "/"]);
			}
            $validator = Validator::make($request->except('image'), $product->rules);
            if ($validator->fails()) {
                return redirect()->action('ProductController@edit', $id)->withInput()->withErrors($validator);
            }
			if($pictureupload){
            $ExtraController = new ExtraController;
            $request->merge(["image_location" => $ExtraController->fileUpload($request)]);
			}		
			if (empty($request->image_location)) {
				Session::flash('alert-warning', 'Uploaden ging fout.');
				return redirect()->action('ProductController@create')->withInput();
			}
            $product->update($request->except('image'));
            Session::flash('alert-success', 'product geupdate');
            return redirect()->action('ProductController@show', $id);
        }
    }

    //hiermee kan een product worden verwijderd
    public function destroy($id){
        $product = Product::find($id);
        if (!empty($product)) {
            Product::destroy($id);
            Session::flash('alert-success', 'product verwijderd');
            return redirect()->action('ProductController@index');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
}
