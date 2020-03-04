<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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

        // return $provider;
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->authenticate($getInfo, $provider);
        if ($user) {
            auth()->login($user, true);
        }
        return redirect()->to('/success');

    }

    public function authenticate($getInfo, $provider)
    {
        $user = User::where('email', $getInfo->email)->first();
        if (!$user) {
            $newUser = '';
            switch ($provider) {
                case 'facebook':
                    $newUser = $this->facebook($getInfo);
                    break;
                case 'google':
                    $newUser = $this->google($getInfo);
                    break;
                case 'twitter':
                    $newUser = $this->twitter($getInfo);
                    break;
                case 'linkedin':
                    $newUser = $this->linkedIn($getInfo);
                    break;
                default:
                    break;
            }
            return $newUser;
        } else {
            return $user;
        }

    }


    private function facebook($getInfo){

    }

    private function google($getInfo){
        $token = $getInfo->token;
        $refreshToken = $getInfo->refreshToken; // not always provided
        $expiresIn = $getInfo->expiresIn;
        $id = $getInfo->id;
        $nickname = $getInfo->nickname;
        $name = $getInfo->name;
        $email = $getInfo->email;
        $avatar = $getInfo->avatar;

        // user array key
        $userSub = $getInfo->user['sub'];
        $userName = $getInfo->user['name'];
        $userGivenName = $getInfo->user['given_name'];
        $userFamilyName = $getInfo->user['family_name'];
        $userPicture = $getInfo->user['picture'];
        $userEmail = $getInfo->user['email'];
        $userEmailVerified = $getInfo->user['email_verified'];
        $userLocale = $getInfo->user['locale'];
        $userId = $getInfo->user['id'];
        $userVerifiedEmail = $getInfo->user['verified_email'];
        $userLink = $getInfo->user['link'];

        $avatarOriginal = $getInfo->avatarOriginal;

        // create user
    }

    private function twitter($getInfo){

    }
    
    private function linkedIn($getInfo){

    }

}
