<?php

namespace App\Http\Controllers;

use Auth;
use App\Institution;
use App\Industry;
use Illuminate\Http\Request;
use App\Http\Requests\InstitutionRequest;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $model)
    {
        return view('institutions.index', ['institutions' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::all();
        return view('institutions.create',compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionRequest $request, Institution $model)
    {
        // echo $request;
        $institution = new Institution;
        $institution->name = $request->name;
        $institution->description = $request->description;
        $institution->industry_id = $request->industry;
        $institution->user_id = Auth::user()->id;
        $institution->status_id = 1;
        $institution->save();
        return redirect()->route('institution.index')->withStatus(__('Institution successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        $institution = Institution::find($institution->id);
        return view('institutions.edit')->with('institution', $institution);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        $institution = Institution::find($institution->id);
        return view('institutions.edit', compact('institution'))->with('institution', $institution);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        $institution = Institution::find($institution->id);
        $institution->name = $request->name;
        $institution->description = $request->description;
        $institution->save();
        return redirect()->route('institution.index')->withStatus(__('Institution successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return redirect()->route('institution.index')->withStatus(__('Institution successfully deleted.'));
    }
}
