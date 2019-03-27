<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ProjectTask;
use App\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectTaskRequest;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectTask $model)
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
        return view("project_tasks.create", ["project"=>$project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, ProjectTaskRequest $request, ProjectTask $model)
    {
        $project = Project::find($id);

        $projectTask = new ProjectTask;
        $projectTask->name = $request->name;
        $projectTask->description = $request->description;
        $projectTask->priority = $request->priority;
        $projectTask->project_id = $project->id;
        $projectTask->total_budget = $request->total_budget;
        $projectTask->used_budget = 0;
        $projectTask->remaining_budget = $request->total_budget;
        $projectTask->start_date = date('Y-m-d', strtotime($request->start_date));
        $projectTask->end_date = date('Y-m-d', strtotime($request->end_date));
        $projectTask->user_id = Auth::user()->id;
        $projectTask->assignee_id = 0;
        $projectTask->status_id = 1;
        $projectTask->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project task successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, ProjectTask $projectTask)
    {
        $project = Project::find($project_id);
        $projectTask = ProjectTask::find($projectTask->id);
        $requisitions = DB::table('requisitions')->where('project_tasks_id', $projectTask->id)->get();
        return view('project_tasks.show')->withProject($project)->withProjectTask($projectTask)->withRequisitions($requisitions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectTask  $projectTask
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
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, ProjectTask $projectTask)
    {
        $projectTask = ProjectTask::find($projectTask->id);
        $projectTask->name = $request->name;
        $projectTask->description = $request->description;
        $projectTask->priority = $request->priority;
        $projectTask->save();
        return redirect()->route('project.index')->withID($id)->withStatus(__('Project task successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTask $projectTask)
    {
        $projectTask->delete();
        return redirect()->route('project_tasks.index')->withStatus(__('Project task successfully deleted.'));
    }
}
