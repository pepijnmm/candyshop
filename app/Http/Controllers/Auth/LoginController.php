<?php

namespace App\Http\Controllers\Auth;

use App\Order;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    private $order;

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->order = Order::firstOrNew(['session_id' => Session::getId()]);

        $this->validate($request, [
            $this->username() => 'required|string', 'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $newOrder = Order::firstOrNew(['user_id' => Auth::id(), 'session_id' => Session::getId(), 'status' => 'active']);
        $newOrder->products()->union($this->order->products());
        $newOrder->save();
        $this->order->forceDelete();
    }
}
