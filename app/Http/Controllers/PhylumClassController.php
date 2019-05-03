<?php

namespace App\Http\Controllers;

use Auth;
use App\Phylum;
use App\PhylumClass;
use Illuminate\Http\Request;

class PhylumClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PhylumClass $model)
    {
        // Show all agricultural types
        return view('phylum_class.index', ['phylum_classes' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create phylum class
        // Get all kingdoms
        $phylums = Phylum::all();
        return view('phylum_class.create')->with('phylums', $phylums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create phylum class
        $phylum_class = new PhylumClass;
        $phylum_class->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $phylum_class->name = $request->name;
        $phylum_class->description = $request->description;
        $phylum_class->thumbnail = "";
        $phylum_class->phylum_id= $request->phylum;
        $phylum_class->user_id = Auth::user()->id;
        $phylum_class->status_id = 1;
        $phylum_class->save();
        return redirect()->route('phylum_class.index')->withStatus(__('Phylum class successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhylumClass  $phylumClass
     * @return \Illuminate\Http\Response
     */
    public function show(PhylumClass $phylumClass)
    {
        // Show phylum class
        $phylumClass = PhylumClass::find($phylumClass->id);
        return view('phylum_class.show')->with('phylum_class', $phylumClass);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhylumClass  $phylumClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PhylumClass $phylumClass)
    {
        // Show single phylum class
        $phylumClass = PhylumClass::find($phylumClass->id);
        return view('phylum_class.edit')->with('phylum_class', $phylumClass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhylumClass  $phylumClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhylumClass $phylumClass)
    {
        // Edit phylum class
        $phylumClass = PhylumClass::find($phylumClass->id);
        $phylumClass->name = $request->name;
        $phylumClass->description = $request->description;
        $phylumClass->save();
        return redirect()->route('phylum_class.index')->withStatus(__('Phylum class successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhylumClass  $phylumClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhylumClass $phylumClass)
    {
        // Delete phylum class
        $phylumClass->delete();
        return redirect()->route('phylum_class.index')->withStatus(__('Phylum class successfully deleted.'));
    }
}
