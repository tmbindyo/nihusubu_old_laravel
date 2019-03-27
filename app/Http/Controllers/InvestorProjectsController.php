<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorProjectsController extends Controller
{
    public function opportunity()
    {
        // Get all projects
        $projects = Project::with(['project_bids'])->get();
        return view('projects.opportunity', ['projects' => $projects]);
        return view('dashboard');
    }
    public function bid()
    {
        // Get user project bids
        $bids = DB::table('project_bids')->where('user_id', '=', Auth::user()->id)->get();
        echo ($bids);
        // return view('dashboard');
    }
    public function ongoing()
    {
        $projects = DB::table('projects')->where('status_id', '=', 5)->get();
        echo ($projects);
        // return view('dashboard');
    }
    public function portfolio()
    {
        $projects = DB::table('projects')->where('status_id', '=', 4)->get();
        echo ($projects);
        // return view('dashboard');
    }
}
