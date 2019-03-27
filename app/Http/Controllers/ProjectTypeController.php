<?php

namespace App\Http\Controllers;

use Auth;
use App\ProjectType;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectTypeRequest;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectType $model)
    {
        return view('project_types.index', ['project_types' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTypeRequest $request, ProjectType $model)
    {
        $projectType = new ProjectType;
        $projectType->name = $request->name;
        $projectType->description = $request->description;
        $projectType->user_id = Auth::user()->id;
        $projectType->status_id = 1;
        $projectType->save();
        return redirect()->route('project_type.index')->withStatus(__('ProjectType successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        $projectType = ProjectType::find($projectType->id);
        return view('project_types.edit')->with('project_type', $projectType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        $projectType = ProjectType::find($projectType->id);
        return view('project_types.edit', compact('project_type'))->with('project_type', $projectType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $projectType = ProjectType::find($projectType->id);
        $projectType->name = $request->name;
        $projectType->description = $request->description;
        $projectType->save();
        return redirect()->route('project_type.index')->withStatus(__('ProjectType successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return redirect()->route('project_type.index')->withStatus(__('ProjectType successfully deleted.'));
    }
}
