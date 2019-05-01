<?php

namespace App\Http\Controllers;

use Auth;
use App\Topography;
use Illuminate\Http\Request;

class TopographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topography $model)
    {
        // Show all topographies
        return view('topography.index', ['topographies' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create topographies
        return view('topography.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create topographies
        $topography = new Topography;
        $topography->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $topography->name = $request->name;
        $topography->description = $request->description;
        $topography->user_id = Auth::user()->id;
        $topography->status_id = 1;
        $topography->save();
        return redirect()->route('topography.index')->withStatus(__('Topography successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function show(Topography $topography)
    {
        // Show topographies
        $topography = Topography::find($topography->id);
        return view('topography.show')->with('topography', $topography);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function edit(Topography $topography)
    {
        // Show single topographies
        $topography = Topography::find($topography->id);
        return view('topography.edit')->with('topography', $topography);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topography $topography)
    {
        // Edit topographies
        $topography = Topography::find($topography->id);
        $topography->name = $request->name;
        $topography->description = $request->description;
        $topography->save();
        return redirect()->route('topography.index')->withStatus(__('Topography successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topography $topography)
    {
        // Delete topographies
        $topography->delete();
        return redirect()->route('topography.index')->withStatus(__('Topography successfully deleted.'));
    }
}
