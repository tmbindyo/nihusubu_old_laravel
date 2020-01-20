<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

}
