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
            return '/admin/dashboard';
        }
        elseif(Auth::user()->usertype == 2)
        {
            return '/admin/dashboard';
        }
        else if(Auth::user()->usertype == 3)
        {
            return '/users/blog/post';
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
