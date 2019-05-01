<?php

namespace App\Http\Controllers;

use Auth;
use App\FamilySize;
use Illuminate\Http\Request;

class FamilySizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FamilySize $model)
    {
        // Show all family sizes
        return view('family_size.index', ['family_sizes' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create family size
        return view('family_size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create family size
        $family_size = new FamilySize;
        $family_size->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $family_size->name = $request->name;
        $family_size->description = $request->description;
        $family_size->user_id = Auth::user()->id;
        $family_size->status_id = 1;
        $family_size->save();
        return redirect()->route('family_size.index')->withStatus(__('Family size successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function show(FamilySize $familySize)
    {
        // Show family sizes
        $familySize = FamilySize::find($familySize->id);
        return view('family_size.show')->with('family_size', $familySize);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilySize $familySize)
    {
        // Show single family sizes
        $familySize = FamilySize::find($familySize->id);
        return view('family_size.edit')->with('family_size', $familySize);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilySize $familySize)
    {
        // Edit family size
        $familySize = FamilySize::find($familySize->id);
        $familySize->name = $request->name;
        $familySize->description = $request->description;
        $familySize->save();
        return redirect()->route('family_size.index')->withStatus(__('Family size successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilySize $familySize)
    {
        // Delete family size
        $familySize->delete();
        return redirect()->route('family_size.index')->withStatus(__('Family size successfully deleted.'));
    }
}
