<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('personal.dashboard');
    }
    public function profileUpdate()
    {
        return back()->withStatus(__('Profile successfully updated.'));
    }
}
