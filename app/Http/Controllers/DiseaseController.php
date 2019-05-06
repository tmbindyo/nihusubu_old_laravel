<?php

namespace App\Http\Controllers;

use Auth;
use App\Disease;
use App\Species;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Disease $model)
    {
        // Show all diseases
        return view('disease.index', ['diseases' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create disease
        // Get all species
        $species = Species::all();
        return view('disease.create')->with('species', $species);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create disease
        $disease = new Disease;
        $disease->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $disease->name = $request->name;
        $disease->description = $request->description;
        $disease->thumbnail = "";
        $disease->species_id = $request->specie;
        $disease->user_id = Auth::user()->id;
        $disease->status_id = 1;
        $disease->save();
        return redirect()->route('disease.index')->withStatus(__('Disease successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        // Show disease
        $disease = Disease::find($disease->id);
        return view('disease.show')->with('disease', $disease);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        // Show single disease
        $disease = Disease::find($disease->id);
        return view('disease.edit')->with('disease', $disease);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        // Edit disease
        $disease = Disease::find($disease->id);
        $disease->name = $request->name;
        $disease->description = $request->description;
        $disease->save();
        return redirect()->route('disease.index')->withStatus(__('Disease ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        // Delete disease
        $disease->delete();
        return redirect()->route('disease.index')->withStatus(__('Disease successfully deleted.'));
    }
}
