<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Http\Controllers\Controller;
use App\Clients;
use Illuminate\Support\Facades\Redirect;
use DateTime;

class ProductsController extends Controller
{
    public function index(){
    $clients = Clients::all();
    foreach($clients as $client){
        $client['childAmount'] = $client->childeren->count();
    }
        return view('users.clients',['clients' =>$clients->toArray(),'rankPageName'=>'Users','pageName' => 'Home']);
    }//firstName middleName lastName birthDate husbandName disease
    public function create(){
        $parameters = [];
        if(!empty( $_GET['done'])){
            $parameters['done'] = $_GET['done'];
        }
        if(!empty( $_GET['error'])){
            $parameters['error'] = $_GET['error'];
        }
        if(!empty( $_GET['firstName'])){
            $parameters['firstName'] = $_GET['firstName'];
        }
        if(!empty( $_GET['middleName'])){
            $parameters['middleName'] = $_GET['middleName'];
        }
        if(!empty( $_GET['lastName'])){
            $parameters['lastName'] = $_GET['lastName'];
        }
        if(!empty( $_GET['birthDate'])){
            $parameters['birthDate'] = $_GET['birthDate'];
        }
        if(!empty( $_GET['birthTime'])){
            $parameters['birthTime'] = $_GET['birthTime'];
        }
        if(!empty( $_GET['husbandName'])){
            $parameters['husbandName'] = $_GET['husbandName'];
        }
        if(!empty( $_GET['disease'])){
            $parameters['disease'] = $_GET['disease'];
        }
        $parameters['rankPageName'] = 'Users';
        $parameters['pageName'] = 'Toevoegen';
        return view('users.clientCreate',$parameters);
    }
    public function store(Request $request){
        if(!empty($request->firstName) && !empty($request->lastName)){
            $client = New clients;
            var_dump($request->birthDate);
            var_dump($request->birthTime);
            if(!empty($request->birthDate) && !empty($request->birthTime) && $request->birthTime !== '00:00' && $request->birthTime !== '00:00:00'){
                $datetimestamp = DateTime::createFromFormat ('Y-m-d H:i:s',(string)($request->birthDate . ' '. $request->birthTime));
                $client->birthDate = $datetimestamp->format('Y-m-d H:i:s');
            }
            else if(!empty($request->birthDate)){
                $datetimestamp = DateTime::createFromFormat ('Y-m-d',(string)($request->birthDate));
                $client->birthDate = $datetimestamp->format('Y-m-d');
            }
            
            $client->firstName = $request->firstName;
            $client->lastName = $request->lastName;
            if(!empty($request->middleName)){
                $client->middleName = $request->middleName;
            }
            if(!empty($request->husbandName)){
                $client->husbandName = $request->husbandName;
            }
            if(!empty($request->disease)){
                $client->disease = $request->disease;
            }
            $client->save();
            $parameters = ['firstName'=>$request->firstName,'lastName'=>$request->lastName,'done'=>'De Client is toegevoegd'];
            if(!empty($request->middleName)){
                $parameters['middleName'] = $request->middleName;
            }
            return redirect()->action('ClientsController@create',$parameters);
        }
        else{
            $parameters = [];
            if(!empty($request->firstName)){
                $parameters['firstName'] = $request->firstName;
            }
            if(!empty($request->lastName)){
                $parameters['lastName'] = $request->lastName;
            }
            if(!empty($request->middleName)){
                $parameters['middleName'] = $request->middleName;
            }
            if(!empty($request->birthDate)){
                $parameters['birthDate'] = $request->birthDate;
            }
            if(!empty($request->birthTime)){
                $parameters['birthTime'] = $request->birthTime;
            }
            if(!empty($request->husbandName)){
                $parameters['husbandName'] = $request->husbandName;
            }
            if(!empty($request->disease)){
                $parameters['disease'] = $request->disease;
            }
            $parameters['error']= 'Vul aub alle velden in';
            return redirect()->action('ClientsController@create',$parameters);
            
        }
    }
    public function show($id){
        if (Clients::where('id', '=', $id)->exists()) {
            $parameters = [];
        if(!empty( $_GET['sure'])){
            $parameters['sure'] = $_GET['sure'];
        }
        $parameters['info'] = (object)Clients::find($id)->toArray();
        $parameters['childeren'] = Clients::find($id)->childeren->toArray();
        $parameters['rankPageName'] = 'Users';
        $parameters['pageName'] = 'Gegevens';
        return view('users.client',$parameters);
        }
        return 'Could not be found';
    }
    public function edit($id){
        if (Clients::where('id', '=', $id)->exists()) {
            $parameters = [];
            if(!empty( $_GET['error'])){
                $parameters['error'] = $_GET['error'];
            }
            if(!empty( $_GET['done'])){
                $parameters['done'] = $_GET['done'];
            }
            if(!empty( $_GET['info'])){
                $parameters['info'] = (object)$_GET['info'];
            }
            else{
                $parameters['info'] = (object)Clients::find($id)->toArray();
                if(!empty($parameters['info']->birthDate) && Count(explode(' ', $parameters['info']->birthDate)) == 2){
                    $parameters['info']->birthTime = explode(' ', $parameters['info']->birthDate)[1];
                    $parameters['info']->birthDate = explode(' ', $parameters['info']->birthDate)[0];
                }
                else if(!empty($parameters['info']->birthDate)){
                    $parameters['info']->birthDate = $parameters['info']->birthDate;
                }
            }
            $parameters['rankPageName'] = 'Users';
            $parameters['pageName'] = 'Wijzigen';
            return view('users.clientEdit',$parameters);
            
            
            //$info = (object)Clients::find($id)->toArray();
            //return view('users.userEdit',['info'=>$info]);
        }
        return 'Could not be found';
    }
    public function update(Request $request, $id){
        if (Clients::where('id', '=', $id)->exists()) {
            if(!empty($request->firstName) && !empty($request->lastName)){
                $client = Clients::find($id);
                $client->firstName = $request->firstName;
                $client->middleName = $request->middleName;
                $client->lastName = $request->lastName;
                if(!empty($request->birthDate) && !empty($request->birthTime)){
                    $datetimestamp = DateTime::createFromFormat ('Y-m-d H:i:s',(string)($request->birthDate . ' '. $request->birthTime));
                    $client->birthDate = $datetimestamp->format('Y-m-d H:i:s');
                }
                else if(!empty($request->birthDate)){
                    $datetimestamp = DateTime::createFromFormat ('Y-m-d',(string)($request->birthDate));
                    $client->birthDate = $datetimestamp->format('Y-m-d');
                }
                else{
                    $client->birthDate = null;
                }
                $client->husbandName = $request->husbandName;
                $client->disease = $request->disease;
                $client->save();
                $client = ["id"=>$id,"firstName"=>$request->firstName,"middleName"=>$request->middleName,"lastName"=>$request->lastName,'birthDate'=>$request->birthDate,'birthTime'=>$request->birthTime,'husbandName'=>$request->husbandName,'disease'=>$request->disease];
                return redirect()->action('ClientsController@edit',['id' =>$id,'done'=>true,'info'=>$client]);
            }
            else{
                $client = ["id"=>$id,"firstName"=>$request->firstName,"middleName"=>$request->middleName,"lastName"=>$request->lastName,'birthDate'=>$request->birthDate,'birthTime'=>$request->birthTime,'husbandName'=>$request->husbandName,'disease'=>$request->disease];
                return redirect()->action('ClientsController@edit',['id' =>$id,'error'=>'U moet een voornaam en achternaam invullen.','info'=>$client]);
            }
            return 'Could not be found';
        }
    }
    public function destroy($id){
        $id = explode(":", $id);
        if(count($id) == 2){
            if($id[1] == 0){
                if (Clients::where('id', '=', $id[0])->exists()) {
                    return redirect()->action('ClientsController@show',['id' =>$id[0],'sure'=>true]);
                }
            }
            else{
                Clients::destroy($id[0]);
                return redirect()->action('ClientsController@index',[]);
            }
        }
    }
}
