<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{

    use UserTrait;
    use institutionTrait;

    // Inventory adjustment CRUD
    public function inventoryAdjustments()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.inventory_adjustments',compact('user','institution'));
    }
    public function inventoryAdjustmentCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.inventory_adjustment_create',compact('user','institution'));
    }
    public function inventoryAdjustmentStore()
    {
        return back()->withSuccess(__('Inventory adjustment successfully stored.'));
    }
    public function inventoryAdjustmentShow($inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.inventory_adjustment_show',compact('user','institution'));
    }
    public function inventoryAdjustmentEdit($inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.inventory_adjustment_edit',compact('user','institution'));
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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.transfer_orders',compact('user','institution'));
    }
    public function transferOrderCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.transfer_order_create',compact('user','institution'));
    }
    public function transferOrderStore()
    {
        return back()->withSuccess(__('Transfer order successfully stored.'));
    }
    public function transferOrderShow($transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.transfer_order_show',compact('user','institution'));
    }
    public function transferOrderEdit($transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.transfer_order_edit',compact('user','institution'));
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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.warehouses',compact('user','institution'));
    }
    public function warehouseStore()
    {
        return back()->withSuccess(__('Warehouse successfully stored.'));
    }
    public function warehouseShow($warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.warehouse_show',compact('user','institution'));
    }
    public function warehouseEdit($warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.warehouse_edit',compact('user','institution'));
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
