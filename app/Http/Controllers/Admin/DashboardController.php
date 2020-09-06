<?php

namespace App\Http\Controllers\Admin;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // User
        $user = $this->getUser();

        return view('admin.dashboard', compact('user'));
    }
}
