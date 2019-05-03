<?php

namespace App\Http\Controllers;

use Auth;
use App\Farm;
use App\Gender;
use App\SandType;
use App\FarmSize;
use App\Fertility;
use App\AgeCluster;
use App\FamilySize;
use App\Topography;
use App\FertilityType;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Farm $model)
    {
        // Show all farms
        return view('farm.index', ['farms' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create farms
        // Get Fertility type
        $age_clusters = AgeCluster::all();
        $fertility_types = FertilityType::all();
        $farm_sizes = FarmSize::all();
        $family_sizes = FamilySize::all();
        $sand_types = SandType::all();
        $topographies = Topography::all();
        $genders = Gender::all();
        $fertilities = Fertility::all();
        return view('farm.create')->with('fertilities', $fertilities)->with('genders', $genders)->with('topographies', $topographies)->with('sand_types', $sand_types)->with('family_sizes', $family_sizes)->with('farm_sizes', $farm_sizes)->with('age_clusters', $age_clusters)->with('fertility_types', $fertility_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create farms
        // User details
        
        // Farm details
        $farm = new Farm;
        $farm->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $farm->name = $request->name;
        $farm->description = $request->description;
        $farm->location = $request->location;
        $farm->latitude = $request->latitude;
        $farm->longitude = $request->longitude;
        $farm->farm_size_id = $request->farm_size;
        $farm->age_cluster_id = $request->age_cluster;
        $farm->family_size_id = $request->family_size;
        $farm->sand_type_id = $request->sand_type;
        $farm->topography_id = $request->topography;
        $farm->gender_id = $request->gender;
        $farm->fertility_id = $request->fertility;
        $farm->user_id = Auth::user()->id;
        $farm->status_id = 1;
        $farm->save();
        return redirect()->route('farm.index')->withStatus(__('Farm successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Farm $farm)
    {
        // Show farms
        $farm = Farm::find($farm->id);
        return view('farm.show')->with('farm', $farm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Farm $farm)
    {
        // Show single farms
        $farm = Farm::find($farm->id);
        return view('farm.edit')->with('farm', $farm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farm $farm)
    {
        // Edit farms
        $farm = Farm::find($farm->id);
        $farm->name = $request->name;
        $farm->description = $request->description;
        $farm->save();
        return redirect()->route('farm.index')->withStatus(__('Farm successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farm $farm)
    {
        // Delete farms
        $farm->delete();
        return redirect()->route('farm.index')->withStatus(__('Farm successfully deleted.'));
    }
}
