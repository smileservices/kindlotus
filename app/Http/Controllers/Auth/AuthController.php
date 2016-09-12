<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request as AuthRequest;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use App\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Mail;

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

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectPath = '/';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);
        //send email confirmation
        Mail::send('emails.verifyEmail', ['code' => $confirmation_code, 'name' => $data['name']], function($message) {
            $message->to(Input::get('email'), Input::get('name'))
                ->subject('Verify your email address');
        });
        //set flash message
        session()->flash('message','Thanks for signing up! Please check your email.');
        //insert user in db
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => 1,
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code
        ]);
    }

    public function confirmEmail($code)
    {
        if (!$code) {
            return abort(403, 'The confirmation code is not right');
        }
        $user = User::getByConfirmationCode($code)->first();
        if (!$user) {
            return abort(403, 'The confirmation code is not right');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        Auth::logIn($user);
        return redirect('')->with('message', 'You have successfully verified your account!');
    }

    public function authenticated($request, $user){
        if (!$user->active()) {
            return abort(403, 'You cannot login with this user. Contact admin');
        }
        if (!$user->confirmed()) {
            return abort(403, 'You haven\'t confirmed you email address');
        }
        return redirect(url()->previous());
    }

    protected function sendFailedLoginResponse(AuthRequest $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ], 'userLogin');
    }

    public function register(AuthRequest $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        return redirect($this->redirectPath());
    }

    /*
     *  SOCIALITE functions
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $service = new SocialAccountService();
        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
        if ($user == 'noEmail') {
            return redirect()->back()->with('message', 'We need to have an e-mail address associated with your account');
        }
        if (!$user->active()) {
            return abort(403, 'Nu va puteti conecta cu acest utiliator');
        }
        Auth::logIn($user);

        return redirect()->intended();
    }

}
