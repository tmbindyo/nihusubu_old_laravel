<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return view('business.login');
    }
    public function register()
    {
        return view('business.register');
    }
    public function forgotPassword()
    {
        return view('business.forgot_password');
    }
}
