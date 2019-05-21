<?php

namespace App\Http\Controllers;

use Auth;
use App\Causes;
use App\Disease;
use Illuminate\Http\Request;

class CausesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Causes $model)
    {
        // Show all causes
        return view('causes.index', ['causes' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create causes
        // Get all diseases
        $diseases = Disease::all();
        return view('causes.create')->with('diseases', $diseases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create causes
        $causes = new Causes;
        $causes->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $causes->name = $request->name;
        $causes->description = $request->description;
        $causes->thumbnail = "";
        $causes->disease_id = $request->disease;
        $causes->user_id = Auth::user()->id;
        $causes->status_id = 1;
        $causes->save();
        return redirect()->route('causes.index')->withStatus(__('Causes successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function show(Causes $causes)
    {
        // Show causes
        $causes = Causes::find($causes->id);
        return view('causes.show')->with('causes', $causes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function edit(Causes $causes)
    {
        // Show single causes
        $causes = Causes::find($causes->id);
        return view('causes.edit')->with('causes', $causes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cause  $causes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Causes $causes)
    {
        // Edit causes
        $causes = Causes::find($causes->id);
        $causes->name = $request->name;
        $causes->description = $request->description;
        $causes->save();
        return redirect()->route('causes.index')->withStatus(__('Causes ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Causes $causes)
    {
        // Delete causes
        $causes->delete();
        return redirect()->route('causes.index')->withStatus(__('Causes successfully deleted.'));
    }
}
