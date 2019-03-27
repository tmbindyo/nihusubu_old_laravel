<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectTask;
use App\Requisition;
use Illuminate\Http\Request;
use App\Http\Requests\RequisitionRequest;

class RequisitionController extends Controller
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
        $projectTask = ProjectTask::find($id);
        return view("requisitions.create", ["projectTask"=>$projectTask]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, RequisitionRequest $request, Requisition $model)
    {
        $projectTask = ProjectTask::find($id);
        $projectTask->used_budget = (int)$projectTask->used_budget+$request->amount;
        $projectTask->remaining_budget = (int)$projectTask->total_budget-($projectTask->used_budget+$request->amount);
        $projectTask->save();

        $project = Project::find($projectTask->id);
        $project->used_budget = (int)$project->used_budget+$request->amount;
        $project->remaining_budget = (int)$project->total_budget-($project->used_budget+$request->amount);
        $project->save();

        $requsitition = new Requisition;
        $requsitition->item_name = $request->item_name;
        $requsitition->description = $request->description;
        $requsitition->reason = $request->reason;
        $requsitition->project_tasks_id = $projectTask->id;
        $requsitition->number = $request->number;
        $requsitition->amount = $request->amount;
        $requsitition->user_id = Auth::user()->id;
        $requsitition->status_id = 1;
        $requsitition->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project task successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, ProjectTask $projectTask)
    {
        $project = Project::find($project_id);
        $projectTask = ProjectTask::find($projectTask->id);
        $requisitions = DB::table('requisitions')->where('project_tasks_id', $projectTask->id)->get();
        return view('project_tasks.edit')->withProject($project)->withProjectTask($projectTask)->withRequisitions($requisitions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
