<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Address;
use App\Category;
use App\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminCheck');
    }
    public function index()
    {
        $orders = Order::where([['user_id', Auth::id()], ['status', '<>', 'active' ], ['status', '<>', 'received' ]])->get();
        return view('order.index', ['orders' => $orders]);
    }

    public function cart()
    {
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
        }
        $order->save();
        if ($order) {
            return view('order.cart', ['order' => $order]);
        }
        Session::flash('alert-warning', 'Winkelwagen kon niet worden gevonden.');
        return redirect()->action('OrderController@index');
    }
    public function checkout(){
        if (Auth::guest()) {
            Session::flash('alert-warning', 'log alstublieft eerst in');
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
        else if(!Order::where(['user_id' => Auth::id(), 'status' => 'active'])->exists()){
            Session::flash('alert-warning', 'U heeft nog geen winkelmandje');
            return redirect()->action('OrderController@cart');
        }
        $order = Order::where(['user_id' => Auth::id(), 'status' => 'active'])->first();
        $addresses = Address::where(['user_id' => Auth::id()])->get();
        return view('order.checkout', ['order' => $order,'addresses' => $addresses]);
    }
    public function checkoutstore(Request $request){
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
        }
        $validator = Validator::make($request->all(), ['adress' => 'required','checkbox'=>'required']);
        if ($validator->fails() || $request->checkbox !== "on") {
                Session::flash('alert-warning', 'Bestelling kon niet worden verwerkt.');
                return redirect()->action('OrderController@checkout')->withInput()->withErrors($validator);
        }
        $order = Order::where(['user_id' => Auth::id(), 'status' => 'active'])->first();
        $order->address_id=$request->adress;
        $order->status='paid';
        $order->save();
        Session::flash('alert-success', 'Producten gekocht');
        return redirect()->action('OrderController@cart')->withInput()->withErrors($validator);
    }
    public function show(Order $order)
    {
        if ($order) {
            return view('order.show',['order'=>$order]);
        }
        Session::flash('alert-warning', 'Bestelling kon niet worden gevonden.');
        return redirect()->action('OrderController@index');
    }

    public function add(Request $request, $id) {
        $validator = Validator::make($request->all(), ['amount' => 'required|min:1']);
        if ($validator->fails()) {
            return redirect()->action('ProductController@edit',$id)->withInput()->withErrors($validator);
        }
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
        }
        $product = Product::find($id);
        if (!empty($product)) {
            if (! $order->products->contains($product->id)) {
                $order->products()->attach($id, ['amount' => $request->amount]);
            }
            else {
                $order->products()->updateExistingPivot($id, ['amount' => $order->products()->find($product->id)->pivot->amount + $request->amount]);
            }
            $order->total_price = 0;
            foreach($order->products()->get() as $product){
                if($product->discount){
                    $order->total_price += round(($product->price-($product->price/100*$product->discount))*$product->pivot->amount,2);
                }
                else{
                    $order->total_price +=  $product->price*$product->pivot->amount; 
                }
           }
            $order->save();
            Session::flash('alert-success', 'product toegevoegd');
            return redirect()->action('OrderController@cart');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('ProductController@show', $id);
    }

    public function remove($product){
        if (Auth::guest()) {
            $order = Order::firstOrNew(['session_id' => Session::getId()]);
        }
        else {
            $order = Order::firstOrNew(['user_id' => Auth::id(), 'status' => 'active']);
        }
        $product = Product::find($product);
        if (!empty($product)) {
            $order->products()->detach($product->id);
            $order->total_price = 0;
            foreach($order->products()->get() as $product){
                if($product->discount){
                    $order->total_price += round(($product->price-($product->price/100*$product->discount))*$product->pivot->amount,2);
                }
                else{
                    $order->total_price +=  $product->price*$product->pivot->amount; 
                }
           }

            
            $order->save();
            Session::flash('alert-success', 'product verwijderd');
            return redirect()->action('OrderController@cart');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@cart');
    }

    public function addamount($order, $product){
        $order = Order::find($order);
        $product = $order->products()->where(['id' => $product])->first();
        if (!empty($product)) {
            $product->pivot->amount += 1;
            $product->pivot->save();
            $order->total_price = 0;
            foreach($order->products()->get() as $product){
                if($product->discount){
                    $order->total_price += round(($product->price-($product->price/100*$product->discount))*$product->pivot->amount,2);
                }
                else{
                    $order->total_price +=  $product->price*$product->pivot->amount; 
                }
           }

            $order->save();
            return redirect()->action('OrderController@cart');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@show', $order);
    }

    public function removeamount( $order, $product){
        $order = Order::find($order);
        $product = $order->products()->where(['id' => $product])->first();
        if (!empty($product)) {
            if ($product->pivot->amount > 1) {
                $product->pivot->amount -= 1;
                $product->pivot->save();
                $order->total_price = 0;
                foreach($order->products()->get() as $product){
                    if($product->discount){
                        $order->total_price += round(($product->price-($product->price/100*$product->discount))*$product->pivot->amount,2);
                    }
                    else{
                        $order->total_price +=  $product->price*$product->pivot->amount; 
                    }
               }

                $order->save();
                return redirect()->action('OrderController@cart');
            }
            Session::flash('alert-warning', 'aantal kan niet lager dan 1');
            return redirect()->action('OrderController@cart');
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@show', $order);
    }

        public function removeorder(Order $order, $product){
        $order = Order::find($order);
        $product = Product::find($product);
        if (!empty($order) &&!empty($product)) {
            $order->products()->detach($product->id);
            $order->total_price = 0;
            foreach($order->products()->get() as $product){
                if($product->discount){
                    $order->total_price += round(($product->price-($product->price/100*$product->discount))*$product->pivot->amount,2);
                }
                else{
                    $order->total_price +=  $product->price*$product->pivot->amount; 
                }
           }

            $order->save();
            Session::flash('alert-success', 'product verwijderd');
            return redirect()->action('OrderController@show', $order);
        }
        Session::flash('alert-warning', 'product kon niet worden gevonden');
        return redirect()->action('OrderController@show', $order);
    }
}
