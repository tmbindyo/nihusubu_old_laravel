<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\PhylumClass;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $model)
    {
        // Show all orders
        return view('order.index', ['orders' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form to create orders
        // Get all phylum_classes
        $phylum_classes = PhylumClass::all();
        return view('order.create')->with('phylum_classes', $phylum_classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Function to create orders
        $order = new Order;
        $order->slug = strtolower(str_replace(' ', '_', $request->name).'_'.rand(1,100));
        $order->name = $request->name;
        $order->description = $request->description;
        $order->thumbnail = "";
        $order->phylum_class_id = $request->phylum_class;
        $order->user_id = Auth::user()->id;
        $order->status_id = 1;
        $order->save();
        return redirect()->route('order.index')->withStatus(__('Order successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // Show orders
        $order = Order::find($order->id);
        return view('order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // Show single orders
        $order = Order::find($order->id);
        return view('order.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Edit orders
        $order = Order::find($order->id);
        $order->name = $request->name;
        $order->description = $request->description;
        $order->save();
        return redirect()->route('order.index')->withStatus(__('Order successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // Delete orders
        $order->delete();
        return redirect()->route('order.index')->withStatus(__('Order successfully deleted.'));
    }
}
