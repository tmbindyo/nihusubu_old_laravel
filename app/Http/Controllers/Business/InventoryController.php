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
        $institutionWarehouses = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->select('id')->get()->toArray();
        $inventoryAdjustments = InventoryAdjustment::whereIn('warehouse_id', $institutionWarehouses)->with('warehouse', 'user', 'status', 'account', 'reason')->get();
//        return $inventoryAdjustments;
        return view('business.inventory_adjustments', compact('user', 'institution', 'inventoryAdjustments'));

    }
    public function inventoryAdjustmentCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // Get reasons
        $reasons = Reason::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Warehouse
        $warehouses = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();
        // Products
        $products = Product::where('institution_id', $institution->id)->where('is_service',0)->where('is_inventory',1)->with('inventory')->get();

        return view('business.inventory_adjustment_create', compact('user', 'institution', 'accounts', 'reasons', 'warehouses', 'products'));
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
        $inventoryAdjustment->is_value_adjustment = false;
        $inventoryAdjustment->inventory_adjustment_number = $reference;
        $inventoryAdjustment->account_id = $request->account;
        $inventoryAdjustment->reason_id = $request->reason;
        $inventoryAdjustment->warehouse_id = $request->warehouse;
        $inventoryAdjustment->description = $request->description;
        $inventoryAdjustment->user_id = $user->id;
        $inventoryAdjustment->institution_id = $institution->id;
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


            // Quantity adjustment
            // Adjust inventory
            $inventory = Inventory::where('product_id', $product->id)->where('warehouse_id', $request->warehouse)->first();
            $inventories = Inventory::all();

            $inventory->quantity = doubleval($itemDetail['new_on_hand']);
            $inventory->save();

        }


        return redirect()->route('business.inventory.adjustment.show',['portal'=>$institution->portal, 'id'=>$inventoryAdjustment->id])->withSuccess(__('Inventory adjustment successfully stored.'));
    }

    public function inventoryAdjustmentShow($portal, $inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $inventoryAdjustment = InventoryAdjustment::findOrFail($inventory_adjustment_id);
        $inventoryAdjustment = InventoryAdjustment::where('id', $inventory_adjustment_id)->with('inventoryAdjustmentProducts.product', 'status', 'reason', 'account', 'warehouse', 'user')->withCount('inventoryAdjustmentProducts')->first();

//        return $inventoryAdjustment;
        return view('business.inventory_adjustment_show', compact('user', 'institution', 'inventoryAdjustment'));
    }

    public function inventoryAdjustmentEdit($portal, $inventory_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.inventory_adjustment_edit', compact('user', 'institution'));
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
        // Get transfer orders
        $transferOrders = TransferOrder::where('institution_id', $institution->id)->with('sourceWarehouse', 'destinationWarehouse', 'user', 'status')->get();

//        return $transferOrders;
        return view('business.transfer_orders', compact('user', 'institution', 'transferOrders'));
    }
    public function transferOrderCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // check if there are more than one warehouses
        $warehouseCount = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->count();
        if($warehouseCount<2){
            return back()->withWarning(__('You need more than one warehouse to make a transfer order.'));
        }
        // Get institution accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // Warehouse
        $warehouses = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();
        // Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_inventory',true)->with('inventory')->get();

        return view('business.transfer_order_create', compact('user', 'institution', 'accounts', 'warehouses', 'products'));
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

        return redirect()->route('business.transfer.order.show',['portal'=>$institution->portal, 'id'=>$transferOrder->id])->withSuccess(__('Transfer order successfully stored.'));
    }

    public function transferOrderShow($portal, $transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        TransferOrder::findOrFail($transfer_order_id);
        $transferOrder = TransferOrder::where('id', $transfer_order_id)->with('sourceWarehouse.user', 'destinationWarehouse.user', 'transferOrderProducts.product')->withCount('transferOrderProducts')->first();
        return view('business.transfer_order_show', compact('user', 'institution', 'transferOrder'));
    }

    public function transferOrderEdit($portal, $transfer_order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.transfer_order_edit', compact('user', 'institution'));
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
        $warehouses = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('address')->get();
        $deletedWarehouses = Warehouse::where('institution_id', $institution->id)->where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->with('address')->get();

        return view('business.warehouses', compact('user', 'institution', 'warehouses', 'deletedWarehouses'));
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
        $warehouse->is_primary = false;
        $warehouse->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $warehouse->user_id = $user->id;
        $warehouse->institution_id = $institution->id;
        $warehouse->address_id = $address->id;
        $warehouse->save();

        // Add inventory records for each warehouse and each product at 0
        // Get products
        $productIds = Product::select('id')->where('institution_id',$institution->id)->where('is_inventory',true)->where('is_product_group',false)->get();
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
        $warehouse = Warehouse::where('id', $warehouse_id)->withCount('inventories')->with('status', 'user', 'address')->first();

        // Get warehouse products
        $inventories = Inventory::where('warehouse_id', $warehouse_id)->with('product')->get();
        // Inventory adjustments
        $inventoryAdjustments = InventoryAdjustment::where('warehouse_id', $warehouse_id)->with('account')->get();
        // Transfer orders from
        $sourceTransferOrders = TransferOrder::where('source_warehouse_id', $warehouse_id)->with('destinationWarehouse')->get();
        // Transfer orders to
        $destinationTransferOrders = TransferOrder::where('destination_warehouse_id', $warehouse_id)->with('sourceWarehouse')->get();

        return view('business.warehouse_show', compact('user', 'institution', 'warehouse', 'inventories', 'inventoryAdjustments', 'sourceTransferOrders', 'destinationTransferOrders'));
    }

    public function warehouseEdit($portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.warehouse_edit', compact('user', 'institution'));
    }

    public function warehouseUpdate(Request $request, $portal, $warehouse_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if warehouse exists
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse = Warehouse::where('id', $warehouse_id)->withCount('inventories')->with('status', 'user', 'address')->first();

        // Warehouse address
        $address = Address::where('id', $warehouse->address_id)->first();
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

        // get products

        // get inventory
        // $inventory = Inventory::where('warehouse_id', $warehouse_id)->get();
        $inventory = Inventory::where('warehouse_id', $warehouse_id)->where('quantity', '>',0)->get();
        if(count($inventory)){
            return back()->withWarning(__('Warehouse still has stock registered to it. Warehouse can only be deleted with all stock at 0'));
        }
        // User
        $user = $this->getUser();
        // Delete
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
