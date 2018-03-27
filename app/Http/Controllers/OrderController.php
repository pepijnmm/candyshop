<?php

namespace App\Http\Controllers;

use App\Order;
use App\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }

    public function cart()
    {
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
            if ($order) {
                return view('order.show', ['order' => $order]);
            }
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
            if ($order) {
                return view('order.show', ['order' => $order]);
            }
        }
        Session::flash('alert-warning', 'Winkelwagen kon niet worden gevonden.');
        return redirect()->action('OrderController@index');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        if ($order) {
            return view('order.show',['order'=>$order]);
        }
        Session::flash('alert-warning', 'Bestelling kon niet worden gevonden.');
        return redirect()->action('OrderController@index');
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
