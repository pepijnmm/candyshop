<?php

namespace App\Http\Controllers;

use App\Http\requests;

class PanelController extends Controller
{
    public function adminpanel(){
    	return view('admin.index');
    }
}