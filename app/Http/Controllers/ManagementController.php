<?php

namespace App\Http\Controllers;

use Auth;
use App\Management;
use App\Disease;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Management $model)
    {
        // Show all managements
        return view('management.index', ['managements' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create management
        // Get all diseases
        $diseases = Disease::all();
        return view('management.create')->with('diseases', $diseases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create management
        $management = new Management;
        $management->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $management->name = $request->name;
        $management->description = $request->description;
        $management->thumbnail = "";
        $management->disease_id = $request->disease;
        $management->user_id = Auth::user()->id;
        $management->status_id = 1;
        $management->save();
        return redirect()->route('management.index')->withStatus(__('Management successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function show(Management $management)
    {
        // Show management
        $management = Management::find($management->id);
        return view('management.show')->with('management', $management);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function edit(Management $management)
    {
        // Show single management
        $management = Management::find($management->id);
        return view('management.edit')->with('management', $management);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Management $management)
    {
        // Edit management
        $management = Management::find($management->id);
        $management->name = $request->name;
        $management->description = $request->description;
        $management->save();
        return redirect()->route('management.index')->withStatus(__('Management ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function destroy(Management $management)
    {
        // Delete management
        $management->delete();
        return redirect()->route('management.index')->withStatus(__('Management successfully deleted.'));
    }
}
