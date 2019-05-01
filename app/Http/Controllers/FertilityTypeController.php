<?php

namespace App\Http\Controllers;

use Auth;
use App\FertilityType;
use Illuminate\Http\Request;

class FertilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FertilityType $model)
    {
        // Show all agricultural types
        return view('fertility_type.index', ['fertility_types' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create fertility type
        return view('fertility_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create fertility type
        $fertility_type = new FertilityType;
        $fertility_type->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $fertility_type->name = $request->name;
        $fertility_type->description = $request->description;
        $fertility_type->user_id = Auth::user()->id;
        $fertility_type->status_id = 1;
        $fertility_type->save();
        return redirect()->route('fertility_type.index')->withStatus(__('Fertility type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FertilityType  $fertilityType
     * @return \Illuminate\Http\Response
     */
    public function show(FertilityType $fertilityType)
    {
        // Show fertility type
        $fertilityType = FertilityType::find($fertilityType->id);
        return view('fertility_type.show')->with('fertility_type', $fertilityType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FertilityType  $fertilityType
     * @return \Illuminate\Http\Response
     */
    public function edit(FertilityType $fertilityType)
    {
        // Show single fertility type
        $fertilityType = FertilityType::find($fertilityType->id);
        return view('fertility_type.edit')->with('fertility_type', $fertilityType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FertilityType  $fertilityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FertilityType $fertilityType)
    {
        // Edit fertility type
        $fertilityType = FertilityType::find($fertilityType->id);
        $fertilityType->name = $request->name;
        $fertilityType->description = $request->description;
        $fertilityType->save();
        return redirect()->route('fertility_type.index')->withStatus(__('Fertility type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FertilityType  $fertilityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FertilityType $fertilityType)
    {
        // Delete fertility type
        $fertilityType->delete();
        return redirect()->route('fertility_type.index')->withStatus(__('Fertility type successfully deleted.'));
    }
}
