<?php

namespace App\Http\Controllers;

use Auth;
use App\Domain;
use App\Kingdom;
use Illuminate\Http\Request;

class KingdomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kingdom $model)
    {
        // Show all kingdoms
        return view('kingdom.index', ['kingdoms' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create kingdoms
        // Get all domains
        $domains = Domain::all();
        return view('kingdom.create')->with('domains', $domains);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create kingdoms
        $kingdom = new Kingdom;
        $kingdom->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $kingdom->name = $request->name;
        $kingdom->description = $request->description;
        $kingdom->thumbnail = "";
        $kingdom->domain_id = $request->domain;
        $kingdom->user_id = Auth::user()->id;
        $kingdom->status_id = 1;
        $kingdom->save();
        return redirect()->route('kingdom.index')->withStatus(__('Kingdom successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kingdom  $kingdom
     * @return \Illuminate\Http\Response
     */
    public function show(Kingdom $kingdom)
    {
        // Show kingdoms
        $kingdom = Kingdom::find($kingdom->id);
        return view('kingdom.show')->with('kingdom', $kingdom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kingdom  $kingdom
     * @return \Illuminate\Http\Response
     */
    public function edit(Kingdom $kingdom)
    {
        // Show single kingdoms
        $kingdom = Kingdom::find($kingdom->id);
        return view('kingdom.edit')->with('kingdom', $kingdom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kingdom  $kingdom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kingdom $kingdom)
    {
        // Edit kingdoms
        $kingdom = Kingdom::find($kingdom->id);
        $kingdom->name = $request->name;
        $kingdom->description = $request->description;
        $kingdom->save();
        return redirect()->route('kingdom.index')->withStatus(__('Kingdom successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kingdom  $kingdom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kingdom $kingdom)
    {
        // Delete kingdoms
        $kingdom->delete();
        return redirect()->route('kingdom.index')->withStatus(__('Kingdom successfully deleted.'));
    }
}
