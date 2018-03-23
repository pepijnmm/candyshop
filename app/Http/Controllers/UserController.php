<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ExtraController extends Controller
{
    //kijkt of de persoon een admin is en als die dat niet is kan die alleen bij de create en store
    public function __construct()
    {
        $this->middleware('AdminCheck',['except' => ['create','store']]);
    }

    //hier kan je alle producten zien
    public function index(){
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
        $user = New User;
        $validator = Validator::make($request, $user->rules);
        if ($validator->fails()) {
            return redirect()->action('UserController@create')->withInput()->withErrors($validator);
        }
        User::create($request);
        Session::flash('alert-success', 'gebruiker aangemaakt');
        return redirect()->action('ProductController@create');
    }
    public function show($id){
        $user = New User::find($id);
        if ($user) {
        return view('user.show',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
    public function delete($id){

    }
}