<?php

namespace App\Http\Controllers;

use Auth;
use App\Family;
use App\Order;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $model)
    {
        // Show all families
        return view('family.index', ['families' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create families
        // Get all orders
        $orders = Order::all();
        return view('family.create')->with('orders', $orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create families
        $family = new Family;
        $family->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $family->name = $request->name;
        $family->description = $request->description;
        $family->thumbnail = "";
        $family->order_id = $request->order;
        $family->user_id = Auth::user()->id;
        $family->status_id = 1;
        $family->save();
        return redirect()->route('family.index')->withStatus(__('Family successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        // Show families
        $family = Family::find($family->id);
        return view('family.show')->with('family', $family);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        // Show single families
        $family = Family::find($family->id);
        return view('family.edit')->with('family', $family);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        // Edit families
        $family = Family::find($family->id);
        $family->name = $request->name;
        $family->description = $request->description;
        $family->save();
        return redirect()->route('family.index')->withStatus(__('Family successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        // Delete families
        $family->delete();
        return redirect()->route('family.index')->withStatus(__('Family successfully deleted.'));
    }
}
