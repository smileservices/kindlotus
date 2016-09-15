<?php

namespace App\Http\Controllers\NgoAuth;

use App\Ngo;
use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**dc
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectPath = 'ngo/home';
    protected $guard = 'ngo';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('ngo.auth.login');
    }
    public function showRegistrationForm()
    {
        return view('ngo.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Ngo
     */
    protected function create(Request $data)
    {
        Ngo::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => 1,
            'password' => bcrypt($data['password']),
        ]);

//        Auth::guard('ngo')->attempt(['email' => $data['email'], 'password' => $data['password']]);

        return redirect($this->redirectPath);
    }

}
