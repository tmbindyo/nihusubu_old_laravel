<?php

namespace App\Http\Controllers;

use Auth;
use App\Status;
use App\Project;
use App\ProjectType;
use App\ProjectBid;
use App\ProjectTask;
use App\ProjectInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $model)
    {
        return view('projects.index', ['projects' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectTypes = ProjectType::all();
        return view('projects.create',compact('projectTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Project $model)
    {
        
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->project_type_id = $request->project_type;
        $project->return_rate = $request->return_rate;
        $project->total_budget = $request->total_budget;
        $project->used_budget = 0;
        $project->remaining_budget = 0;
        $project->contributed_budget = 0;
        $project->start_date = date('Y-m-d', strtotime($request->start_date));
        $project->end_date = date('Y-m-d', strtotime($request->end_date));
        $project->user_id = Auth::user()->id;
        $project->status_id = 1;
        $project->save();
        return redirect()->route('project.index')->withStatus(__('Project successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::find($project->id);
        // $projectTasks = ProjectTask::all();
        if (Auth::user()->user_type_id == 1)
            $projectBids = DB::table('project_bids')->where('project_id', $project->id)->get();
        elseif (Auth::user()->user_type_id == 3) {
            $projectBids = DB::table('project_bids')->where('project_id', $project->id)->where('user_id', Auth::user()->id)->get();
        }elseif (Auth::user()->user_type_id == 4) {
            $projectBids = DB::table('project_bids')->where('project_id', $project->id)->get();
        }else {
            $projectBids = [];
        }
        $projectTasks = DB::table('project_tasks')->where('project_id', $project->id)->get();
        // echo ($projectTasks);
        if (Auth::user()->user_type_id == 1)
        $projectInvestments = DB::table('project_investments')->where('project_id', $project->id)->get();
        elseif (Auth::user()->user_type_id == 3) {
            $projectInvestments = DB::table('project_investments')->where('project_id', $project->id)->where('user_id', Auth::user()->id)->get();
        }elseif (Auth::user()->user_type_id == 4) {
            $projectInvestments = DB::table('project_investments')->where('project_id', $project->id)->get();
        }else {
            $projectInvestments = [];
        }
        return view('projects.show')->withProject($project)->withProjectBids($projectBids)->withProjectTasks($projectTasks)->withProjectInvestments($projectInvestments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);
        $statuses = Status::all();
        return view('projects.edit',compact('project','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project = Project::find($project->id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->status_id = $request->status;
        $project->save();
        return redirect()->route('project.index')->withStatus(__('Project successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->withStatus(__('Project successfully deleted.'));
    }
}
