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
        $user_id = Auth::user()->id;
        $projects = Project::with(['project_bids'])
            ->whereDoesntHave('project_bids', function($q) use($user_id) {
            // Query the name field in status table
            $q->where('user_id', '=', $user_id); // '=' is optional
        })
        ->get();
        return view('projects.opportunity', ['projects' => $projects]);
    }
    public function bid()
    {
        // Get projects
        $user_id = Auth::user()->id;
        $projects = Project::with(['project_bids'])
            ->whereHas('project_bids', function($q) use($user_id) {
            // Query the name field in status table
            $q->where('user_id', '=', $user_id); // '=' is optional
        })
        ->get();
        return view('projects.pending', ['projects' => $projects]);
    }
    public function ongoing()
    {
        // Get projects
        $user_id = Auth::user()->id;
        $projects = Project::with(['project_bids'])
            ->whereHas('project_bids', function($q) use($user_id) {
            // Query the name field in status table
            $q->where('user_id', '=', $user_id); // '=' is optional
        })
        ->where('status_id', '=', 5)
        ->get();
        return view('projects.ongoing', ['projects' => $projects]);
    }
    public function portfolio()
    {
        $user_id = Auth::user()->id;
        $projects = Project::with(['project_bids'])
            ->whereHas('project_bids', function($q) use($user_id) {
            // Query the name field in status table
            $q->where('user_id', '=', $user_id); // '=' is optional
        })
        ->where('status_id', '=', 4)
        ->get();
        // $projects = DB::table('projects')->where('status_id', '=', 4)->get();
        return view('projects.portfolio', ['projects' => $projects]);
    }
}
