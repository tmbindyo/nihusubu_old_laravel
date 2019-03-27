<?php

namespace App\Http\Controllers;

use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->user_type_id == 1){
            return view('dashboard');
        } elseif (Auth::user()->user_type_id == 3) {
            return view('investor_dashboard');
        } elseif (Auth::user()->user_type_id == 4) {
            return view('project_manager.dashboard');
        } else {
            return redirect('login');
        }
            
    }

    public function admin()
    {
        return view('dashboard');
    }
    public function investor()
    {
        return view('investor.dashboard');
    }
    public function projectmanager()
    {
        return view('project.manager.dashboard');
    }
}
