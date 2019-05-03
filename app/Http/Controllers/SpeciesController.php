<?php

namespace App\Http\Controllers;

use Auth;
use App\Species;
use App\Genus;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Species $model)
    {
        // Show all species
        return view('species.index', ['species' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create species
        // Get all genera
        $genera = Genus::all();
        return view('species.create')->with('genera', $genera);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create species
        $species = new Species;
        $species->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $species->name = $request->name;
        $species->description = $request->description;
        $species->kingdom_id = $request->kingdom;
        $species->user_id = Auth::user()->id;
        $species->status_id = 1;
        $species->save();
        return redirect()->route('species.index')->withStatus(__('Species successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        // Show species
        $species = Species::find($species->id);
        return view('species.show')->with('species', $species);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        // Show single species
        $species = Species::find($species->id);
        return view('species.edit')->with('species', $species);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specie  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species)
    {
        // Edit species
        $species = Species::find($species->id);
        $species->name = $request->name;
        $species->description = $request->description;
        $species->save();
        return redirect()->route('species.index')->withStatus(__('Species ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function destroy(Species $species)
    {
        // Delete species
        $species->delete();
        return redirect()->route('species.index')->withStatus(__('Species successfully deleted.'));
    }
}
