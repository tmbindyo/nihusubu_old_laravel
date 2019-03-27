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
    }
    public function bid()
    {
        // Get user project bids
        $userBids = DB::table('project_bids')->where('user_id', '=', Auth::user()->id)->get();
        // $projects = Project::findOrFail($userBids->project_id);
        return view('project_bids.user', ['userBids' => $userBids]);
    }
    public function ongoing()
    {
        $projects = DB::table('projects')->where('status_id', '=', 5)->get();
        return view('projects.ongoing', ['projects' => $projects]);
    }
    public function portfolio()
    {
        $projects = DB::table('projects')->where('status_id', '=', 4)->get();
        return view('projects.portfolio', ['projects' => $projects]);
    }
}
