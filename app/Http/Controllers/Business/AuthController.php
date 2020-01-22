<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function businessLogin()
    {
        return view('auth.business.login');
    }

    public function businessLoginTwoColumns()
    {
        return view('auth.business.login_two_columns');
    }

    public function businessForgotPassword()
    {
        return view('auth.business.forgot_password');
    }

    public function businessRegisterPage()
    {
        return view('auth.business.register');
    }
}
