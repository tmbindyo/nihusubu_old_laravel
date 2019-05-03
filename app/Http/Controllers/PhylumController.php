<?php

namespace App\Http\Controllers;

use Auth;
use App\Phylum;
use App\Kingdom;
use Illuminate\Http\Request;

class PhylumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Phylum $model)
    {
        // Show all phylums
        return view('phylum.index', ['phylums' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create phylums
        // Get all kingdoms
        $kingdoms = Kingdom::all();
        return view('phylum.create')->with('kingdoms', $kingdoms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create phylums
        $phylum = new Phylum;
        $phylum->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $phylum->name = $request->name;
        $phylum->description = $request->description;
        $phylum->thumbnail = "";
        $phylum->kingdom_id = $request->kingdom;
        $phylum->user_id = Auth::user()->id;
        $phylum->status_id = 1;
        $phylum->save();
        return redirect()->route('phylum.index')->withStatus(__('Phylum successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phylum  $phylum
     * @return \Illuminate\Http\Response
     */
    public function show(Phylum $phylum)
    {
        // Show phylums
        $phylum = Phylum::find($phylum->id);
        return view('phylum.show')->with('phylum', $phylum);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phylum  $phylum
     * @return \Illuminate\Http\Response
     */
    public function edit(Phylum $phylum)
    {
        // Show single phylums
        $phylum = Phylum::find($phylum->id);
        return view('phylum.edit')->with('phylum', $phylum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phylum  $phylum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phylum $phylum)
    {
        // Edit phylums
        $phylum = Phylum::find($phylum->id);
        $phylum->name = $request->name;
        $phylum->description = $request->description;
        $phylum->save();
        return redirect()->route('phylum.index')->withStatus(__('Phylum successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phylum  $phylum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phylum $phylum)
    {
        // Delete phylums
        $phylum->delete();
        return redirect()->route('phylum.index')->withStatus(__('Phylum successfully deleted.'));
    }
}
