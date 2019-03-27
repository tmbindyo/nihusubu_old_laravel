<?php

namespace App\Http\Controllers;

use Auth;
use App\Industry;
use Illuminate\Http\Request;
use App\Http\Requests\IndustryRequest;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Industry $model)
    {
        return view('industries.index', ['industries' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('industries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndustryRequest $request, Industry $model)
    {
        $industry = new Industry;
        $industry->name = $request->name;
        $industry->description = $request->description;
        $industry->user_id = Auth::user()->id;
        $industry->status_id = 1;
        $industry->save();
        return redirect()->route('industry.index')->withStatus(__('Industry successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Industry $industry)
    {
        $industry = Industry::find($industry->id);
        return view('industries.edit')->with('industry', $industry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function edit(Industry $industry)
    {
        $industry = Industry::find($industry->id);
        return view('industries.edit', compact('industry'))->with('industry', $industry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Industry $industry)
    {

        $industry = Industry::find($industry->id);
        $industry->name = $request->name;
        $industry->description = $request->description;
        $industry->save();
        return redirect()->route('industry.index')->withStatus(__('Industry successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('industry.index')->withStatus(__('Industry successfully deleted.'));
    }
}
