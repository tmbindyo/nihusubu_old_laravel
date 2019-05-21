<?php

namespace App\Http\Controllers;

use Auth;
use App\Symptom;
use App\Disease;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Symptom $model)
    {
        // Show all symptoms
        return view('symptom.index', ['symptoms' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create symptom
        // Get all disease
        $diseases = Disease::all();
        return view('symptom.create')->with('diseases', $diseases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create symptom
        $symptom = new Symptom;
        $symptom->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $symptom->name = $request->name;
        $symptom->description = $request->description;
        $symptom->thumbnail = "";
        $symptom->disease_id = $request->disease;
        $symptom->user_id = Auth::user()->id;
        $symptom->status_id = 1;
        $symptom->save();
        return redirect()->route('symptom.index')->withStatus(__('Symptom successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        // Show symptom
        $symptom = Symptom::find($symptom->id);
        return view('symptom.show')->with('symptom', $symptom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit(Symptom $symptom)
    {
        // Show single symptom
        $symptom = Symptom::find($symptom->id);
        return view('symptom.edit')->with('symptom', $symptom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        // Edit symptom
        $symptom = Symptom::find($symptom->id);
        $symptom->name = $request->name;
        $symptom->description = $request->description;
        $symptom->save();
        return redirect()->route('symptom.index')->withStatus(__('Symptom ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
        // Delete symptom
        $symptom->delete();
        return redirect()->route('symptom.index')->withStatus(__('Symptom successfully deleted.'));
    }
}
