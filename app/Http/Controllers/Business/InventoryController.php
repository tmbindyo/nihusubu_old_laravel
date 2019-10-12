<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    // Inventory adjustment CRUD
    public function inventoryAdjustments()
    {
        return view('business.inventory_adjustments');
    }
    public function inventoryAdjustmentCreate()
    {
        return view('business.inventory_adjustment_create');
    }
    public function inventoryAdjustmentStore()
    {
        return back()->withSuccess(__('Inventory adjustment successfully stored.'));
    }
    public function inventoryAdjustmentShow($inventory_adjustment_id)
    {
        return view('business.inventory_adjustment_show');
    }
    public function inventoryAdjustmentEdit($inventory_adjustment_id)
    {
        return view('business.inventory_adjustment_edit');
    }
    public function inventoryAdjustmentUpdate(Request $request, $inventory_adjustment_id)
    {
        return back()->withSuccess(__('Inventory adjustment successfully updated.'));
    }
    public function inventoryAdjustmentDelete(Request $request, $inventory_adjustment_id)
    {
        return back()->withSuccess(__('Inventory adjustment successfully deleted.'));
    }

    // Transfer order CRUD
    public function transferOrders()
    {
        return view('business.transfer_orders');
    }
    public function transferOrderCreate()
    {
        return view('business.transfer_order_create');
    }
    public function transferOrderStore()
    {
        return back()->withSuccess(__('Transfer order successfully stored.'));
    }
    public function transferOrderShow($transfer_order_id)
    {
        return view('business.transfer_order_show');
    }
    public function transferOrderEdit($transfer_order_id)
    {
        return view('business.transfer_order_edit');
    }
    public function transferOrderUpdate(Request $request, $transfer_order_id)
    {
        return back()->withSuccess(__('Transfer order successfully updated.'));
    }
    public function transferOrderDelete(Request $request, $transfer_order_id)
    {
        return back()->withSuccess(__('Transfer order successfully deleted.'));
    }


    // Warehouse CRUD
    public function warehouses()
    {
        return view('business.warehouses');
    }
    public function warehouseStore()
    {
        return back()->withSuccess(__('Warehouse successfully stored.'));
    }
    public function warehouseShow($warehouse_id)
    {
        return view('business.warehouse_show');
    }
    public function warehouseEdit($warehouse_id)
    {
        return view('business.warehouse_edit');
    }
    public function warehouseUpdate(Request $request, $warehouse_id)
    {
        return back()->withSuccess(__('Warehouse successfully updated.'));
    }
    public function warehouseDelete(Request $request, $warehouse_id)
    {
        return back()->withSuccess(__('Warehouse successfully deleted.'));
    }

}
