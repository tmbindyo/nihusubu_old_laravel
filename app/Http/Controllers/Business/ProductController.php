<?php

namespace App\Http\Controllers\Business;

use App\Item;
use App\ProductSubCategory;
use App\TaxMethod;
use DB;
use App\Tax;
use App\Unit;
use App\Brand;
use App\Upload;
use App\Product;
use App\Account;
use App\Restock;
use App\Inventory;
use App\Warehouse;
use App\ProductTax;
use App\ProductGroup;
use App\ProductImage;
use App\ExpenseAccount;
use App\ProductGroupTax;
use App\ProductDiscount;
use App\ProductCategory;
use App\Traits\UserTrait;
use App\CompositeProductTax;
use Illuminate\Http\Request;
use App\CompositeProductProduct;
use App\Traits\InstitutionTrait;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentExtensionTrait;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use DocumentExtensionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Product group CRUD
    public function productGroups($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get product groups
        $productGroups = Product::where('institution_id', $institution->id)->where('is_product_group', True)->where('is_product_group_child', False)->with('status')->withCount('productGroupProducts')->get();

        return view('business.product_groups', compact('user', 'institution', 'productGroups'));
    }

    public function productGroupCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution brands
        $brands = Brand::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();

        return view('business.product_group_create', compact('user', 'institution', 'taxes', 'units', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts', 'brands', 'productSubCategories', 'taxMethods'));
    }

    public function productGroupStore(Request $request, $portal)
    {


        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Convert array to string
        $attributes = implode(' ', array_values($request->attribute));
        $attribute_options = implode(' ', array_values($request->attribute_options));

        // return error if product group array is empty
        // if($request->products->isEmpty()){
        //     return back()->withError('No products submitted');
        // }

        // Register product group
        $productGroup = new Product();
        if($request->product_type == "services") {
            $productGroup->is_service = true;
        }else{
            $productGroup->is_service = false;

            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->first();
            if(!$warehouse){
                return back()->withWarning(__('Please add a warehouse to register a product.'));
            }
        }
        $productGroup->name = $request->product_name;
        $productGroup->description = $request->description;
        $productGroup->product_sub_category_id = $request->product_sub_category;
        $productGroup->brand_id = $request->brand;
        $productGroup->attributes = $attributes;
        $productGroup->attribute_options = $attribute_options;

        $productGroup->selling_account_id = $request->selling_account;
        $productGroup->purchase_account_id = $request->purchase_account;
        $productGroup->inventory_account_id = $request->inventory_account;

        // Check if the product is has been value added
        if ($request->is_created == "on"){
            $productGroup->is_created = true;
        }else{
            $productGroup->is_created = false;
        }
        $productGroup->creation_time = $request->creation_time;
        $productGroup->creation_cost = $request->creation_cost;

        $productGroup->selling_price = 0;

        if($request->product_type == "services") {
            $productGroup->is_service = true;
        }else{
            $productGroup->is_service = false;
        }

        $productGroup->user_id = $user->id;
        $productGroup->unit_id = $request->unit;
        $productGroup->tax_method_id = $request->tax_method;
        $productGroup->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $productGroup->institution_id = $institution->id;
        $productGroup->is_product_group = true;

        if ($request->is_returnable == "on"){
            $productGroup->is_returnable = true;
        }else{
            $productGroup->is_returnable = false;
        }
        if ($request->is_inventory == "on"){
            $productGroup->is_inventory = true;
        }else{
            $productGroup->is_inventory = false;
        }
        $productGroup->is_composite_product = false;
        $productGroup->is_product_group_child = false;
        $productGroup->is_item = false;
        $productGroup->save();

        // Product taxes
        if ($request->taxes){
            foreach ($request->taxes as $productProductTax){
                $productGroupTax = new ProductTax();
                $productGroupTax->product_id = $productGroup->id;
                $productGroupTax->tax_id = $productProductTax;
                $productGroupTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productGroupTax->user_id = $user->id;
                $productGroupTax->save();
            }
        }


        foreach ($request->products as $productGroupProduct){

            $product = new Product;
            // check if product is a service or a good
            if($request->product_type == "services") {
                $product->is_service = true;
            }else{
                $product->is_service = false;
            }
            $product->name = $productGroupProduct['name'];
            $product->attributes = $attributes;
            $product->description = $request->description;
            $product->unit_id = $request->unit;
            $product->tax_method_id = $request->tax_method;
            // Check if the product is eligible for sales return
            if ($request->is_returnable == "on"){
                $product->is_returnable = true;
            }else{
                $product->is_returnable = false;
            }

            $product->selling_account_id = $request->selling_account;
            $product->purchase_account_id = $request->purchase_account;

            $product->opening_stock = $productGroupProduct['opening_stock'];
            $product->opening_stock_value = $productGroupProduct['opening_stock_value'];

            $product->selling_price = $productGroupProduct['selling_price'];
            $product->purchase_price = $productGroupProduct['purchase_price'];
            $product->reorder_level = $productGroupProduct['reorder_level'];
            // Check if the product is has been value added
            if ($request->is_created == "on"){
                $product->is_created = true;
            }else{
                $product->is_created = false;
            }
            $product->creation_time = $request->creation_time;
            $product->creation_cost = $request->creation_cost;
            $product->inventory_account_id = $request->inventory_account;
            if ($request->is_inventory == "on"){
                $product->is_inventory = true;
                $product->opening_stock = $productGroupProduct['opening_stock'];
                $product->opening_stock_value = $productGroupProduct['opening_stock_value'];
                $product->reorder_level = $productGroupProduct['reorder_level'];
            }else{
                $product->is_inventory = false;
            }

            $product->is_product_group = false;
            $product->is_product_group_child = true;
            $product->is_composite_product = false;
            $product->is_item = false;

            $product->product_group_id = $productGroup->id;
            $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $product->user_id = $user->id;
            $product->institution_id = $institution->id;
            $product->save();

            $taxAmount = 0;


            // Create inventory records if product is a good
            if($request->product_type == "goods" and $request->is_inventory == "on") {

                // todo create stock tables for product
                // Get primary warehouse
                $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

                // create inventory record
                $inventory = new Inventory();
                $inventory->date = date('Y-m-d');
                $inventory->quantity = $productGroupProduct['opening_stock'];
                $inventory->is_item = false;
                $inventory->is_product = true;
                $inventory->warehouse_id = $warehouse->id;
                $inventory->product_id = $product->id;
                $inventory->user_id = $user->id;
                $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $inventory->save();

                // Create inventory records for subsequent warehouses

                $warehouseIds = Warehouse::select('id')->where('is_primary', false)->get();

                // Records for the rest of the warehouses
                foreach ($warehouseIds as $warehouseId){
                    // Inventory record
                    $inventory = new Inventory();
                    $inventory->quantity = 0;
                    $inventory->is_item = false;
                    $inventory->is_product = true;
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
                if($productGroupProduct['opening_stock_value'] == 0 or $productGroupProduct['opening_stock'] == 0)
                {
                    $unit_value = 0;
                }else{
                    $unit_value = floatval($productGroupProduct['opening_stock_value'])/floatval($productGroupProduct['opening_stock']);
                }
                $restock->unit_value = $unit_value;
                $restock->total_value = $productGroupProduct['opening_stock_value'];
                $restock->quantity = $productGroupProduct['opening_stock'];
                $restock->is_item = false;
                $restock->is_product = true;
                $restock->warehouse_id = $warehouse->id;
                $restock->product_id = $product->id;
                $restock->is_opening_stock = true;
                $restock->user_id = $user->id;
                $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $restock->save();
            }

            // Product taxes
            if ($request->taxes){
                foreach ($request->taxes as $productProductTax){
                    // get tax
                    $tax = Tax::findOrFail($productProductTax);
                    if ($tax->is_percentage){
                        $percentageTax = $tax->amount/100 * $productGroupProduct['selling_price'];
                        $taxAmount += $percentageTax;
                    }else{
                        // amount
                        $taxAmount += $tax->amount;
                    }
                    $productTax = new ProductTax();
                    $productTax->product_id = $product->id;
                    $productTax->tax_id = $productProductTax;
                    $productTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                    $productTax->user_id = $user->id;
                    $productTax->save();
                }
            }


            // set tax selling
            $productTaxUpdate = Product::findOrFail($product->id);
            if($request->tax_method_id = 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
                $productTaxUpdate->taxed_selling_price = ceil(floatval($taxAmount+$productGroupProduct['selling_price']));
                $productTaxUpdate->tax_amount = ceil(floatval($taxAmount));
            }else{
                $productTaxUpdate->taxed_selling_price = $productGroupProduct['selling_price'];
                $productTaxUpdate->tax_amount = ceil(floatval($taxAmount));
            }
            $productTaxUpdate->save();


        }

        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $extension = $file->getClientOriginalExtension();
                $file_name_extension = $file->getClientOriginalName();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $productGroup->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        return redirect(route('business.product.group.show',['portal'=>$institution->portal, 'id'=>$productGroup->id]));

    }

    public function productGroupShow($portal, $product_group_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $accounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // Get product groups
        $productGroup = Product::findOrFail($product_group_id);
        $productGroup = Product::where('id', $product_group_id)->with('productGroupProducts')->first();

        return view('business.product_group_show', compact('user', 'institution', 'productGroup', 'taxes', 'units', 'accounts'));
    }

    public function productGroupEdit($portal, $product_group_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $units = Unit::where('institution_id', $institution->id)->get();
        // Get institution brands
        $brands = Brand::where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();
        // Get product groups
        $productGroup = Product::findOrFail($product_group_id);
        $productGroup = Product::where('id', $product_group_id)->with('productGroupProducts', 'productTaxes')->first();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();

        $productAttributes = array();
        foreach ($productGroup->productGroupProducts as $product) {
            array_push($productAttributes, explode("-", $product->name)[1]);
        }
        $productAttributes = implode(", ", $productAttributes);

        return view('business.product_group_edit', compact('user', 'institution', 'taxes', 'units', 'productGroup', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts', 'productAttributes', 'brands', 'productSubCategories', 'taxMethods'));
    }

    public function productGroupUpdate(Request $request, $portal, $product_group_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Convert array to string
        $attributes = implode(' ', array_values($request->attribute));
        $attribute_options = implode(' ', array_values($request->attribute_options));

        // return error if product group array is empty
        // if($request->products->isEmpty()){
        //     return back()->withError('No products submitted');
        // }

        // check if the product group exists
        $productGroupExists = Product::findOrFail($product_group_id);
        $productGroup = Product::where('id', $product_group_id)->first();

        if($request->product_type == "services") {
            $productGroup->is_service = true;
        }else{
            $productGroup->is_service = false;
        }
        $productGroup->name = $request->product_name;
        $productGroup->description = $request->description;
        $productGroup->attributes = $attributes;
        $productGroup->attribute_options = $attribute_options;
        $productGroup->tax_method_id = $request->tax_method;
        $productGroup->selling_account_id = $request->selling_account;
        $productGroup->purchase_account_id = $request->purchase_account;
        $productGroup->inventory_account_id = $request->inventory_account;

        // Check if the product is has been value added
        if ($request->is_created == "on"){
            $productGroup->is_created = true;
        }else{
            $productGroup->is_created = false;
        }
        $productGroup->creation_time = $request->creation_time;
        $productGroup->creation_cost = $request->creation_cost;

        $productGroup->user_id = $user->id;
        $productGroup->unit_id = $request->unit;
        $productGroup->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $productGroup->institution_id = $institution->id;

        if ($request->is_returnable == "on"){
            $productGroup->is_returnable = true;
        }else{
            $productGroup->is_returnable = false;
        }
        $productGroup->save();

        // Product taxes update
        $productGroupRequestTaxes =array();
        foreach ($request->taxes as $productGroupProductTax){
            // Append to array
            $productGroupRequestTaxes[]['id'] = $productGroupProductTax;

            // Check if product tax exists
            $productGroupTax = ProductTax::where('product_id', $productGroup->id)->where('tax_id', $productGroupProductTax)->first();

            if($productGroupTax === null) {
                $productGroupTax = new ProductTax();
                $productGroupTax->product_id = $productGroup->id;
                $productGroupTax->tax_id = $productGroupProductTax;
                $productGroupTax->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $productGroupTax->user_id = $user->id;
                $productGroupTax->save();
            }

        }

        $productGroupTaxesIds = ProductTax::where('product_id', $product_group_id)->whereNotIn('tax_id', $productGroupRequestTaxes)->select('id')->get()->toArray();
        DB::table('product_taxes')->whereIn('id', $productGroupTaxesIds)->delete();



        $productGroupRequestProduct =array();
        $existingProductNames =array();
        foreach ($request->products as $productGroupProduct){


            // check if product exists
            $productName = Product::where('name', $productGroupProduct['name'])->where('product_group_id', $productGroup->id)->first();
            $existingProductNames[]['product'] = $productName;
            if($productName){
                // product exists
                $product = Product::where('name', $productGroupProduct['name'])->where('product_group_id', $productGroup->id)->first();

                $productGroupRequestProduct[]['id'] = $product->id;
                // check if product is a service or a good
                if($request->product_type == "services") {
                    $product->is_service = true;
                }else{
                    $product->is_service = false;
                }
                $product->name = $productGroupProduct['name'];
                $product->attributes = $attributes;
                $product->description = $request->description;
                $product->unit_id = $request->unit;
                $product->tax_method_id = $request->tax_method;
                // Check if the product is eligible for sales return
                if ($request->is_returnable == "on"){
                    $product->is_returnable = true;
                }else{
                    $product->is_returnable = false;
                }

                $product->selling_account_id = $request->selling_account;
                $product->purchase_account_id = $request->purchase_account;

                $product->selling_price = $productGroupProduct['selling_price'];
                $product->purchase_price = $productGroupProduct['purchase_price'];
                $product->reorder_level = $productGroupProduct['reorder_level'];
                // Check if the product is has been value added
                if ($request->is_created == "on"){
                    $product->is_created = true;
                }else{
                    $product->is_created = false;
                }
                $product->creation_time = $request->creation_time;
                $product->creation_cost = $request->creation_cost;
                $product->inventory_account_id = $request->inventory_account;
                $product->opening_stock = $productGroupProduct['opening_stock'];
                $product->opening_stock_value = $productGroupProduct['opening_stock_value'];
                $product->reorder_level = $productGroupProduct['reorder_level'];

                $product->is_product_group = true;
                $product->is_composite_product = false;

                $product->product_group_id = $productGroup->id;
                $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $product->user_id = $user->id;
                $product->institution_id = $institution->id;
                $product->save();

                $taxAmount = 0;

                // Create inventory records if product is a good
                if($request->product_type != "services") {

                    // todo create stock tables for product
                    // Get primary warehouse
                    $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

                    // create inventory record
                    $inventory = new Inventory();
                    $inventory->date = date('Y-m-d');
                    $inventory->quantity = $productGroupProduct['opening_stock'];
                    $inventory->is_item = false;
                    $inventory->is_product = true;
                    $inventory->warehouse_id = $warehouse->id;
                    $inventory->product_id = $product->id;
                    $inventory->user_id = $user->id;
                    $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                    $inventory->save();

                    // Create inventory records for subsequent warehouses

                    $warehouseIds = Warehouse::select('id')->where('is_primary', false)->get();

                    // Records for the rest of the warehouses
                    foreach ($warehouseIds as $warehouseId){
                        // Inventory record
                        $inventory = new Inventory();
                        $inventory->quantity = 0;
                        $inventory->is_item = false;
                        $inventory->is_product = true;
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
                    if($productGroupProduct['opening_stock_value'] == 0 or $productGroupProduct['opening_stock'] == 0)
                    {
                        $unit_value = 0;
                    }else{
                        $unit_value = floatval($productGroupProduct['opening_stock_value'])/floatval($productGroupProduct['opening_stock']);
                    }
                    $restock->unit_value = $unit_value;
                    $restock->total_value = $productGroupProduct['opening_stock_value'];
                    $restock->quantity = $productGroupProduct['opening_stock'];
                    $restock->is_item = false;
                    $restock->is_product = true;
                    $restock->warehouse_id = $warehouse->id;
                    $restock->product_id = $product->id;
                    $restock->is_opening_stock = true;
                    $restock->user_id = $user->id;
                    $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                    $restock->save();
                }


                // Product taxes update
                $productRequestTaxes =array();
                foreach ($request->taxes as $productProductTax){
                    // Append to array
                    $productRequestTaxes[]['id'] = $productProductTax;

                    // Check if product tax exists
                    $productTax = ProductTax::where('product_id', $product->id)->where('tax_id', $productProductTax)->with('tax')->first();

                    if($productTax === null) {
                        // get tax
                        $productTax = new ProductTax();
                        $productTax->product_id = $product->id;
                        $productTax->tax_id = $productProductTax;
                        $productTax->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                        $productTax->user_id = $user->id;
                        $productTax->save();
                    }

                    $tax = Tax::findOrFail($productProductTax);
                    if ($tax->is_percentage){
                        $taxPercentage = $tax->amount/100 * $productGroupProduct['selling_price'];
                        $taxAmount += $taxPercentage;
                    }else{
                        // amount
                        $taxAmount += $tax->amount;
                    }

                }

                // set tax selling;
                $productTax = Product::findOrFail($product->id);
                if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
                    $productTax->taxed_selling_price = ceil(floatval($taxAmount+$productGroupProduct['selling_price']));
                    $productTax->tax_amount = ceil(floatval($taxAmount));
                }else{
                    $productTax->taxed_selling_price = $productGroupProduct['selling_price'];
                    $productTax->tax_amount = ceil(floatval($taxAmount));
                }
                $productTax->save();

                $productTaxesIds = ProductTax::where('product_id', $product->id)->whereNotIn('tax_id', $productRequestTaxes)->select('id')->get()->toArray();
                DB::table('product_taxes')->whereIn('id', $productTaxesIds)->delete();

            }
            else {
                // product doesn't exist
                $product = new Product;
                // check if product is a service or a good
                if($request->product_type == "services") {
                    $product->is_service = true;
                }else{
                    $product->is_service = false;
                }
                $product->name = $productGroupProduct['name'];
                $product->attribute = $attributes;
                $product->description = $request->description;
                $product->unit_id = $request->unit;
                $product->tax_method_id = $request->tax_method;
                // Check if the product is eligible for sales return
                if ($request->is_returnable == "on"){
                    $product->is_returnable = true;
                }else{
                    $product->is_returnable = false;
                }

                $product->selling_account_id = $request->selling_account;
                $product->purchase_account_id = $request->purchase_account;

                $product->selling_price = $productGroupProduct['selling_price'];
                $product->purchase_price = $productGroupProduct['purchase_price'];
                $product->reorder_level = $productGroupProduct['reorder_level'];
                // Check if the product is has been value added
                if ($request->is_created == "on"){
                    $product->is_created = true;
                }else{
                    $product->is_created = false;
                }
                $product->creation_time = $request->creation_time;
                $product->creation_cost = $request->creation_cost;
                $product->inventory_account_id = $request->inventory_account;
                $product->opening_stock = $productGroupProduct['opening_stock'];
                $product->opening_stock_value = $productGroupProduct['opening_stock_value'];
                $product->reorder_level = $productGroupProduct['reorder_level'];

                $product->is_product_group = true;
                $product->is_composite_product = false;
                $product->is_item = false;

                $product->product_group_id = $productGroup->id;
                $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $product->user_id = $user->id;
                $product->institution_id = $institution->id;
                $product->save();
                //track the id as to delete products that have been deleted
                $productGroupRequestProduct[]['id'] = $product->id;

                $taxAmount = 0;

                // Create inventory records if product is a good
                if($request->product_type != "services") {

                    // todo create stock tables for product
                    // Get primary warehouse
                    $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

                    // create inventory record
                    $inventory = new Inventory();
                    $inventory->date = date('Y-m-d');
                    $inventory->quantity = $productGroupProduct['opening_stock'];
                    $inventory->is_item = false;
                    $inventory->is_product = true;
                    $inventory->warehouse_id = $warehouse->id;
                    $inventory->product_id = $product->id;
                    $inventory->user_id = $user->id;
                    $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                    $inventory->save();

                    // Create inventory records for subsequent warehouses

                    $warehouseIds = Warehouse::select('id')->where('is_primary', false)->get();

                    // Records for the rest of the warehouses
                    foreach ($warehouseIds as $warehouseId){
                        // Inventory record
                        $inventory = new Inventory();
                        $inventory->quantity = 0;
                        $inventory->is_item = false;
                        $inventory->is_product = true;
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
                    if($productGroupProduct['opening_stock_value'] == 0 or $productGroupProduct['opening_stock'] == 0)
                    {
                        $unit_value = 0;
                    }else{
                        $unit_value = floatval($productGroupProduct['opening_stock_value'])/floatval($productGroupProduct['opening_stock']);
                    }
                    $restock->unit_value = $unit_value;
                    $restock->total_value = $productGroupProduct['opening_stock_value'];
                    $restock->quantity = $productGroupProduct['opening_stock'];
                    $restock->is_item = false;
                    $restock->is_product = true;
                    $restock->warehouse_id = $warehouse->id;
                    $restock->product_id = $product->id;
                    $restock->is_opening_stock = true;
                    $restock->user_id = $user->id;
                    $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                    $restock->save();
                }

                // Product taxes
                if ($request->taxes){
                    foreach ($request->taxes as $productProductTax){
                        // get tax
                        $tax = Tax::findOrFail($productProductTax);
                        if ($tax->is_percentage){
                            $taxPercentage = $tax->amount/100 * $request->selling_price;
                            $taxAmount += $taxPercentage;
                        }else{
                            // amount
                            $taxAmount += $tax->amount;
                        }
                        $productTax = new ProductTax();
                        $productTax->product_id = $product->id;
                        $productTax->tax_id = $productProductTax;
                        $productTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                        $productTax->user_id = $user->id;
                        $productTax->save();
                    }
                }

                // set tax selling
                $productTax = Product::findOrFail($product->id);
                if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
                    $productTax->taxed_selling_price = ceil(floatval($taxAmount+$productGroupProduct['selling_price']));
                    $productTax->tax_amount = ceil(floatval($taxAmount));
                }else{
                    $productTax->taxed_selling_price = $productGroupProduct['selling_price'];
                    $productTax->tax_amount = ceil(floatval($taxAmount));
                }
                $productTax->save();

            }



        }

        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $extension = $file->getClientOriginalExtension();
                $file_name_extension = $file->getClientOriginalName();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $productGroup->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        $productGroupProductIds = Product::where('product_group_id', $product_group_id)->whereNotIn('id', $productGroupRequestProduct)->select('id')->get()->toArray();
        // return $productGroupProductIds;
        Product::destroy($productGroupProductIds);
        // DB::table('products')->whereIn('id', $productGroupProductIds)->delete();

        return redirect(route('business.product.group.show',['portal'=>$institution->portal, 'id'=>$productGroup->id]))->withSuccess(__('Product Group successfully updated.'));
    }

    public function productGroupDelete($portal, $product_group_id)
    {
        return back()->withSuccess(__('Product Group successfully deleted.'));
    }







    // Product CRUD
    public function products($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution products
        $products = Product::where('institution_id', $institution->id)->with('status', 'unit', 'inventory', 'stock_on_hand')->where('is_product_group', false)->where('is_item', false)->where('is_product_group_child', false)->where('is_composite_product', false)->where('status_id', 'f6654b11-8f04-4ac9-993f-116a8a6ecaae')->get();

//        return $products;

        return view('business.products', compact('user', 'products', 'institution'));
    }
    public function productCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $brands = Brand::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();
        // $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();
        // Getting Products
        $items = Product::where('institution_id', $institution->id)->where('is_item',true)->with('inventory.warehouse')->get();


        return view('business.product_create', compact('user', 'units', 'taxes', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts', 'institution', 'brands', 'productSubCategories', 'taxMethods', 'items'));
    }

    public function productStore(Request $request, $portal)
    {


        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $product = new Product;
        // check if product is a service or a good
        if($request->product_type == "services") {
            $product->is_service = true;
        }else{
            $product->is_service = false;
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->first();
            if(!$warehouse){
                return back()->withWarning(__('Please add a warehouse to register a product.'));
            }
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_id = $request->unit;
        $product->product_sub_category_id = $request->product_sub_category;
        $product->brand_id = $request->brand;

        // Check if the product is eligible for sales return
        if ($request->is_returnable == "on"){
            $product->is_returnable = true;
        }else{
            $product->is_returnable = false;
        }

        if ($request->is_inventory == "on"){
            $product->is_inventory = true;
            $product->opening_stock = $request->opening_stock;
            $product->opening_stock_value = $request->opening_stock_value;
            $product->reorder_level = $request->reorder_level;
        }else{
            $product->is_inventory = false;
        }

        $product->tax_method_id = $request->tax_method;
        $product->selling_account_id = $request->selling_account;
        $product->purchase_account_id = $request->purchase_account;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;

        // Check if the product is has been value added
        if ($request->is_created == "on"){
            $product->is_created = true;
        }else{
            $product->is_created = false;
        }
        $product->creation_time = $request->creation_time;
        $product->creation_cost = $request->creation_cost;
        $product->inventory_account_id = $request->inventory_account;

        $product->is_product_group = false;
        $product->is_product_group_child = false;
        $product->is_composite_product = false;
        $product->is_item = false;

        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->user_id = $user->id;
        $product->institution_id = $institution->id;
        $product->save();

        $taxAmount = 0;

        if($request->product_type == "goods" && $request->is_inventory == "on") {

            // todo create stock tables for product
            // Get primary warehouse
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

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

            $warehouseIds = Warehouse::select('id')->where('is_primary', false)->get();

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
            $restock->is_opening_stock = true;
            $restock->user_id = $user->id;
            $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $restock->save();
        }

        // Product taxes
        if ($request->taxes){
            foreach ($request->taxes as $productProductTax){
                // get tax
                $tax = Tax::findOrFail($productProductTax);
                if ($tax->is_percentage){
                    $percentageTax = $tax->amount/100 * $request->selling_price;
                    $taxAmount += $percentageTax;
                }else{
                    // amount
                    $taxAmount += $tax->amount;
                }

                $productTax = new ProductTax();
                $productTax->product_id = $product->id;
                $productTax->tax_id = $productProductTax;
                $productTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productTax->user_id = $user->id;
                $productTax->save();
            }
        }

        // set tax selling
        $productTax = Product::findOrFail($product->id);
        if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
            $productTax->taxed_selling_price = ceil(floatval($taxAmount+$request->selling_price));
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }else{
            $productTax->taxed_selling_price = $request->selling_price;
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }
        $productTax->save();

        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $file_name_extension = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $product->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        return redirect()->route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])->withSuccess(__('Product successfully saved.'));
    }

    public function productShow($portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        Product::findOrFail($product_id);
        $product = Product::where('institution_id', $institution->id)->where('id', $product_id)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'saleProducts', 'user', 'inventoryAdjustmentProducts', 'transferOrderProducts', 'productImages.upload', 'taxMethod')->withCount('saleProducts', 'restock')->first();
//         return $product;

        return view('business.product_show', compact('product', 'user', 'institution'));
    }

    public function productEdit($portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if exists
        Product::findOrFail($product_id);
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution brands
        $brands = Brand::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();

        $productExists = Product::findOrFail($product_id);
        $product = Product::where('id', $product_id)->with('status', 'product_discounts', 'productTaxes', 'productImages.upload')->first();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();

//        return $product;
        return view('business.product_edit', compact('user', 'institution', 'product', 'taxes', 'units', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts', 'brands', 'productSubCategories', 'taxMethods'));
    }

    public function productUpdate(Request $request, $portal, $product_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $product = Product::findOrFail($product_id);

        // check if product is a service or a good
        if ($request->product_type == "services") {
            $product->is_service = true;
        } else {
            $product->is_service = false;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_id = $request->unit;
        // Check if the product is eligible for sales return
        if ($request->is_returnable == "on") {
            $product->is_returnable = true;
        } else {
            $product->is_returnable = false;
        }
        if ($request->is_inventory == "on") {
            $product->is_inventory = true;
            $product->opening_stock = $request->opening_stock;
            $product->opening_stock_value = $request->opening_stock_value;
            $product->reorder_level = $request->reorder_level;
        } else {
            $product->is_inventory = false;
        }
        $product->tax_method_id = $request->tax_method;
        $product->selling_account_id = $request->selling_account;
        $product->purchase_account_id = $request->purchase_account;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;
        // Check if the product is has been value added
        if ($request->is_created == "on") {
            $product->is_created = true;
        } else {
            $product->is_created = false;
        }
        $product->creation_time = $request->creation_time;
        $product->creation_cost = $request->creation_cost;
        $product->inventory_account_id = $request->inventory_account;

        $product->is_product_group = false;

        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->user_id = $user->id;
        $product->institution_id = $institution->id;
        $product->save();

        $taxAmount = 0;

        if($request->product_type != "services" && $request->is_inventory == "on") {
            // todo create stock tables for product
            // Get primary warehouse
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

            // todo, it refactors it to the value put here which will erare the current stock value
            // create inventory
            $inventory = Inventory::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->first();
            $inventory->quantity = $request->opening_stock;
            $inventory->save();

            // Create record for inventory, tracking the stock input
            $restock = Restock::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->where('is_opening_stock', true)->first();
            $restock->initial_warehouse_amount = 0;
            $restock->subsequent_warehouse_amount = $request->opening_stock;
            // getting unit value
            if (doubleval($request->opening_stock) > 0) {
                $unit_value = floatval($request->opening_stock_value) / floatval($request->opening_stock);
            } else {
                $unit_value = 0;
            }
            $restock->unit_value = $unit_value;
            $restock->total_value = $request->opening_stock_value;
            $restock->quantity = $request->opening_stock;
            $restock->save();
        }


        // Product taxes update
        $productRequestTaxes =array();
        foreach ($request->taxes as $productProductTax){
            // Append to array
            $productRequestTaxes[]['id'] = $productProductTax;

            // Check if product tax exists
            $productTax = ProductTax::where('product_id', $product->id)->where('tax_id', $productProductTax)->with('tax')->first();

            if($productTax === null) {
                // get tax

                $productTaxNew = new ProductTax();
                $productTaxNew->product_id = $product->id;
                $productTaxNew->tax_id = $productProductTax;
                $productTaxNew->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $productTaxNew->user_id = $user->id;
                $productTaxNew->save();
                $productTax = ProductTax::where('product_id', $product->id)->where('tax_id', $productProductTax)->with('tax')->first();
            }
//            return $productTax;

            if ($productTax->tax->is_percentage){
                $taxPercentage = $productTax->tax->amount/100 * $request->selling_price;
                $taxAmount += $taxPercentage;
            }else{
                // amount
                $taxAmount += $productTax->tax->amount;
            }
        }

        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $extension = $file->getClientOriginalExtension();
                $file_name_extension = $file->getClientOriginalName();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $product->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        // set tax selling
        $productTax = Product::findOrFail($product->id);
        if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
            $productTax->taxed_selling_price = ceil(floatval($taxAmount+$request->selling_price));
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }else{
            $productTax->taxed_selling_price = $request->selling_price;
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }
        $productTax->save();

        $productTaxesIds = ProductTax::where('product_id', $product_id)->whereNotIn('tax_id', $productRequestTaxes)->select('id')->get()->toArray();
        DB::table('product_taxes')->whereIn('id', $productTaxesIds)->delete();


        return redirect()->route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])->withSuccess(__('Product successfully updated.'));
    }

    public function productDelete($portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Update product status
        $product = Product::findOrFail($product_id);
        $product->status_id = "bc6170bf-299a-44f5-8362-8cdeed1f47b0";
        $product->save();

        return back()->withSuccess(__('Product successfully deleted.'));
    }

    public function productRestore($portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Update product status
        $product = Product::findOrFail($product_id);
        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->save();

        return back()->withSuccess(__('Product successfully restored.'));
    }





    // Composite product CRUD
    public function compositeProducts($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get products
//        $compositeProducts = CompositeProduct::where('institution_id', $institution->id)->withCount('compositeProductProducts')->get();
        $compositeProducts = Product::where('institution_id', $institution->id)->where('is_composite_product', true)->withCount('compositeProductProducts')->get();

        return view('business.composite_products', compact('user', 'institution', 'compositeProducts'));
    }

    public function compositeProductCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution units
        $brands = Brand::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->get();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();

        return view('business.composite_product_create', compact('user', 'institution', 'taxes', 'salesAccounts', 'units', 'products', 'brands', 'productSubCategories', 'taxMethods'));
    }

    public function compositeProductStore(Request $request, $portal)
    {

//        return $request;

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Create composite product
        $product = new Product();
        if($request->product_type == "services") {
            $product->is_service = true;
        }else{
            $product->is_service = false;
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->first();
            if(!$warehouse){
                return back()->withWarning(__('Please add a warehouse to register a product.'));
            }
        }
        if ($request->is_returnable == "on"){
            $product->is_returnable = true;
        }else{
            $product->is_returnable = false;
        }
        if ($request->is_inventory == "on"){
            $product->is_inventory = true;
        }else{
            $product->is_inventory = false;
        }
        $product->tax_method_id = $request->tax_method;
        $product->unit_id = $request->unit;
        $product->name = $request->product_name;
        $product->product_sub_category_id = $request->product_sub_category;
        $product->brand_id = $request->brand;
        $product->stock_keeping_unit = $request->unit;
        $product->selling_price = $request->selling_price;
        $product->selling_account_id = $request->selling_account;

        $product->is_inventory = false;
        $product->is_created = false;
        $product->is_composite_product = true;
        $product->is_product_group = false;
        $product->is_product_group_child = false;
        $product->is_item = false;

        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->user_id = $user->id;
        $product->institution_id = $institution->id;
        $product->save();
        $taxAmount = 0;

        // products
        foreach ($request->item_details as $compositeProductItem){
            // Create product
            $compositeProductProduct = new CompositeProductProduct();
            $compositeProductProduct->quantity = $compositeProductItem['quantity'];
            $compositeProductProduct->unit_price = $compositeProductItem['unit_price'];
            $compositeProductProduct->total_price = $compositeProductItem['total_price'];
            $compositeProductProduct->user_id = $user->id;
            $compositeProductProduct->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $compositeProductProduct->composite_product_id = $product->id;
            $compositeProductProduct->product_id = $compositeProductItem['details'];
            $compositeProductProduct->save();
        }

        // Product taxes
        if ($request->taxes){
            foreach ($request->taxes as $compositeProductProductTax){
                // get tax
                $tax = Tax::findOrFail($compositeProductProductTax);
                if ($tax->is_percentage){
                    $taxPercentage = $tax->amount/100 * $request->selling_price;
                    $taxAmount += $taxPercentage;
                }else{
                    // amount
                    $taxAmount += $tax->amount;
                }
                $compositeProductTax = new ProductTax();
                $compositeProductTax->product_id = $product->id;
                $compositeProductTax->tax_id = $compositeProductProductTax;
                $compositeProductTax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $compositeProductTax->user_id = $user->id;
                $compositeProductTax->save();
            }
        }

        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $extension = $file->getClientOriginalExtension();
                $file_name_extension = $file->getClientOriginalName();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $product->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        // set tax selling
        $productTax = Product::findOrFail($product->id);
        if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
            $productTax->taxed_selling_price = ceil(floatval($taxAmount+$request->selling_price));
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }else{
            $productTax->taxed_selling_price = $request->selling_price;
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }
        $productTax->save();

        return redirect()->route('business.composite.product.show',['portal'=>$institution->portal, 'id'=>$product->id])->withSuccess(__('Composite product successfully stored.'));
    }

    public function compositeProductShow($portal, $composite_product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $compositeProduct = Product::findOrFail($composite_product_id);
        $compositeProduct = Product::where('institution_id', $institution->id)->where('id', $composite_product_id)->withCount('saleProducts', 'compositeProductProducts')->with('saleProducts', 'compositeProductProducts.product', 'productTaxes', 'user', 'status')->first();
//        return $compositeProduct;
        $compositeProductProducts = CompositeProductProduct::where('composite_product_id', $compositeProduct->id)->with('product')->get();
//         return $compositeProduct->compositeProductProducts;
        return view('business.composite_product_show', compact('user', 'institution', 'compositeProduct', 'compositeProductProducts'));
    }

    public function compositeProductEdit(Request $request, $portal, $composite_product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution brands
        $brands = Brand::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // product categories
        $productSubCategories = ProductSubCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        // Get institution taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Products
        $products = Product::where('is_product_group',false)->where('is_item',false)->whereNotIn('id',[$composite_product_id])->where('institution_id', $institution->id)->get();
        // check if exists
        $compositeProduct = Product::findOrFail($composite_product_id);
        // get composite product
        $compositeProduct = Product::where('id', $composite_product_id)->withCount('saleProducts', 'compositeProductProducts')->with('compositeProductProducts', 'productTaxes', 'user', 'status')->first();
        $compositeProductProducts = CompositeProductProduct::where('composite_product_id', $compositeProduct->id)->with('product')->get();
        // Get tax methods
        $taxMethods = TaxMethod::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->get();

        return view('business.composite_product_edit', compact('user', 'institution', 'compositeProduct', 'compositeProductProducts', 'units', 'salesAccounts', 'taxes', 'products', 'brands', 'productSubCategories', 'taxMethods'));
    }

    public function compositeProductUpdate(Request $request, $portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // check if composite product exists
        $product = Product::findOrFail($product_id);
        $product = Product::where('id', $product_id)->first();
        if($request->product_type == "services") {
            $product->is_service = true;
        }else{
            $product->is_service = false;
        }
        if ($request->is_returnable == "on"){
            $product->is_returnable = true;
        }else{
            $product->is_returnable = false;
        }
        $product->tax_method_id = $request->tax_method;
        $product->unit_id = $request->unit;
        $product->name = $request->product_name;
        $product->stock_keeping_unit = $request->unit;
        $product->selling_price = $request->selling_price;
        $product->selling_account_id = $request->selling_account;

        $product->is_created = false;
        $product->is_composite_product = true;
        $product->is_product_group = false;

        $product->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $product->user_id = $user->id;
        $product->institution_id = $institution->id;
        $product->save();

        $taxAmount = 0;

        // composite products
        $compositeProductRequestProducts =array();
        foreach ($request->item_details as $compositeProductItem){
            // Append to array
            $compositeProductRequestProducts[]['id'] = $compositeProductItem['details'];

            // check if composite product exists
            $compositeProductExists = CompositeProductProduct::where('product_id', $product->id)->where('product_id', $product->id)->first();

            if ($compositeProductExists == null)
            {
                // Create product
                $compositeProductProduct = new CompositeProductProduct();
                $compositeProductProduct->quantity = $compositeProductItem['quantity'];
                $compositeProductProduct->unit_price = $compositeProductItem['unit_price'];
                $compositeProductProduct->total_price = $compositeProductItem['total_price'];
                $compositeProductProduct->user_id = $user->id;
                $compositeProductProduct->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $compositeProductProduct->composite_product_id = $product->id;
                $compositeProductProduct->product_id = $compositeProductItem['details'];
                $compositeProductProduct->save();
            }

        }

        $compositeProductProductIds = CompositeProductProduct::where('composite_product_id', $product->id)->whereNotIn('product_id', $compositeProductRequestProducts)->select('id')->get()->toArray();
        DB::table('composite_product_products')->whereIn('id', $compositeProductProductIds)->delete();

        // Product taxes update
        $productRequestTaxes =array();
        foreach ($request->taxes as $productProductTax){
            // Append to array
            $productRequestTaxes[]['id'] = $productProductTax;

            // Check if product tax exists
            $productTax = ProductTax::where('product_id', $product->id)->where('tax_id', $productProductTax)->first();

            if($productTax === null) {

                $productTax = new ProductTax();
                $productTax->product_id = $product->id;
                $productTax->tax_id = $productProductTax;
                $productTax->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $productTax->user_id = $user->id;
                $productTax->save();
            }
            // get tax
            $tax = Tax::findOrFail($productProductTax);
            if ($tax->is_percentage){
                $taxPercentage = $tax->amount/100 * $request->selling_price;
                $taxAmount += $taxPercentage;
            }else{
                // amount
                $taxAmount += $tax->amount;
            }

        }


        // product images
        if($request->file){
            foreach ($request->file as $file){

                // folder name
                $folderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/");
                $pixel500FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/500/");
                $pixel1000FolderName = str_replace(' ', '', $institution->portal."/product/".$product->name."/1000/");
                $extension = $file->getClientOriginalExtension();
                $file_name_extension = $file->getClientOriginalName();
                // upload image
                $file->storeAs($folderName, $file->getClientOriginalName());
                $path = public_path()."/storage/".$folderName.$file_name_extension;
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $image_name = $file_name.'.'.$extension;
                $width = Image::make( $file )->width();
                $height = Image::make( $file )->height();
                $size = $file->getClientSize();
                $extensionType = $this->uploadExtension($extension);
                // smaller image
                if ($width > $height) { //landscape

                    $orientation = "landscape";

                    $small_image = Image::make( $file )->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                } else {

                    $orientation = "portrait";

                    $small_image = Image::make( $file )->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel500FolderName.$file->getClientOriginalName(), $small_image);

                    $large_image = Image::make( $file )->resize(null, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put($pixel1000FolderName.$file->getClientOriginalName(), $large_image);

                }

                // product image store
                // upload record
                $upload = new Upload();
                $upload->name = $file_name_extension;
                $upload->extension = $extension;
                $upload->size = $size;
                $upload->original = $folderName.$image_name;
                $upload->file_type = $extensionType;
                $upload->small_thumbnail = $pixel500FolderName.$file->getClientOriginalName();
                $upload->large_thumbnail = $pixel1000FolderName.$file->getClientOriginalName();
                $upload->institution_id = $institution->id;
                $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $upload->upload_type_id = "b2004522-e7aa-41dd-b033-7252d0a642b7";
                $upload->user_id = $user->id;
                $upload->save();

                // product image
                $productImage = new ProductImage();
                $productImage->upload_id = $upload->id;
                $productImage->product_id = $product->id;
                $productImage->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $productImage->user_id = $user->id;
                $productImage->save();
            }
        }

        // set tax selling
        $productTax = Product::findOrFail($product->id);
        if($request->tax_method == 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
            $productTax->taxed_selling_price = ceil(floatval($taxAmount+$request->selling_price));
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }else{
            $productTax->taxed_selling_price = $request->selling_price;
            $productTax->tax_amount = ceil(floatval($taxAmount));
        }
        $productTax->save();

        $productTaxesIds = ProductTax::where('product_id', $product->id)->whereNotIn('tax_id', $productRequestTaxes)->select('id')->get()->toArray();
        DB::table('product_taxes')->whereIn('id', $productTaxesIds)->delete();

        return redirect()->route('business.composite.product.show',['portal'=>$institution->portal, 'id'=>$product->id])->withSuccess(__('Composite product successfully updated.'));
    }

    public function compositeProductDelete($portal, $composite_product_id)
    {
        return back()->withSuccess(__('Composite product successfully deleted.'));
    }



    // items
    public function items($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution products
        $items = Product::where('institution_id', $institution->id)->with('status', 'unit', 'inventory', 'stock_on_hand')->where('is_item', true)->where('status_id', 'f6654b11-8f04-4ac9-993f-116a8a6ecaae')->get();

        return view('business.items', compact('items', 'user', 'institution', 'items'));
    }

    public function itemCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();

        return view('business.item_create', compact('user', 'units', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts', 'institution'));
    }

    public function itemStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $item = new Product();
        // check if there is a warehouse
        if($request->is_inventory = "on") {
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->first();
            if(!$warehouse){
                return back()->withWarning(__('Please add a warehouse to register an item.'));
            }
        }

        $item->name = $request->name;
        $item->unit_id = $request->unit;

        if ($request->is_inventory == "on"){
            $item->is_inventory = true;
            $item->opening_stock = $request->opening_stock;
            $item->opening_stock_value = $request->opening_stock_value;
            $item->reorder_level = $request->reorder_level;
        }else{
            $item->is_inventory = false;
        }

        $item->purchase_account_id = $request->purchase_account;
        $item->purchase_price = $request->purchase_price;

        $item->inventory_account_id = $request->inventory_account;

        $item->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
        $item->user_id = $user->id;
        $item->institution_id = $institution->id;
        $item->is_item = true;
        $item->is_service = false;
        $item->is_created = false;
        $item->is_returnable = false;
        $item->is_product_group = false;
        $item->is_composite_product = false;
        $item->is_product_group_child = false;
        $item->save();

        $taxAmount = 0;

        if($request->is_inventory == "on") {

            // todo create stock tables for item
            // Get primary warehouse
            $warehouse = Warehouse::where('institution_id', $institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('is_primary', true)->first();

            // create inventory record
            $inventory = new Inventory();
            $inventory->date = date('Y-m-d');
            $inventory->quantity = $request->opening_stock;
            $inventory->warehouse_id = $warehouse->id;
            $inventory->product_id = $item->id;
            $inventory->user_id = $user->id;
            $inventory->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $inventory->save();

            // Create inventory records for subsequent warehouses

            $warehouseIds = Warehouse::select('id')->where('is_primary', false)->get();

            // Records for the rest of the warehouses
            foreach ($warehouseIds as $warehouseId){
                // Inventory record
                $inventory = new Inventory();
                $inventory->quantity = 0;
                $inventory->product_id = $item->id;
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
            $restock->product_id = $item->id;
            $restock->is_opening_stock = true;
            $restock->user_id = $user->id;
            $restock->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
            $restock->save();
        }


        return redirect()->route('business.item.show',['portal'=>$institution->portal, 'id'=>$item->id])->withSuccess(__('Item '.$request->name.' successfully saved.'));
    }

    public function itemShow($portal, $item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if item exists
        Product::findOrFail($item_id);
        $item = Product::where('institution_id', $institution->id)->where('id', $item_id)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'user')->withCount( 'restock')->first();
        return view('business.item_show', compact('item', 'user', 'institution'));
    }

    public function itemEdit($portal, $item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get institution units
        $units = Unit::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get institution accounts
        $salesAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '798077ba-ae21-4df0-8079-5a7c82afd90e')->with('accountType')->get();
        $expenseAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd')->with('accountType')->get();
        $costOfGoodsSoldAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5')->with('accountType')->get();
        $stockAccounts = ExpenseAccount::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->where('account_type_id', '4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->with('accountType')->get();
        // Check if item exists
        Product::findOrFail($item_id);
        $item = Product::where('institution_id', $institution->id)->where('id', $item_id)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'user')->withCount( 'restock')->first();

        return view('business.item_edit', compact('item', 'units', 'user', 'institution', 'salesAccounts', 'expenseAccounts', 'costOfGoodsSoldAccounts', 'stockAccounts'));
    }

    public function itemUpdate(Request $request, $portal, $item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $item = Product::findOrFail($item_id);

        $item->name = ($request->name);
        $item->user_id = $user->id;
        $item->save();

        return redirect()->route('business.item.show',['portal'=>$institution->portal, 'id'=>$item->id])->withSuccess('Item '.$item->name.' updated!');
    }

    public function itemDelete($portal, $item_id)
    {

        $item = Product::findOrFail($item_id);
        $item->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $item->save();

        return back()->withSuccess(__('Item '.$item->name.' successfully deleted.'));
    }

    public function itemRestore($portal, $item_id)
    {

        $item = Item::findOrFail($item_id);
        $item->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $item->restore();

        return back()->withSuccess(__('Item '.$item->name.' successfully restored.'));
    }


    public function productDiscountStore(Request $request, $portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if exists
        $product = Product::findOrFail($product_id);

//        return $request;

        $productDiscount = new ProductDiscount;

        if ($request->is_percentage == "on"){
            $productDiscount->is_percentage = true;
        }else{
            $productDiscount->is_percentage = false;
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

    public function productDiscountUpdate(Request $request, $portal, $product_discount_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        $productDiscountExists = ProductDiscount::findOrFail($product_discount_id);
        $productDiscount = ProductDiscount::where('id', $product_discount_id)->first();

        $productDiscount->quantity = $request->quantity;
        $productDiscount->minimum_items = $request->minimum_items;
        $productDiscount->discount = $request->discount;
        $productDiscount->start_date = date('Y-m-d', strtotime($request->start_date));;
        $productDiscount->end_date = date('Y-m-d', strtotime($request->end_date));;
        $productDiscount->save();

        return back()->withSuccess(__('Product discount successfully updated.'));
    }

    public function productDiscountDelete($portal, $product_discount_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Check if the product discount exists
        $productDiscount = ProductDiscount::findOrFail($product_discount_id);
        $productDiscountDelete = ProductDiscount::destroy($product_discount_id);

        return back()->withSuccess(__('Product discount successfully deleted.'));
    }





    public function productImageUpload(Request $request, $portal, $product_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if product exists
        $product = Product::findOrFail($product_id);
        // Get product
        $product = Product::where('id', $product_id)->first();

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

    public function productImageDelete($portal, $product_image_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Check if the product image exists
        $productImage = ProductImage::findOrFail($product_image_id);
        $productImageDelete = ProductImage::destroy($product_image_id);

        // todo delete upload table record

        return back()->withSuccess(__('Product image successfully deleted.'));

    }

}
