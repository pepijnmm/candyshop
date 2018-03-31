<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    //kijkt of de persoon een admin is en als die dat niet is kan die alleen bij de register en userstore en userupdate useredit
    public function __construct()
    {
        $this->middleware('AdminCheck');
    }

    //hier kan je alle gebruikers zien
    public function index(){
        $categories = Category::all();
        return view('category.index', ['categories' => $categories]);
    }
    //hier kan een admin accounts toevoegen
    public function create(){
        $categories = Category::all();
        return view('category.create', ['categories'=>$categories]);
    }
    //hier word het opgeslagen
    public function store(Request $request){
        $category = New Category;
        $pictureupload = false;
        if(!empty($request->image)){
            $pictureupload = true;
            $request->merge(["image_location" => "/"]);
        }
        $validator = Validator::make($request->except('image'), $category->rules);
        if ($validator->fails()) {
            return redirect()->action('CategoryController@create')->withInput()->withErrors($validator);
        }
        if($pictureupload){
            $ExtraController = new ExtraController;
            $request->merge(["image_location" => $ExtraController->fileUpload($request)]);
            if (empty($request->image_location)) {
                Session::flash('alert-warning', 'Uploaden ging fout.');
                return redirect()->action('CategoryController@create')->withInput();
            }
        }       
        if($request->child_from == 0){
            $request = $request->except(['child_from','image']);
        }
        else{
            $request = $request->except('image');
        }
        Category::create($request);
        Session::flash('alert-success', 'Category aangemaakt');
        return redirect()->action('CategoryController@create');
    }
    //hier stat de info van een gebruiker
    public function show($id){
        $category = Category::find($id);
        if (!empty($category)) {
        return view('category.show',['category'=>$category]);
        }
        Session::flash('alert-warning', 'Category kon niet worden gevonden');
        return redirect()->action('CategoryController@index');
    }

    //hier kan een gebruiker worden aangepast
    public function edit($id){
        $category = Category::find($id);
        $categories = Category::all()->except($id);
        if (!empty($category)) {
        return view('category.edit',['category'=>$category,'categories'=>$categories]);
        }
        Session::flash('alert-warning', 'Category kon niet worden gevonden');
        return redirect()->action('CategoryController@index');
    }
    public function update(Request $request, $id){
        $category = Category::find($id);
        if (!empty($category)) {
            $pictureupload = false;
            if(!empty($request->image)){
                $pictureupload = true;
                $request->merge(["image_location" => "/"]);
            }
            $validator = Validator::make($request->except('image'), (['name' => 'unique:categories,name,'.$id,]+$category->rules));
            if ($validator->fails()) {
                return redirect()->action('CategoryController@edit',$id)->withInput()->withErrors($validator);
            }
            if($pictureupload){
                $ExtraController = new ExtraController;
                $request->merge(["image_location" => $ExtraController->fileUpload($request)]);
                if (empty($request->image_location)) {
                    Session::flash('alert-warning', 'Uploaden ging fout.');
                    return redirect()->action('CategoryController@edit',$id)->withInput();
                }
            }       
            if($request->child_from == 0){
                $request->merge(["child_from" => NULL]);
            }
            $category->update($request->except('image'));
            Session::flash('alert-success', 'Category bijgewerkt!');
            return redirect()->action('CategoryController@show', $id);
        }
        Session::flash('alert-warning', 'Category Kon niet worden gevonden.');
        return redirect()->action('CategoryController@show', $id);
    }
    public function destroy($id){
        $category = Category::find($id);
        if (!empty($category)) {
            Category::destroy($id);
            Session::flash('alert-success', 'Category verwijderd');
            return redirect()->action('CategoryController@index');
        }
        Session::flash('alert-warning', 'Category kon niet worden gevonden');
        return redirect()->action('CategoryController@index');
    }
}