<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectBid;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectBidRequest;

class ProjectBidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project = Project::find($id);
        return view("project_bids.create", ["project"=>$project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, ProjectBidRequest $request, ProjectBid $model)
    {
        $project = Project::find($id);

        $projectBid = new ProjectBid;
        $projectBid->project_id = $project->id;
        $projectBid->bid_amount = $request->bid_amount;
        $projectBid->user_id = Auth::user()->id;
        $projectBid->status_id = 1;
        $projectBid->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project task successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectBid  $projectBid
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $projectBids = ProjectBid::find($project->id);
        return view('project_bids.index',compact('projectBids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectBid  $projectBid
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, ProjectBid $projectBid)
    {
        $project = Project::find($project_id);
        $projectBid = ProjectBid::find($projectBid->id);
        return view('project_bids.edit',compact('projectBid','project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectBid  $projectBid
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, ProjectBid $projectBid)
    {
        if($projectBid->status_id == 2){
            // Create record for project investment
        }
        $projectBid = ProjectBid::find($projectBid->id);
        $projectBid->bid_amount = $request->bid_amount;
        $projectBid->status_id = $request->status_id;
        $projectBid->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project task successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectBid  $projectBid
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectBid $projectBid)
    {
        //
    }
}
