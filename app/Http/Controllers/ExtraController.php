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
	
	//hij slaat de afbeelding op, veranderd de naam met een datum erachter en daarna doet die de naam terug sturen
    public function fileUpload(Request $request){
        $validator = Validator::make($request->only('image'), [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return '';
        }
        try{
		$image = $request->file('image');
        $input['imagename'] = date('Y-m-d H-i-s').'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
		
        $image->move($destinationPath, $input['imagename']);
		}
		catch(){
			return '';
		}
		return $input['imagename'];
    }
    public function gallery(){
        $images = preg_grep('~\.(jpeg|jpg|png|gif|svg)$~', scandir(public_path('/images')));
        return view('admin.gallery',['images' =>$images]);

    }
}