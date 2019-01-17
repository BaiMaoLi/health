<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\admin\Event;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating user for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect user after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated(Request $request, $user)
    {
        return redirect('/home');
    }

    public function showLoginForm()
    {
        $events=Event::where('category_name','Public')->get();
        return view('login_fail',compact('events'));
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
