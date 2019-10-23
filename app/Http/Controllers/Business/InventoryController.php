<?php

namespace App\Http\Controllers\Business;

use App\Account;
use App\Address;
use App\Inventory;
use App\InventoryAdjustment;
use App\Product;
use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use App\TransferOrder;
use App\Warehouse;
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
        // Get inventory adjustments
        $institutionWarehouses = Warehouse::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventoryAdjustments = InventoryAdjustment::whereIn('warehouse_id', $institutionWarehouses)->with('warehouse','user','status','account')->get();

        return view('business.inventory_adjustments',compact('user','institution','inventoryAdjustments'));
    }
    public function inventoryAdjustmentCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get institution accounts
        $accounts = Account::where('institution_id',$institution->id)->get();

        return view('business.inventory_adjustment_create',compact('user','institution','accounts'));
    }
    public function inventoryAdjustmentStore(Request $request)
    {
        return $request;
        // return back()->withSuccess(__('Inventory adjustment successfully stored.'));
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
        // Warehouses
        $warehouses = Warehouse::where('institution_id',$institution->id)->with('address')->get();

        return view('business.warehouses',compact('user','institution','warehouses'));
    }
    public function warehouseStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Warehouse address
        $address = new Address();
        $address->attention = $request->attention;

        $address->street = $request->street;
        $address->town = $request->town;
        $address->po_box = $request->po_box;
        $address->postal_code = $request->postal_code;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->email = $request->email;
        $address->phone_number = $request->phone_number;
        $address->user_id = $user->id;
        $address->address_type_id = 'f7e388be-1eaa-4acc-9929-daf50bb0b5d1';
        $address->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $address->save();

        // Warehouse registration
        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->is_primary = False;
        $warehouse->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $warehouse->user_id = $user->id;
        $warehouse->institution_id = $institution->id;
        $warehouse->address_id = $address->id;
        $warehouse->save();

        // Add inventory records for each warehouse and each product at 0
        // Get all products
        $productIds = Product::select('id')->get();
        foreach ($productIds as $productId){
            // Inventory record
            $inventory = new Inventory();
            $inventory->quantity = 0;
            $inventory->warehouse_id = $warehouse->id;
            $inventory->product_id = $productId->id;
            $inventory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $inventory->user_id = $user->id;
            $inventory->save();
        }

        return back()->withSuccess(__('Warehouse successfully stored.'));
    }
    public function warehouseShow($warehouse_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if warehouse exists
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse = Warehouse::where('id',$warehouse_id)->withCount('inventories')->with('status','user','address')->first();

        // Get warehouse products
        $inventories = Inventory::where('warehouse_id',$warehouse_id)->with('product')->get();
        // Inventory adjustments
        $inventoryAdjustments = InventoryAdjustment::where('warehouse_id',$warehouse_id)->with('account')->get();
        // Transfer orders from
        $sourceTransferOrders = TransferOrder::where('source_warehouse_id',$warehouse_id)->with('destination_warehouse')->get();
        // Transfer orders to
        $destinationTransferOrders = TransferOrder::where('destination_warehouse_id',$warehouse_id)->with('source_warehouse')->get();

        return view('business.warehouse_show',compact('user','institution','warehouse','inventories','inventoryAdjustments','sourceTransferOrders','destinationTransferOrders'));
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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $warehouse->save();

        return back()->withSuccess(__('Warehouse successfully deleted.'));
    }
    public function warehouseRestore(Request $request, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $warehouse->save();

        return back()->withSuccess(__('Warehouse successfully deleted.'));
    }

}
