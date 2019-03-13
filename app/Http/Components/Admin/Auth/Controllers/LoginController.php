<?php

namespace App\Http\Components\Admin\Auth\Controllers;

use App\Http\Components\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }
    public function showFields()
    {
        return response()->json([ 'fields' => ['email','password', 'remember_token'] ],200);
    }

    public function sendLoginResponse($request){
        return response()->json([
            'token' => tokenizer()->jwt($this->guard()->user())
        ], 200);
    }
}
