<?php

namespace App\Http\Controllers\Business;

use App\Account;
use App\Address;
use App\Inventory;
use App\InventoryAdjustment;
use App\InventoryAdjustmentProduct;
use App\Product;
use App\Reason;
use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Traits\UserTrait;
use App\TransferOrder;
use App\TransferOrderProduct;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Inventory adjustment CRUD
    public function inventoryAdjustments($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get inventory adjustments
        $institutionWarehouses = Warehouse::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventoryAdjustments = InventoryAdjustment::whereIn('warehouse_id', $institutionWarehouses)->with('warehouse','user','status','account','reason')->get();
//        return $inventoryAdjustments;
        return view('business.inventory_adjustments',compact('user','institution','inventoryAdjustments'));

    }
    public function inventoryAdjustmentCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution accounts
        $accounts = Account::where('institution_id',$institution->id)->where('is_institution',true)->get();
        // Get reasons
        $reasons = Reason::where('institution_id',$institution->id)->get();
        // Warehouse
        $warehouses = Warehouse::where('institution_id',$institution->id)->get();
        // Products
        $products = Product::where('institution_id',$institution->id)->with('inventory')->get();

        return view('business.inventory_adjustment_create',compact('user','institution','accounts','reasons','warehouses','products'));
    }

    public function inventoryAdjustmentStore(Request $request, $portal)
    {
//        return $request;

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Generate reference number
        $size = 5;
        $reference = $this->getRandomString($size);

        // Inventory adjustment
        $inventoryAdjustment = new InventoryAdjustment();
        if ($request->mode_of_adjustment == "value"){
            $inventoryAdjustment->is_value_adjustment = True;
        }else{
            $inventoryAdjustment->is_value_adjustment = False;
        }
        // Generate inventory adjustment number
        $inventoryAdjustment->inventory_adjustment_number = $reference;
        $inventoryAdjustment->account_id = $request->account;
        $inventoryAdjustment->reason_id = $request->reason;
        $inventoryAdjustment->warehouse_id = $request->warehouse;
        $inventoryAdjustment->description = $request->description;
        $inventoryAdjustment->user_id = $user->id;
        $inventoryAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $inventoryAdjustment->save();

        foreach ($request->item_details as $itemDetail){

            // return $itemDetail['new_on_hand'];
            // Check if product exists
            $product = Product::findOrFail($itemDetail['details']);

            $inventoryAdjustmentProduct = new InventoryAdjustmentProduct();
            $inventoryAdjustmentProduct->inventory_adjustment_number = 4756;
            $inventoryAdjustmentProduct->initial_quantity = $itemDetail['on_hand'];
            $inventoryAdjustmentProduct->subsequent_quantity = $itemDetail['new_on_hand'];
            $inventoryAdjustmentProduct->quantity = $itemDetail['adjusted'];
            $inventoryAdjustmentProduct->inventory_adjustment_id = $inventoryAdjustment->id;
            $inventoryAdjustmentProduct->product_id = $itemDetail['details'];
            $inventoryAdjustmentProduct->user_id = $user->id;
            $inventoryAdjustmentProduct->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $inventoryAdjustmentProduct->save();


            if ($request->mode_of_adjustment == "quantity"){
                // Quantity adjustment
                // Adjust inventory
                // return $itemDetail['new_on_hand'];
                $inventory = Inventory::where('product_id',$product->id)->where('warehouse_id',$request->warehouse)->first();
                $inventories = Inventory::all();
                // return $inventories;
                $inventory->quantity = doubleval($itemDetail['new_on_hand']);
                $inventory->save();
            }elseif ($request->mode_of_adjustment == "value"){

            }

            // Value adjustment
        }


        return redirect()->route('business.inventory.adjustment.show',['portal'=>$institution->portal,'id'=>$inventoryAdjustment->id])->withSuccess(__('Inventory adjustment successfully stored.'));
    }

    public function inventoryAdjustmentShow($portal, $inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $inventoryAdjustment = InventoryAdjustment::findOrFail($inventory_adjustment_id);
        $inventoryAdjustment = InventoryAdjustment::where('id',$inventory_adjustment_id)->with('inventory_adjustment_products.product','status','reason','account','warehouse','user')->withCount('inventory_adjustment_products')->first();

//        return $inventoryAdjustment;
        return view('business.inventory_adjustment_show',compact('user','institution','inventoryAdjustment'));
    }

    public function inventoryAdjustmentEdit($portal, $inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.inventory_adjustment_edit',compact('user','institution'));
    }

    public function inventoryAdjustmentUpdate(Request $request, $portal, $inventory_adjustment_id)
    {
        return back()->withSuccess(__('Inventory adjustment successfully updated.'));
    }

    public function inventoryAdjustmentDelete(Request $request, $portal, $inventory_adjustment_id)
    {
        return back()->withSuccess(__('Inventory adjustment successfully deleted.'));
    }

    // Transfer order CRUD
    public function transferOrders($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get inventory adjustments
        $institutionWarehouses = Warehouse::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $transferOrders = TransferOrder::where('institution_id', $institution->id)->with('source_warehouse','destination_warehouse','user','status')->get();

//        return $transferOrders;
        return view('business.transfer_orders',compact('user','institution','transferOrders'));
    }
    public function transferOrderCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution accounts
        $accounts = Account::where('institution_id',$institution->id)->where('is_institution',true)->get();
        // Warehouse
        $warehouses = Warehouse::where('institution_id',$institution->id)->get();
        // Products
        $products = Product::where('institution_id',$institution->id)->with('inventory')->get();


        return view('business.transfer_order_create',compact('user','institution','accounts','warehouses','products'));
    }

    public function transferOrderStore(Request $request, $portal)
    {


        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $size = 5;
        $reference = $this->getRandomString($size);

        $transferOrder = new TransferOrder();
        $transferOrder->transfer_order_number = $reference;;
        $transferOrder->reason = $request->reason;
        $transferOrder->date = date("Y/m/d");
        $transferOrder->source_warehouse_id = $request->source_warehouse;
        $transferOrder->destination_warehouse_id = $request->destination_warehouse;
        $transferOrder->user_id = $user->id;
        $transferOrder->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $transferOrder->institution_id = $institution->id;
        $transferOrder->save();

        // inventory where product and warehouse
        foreach ($request->item_details as $transfer){

            $sourceWarehouse = Inventory::where('warehouse_id', $request->source_warehouse)->where('product_id', $transfer['product_id'])->first();


            $destinationWarehouse = Inventory::where('warehouse_id', $request->destination_warehouse)->where('product_id', $transfer['product_id'])->first();


            $transferOrderProduct = new TransferOrderProduct();
            $transferOrderProduct->source_warehouse_initial_amount = $sourceWarehouse->quantity;
            $source_subsequent_amount = doubleval($sourceWarehouse->quantity)-doubleval($transfer['transfer_quantity']);
            $transferOrderProduct->source_warehouse_subsequent_amount = $source_subsequent_amount;
            $transferOrderProduct->destination_warehouse_initial_amount = $destinationWarehouse->quantity;
            $destination_subsequent_amount = doubleval($destinationWarehouse->quantity)+doubleval($transfer['transfer_quantity']);
            $transferOrderProduct->destination_warehouse_subsequent_amount = $destination_subsequent_amount;
            $transferOrderProduct->quantity = $transfer['transfer_quantity'];
            $transferOrderProduct->transfer_order_id = $transferOrder->id;
            $transferOrderProduct->product_id = $transfer['product_id'];
            $transferOrderProduct->user_id = $user->id;
            $transferOrderProduct->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $transferOrderProduct->save();

            // deduct from source
            $sourceWarehouse->date = date("Y/m/d");
            $sourceWarehouse->quantity = $source_subsequent_amount;
            $sourceWarehouse->save();

            // add to destination
            $destinationWarehouse->date = date("Y/m/d");
            $destinationWarehouse->quantity = $destination_subsequent_amount;
            $destinationWarehouse->save();

        }

        return redirect()->route('business.transfer.order.show',['portal'=>$institution->portal,'id'=>$transferOrder->id])->withSuccess(__('Transfer order successfully stored.'));
    }

    public function transferOrderShow($portal, $transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $transferOrder = TransferOrder::findOrFail($transfer_order_id);
        $transferOrder = TransferOrder::where('id',$transfer_order_id)->with('source_warehouse.user','destination_warehouse.user','transfer_order_products.product')->withCount('transfer_order_products')->first();
        return view('business.transfer_order_show',compact('user','institution','transferOrder'));
    }

    public function transferOrderEdit($portal, $transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.transfer_order_edit',compact('user','institution'));
    }

    public function transferOrderUpdate(Request $request, $portal, $transfer_order_id)
    {
        return back()->withSuccess(__('Transfer order successfully updated.'));
    }

    public function transferOrderDelete(Request $request, $portal, $transfer_order_id)
    {
        return back()->withSuccess(__('Transfer order successfully deleted.'));
    }


    // Warehouse CRUD
    public function warehouses($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Warehouses
        $warehouses = Warehouse::where('institution_id',$institution->id)->with('address')->get();

        return view('business.warehouses',compact('user','institution','warehouses'));
    }

    public function warehouseStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Warehouse address
        $address = new Address();
        // $address->attention = $request->attention;

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
        // Get products
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

    public function warehouseShow($portal, $warehouse_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
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

    public function warehouseEdit($portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.warehouse_edit',compact('user','institution'));
    }

    public function warehouseUpdate(Request $request, $portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if warehouse exists
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse = Warehouse::where('id',$warehouse_id)->withCount('inventories')->with('status','user','address')->first();

        // Warehouse address
        $address = Address::where('id',$warehouse->address_id)->first();
        // $address->attention = $request->attention;
        $address->street = $request->street;
        $address->town = $request->town;
        $address->po_box = $request->po_box;
        $address->postal_code = $request->postal_code;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->email = $request->email;
        $address->phone_number = $request->phone_number;
        $address->user_id = $user->id;
        $address->save();

        // Warehouse registration
        $warehouse->name = $request->name;
        $warehouse->user_id = $user->id;
        $warehouse->save();

        return back()->withSuccess(__('Warehouse successfully updated.'));
    }

    public function warehouseDelete(Request $request, $portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $warehouse->save();

        return back()->withSuccess(__('Warehouse successfully deleted.'));
    }

    public function warehouseRestore(Request $request, $portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $warehouse->save();

        return back()->withSuccess(__('Warehouse successfully deleted.'));
    }

}
