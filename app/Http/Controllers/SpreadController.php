<?php

namespace App\Http\Controllers;

use Auth;
use App\Spread;
use App\Disease;
use Illuminate\Http\Request;

class SpreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Spread $model)
    {
        // Show all spreads
        return view('spread.index', ['spreads' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create spread
        // Get all disease
        $diseases = Disease::all();
        return view('spread.create')->with('diseases', $diseases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create spread
        $spread = new Spread;
        $spread->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $spread->name = $request->name;
        $spread->description = $request->description;
        $spread->thumbnail = "";
        $spread->disease_id = $request->disease;
        $spread->user_id = Auth::user()->id;
        $spread->status_id = 1;
        $spread->save();
        return redirect()->route('spread.index')->withStatus(__('Spread successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spread  $spread
     * @return \Illuminate\Http\Response
     */
    public function show(Spread $spread)
    {
        // Show spread
        $spread = Spread::find($spread->id);
        return view('spread.show')->with('spread', $spread);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spread  $spread
     * @return \Illuminate\Http\Response
     */
    public function edit(Spread $spread)
    {
        // Show single spread
        $spread = Spread::find($spread->id);
        return view('spread.edit')->with('spread', $spread);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spread  $spread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spread $spread)
    {
        // Edit spread
        $spread = Spread::find($spread->id);
        $spread->name = $request->name;
        $spread->description = $request->description;
        $spread->save();
        return redirect()->route('spread.index')->withStatus(__('Spread ssuccessfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spread  $spread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spread $spread)
    {
        // Delete spread
        $spread->delete();
        return redirect()->route('spread.index')->withStatus(__('Spread successfully deleted.'));
    }
}
