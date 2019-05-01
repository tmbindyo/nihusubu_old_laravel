<?php

namespace App\Http\Controllers;

use Auth;
use App\Fertility;
use App\FertilityType;
use Illuminate\Http\Request;

class FertilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Fertility $model)
    {
        // Show all fertilities
        return view('fertility.index', ['fertilities' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create fertilities
        $fertility_types = FertilityType::all();
        return view('fertility.create',compact('fertility_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create fertilities
        $fertility = new Fertility;
        $fertility->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $fertility->name = $request->name;
        $fertility->description = $request->description;
        $fertility->fertility_type_id = $request->fertility_type;
        $fertility->user_id = Auth::user()->id;
        $fertility->status_id = 1;
        $fertility->save();
        return redirect()->route('fertility.index')->withStatus(__('Fertility successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fertility  $fertility
     * @return \Illuminate\Http\Response
     */
    public function show(Fertility $fertility)
    {
        // Show fertilities
        $fertility = Fertility::find($fertility->id);
        return view('fertility.show')->with('fertility', $fertility);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fertility  $fertility
     * @return \Illuminate\Http\Response
     */
    public function edit(Fertility $fertility)
    {
        // Show single fertilities
        $fertility = Fertility::find($fertility->id);
        return view('fertility.edit')->with('fertility', $fertility);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fertility  $fertility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fertility $fertility)
    {
        // Edit fertilities
        $fertility = Fertility::find($fertility->id);
        $fertility->name = $request->name;
        $fertility->description = $request->description;
        $fertility->save();
        return redirect()->route('fertility.index')->withStatus(__('Fertility successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fertility  $fertility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fertility $fertility)
    {
        // Delete fertilities
        $fertility->delete();
        return redirect()->route('fertility.index')->withStatus(__('Fertility successfully deleted.'));
    }
}
