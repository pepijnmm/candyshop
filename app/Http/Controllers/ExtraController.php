<?php

namespace App\Http\Controllers;

class ExtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminCheck');
    }
    public function fileUpload(Request $request,$redirect){
    $img = ['image'=>$request->image];
    $this->validate($img, [

    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);


    $image = $request->file('image');

    $input['imagename'] = date('Y-m-d H-i-s').'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images');

    $image->move($destinationPath, $input['imagename']);


    $this->postImage->add($input);
	return redirect()->action($redirect)->withInput();
    }
}