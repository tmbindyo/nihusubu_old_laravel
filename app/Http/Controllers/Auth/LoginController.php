<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider) {

        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback($provider) {

        $user = Socialite::driver($provider)->user();

        // google
        $token = $user->token;
        $expiresIn = $user->expiresIn;
        $id = $user->id;
        $name = $user->name;
        $email = $user->email;
        $avatar = $user->avatar;
        $avatar = $user->avatar;
        // user
        $user_name = $user->user->name;
        $user_given_name = $user->user->given_name;
        $user_family_name = $user->user->family_name;
        $user_picture = $user->user->picture;
        $user_email = $user->user->email;
        $user_email_verified = $user->user->email_verified;
        $user_locale = $user->user->locale;
        $user_id = $user->user->id;
        $user_email_verified = $user->user->verified_email;

        // check if has an account
        // check if verified
        // redirect
        $user_id = $user->user->id;
        dd($user);
        // return $token;

        return $user;

    }

}
