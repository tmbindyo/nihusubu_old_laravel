<?php

namespace App\Http\Controllers\Business;

use App\Account;
use App\Inventory;
use App\Product;
use App\ProductDiscount;
use App\ProductImage;
use App\ProductTax;
use App\Restock;
use App\Tax;
use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use App\Unit;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use UserTrait;
    use institutionTrait;


    // Product group CRUD
    public function productGroups()
    {
        return view('business.product_groups');
    }
    public function productGroupCreate()
    {
        return view('business.product_group_create');
    }
    public function productGroupStore(Request $request)
    {
        return back()->withSuccess(__('Product Group successfully stored.'));
    }
    public function productGroupShow($product_group_id)
    {
        return view('business.product_group_show');
    }
    public function productGroupEdit($product_group_id)
    {
        return view('business.product_group_edit');
    }
    public function productGroupUpdate(Request $request)
    {
        return back()->withSuccess(__('Product Group successfully updated.'));
    }
    public function productGroupDelete($product_group_id)
    {
        return back()->withSuccess(__('Product Group successfully deleted.'));
    }







    // Product CRUD
    public function products()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get institution products
        $products = Product::where('institution_id',$institution->id)->with('status','unit','inventory')->where('is_product_group',False)->get();

        return view('business.products',compact('user','products'));
    }
    public function productCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get institution units
        $units = Unit::where('institution_id',$institution->id)->get();
        // Get institution accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // Get institution taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();

        return view('business.product_create',compact('user','units','accounts','taxes'));
    }
    public function productStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

//        return $request;
        $product = new Product;

        // check if product is a service or a good
        if($request->product_type == "services") {
            $product->is_service = True;
        }else{
            $product->is_service = False;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_id = $request->unit;
        // Check if the product is eligible for sales return
        if ($request->is_returnable == "on"){
            $product->is_returnable = True;
        }else{
            $product->is_returnable = False;
        }
        $product->selling_account_id = $request->selling_account;
        $product->purchase_account_id = $request->purchase_account;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;
        // Check if the product is has been value added
        if ($request->is_created == "on"){
            $product->is_created = True;
        }else{
            $product->is_created = False;
        }
        $product->creation_time = $request->creation_time;
        $product->creation_cost = $request->creation_cost;
        $product->inventory_account_id = $request->inventory_account;
        $product->opening_stock = $request->opening_stock;
        $product->opening_stock_value = $request->opening_stock_value;
        $product->reorder_level = $request->reorder_level;

        $product->is_product_group = False;

        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->user_id = $user->id;
        $product->institution_id = $institution->id;
        $product->save();

        // product images


        // todo create stock tables for product
        // Get primary warehouse
        $warehouse = Warehouse::where('institution_id',$institution->id)->where('is_primary',True)->first();

        // create inventory
        $inventory = new Inventory();
        $inventory->date = date('Y-m-d');
        $inventory->quantity = $request->opening_stock;
        $inventory->warehouse_id = $warehouse->id;
        $inventory->product_id = $product->id;
        $inventory->user_id = $user->id;
        $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $inventory->save();

        // Create record for inventory, tracking the stock input
        $restock = new Restock();
        $restock->date = date('Y-m-d');
        $restock->initial_warehouse_amount = 0;
        $restock->subsequent_warehouse_amount = $request->opening_stock;
        // getting unit value
        $unit_value = floatval($request->opening_stock_value)/floatval($request->opening_stock);
        $restock->unit_value = $unit_value;
        $restock->total_value = $request->opening_stock_value;
        $restock->quantity = $request->opening_stock;
        $restock->warehouse_id = $warehouse->id;
        $restock->product_id = $product->id;
        $restock->is_opening_stock = True;
        $restock->user_id = $user->id;
        $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $restock->save();

        // Product taxes
        if ($request->taxes){
            foreach ($request->taxes as $productProductTax){
                $productTax = new ProductTax();
                $productTax->product_id = $product->id;
                $productTax->tax_id = $productProductTax;
                $productTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productTax->user_id = $user->id;
                $productTax->save();
            }
        }

        return back()->withSuccess(__('Product successfully stored.'));
    }
    public function productShow($product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $productExists = Product::findOrFail($product_id);
        $product = Product::where('id',$product_id)->with('status','inventory','restock','unit','order_products','sale_products','user','inventory_adjustment_products','transfer_order_products')->withCount('order_products','sale_products','restock')->first();

        return view('business.product_show',compact('product','user','institution'));
    }
    public function productEdit($product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if exists
        $product = Product::findOrFail($product_id);
        // Get institution taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get institution units
        $units = Unit::where('institution_id',$institution->id)->get();

        $productExists = Product::findOrFail($product_id);
        $product = Product::where('id',$product_id)->with('status','product_discounts','product_taxes','product_images')->first();

        return view('business.product_edit',compact('user','institution','product','taxes','units'));
    }
    public function productUpdate(Request $request,$product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $product = Product::findOrFail($product_id);

        return back()->withSuccess(__('Product successfully updated.'));
    }
    public function productDelete($product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Update product status
        $product = Product::findOrFail($product_id);
        $product->status_id = "bc6170bf-299a-44f5-8362-8cdeed1f47b0";
        $product->save();

        return back()->withSuccess(__('Product successfully deleted.'));
    }
    public function productRestore($product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Update product status
        $product = Product::findOrFail($product_id);
        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->save();

        return back()->withSuccess(__('Product successfully restored.'));
    }





    // Composite product CRUD
    public function compositeProducts()
    {
        return view('business.composite_products');
    }
    public function compositeProductCreate()
    {
        return view('business.composite_product_create');
    }
    public function compositeProductStore(Request $request)
    {
        return back()->withSuccess(__('Composite product successfully stored.'));
    }
    public function compositeProductShow($composite_product_id)
    {
        return view('business.composite_product_show');
    }
    public function compositeProductEdit($composite_product_id)
    {
        return view('business.composite_product_edit');
    }
    public function compositeProductUpdate(Request $request)
    {
        return back()->withSuccess(__('Composite product successfully updated.'));
    }
    public function compositeProductDelete($composite_product_id)
    {
        return back()->withSuccess(__('Composite product successfully deleted.'));
    }


}
