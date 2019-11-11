<?php

namespace App\Http\Controllers\Business;

use App\CompositeProduct;
use App\ProductGroup;
use DB;
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
use App\Upload;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    use UserTrait;
    use institutionTrait;

    // Product group CRUD
    public function productGroups()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get product groups
        $productGroups = ProductGroup::where('institution_id',$institution->id)->with('status')->withCount('products')->get();

        return view('business.product_groups',compact('user','institution','productGroups'));
    }
    public function productGroupCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get institution taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get institution units
        $units = Unit::where('institution_id',$institution->id)->get();
        // Get institution accounts
        $accounts = Account::where('institution_id',$institution->id)->get();

        return view('business.product_group_create',compact('user','institution','taxes','units','accounts'));
    }
    public function productGroupStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Convert array to string
        $attributes = implode(' ', array_values($request->attribute));
        $attribute_options = implode(' ', array_values($request->attribute_options));

        // Register product group
        $productGroup = new ProductGroup();
        $productGroup->name = $request->product_name;
        $productGroup->description = $request->description;
        $productGroup->attributes = $attributes;
        $productGroup->attribute_options = $attribute_options;
        $productGroup->user_id = $user->id;
        $productGroup->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $productGroup->institution_id = $institution->id;
        $productGroup->save();



        foreach ($request->products as $productGroupProduct){
            $product = new Product;
            // check if product is a service or a good
            if($request->product_type == "services") {
                $product->is_service = True;
            }else{
                $product->is_service = False;
            }
            $product->name = $productGroupProduct['name'];
            $product->attribute = $attributes;
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

            $product->selling_price = $productGroupProduct['selling_price'];
            $product->purchase_price = $productGroupProduct['purchase_price'];
            // Check if the product is has been value added
            if ($request->is_created == "on"){
                $product->is_created = True;
            }else{
                $product->is_created = False;
            }
            $product->inventory_account_id = $request->inventory_account;
            $product->opening_stock = $productGroupProduct['opening_stock'];
            $product->opening_stock_value = $productGroupProduct['opening_stock_value'];
            $product->reorder_level = $request->reorder_level;

            $product->is_product_group = True;

            $product->product_group_id = $productGroup->id;
            $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $product->user_id = $user->id;
            $product->institution_id = $institution->id;
            $product->save();


            // Create inventory records if product is a good
            if($request->product_type != "services") {

                // todo create stock tables for product
                // Get primary warehouse
                $warehouse = Warehouse::where('institution_id',$institution->id)->where('is_primary',True)->first();

                // create inventory record
                $inventory = new Inventory();
                $inventory->date = date('Y-m-d');
                $inventory->quantity = $request->opening_stock;
                $inventory->warehouse_id = $warehouse->id;
                $inventory->product_id = $product->id;
                $inventory->user_id = $user->id;
                $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $inventory->save();

                // Create inventory records for subsequent warehouses

                $warehouseIds = Warehouse::select('id')->where('is_primary',False)->get();

                // Records for the rest of the warehouses
                foreach ($warehouseIds as $warehouseId){
                    // Inventory record
                    $inventory = new Inventory();
                    $inventory->quantity = 0;
                    $inventory->product_id = $product->id;
                    $inventory->warehouse_id = $warehouseId->id;
                    $inventory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                    $inventory->user_id = $user->id;
                    $inventory->save();
                }

                // Create record for inventory, tracking the stock input
                $restock = new Restock();
                $restock->date = date('Y-m-d');
                $restock->initial_warehouse_amount = 0;
                $restock->subsequent_warehouse_amount = $productGroupProduct['opening_stock'];
                // getting unit value
                $unit_value = floatval($productGroupProduct['opening_stock_value'])/floatval($productGroupProduct['opening_stock']);
                $restock->unit_value = $unit_value;
                $restock->total_value = $productGroupProduct['opening_stock_value'];
                $restock->quantity = $productGroupProduct['opening_stock'];
                $restock->warehouse_id = $warehouse->id;
                $restock->product_id = $product->id;
                $restock->is_opening_stock = True;
                $restock->user_id = $user->id;
                $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $restock->save();
            }

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

        }

        return redirect(route('business.product.groups'));

    }
    public function productGroupShow($product_group_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get product groups
        $productGroup = ProductGroup::findOrFail($product_group_id);
        $productGroup = ProductGroup::where('id',$product_group_id)->with('products')->first();

        return view('business.product_group_show',compact('user','institution','productGroup'));
    }
    public function productGroupEdit($product_group_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.product_group_edit',compact('user','institution'));
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
        $products = Product::where('institution_id',$institution->id)->with('status','unit','inventory','stock_on_hand')->where('is_product_group',False)->where('status_id','f6654b11-8f04-4ac9-993f-116a8a6ecaae')->get();

//        return $products;

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


        // Create inventory records if product is a good


        if($request->product_type != "services") {

            // todo create stock tables for product
            // Get primary warehouse
            $warehouse = Warehouse::where('institution_id',$institution->id)->where('is_primary',True)->first();

            // create inventory record
            $inventory = new Inventory();
            $inventory->date = date('Y-m-d');
            $inventory->quantity = $request->opening_stock;
            $inventory->warehouse_id = $warehouse->id;
            $inventory->product_id = $product->id;
            $inventory->user_id = $user->id;
            $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $inventory->save();

            // Create inventory records for subsequent warehouses

            $warehouseIds = Warehouse::select('id')->where('is_primary',False)->get();

            // Records for the rest of the warehouses
            foreach ($warehouseIds as $warehouseId){
                // Inventory record
                $inventory = new Inventory();
                $inventory->quantity = 0;
                $inventory->product_id = $product->id;
                $inventory->warehouse_id = $warehouseId->id;
                $inventory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $inventory->user_id = $user->id;
                $inventory->save();
            }

            // Create record for inventory, tracking the stock input
            $restock = new Restock();
            $restock->date = date('Y-m-d');
            $restock->initial_warehouse_amount = 0;
            $restock->subsequent_warehouse_amount = $request->opening_stock;

            // getting unit value
            if (doubleval($request->opening_stock) > 0 ){
                $unit_value = floatval($request->opening_stock_value)/floatval($request->opening_stock);
            }
            else{
                $unit_value = 0;
            }
            $restock->unit_value = $unit_value;
            $restock->total_value = $request->opening_stock_value;
            $restock->quantity = $request->opening_stock;
            $restock->warehouse_id = $warehouse->id;
            $restock->product_id = $product->id;
            $restock->is_opening_stock = True;
            $restock->user_id = $user->id;
            $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $restock->save();
        }

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
        // Get institution accounts
        $accounts = Account::get();

        $productExists = Product::findOrFail($product_id);
        $product = Product::where('id',$product_id)->with('status','product_discounts','product_taxes','product_images.upload')->first();

//        return $product;
        return view('business.product_edit',compact('user','institution','product','taxes','units','accounts'));
    }
    public function productUpdate(Request $request,$product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $product = Product::findOrFail($product_id);

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

        // todo create stock tables for product
        // Get primary warehouse
        $warehouse = Warehouse::where('institution_id',$institution->id)->where('is_primary',True)->first();

        // todo, it refactors it to the value put here which will erare the current stock value
        // create inventory
        $inventory = Inventory::where('warehouse_id',$warehouse->id)->where('product_id',$product->id)->first();
        $inventory->quantity = $request->opening_stock;
        $inventory->save();

        // Create record for inventory, tracking the stock input
        $restock = Restock::where('warehouse_id',$warehouse->id)->where('product_id',$product->id)->where('is_opening_stock',True)->first();
        $restock->initial_warehouse_amount = 0;
        $restock->subsequent_warehouse_amount = $request->opening_stock;
        // getting unit value
        if (doubleval($request->opening_stock) > 0 ){
            $unit_value = floatval($request->opening_stock_value)/floatval($request->opening_stock);
        }
        else{
            $unit_value = 0;
        }
        $restock->unit_value = $unit_value;
        $restock->total_value = $request->opening_stock_value;
        $restock->quantity = $request->opening_stock;
        $restock->save();



        // Product taxes update
        $productRequestTaxes =array();
        foreach ($request->taxes as $productProductTax){
            // Append to array
            $productRequestTaxes[]['id'] = $productProductTax;

            // Check if product tax exists
            $productTax = ProductTax::where('product_id',$product->id)->where('tax_id',$productProductTax)->first();

            if($productTax === null) {
                $productTax = new ProductTax();
                $productTax->product_id = $product->id;
                $productTax->tax_id = $productProductTax;
                $productTax->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $productTax->user_id = $user->id;
                $productTax->save();
            }
        }

        $productTaxesIds = ProductTax::where('product_id',$product_id)->whereNotIn('tax_id',$productRequestTaxes)->select('id')->get()->toArray();
        DB::table('product_taxes')->whereIn('id', $productTaxesIds)->delete();


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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get products
        $compositeProducts = CompositeProduct::where('institution_id',$institution->id)->get();

        return view('business.composite_products',compact('user','institution','compositeProducts'));
    }
    public function compositeProductCreate()
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
        // Products
        $products = Product::where('institution_id',$institution->id)->get();

        return view('business.composite_product_create',compact('user','institution','taxes','accounts','units','products'));
    }
    public function compositeProductStore(Request $request)
    {
        return $request;

        $compositeProduct = new CompositeProduct();
        $compositeProduct->name = $request->product_name;
        $compositeProduct->stock_keeping_unit = $request->unit;
        $compositeProduct->selling_price = $request->selling_price;


        $compositeProduct->user_id = $user->id;
        $compositeProduct->institution_id = $institution->id;
        $compositeProduct->save();

        return back()->withSuccess(__('Composite product successfully stored.'));
    }
    public function compositeProductShow($composite_product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.composite_product_show',compact('user','institution'));
    }
    public function compositeProductEdit($composite_product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.composite_product_edit',compact('user','institution'));
    }
    public function compositeProductUpdate(Request $request)
    {
        return back()->withSuccess(__('Composite product successfully updated.'));
    }
    public function compositeProductDelete($composite_product_id)
    {
        return back()->withSuccess(__('Composite product successfully deleted.'));
    }





    public function productDiscountStore(Request $request, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if exists
        $product = Product::findOrFail($product_id);

//        return $request;

        $productDiscount = new ProductDiscount;

        if ($request->is_percentage == "on"){
            $productDiscount->is_percentage = True;
        }else{
            $productDiscount->is_percentage = False;
        }
        $productDiscount->product_id = $product_id;
        $productDiscount->quantity = $request->quantity;
        $productDiscount->minimum_items = $request->minimum_items;
        $productDiscount->discount = $request->discount;
        $productDiscount->start_date = date('Y-m-d', strtotime($request->start_date));;
        $productDiscount->end_date = date('Y-m-d', strtotime($request->end_date));;
        $productDiscount->user_id = $user->id;
        $productDiscount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productDiscount->save();

        return back()->withSuccess(__('Product discount successfully added.'));
    }
    public function productDiscountUpdate(Request $request,$product_discount_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $productDiscountExists = ProductDiscount::findOrFail($product_discount_id);
        $productDiscount = ProductDiscount::where('id',$product_discount_id)->first();

        $productDiscount->quantity = $request->quantity;
        $productDiscount->minimum_items = $request->minimum_items;
        $productDiscount->discount = $request->discount;
        $productDiscount->start_date = date('Y-m-d', strtotime($request->start_date));;
        $productDiscount->end_date = date('Y-m-d', strtotime($request->end_date));;
        $productDiscount->save();

        return back()->withSuccess(__('Product discount successfully updated.'));
    }
    public function productDiscountDelete($product_discount_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Check if the product discount exists
        $productDiscount = ProductDiscount::findOrFail($product_discount_id);
        $productDiscountDelete = ProductDiscount::destroy($product_discount_id);

        return back()->withSuccess(__('Product discount successfully deleted.'));
    }





    public function productImageUpload(Request $request,$product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if product exists
        $product = Product::findOrFail($product_id);
        // Get product
        $product = Product::where('id',$product_id)->first();

        $institutionName = str_replace(' ', '', $institution->name."/");
        $folderName = str_replace(' ', '', $product->name."/");

        $file = Input::file("file");
        $file_name_extension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $path = public_path().'/uploads/'.$institutionName.$folderName.$file_name_extension;

        $file->move(public_path().'/uploads/'.$institutionName.$folderName, $file_name_extension);
        $path = public_path().'/uploads/'.$institutionName.$folderName.$file_name_extension;

        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $small_thumbnail = $file_name."_small_thumbnail.".$extension;
        $large_thumbnail = $file_name."_large_thumbnail.".$extension;
        $banner = $file_name."_banner.".$extension;

        // image
        Image::make( $path )->fit(210, 250)->save(public_path().'/uploads/'.$institutionName.$folderName.$small_thumbnail);
        Image::make( $path )->fit(550, 400)->save(public_path().'/uploads/'.$institutionName.$folderName.$large_thumbnail);
        Image::make( $path )->fit(1440, 900)->save(public_path().'/uploads/'.$institutionName.$folderName.$banner);

        $img = Image::make($path);
        $size = $img->filesize();

        $upload = new Upload();
        $upload->name = $file_name;
        $upload->extension = $extension;
        $upload->image = 'uploads/'.$institutionName.$folderName.$file_name;
        $upload->small_thumbnail = 'uploads/'.$institutionName.$folderName.$small_thumbnail;
        $upload->large_thumbnail = 'uploads/'.$institutionName.$folderName.$large_thumbnail;
        $upload->banner = 'uploads/'.$institutionName.$folderName.$banner;
        $upload->size = $size;
        $upload->extension = $extension;
        $upload->upload_type_id = 'b2004522-e7aa-41dd-b033-7252d0a642b7';
        $upload->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $upload->user_id = $user->id;
        $upload->institution_id = $institution->id;
        $upload->save();

        $productImage = new ProductImage();
        $productImage->upload_id = $upload->id;
        $productImage->product_id = $product->id;
        $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productImage->user_id = $user->id;
        $productImage->save();

        return back()->withSuccess(__('Product image successfully uploaded.'));
    }
    public function productImageDelete($product_image_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Check if the product image exists
        $productImage = ProductImage::findOrFail($product_image_id);
        $productImageDelete = ProductImage::destroy($product_image_id);

        // todo delete upload table record

        return back()->withSuccess(__('Product image successfully deleted.'));

    }

}
