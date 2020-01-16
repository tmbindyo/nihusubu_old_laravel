<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function personalLogin()
    {
        return view('auth.personal.login');
    }

    public function personalLoginTwoColumns()
    {
        return view('auth.personal.login_two_columns');
    }

    public function personalForgotPassword()
    {
        return view('auth.personal.forgot_password');
    }

    public function personalRegisterPage()
    {
        return view('auth.personal.register');
    }
}
