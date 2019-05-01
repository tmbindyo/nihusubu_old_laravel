<?php

namespace App\Http\Controllers;

use Auth;
use App\AgricultureType;
use Illuminate\Http\Request;

class AgricultureTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgricultureType $model)
    {
        // Show all agricultural types
        return view('agriculture_type.index', ['agriculture_types' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create agriculture type
        return view('agriculture_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create agriculture type
        $agriculture_type = new AgricultureType;
        $agriculture_type->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $agriculture_type->name = $request->name;
        $agriculture_type->description = $request->description;
        $agriculture_type->user_id = Auth::user()->id;
        $agriculture_type->status_id = 1;
        $agriculture_type->save();
        return redirect()->route('agriculture_type.index')->withStatus(__('Agriculture type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AgricultureType  $agricultureType
     * @return \Illuminate\Http\Response
     */
    public function show(AgricultureType $agricultureType)
    {
        // Show agriculture type
        $agricultureType = AgricultureType::find($agricultureType->id);
        return view('agriculture_type.show')->with('agriculture_type', $agricultureType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AgricultureType  $agricultureType
     * @return \Illuminate\Http\Response
     */
    public function edit(AgricultureType $agricultureType)
    {
        // Show single agriculture type
        $agricultureType = AgricultureType::find($agricultureType->id);
        return view('agriculture_type.edit')->with('agriculture_type', $agricultureType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AgricultureType  $agricultureType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgricultureType $agricultureType)
    {
        // Edit agriculture type
        $agricultureType = AgricultureType::find($agricultureType->id);
        $agricultureType->name = $request->name;
        $agricultureType->description = $request->description;
        $agricultureType->save();
        return redirect()->route('agriculture_type.index')->withStatus(__('Agriculture type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AgricultureType  $agricultureType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgricultureType $agricultureType)
    {
        // Delete agriculture type
        $agricultureType->delete();
        return redirect()->route('agriculture_type.index')->withStatus(__('Agriculture type successfully deleted.'));
    }
}
