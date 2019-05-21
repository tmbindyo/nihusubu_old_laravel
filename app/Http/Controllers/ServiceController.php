<?php

namespace App\Http\Controllers;

use Auth;
use App\Domain;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $model)
    {
        // Show all services
        return view('platform_management.service.index', ['services' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create services
        // Get all domains
        $domains = Domain::all();
        return view('platform_management.service.create')->with('domains', $domains);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create services
        $service = new Service;
        $service->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $service->name = $request->name;
        $service->description = $request->description;
        $service->thumbnail = "";
        $service->domain_id = $request->domain;
        $service->user_id = Auth::user()->id;
        $service->status_id = 1;
        $service->save();
        return redirect()->route('platform_management.service.index')->withStatus(__('Service successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        // Show services
        $service = Service::find($service->id);
        return view('platform_management.service.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        // Show single services
        $service = Service::find($service->id);
        return view('platform_management.service.edit')->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        // Edit services
        $service = Service::find($service->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();
        return redirect()->route('platform_management.service.index')->withStatus(__('Service successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // Delete services
        $service->delete();
        return redirect()->route('platform_management.service.index')->withStatus(__('Service successfully deleted.'));
    }
}
