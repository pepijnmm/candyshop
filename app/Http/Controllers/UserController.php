<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
        return view('user.index', ['users' => $users]);
    }
    //hier registreren normale gebruikers
	public function register(){
        return view('user.register');
    }
    //hier word het opgeslagen
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
    //hier kunnen normale gebruikers hun gegevens wijzigen
	public function useredit(){
        $user = User::find(Auth::id());
        if (!empty($user)) {
        return view('user.useredit',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@showcurrent');
    }
    //hier word het opgeslagen
    public function userupdate(Request $request){
        $user = User::find(Auth::id());
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
    //hier kan een normale gebruiker zijn account zien
	public function showcurrent(){
        $user = User::find(Auth::id());
        if (!empty($user)) {
        return view('user.usershow',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('ProductController@index');
    }
    //wachtwoord aanpassen
    public function passwordchange(){
        return view('user.passwordchange');
    }
    //wachtwoord aanpassen
    public function storepasswordchange(Request $request){
        $user = User::find(Auth::id());
        if(!empty($user)){
            $validator = Validator::make($request->all(), [
                'oldpassword' => 'required',
                'newpassword' => 'required',
                'secondnewpassword' =>  'required',
                ]);
            if ($validator->fails()) {
                return redirect()->action('UserController@passwordchange')->withInput()->withErrors($validator);
            }
            if($request->newpassword == $request->secondnewpassword){
                    if(Hash::check($request->oldpassword,User::find(Auth::id())->password)){
                        $user->password = Hash::make($request->newpassword);
                        $user->save(); 
                        Session::flash('alert-success', 'Gebruiker bijgewerkt!');
                        return redirect()->action('UserController@showcurrent');
                }
                else{
                Session::flash('alert-warning', 'Oude wachtwoord komt niet overeen');
                return redirect()->action('UserController@passwordchange')->withInput();
                }
            }
            else{
                Session::flash('alert-warning', 'nieuwe wachtwoorden komen niet overeen');
                return redirect()->action('UserController@passwordchange')->withInput();
            }
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@showcurrent');
    }
    //wachtwoord reset kiest een random wachtwoord
    public function passwordreset($id){
        $user = User::find(Auth::id());
        if(!empty($user)){
            $password = str_random(8);
            $user->password = Hash::make($password);
            $user->save(); 
            Session::flash('alert-success', 'Wachtwoord is nu: '.$password);
            return redirect()->action('UserController@index');
        }
    }
    //hier kan een admin accounts toevoegen
    public function create(){
        return view('user.create');
    }
    //hier word het opgeslagen
    public function store(Request $request){
        $user = New User;
		if ($request->role == "on") {
			$request->merge(["role" => 1]);
		} else {
			$request->merge(["role" => 0]);
		}
        $validator = Validator::make($request->all(), $user->rules);
        if ($validator->fails()) {
            return redirect()->action('UserController@create')->withInput()->withErrors($validator);
        }
		$request->merge(["password" => Hash::make($request->password)]);
        User::create($request->all());
        Session::flash('alert-success', 'gebruiker aangemaakt');
        return redirect()->action('UserController@create');
    }
    //hier stat de info van een gebruiker
    public function show($id){
        $user = User::find($id);
        if (!empty($user)) {
        return view('user.show',['user'=>$user]);
        }
        Session::flash('alert-warning', 'gebruiker kon niet worden gevonden');
        return redirect()->action('UserController@index');
    }
    //hier kan een gebruiker worden aangepast
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
            $user->update($request->all());
            Session::flash('alert-success', 'Gebruiker bijgewerkt!');
            return redirect()->action('UserController@show', $id);
        }
        Session::flash('alert-warning', 'Gebruiker Kon niet worden gevonden.');
        return redirect()->action('UserController@show', $id);
    }
    public function destroy($id){
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