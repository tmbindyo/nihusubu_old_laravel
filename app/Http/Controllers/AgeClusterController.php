<?php

namespace App\Http\Controllers;

use Auth;
use App\AgeCluster;
use Illuminate\Http\Request;

class AgeClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgeCluster $model)
    {
        // Show all age clusters
        return view('age_cluster.index', ['age_clusters' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create age cluster
        return view('age_cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create age cluster
        $age_cluster = new AgeCluster;
        $age_cluster->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $age_cluster->name = $request->name;
        $age_cluster->description = $request->description;
        $age_cluster->user_id = Auth::user()->id;
        $age_cluster->status_id = 1;
        $age_cluster->save();
        return redirect()->route('age_cluster.index')->withStatus(__('Age cluster successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AgeCluster  $ageCluster
     * @return \Illuminate\Http\Response
     */
    public function show(AgeCluster $ageCluster)
    {
        // Show age clusters
        $ageCluster = AgeCluster::find($ageCluster->id);
        return view('age_cluster.show')->with('age_cluster', $ageCluster);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AgeCluster  $ageCluster
     * @return \Illuminate\Http\Response
     */
    public function edit(AgeCluster $ageCluster)
    {
        // Show single age clusters
        $ageCluster = AgeCluster::find($ageCluster->id);
        return view('age_cluster.edit')->with('age_cluster', $ageCluster);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AgeCluster  $ageCluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgeCluster $ageCluster)
    {
        // Edit age cluster
        $ageCluster = AgeCluster::find($ageCluster->id);
        $ageCluster->name = $request->name;
        $ageCluster->description = $request->description;
        $ageCluster->save();
        return redirect()->route('age_cluster.index')->withStatus(__('Age cluster successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AgeCluster  $ageCluster
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgeCluster $ageCluster)
    {
        // Delete age cluster
        $ageCluster->delete();
        return redirect()->route('age_cluster.index')->withStatus(__('Age cluster successfully deleted.'));
    }
}
