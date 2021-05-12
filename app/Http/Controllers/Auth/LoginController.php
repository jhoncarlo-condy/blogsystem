<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectTo()
    {
        if(Auth::user()->usertype == 1)
        {
            return '/dashboard';
        }
        elseif(Auth::user()->usertype == 2)
        {
            return '/dashboard';
        }
        else if(Auth::user()->usertype == 3)
        {
            return '/blog/users';
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
