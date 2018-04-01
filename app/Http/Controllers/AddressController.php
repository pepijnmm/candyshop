<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
    //kijkt of de persoon een admin is en als die dat niet is kan die alleen bij de register en userstore en userupdate useredit
    public function __construct()
    {
        $this->middleware('GuestCheck');
    }

    //hier kan je alle gebruikers zien
    public function index(){
        $addresses = Address::where(['user_id'=>Auth::id()])->get();
        return view('address.index', ['addresses' => $addresses]);
    }
    //hier kan een admin accounts toevoegen
    public function create(){
        return view('address.create');
    }
    //hier word het opgeslagen
    public function store(Request $request){
        $address = New Address;
        $request->merge(["user_id" => Auth::id()]);
        $validator = Validator::make($request->all(), $address->rules);
        if ($validator->fails()) {
            return redirect()->action('AddressController@create')->withInput()->withErrors($validator);
        }      
        Address::create($request->all());
        Session::flash('alert-success', 'Adres aangemaakt');
        return redirect()->action('AddressController@create');
    }
    //hier stat de info van een gebruiker
    public function show($id){
        $address = Address::where(['user_id'=>Auth::id(),'id'=>$id])->first();
        if (!empty($address)) {
        return view('address.show',['address'=>$address]);
        }
        Session::flash('alert-warning', 'Adres kon niet worden gevonden');
        return redirect()->action('AddressController@index');
    }

    //hier kan een gebruiker worden aangepast
    public function edit($id){
        $address = Address::where(['user_id'=>Auth::id(),'id'=>$id])->first();
        if (!empty($address)) {
        return view('address.edit',['address'=>$address]);
        }
        Session::flash('alert-warning', 'Adres kon niet worden gevonden');
        return redirect()->action('AddressController@index');
    }
    public function update(Request $request, $id){
        $address = Address::where(['user_id'=>Auth::id(),'id'=>$id])->first();
        if (!empty($address)) {
            $validator = Validator::make($request->all(), ($address->ruleschange));
            if ($validator->fails()) {
                return redirect()->action('AddressController@edit',$id)->withInput()->withErrors($validator);
            }     
            $address->update($request->all());
            Session::flash('alert-success', 'Adres bijgewerkt!');
            return redirect()->action('AddressController@show', $id);
        }
        Session::flash('alert-warning', 'Adres Kon niet worden gevonden.');
        return redirect()->action('AddressController@show', $id);
    }
    public function destroy($id){
        $address = Address::where(['user_id'=>Auth::id(),'id'=>$id])->first();
        if (!empty($address)) {
            Address::destroy($id);
            Session::flash('alert-success', 'Adres verwijderd');
            return redirect()->action('AddressController@index');
        }
        Session::flash('alert-warning', 'Adres kon niet worden gevonden');
        return redirect()->action('AddressController@index');
    }
}