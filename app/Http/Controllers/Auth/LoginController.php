<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function index()
    {
      return view('main.login');
    }

    public function authenticate(){

        $password = request('password');
        $email = request('email');
        
        if (Auth::attempt(['email' => $email, 'password' => $password ])) {
              // Authentication passed...
              
                $u = Auth::user();
                session()->put('role', $u->role);
                session()->put('current_user', $u->name);
  
                auth()->login(Auth::user());
                if( $u->role == 'admin' ){
                  return redirect()->route('admin-main');
                }else{
                  session()->put('user_id', $u->id);
                  return redirect()->route('customer-main');
                }
              
  
          }
          return redirect('/login')->with('status', 'Invalid username or password');
      }
  
      public function logout(){
        Auth::logout();
        return redirect('/');
      }
}
