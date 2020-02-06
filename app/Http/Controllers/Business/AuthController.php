<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;

class AuthController extends Controller
{



    public function standardSignupLogin()
    {

        $plan = Plan::where('id','410f31ed-47be-4658-930a-a47f2839ebf5')->first();
        return view('auth.business_register',compact('plan'));
    }

    public function professionalLogin()
    {
        $plan = Plan::where('id','34ae6893-5329-46b4-99a9-3cde1367fb55')->first();
        return view('auth.business_register',compact('plan'));
    }

    public function personalSignup()
    {
        return back()->withErrors("Coming soon");
    }

    public function businessRegisterPage()
    {
        return view('auth.business.register');
    }

    public function businessAdd()
    {
        return view('auth.create_new_account');
    }
}
