<?php

namespace App\Http\Controllers;

use Auth;
use App\Genus;
use App\Family;
use Illuminate\Http\Request;

class GenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Genus $model)
    {
        // Show all genera
        return view('genus.index', ['genera' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create genera
        // Get all families
        $families = Family::all();
        return view('genus.create')->with('families', $families);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create genera
        $genus = new Genus;
        $genus->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $genus->name = $request->name;
        $genus->description = $request->description;
        $genus->thumbnail = "";
        $genus->family_id = $request->family;
        $genus->user_id = Auth::user()->id;
        $genus->status_id = 1;
        $genus->save();
        return redirect()->route('genus.index')->withStatus(__('Genus successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genus  $genus
     * @return \Illuminate\Http\Response
     */
    public function show(Genus $genus)
    {
        // Show genera
        $genus = Genus::find($genus->id);
        return view('genus.show')->with('genus', $genus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genus  $genus
     * @return \Illuminate\Http\Response
     */
    public function edit(Genus $genus)
    {
        // Show single genera
        $genus = Genus::find($genus->id);
        return view('genus.edit')->with('genus', $genus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genus  $genus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genus $genus)
    {
        // Edit genera
        $genus = Genus::find($genus->id);
        $genus->name = $request->name;
        $genus->description = $request->description;
        $genus->save();
        return redirect()->route('genus.index')->withStatus(__('Genus successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genus  $genus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genus $genus)
    {
        // Delete genera
        $genus->delete();
        return redirect()->route('genus.index')->withStatus(__('Genus successfully deleted.'));
    }
}
