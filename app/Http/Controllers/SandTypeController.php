<?php

namespace App\Http\Controllers;

use Auth;
use App\SandType;
use Illuminate\Http\Request;

class SandTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SandType $model)
    {
        // Show all agricultural types
        return view('sand_type.index', ['sand_types' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create sand type
        return view('sand_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create sand type
        $sand_type = new SandType;
        $sand_type->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $sand_type->name = $request->name;
        $sand_type->description = $request->description;
        $sand_type->user_id = Auth::user()->id;
        $sand_type->status_id = 1;
        $sand_type->save();
        return redirect()->route('sand_type.index')->withStatus(__('Sand type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SandType  $sandType
     * @return \Illuminate\Http\Response
     */
    public function show(SandType $sandType)
    {
        // Show sand type
        $sandType = SandType::find($sandType->id);
        return view('sand_type.show')->with('sand_type', $sandType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SandType  $sandType
     * @return \Illuminate\Http\Response
     */
    public function edit(SandType $sandType)
    {
        // Show single sand type
        $sandType = SandType::find($sandType->id);
        return view('sand_type.edit')->with('sand_type', $sandType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SandType  $sandType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SandType $sandType)
    {
        // Edit sand type
        $sandType = SandType::find($sandType->id);
        $sandType->name = $request->name;
        $sandType->description = $request->description;
        $sandType->save();
        return redirect()->route('sand_type.index')->withStatus(__('Sand type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SandType  $sandType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SandType $sandType)
    {
        // Delete sand type
        $sandType->delete();
        return redirect()->route('sand_type.index')->withStatus(__('Sand type successfully deleted.'));
    }
}
