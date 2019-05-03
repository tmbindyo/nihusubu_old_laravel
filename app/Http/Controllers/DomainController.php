<?php

namespace App\Http\Controllers;

use Auth;
use App\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Domain $model)
    {
        // Show all domains
        return view('domain.index', ['domains' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create domains
        return view('domain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create domains
        $domain = new Domain;
        $domain->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $domain->name = $request->name;
        $domain->description = $request->description;
        $domain->thumbnail = "";
        $domain->user_id = Auth::user()->id;
        $domain->status_id = 1;
        $domain->save();
        return redirect()->route('domain.index')->withStatus(__('Domain successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        // Show domains
        $domain = Domain::find($domain->id);
        return view('domain.show')->with('domain', $domain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        // Show single domains
        $domain = Domain::find($domain->id);
        return view('domain.edit')->with('domain', $domain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        // Edit domains
        $domain = Domain::find($domain->id);
        $domain->name = $request->name;
        $domain->description = $request->description;
        $domain->save();
        return redirect()->route('domain.index')->withStatus(__('Domain successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        // Delete domains
        $domain->delete();
        return redirect()->route('domain.index')->withStatus(__('Domain successfully deleted.'));
    }
}
