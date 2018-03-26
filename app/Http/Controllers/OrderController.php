<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
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
		$order = Order::find(1);
		foreach ($order->products as $product)
            {
                var_dump($product->name);
            }
			die();
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
            $order = Order::find(1);
            if ($order) {
                return view('order.show', ['order' => $order]);
            }
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'session_id' => Session::getId(), 'status' => 'active']);
            $order = Order::find(1);
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
