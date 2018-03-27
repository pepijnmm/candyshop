<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //kijkt of de persoon een admin is en als die dat niet is kan die alleen bij de register en userstore en userupdate useredit
    public function __construct()
    {
        $this->middleware('AdminCheck',['except' => ['register','userstore','useredit','userupdate','showcurrent']]);
    }

    //hier kan je alle gebruikers zien
    public function index(){
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }
	public function register(){
        return view('users.register');
    }
    public function userstore(Request $request){
        $user = New User;
		$validator = Validator::make($request->all(), $user->userregister);
        if ($validator->fails()) {
            return redirect()->action('UserController@register')->withInput()->withErrors($validator);
        }
		$request->merge(["password" => Hash::make($request->password)]);
        User::create($request->all());
        Session::flash('alert-success', 'gebruiker aangemaakt');
        return redirect()->to('/');
    }
	public function useredit($id){
        $user = User::find($id);
        if (!empty($user)) {
        return view('user.useredit',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@index');
    }
    public function userupdate(Request $request, $id){
        $user = User::find($id);
        if (!empty($user)) {
            $validator = Validator::make($request->all(), $user->userchange);
            if ($validator->fails()) {
                return redirect()->action('UserController@useredit')->withInput()->withErrors($validator);
            }
            $application->update($request->all());
            Session::flash('alert-success', 'Gebruiker bijgewerkt!');
            return redirect()->action('UserController@showcurrent');
        }
        Session::flash('alert-warning', 'Gebruiker Kon niet worden gevonden.');
        return redirect()->action('UserController@showcurrent');
    }
	public function showcurrent(){
        $user = User::find(Auth::id());
        if (!empty($user)) {
        return view('user.show',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
        $user = New User;
		if ($request->role == "on") {
			$request->merge(["role" => 1]);
		} else {
			$request->merge(["role" => 0]);
		}
        $validator = Validator::make($request, $user->rules);
        if ($validator->fails()) {
            return redirect()->action('UserController@create')->withInput()->withErrors($validator);
        }
		$request->merge(["password" => Hash::make($request->password)]);
        User::create($request);
        Session::flash('alert-success', 'gebruiker aangemaakt');
        return redirect()->action('UserController@create');
    }
    public function show($id){
        $user = User::find($id);
        if (!empty($user)) {
        return view('user.show',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@index');
    }
    public function edit($id){
        $user = User::find($id);
        if (!empty($user)) {
        return view('user.edit',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@index');
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        if (!empty($user)) {
			if ($request->role == "on") {
				$request->merge(["role" => true]);
			} else {
				$request->merge(["role" => false]);
			}
            $validator = Validator::make($request->all(), $user->ruleschange);
            if ($validator->fails()) {
                return redirect()->action('UserController@edit')->withInput()->withErrors($validator);
            }
            $application->update($request->all());
            Session::flash('alert-success', 'Gebruiker bijgewerkt!');
            return redirect()->action('UserController@show', $id);
        }
        Session::flash('alert-warning', 'Gebruiker Kon niet worden gevonden.');
        return redirect()->action('UserController@show', $id);
    }
    public function delete($id){
        $user = User::find($id);
        if (!empty($user)) {
            User::destroy($id);
            Session::flash('alert-success', 'gebruiker verwijderd');
            return redirect()->action('UserController@index');
        }
        Session::flash('alert-warning', 'Gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@index');
    }
}