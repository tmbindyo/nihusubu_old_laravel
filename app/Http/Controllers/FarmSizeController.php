<?php

namespace App\Http\Controllers;

use Auth;
use App\FarmSize;
use Illuminate\Http\Request;

class FarmSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FarmSize $model)
    {
        // Show all farm sizes
        return view('farm_size.index', ['farm_sizes' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create farm size
        return view('farm_size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create farm size
        $farm_size = new FarmSize;
        $farm_size->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $farm_size->name = $request->name;
        $farm_size->description = $request->description;
        $farm_size->user_id = Auth::user()->id;
        $farm_size->status_id = 1;
        $farm_size->save();
        return redirect()->route('farm_size.index')->withStatus(__('Farm size successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FarmSize  $farmSize
     * @return \Illuminate\Http\Response
     */
    public function show(FarmSize $farmSize)
    {
        // Show farm sizes
        $farmSize = FarmSize::find($farmSize->id);
        return view('farm_size.show')->with('farm_size', $farmSize);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FarmSize  $farmSize
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmSize $farmSize)
    {
        // Show single farm sizes
        $farmSize = FarmSize::find($farmSize->id);
        return view('farm_size.edit')->with('farm_size', $farmSize);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FarmSize  $farmSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FarmSize $farmSize)
    {
        // Edit farm size
        $farmSize = FarmSize::find($farmSize->id);
        $farmSize->name = $request->name;
        $farmSize->description = $request->description;
        $farmSize->save();
        return redirect()->route('farm_size.index')->withStatus(__('Farm size successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FarmSize  $farmSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmSize $farmSize)
    {
        // Delete farm size
        $farmSize->delete();
        return redirect()->route('farm_size.index')->withStatus(__('Farm size successfully deleted.'));
    }
}
