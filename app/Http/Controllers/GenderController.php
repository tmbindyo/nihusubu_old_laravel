<?php

namespace App\Http\Controllers;

use Auth;
use App\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gender $model)
    {
        // Show all genders
        return view('gender.index', ['genders' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create genders
        return view('gender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create genders
        $gender = new Gender;
        $gender->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $gender->name = $request->name;
        $gender->description = $request->description;
        $gender->user_id = Auth::user()->id;
        $gender->status_id = 1;
        $gender->save();
        return redirect()->route('gender.index')->withStatus(__('Gender successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function show(Gender $gender)
    {
        // Show genders
        $gender = Gender::find($gender->id);
        return view('gender.show')->with('gender', $gender);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function edit(Gender $gender)
    {
        // Show single genders
        $gender = Gender::find($gender->id);
        return view('gender.edit')->with('gender', $gender);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gender $gender)
    {
        // Edit genders
        $gender = Gender::find($gender->id);
        $gender->name = $request->name;
        $gender->description = $request->description;
        $gender->save();
        return redirect()->route('gender.index')->withStatus(__('Gender successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gender $gender)
    {
        // Delete genders
        $gender->delete();
        return redirect()->route('gender.index')->withStatus(__('Gender successfully deleted.'));
    }
}
