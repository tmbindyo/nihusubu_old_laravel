<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectInvestment;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectInvestmentRequest;

class ProjectInvestmentController extends Controller
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

        $users = Project::all();
        $project = Project::find($id);
        return view("project_investments.create", ["project"=>$project,"users"=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, ProjectInvestmentRequest $request, ProjectInvestment $model)
    {
        $project = Project::find($id);
        $project->total_budget = (int)$project->total_budget+$request->amount;
        $project->save();

        $projectInvestment = new ProjectInvestment;
        $projectInvestment->amount = $request->amount;
        $projectInvestment->project_id = $project->id;
        // If variable
        // $projectInvestment->investor_id = $request->investor_id;
        $projectInvestment->investor_id = Auth::user()->id;
        $projectInvestment->user_id = Auth::user()->id;
        $projectInvestment->status_id = 1;
        $projectInvestment->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project investment successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectInvestment  $projectInvestment
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectInvestment $projectInvestment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectInvestment  $projectInvestment
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, ProjectInvestment $projectInvestment)
    {
        $project = Project::find($project_id);
        $projectInvestment = ProjectInvestment::find($projectInvestment->id);
        return view('project_investments.edit',compact('projectInvestment','project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectInvestment  $projectInvestment
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, ProjectInvestment $projectInvestment)
    {
        $projectInvestment = ProjectInvestment::find($projectInvestment->id);
        $projectInvestment->amount = $request->amount;
        $projectInvestment->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project investment successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectInvestment  $projectInvestment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectInvestment $projectInvestment)
    {
        //
    }
}
