<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectBid;
use App\ProjectInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectBidRequest;


class BidManagementController extends Controller
{
    public function approve($project_id, $project_bid_id)
    {
        // Change status
        $projectBid = ProjectBid::find($project_bid_id);
        $projectBid->status_id = 2;
        
        // Update project record
        $project = Project::find($project_id);
        $project->contributed_budget = (int)$project->contributed_budget+$projectBid->bid_amount;
        
        // Project investment record
        $projectInvestment = new ProjectInvestment;
        $projectInvestment->amount = $projectBid->bid_amount;
        $projectInvestment->project_id =  $projectBid->project_id;
        $projectInvestment->investor_id = $projectBid->user_id;
        $projectInvestment->user_id = Auth::user()->id;
        $projectInvestment->status_id = 2;

        // Save project bid
        $projectBid->save();
        // Save project 
        $project->save();
        $projectInvestment->save();

        

        // Create record 

        // $projectTasks = ProjectTask::all();
        if (Auth::user()->user_type_id == 1)
            $projectBids = DB::table('project_bids')->where('project_id', $project_id)->where('status_id', 1)->get();
        elseif (Auth::user()->user_type_id == 3) {
            $projectBids = DB::table('project_bids')->where('project_id', $project_id)->where('status_id', 1)->where('user_id', Auth::user()->id)->get();
        }elseif (Auth::user()->user_type_id == 4) {
            $projectBids = DB::table('project_bids')->where('project_id', $project_id)->where('status_id', 1)->get();
        }else {
            $projectBids = [];
        }
        $projectTasks = DB::table('project_tasks')->where('project_id', $project_id)->get();
        // echo ($projectTasks);
        $projectInvestments = DB::table('project_investments')->where('project_id', $project_id)->get();
        return view('projects.show')->withProject($project)->withProjectBids($projectBids)->withProjectTasks($projectTasks)->withProjectInvestments($projectInvestments);
    }
}
