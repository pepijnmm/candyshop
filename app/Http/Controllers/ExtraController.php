<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ExtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminCheck');
    }
    public function fileUpload(Request $request){
    $validator = Validator::make($request->only('image',"_method","_token"), [

    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);
    if ($validator->fails()) {
        return '';
    }
    $image = $request->file('image');
    $input['imagename'] = date('Y-m-d H-i-s').'.'.$image->getClientOriginalExtension();
    $request->merge(["image_location" => $input['imagename']]);
    $destinationPath = public_path('/images');

    $image->move($destinationPath, $input['imagename']);
	return $input['imagename'];
    }
    public function gallery(){
        $images = preg_grep('~\.(jpeg|jpg|png)$~', scandir(public_path('/images')));
        return view('admin.gallery',['images' =>$images]);

    }
}