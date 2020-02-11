<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;

class AuthController extends Controller
{

    public function businessSignup()
    {

        $plans = Plan::where('plan_type_id','7dd05c3c-7526-498b-9fbb-d0c766a678ac')->get();
        return view('auth.register',compact('plans'));
    }

    public function standardSignup()
    {

        $plan = Plan::where('id','410f31ed-47be-4658-930a-a47f2839ebf5')->first();
        return view('auth.business_register',compact('plan'));
    }

    public function professionalSignup()
    {
        $plan = Plan::where('id','34ae6893-5329-46b4-99a9-3cde1367fb55')->first();
        return view('auth.business_register',compact('plan'));
    }

    public function personalSignup()
    {
        return back()->withErrors("Coming soon");
    }

    public function businessAdd()
    {
        $plans = Plan::where('plan_type_id','7dd05c3c-7526-498b-9fbb-d0c766a678ac')->get();
        return view('auth.create_new_account',compact('plans'));
    }
}
