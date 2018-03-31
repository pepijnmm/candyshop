<?php

namespace App\Http\Controllers;

use App\Order;
use App\Category;
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
        $orders = Order::where([['user_id', Auth::id()], ['status', '<>', 'active' ], ['status', '<>', 'received' ]])->get();
        return view('order.index', ['orders' => $orders]);
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

    public function add($product, $amount)
    {
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
        }
        $product = Product::find($product);
        if (!empty($order) && !empty($product)) {
            if (! $order->products->contains($product->id)) {
                $product->orders()->attach([$order->id => ['amount' => $amount]]);
            }
            else {
                $product->orders()->updateExistingPivot($order->id, ['amount' => $order->products()->find($product->id)->pivot->amount + $amount]);
            }
            $order->total_price += $product->price;

            $order->save();
            Session::flash('alert-success', 'product toegevoegd');
            return redirect()->action('OrderController@cart');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@show', $order);
    }

    public function remove($order, $product){
        $order = Order::find($order);
        $product = Product::find($product);
        if (!empty($order) && !empty($product)) {
            $order->products()->detach($product->id);
            $order->total_price -= $product->price;

            $order->save();
            Session::flash('alert-success', 'product verwijderd');
            return redirect()->action('OrderController@show', $order);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@show', $order);
    }

    public function destroy(Order $order)
    {
        //
    }
}
