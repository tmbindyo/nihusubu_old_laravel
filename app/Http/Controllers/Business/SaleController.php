<?php

namespace App\Http\Controllers\Business;

use App\Account;
use DB;
use App\Address;
use App\AlbumTag;
use App\Contact;
use App\Estimate;
use App\EstimateProduct;
use App\Inventory;
use App\Invoice;
use App\Order;
use App\PaymentReceived;
use App\PaymentTerm;
use App\Product;
use App\ProductTax;
use App\Sale;
use App\SaleProduct;
use App\Tax;
use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;

class SaleController extends Controller
{

    use UserTrait;
    use InstitutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function estimates($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Estimates
        $estimates = Sale::where('institution_id',$institution->id)->where('is_estimate',True)->with('status','contact')->get();

//        return $estimates;

        return view('business.estimates',compact('user','institution','estimates'));
    }

    public function estimateCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.estimate_create',compact('user','institution','contacts','taxes','inventories','products'));
    }

    public function estimateStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

//        return $request;
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // Create estimate
        $estimate = new Sale();
        $estimate->reference = $reference;
        $estimate->customer_notes = $request->customer_notes;
        $estimate->terms_and_conditions = $request->terms_and_conditions;
        $estimate->date = date('Y-m-d', strtotime($request->date));
        $estimate->due_date = date('Y-m-d', strtotime($request->due_date));
        $estimate->subtotal = $request->subtotal;
        $estimate->discount = $request->discount;
        $estimate->total = $request->grand_total;
        $estimate->refund = 0;
        $estimate->paid = 0;
        $estimate->balance = $request->grand_total;
        $estimate->is_returned = False;
        $estimate->is_refunded = False;
        $estimate->is_product = True;
        $estimate->is_project = False;

        $estimate->is_estimate = True;
        $estimate->is_invoice = False;
        $estimate->is_sale = False;
        $estimate->is_order = False;
        $estimate->is_sample = False;
        // Todo impliment uploads for attachments
        $estimate->has_uploads = False;
        // Check if draft
        if ($request->is_draft == "on"){
            $estimate->is_draft = True;
            $estimate->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $estimate->is_draft = False;
            $estimate->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $estimate->contact_id = $request->contact;
        $estimate->institution_id = $institution->id;
        $estimate->user_id = $user->id;
        // estimate tax default
        $tax = 0;
        $estimate->tax = $tax;
        $estimate->save();

        // to do check if its a service or a product


        // Estimate products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id',$inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }

            // Check if product has taxes
            $taxes = ProductTax::where('product_id',$product_id)->with('tax')->get();
            if ($taxes){
                foreach ($taxes as $product_tax){
                    $product_tax_value = doubleval($product_tax->tax->amount) * 0.01 * $item['amount'];
                    $tax = doubleval($tax) + doubleval($product_tax_value);
                }
            }

            $estimateProduct =  new SaleProduct();
            $estimateProduct->rate = $item['rate'];
            $estimateProduct->quantity = $item['quantity'];
            $estimateProduct->amount = $item['amount'];
            $estimateProduct->sale_id = $estimate->id;
            $estimateProduct->refund_amount = 0;
            $estimateProduct->warehouse_id = $warehouse_id;
            $estimateProduct->is_product = True;
            $estimateProduct->is_refunded = False;
            $estimateProduct->is_returned = False;
            $estimateProduct->product_id = $product_id;
            $estimateProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $estimateProduct->user_id = $user->id;
            $estimateProduct->save();
        }

        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($estimate->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->save();

        return redirect()->route('business.estimate.show',['portal'=>$institution->portal,'id'=>$estimate->id])->withSuccess(__('Estimate successfully created.'));
    }

    public function estimateShow($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','contact.organization','sale_products.product.product_taxes')->withCount('sale_products')->first();
        // return $estimate;

        return view('business.estimate_show',compact('user','institution','estimate'));
    }

    public function estimateEdit($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','contact','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.estimate_edit',compact('user','institution','contacts','products','inventories','estimate'));
    }

    public function estimateUpdate(Request $request, $portal, $estimate_id)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create estimate
        $estimate = Sale::where('institution_id',$institution->id)->where('id',$estimate_id)->first();
        $estimate->customer_notes = $request->customer_notes;
        $estimate->terms_and_conditions = $request->terms_and_conditions;
        $estimate->date = date('Y-m-d', strtotime($request->date));
        $estimate->due_date = date('Y-m-d', strtotime($request->due_date));
        $estimate->subtotal = $request->subtotal;
        $estimate->discount = $request->discount;
        $estimate->total = $request->grand_total;


        // Todo impliment uploads for attachments
        $estimate->has_uploads = False;
        // Check if draft
        if ($request->is_draft == "on"){
            $estimate->is_draft = True;
            $estimate->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $estimate->is_draft = False;
            $estimate->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $estimate->contact_id = $request->contact;
        $estimate->user_id = $user->id;
        $estimate->save();
        $tax = 0;


        $estimateProducts =array();
        // Estimate products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id',$inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            $estimateProducts[]['id'] = $product_id;

            // Check if product has taxes
            $taxes = ProductTax::where('product_id',$product_id)->with('tax')->get();
            if ($taxes){
                foreach ($taxes as $product_tax){
                    $product_tax_value = doubleval($product_tax->tax->amount) * 0.01 * $item['amount'];
                    $tax = doubleval($tax) + doubleval($product_tax_value);
                }
            }

            // Check if album tag exists
            $saleProductExists = SaleProduct::where('sale_id',$estimate->id)->where('product_id',$product_id)->first();

            if($saleProductExists === null) {

                $estimateProduct = new SaleProduct();
                $estimateProduct->rate = $item['rate'];
                $estimateProduct->quantity = $item['quantity'];
                $estimateProduct->amount = $item['amount'];
                $estimateProduct->sale_id = $estimate->id;
                $estimateProduct->warehouse_id = $warehouse_id;
                $estimateProduct->product_id = $product_id;
                $estimateProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $estimateProduct->user_id = $user->id;
                $estimateProduct->save();
            }
        }

        // Parse the deleted album tags into an array
        $estimateProductsIds = SaleProduct::where('sale_id',$estimate->id)->whereNotIn('product_id',$estimateProducts)->select('id')->get()->toArray();

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $estimateProductsIds)->delete();

        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($estimate->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->save();

        return back()->withSuccess(__('Estimate successfully updated.'));
    }

    public function estimateConvertToInvoice($portal, $estimate_id)
    {

        // User
        $user = $this->getUser();

        // Create estimate
        $estimate = Sale::where('id',$estimate_id)->first();
        $estimate->is_invoice = True;
        $estimate->user_id = $user->id;
        $estimate->save();

        return back()->withSuccess(__('Estimate successfully converted to sale.'));
    }

    public function estimateDelete($portal, $estimate_id)
    {
        return back()->withSuccess(__('Estimate successfully deleted.'));
    }

    public function estimateProductDelete($portal, $estimate_product_id)
    {
//        return $estimate_product_id;
        $estimateProduct = SaleProduct::findOrFail($estimate_product_id);

        // update estimate
        $estimate = Sale::where('id',$estimateProduct->sale_id)->first();
        $estimate->total = floatval($estimate->total)-floatval($estimateProduct->amount);
        $estimate->subtotal =  floatval($estimate->subtotal)-floatval($estimateProduct->amount);
        $estimate->save();

        $estimateProduct->delete();
        return back()->withSuccess(__('Estimate product successfully deleted.'));
    }

    public function estimatePrint($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','contact','sale_products.product')->withCount('sale_products')->first();
//        return $estimate;
        return view('business.estimate_print',compact('user','institution','estimate'));
    }



    public function invoices($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Invoices
        $invoices = Sale::where('institution_id',$institution->id)->where('is_invoice',True)->with('status','contact')->get();

        return view('business.invoices',compact('user','institution','invoices'));
    }

    public function invoiceCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.invoice_create',compact('user','institution','products','inventories','contacts','taxes'));
    }

    public function invoiceStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // Create invoice
        $invoice = new Sale();
        $invoice->reference = $reference;
        $invoice->customer_notes = $request->customer_notes;
        $invoice->terms_and_conditions = $request->terms_and_conditions;
        $invoice->date = date('Y-m-d', strtotime($request->date));
        $invoice->due_date = date('Y-m-d', strtotime($request->due_date));
        $invoice->subtotal = $request->subtotal;
        $invoice->discount = $request->discount;
        $invoice->total = $request->grand_total;
        $invoice->refund = 0;
        $invoice->paid = 0;
        $invoice->balance = $request->grand_total;
        $invoice->is_returned = False;
        $invoice->is_refunded = False;
        $invoice->is_product = True;
        $invoice->is_project = False;

        $invoice->is_estimate = False;
        $invoice->is_invoice = True;
        $invoice->is_sale = False;
        $invoice->is_order = False;
        $invoice->is_sample = False;
        // Todo impliment uploads for attachments
        $invoice->has_uploads = False;
        // Check if draft
        if ($request->is_draft == "on"){
            $invoice->is_draft = True;
            $invoice->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $invoice->is_draft = False;
            $invoice->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $invoice->contact_id = $request->contact;
        $invoice->institution_id = $institution->id;
        $invoice->user_id = $user->id;
        // invoice tax default
        $tax = 0;
        $invoice->tax = $tax;
        $invoice->save();

        // to do check if its a service or a product


        // Invoice products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id',$inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }

            // Check if product has taxes
            $taxes = ProductTax::where('product_id',$product_id)->with('tax')->get();
            if ($taxes){
                foreach ($taxes as $product_tax){
                    $product_tax_value = doubleval($product_tax->tax->amount) * 0.01 * $item['amount'];
                    $tax = doubleval($tax) + doubleval($product_tax_value);
                }
            }

            $invoiceProduct =  new SaleProduct();
            $invoiceProduct->rate = $item['rate'];
            $invoiceProduct->quantity = $item['quantity'];
            $invoiceProduct->amount = $item['amount'];
            $invoiceProduct->sale_id = $invoice->id;
            $invoiceProduct->refund_amount = 0;
            $invoiceProduct->warehouse_id = $warehouse_id;
            $invoiceProduct->is_product = True;
            $invoiceProduct->is_refunded = False;
            $invoiceProduct->is_returned = False;
            $invoiceProduct->product_id = $product_id;
            $invoiceProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $invoiceProduct->user_id = $user->id;
            $invoiceProduct->save();
        }

        // Set invoice tax
        $invoiceTaxSet = Sale::findOrFail($invoice->id);
        $invoiceTaxSet->tax = $tax;
        $invoiceTaxSet->save();

        return redirect()->route('business.invoice.show',['portal'=>$institution->portal,'id'=>$invoice->id])->withSuccess(__('Invoice successfully created.'));
    }

    public function invoiceShow($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','contact','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.invoice_show',compact('user','institution','invoice'));
    }

    public function invoiceEdit($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','contact','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.invoice_edit',compact('user','institution','contacts','products','inventories','invoice'));
    }

    public function invoiceUpdate(Request $request, $portal, $invoice_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create invoice
        $invoice = Sale::where('id',$invoice_id)->first();
        $invoice->customer_notes = $request->customer_notes;
        $invoice->terms_and_conditions = $request->terms_and_conditions;
        $invoice->date = date('Y-m-d', strtotime($request->date));
        $invoice->due_date = date('Y-m-d', strtotime($request->due_date));
        $invoice->subtotal = $request->subtotal;
        $invoice->discount = $request->discount;
        $invoice->total = $request->grand_total;


        // Todo impliment uploads for attachments
        $invoice->has_uploads = False;
        // Check if draft
        if ($request->is_draft == "on"){
            $invoice->is_draft = True;
            $invoice->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $invoice->is_draft = False;
            $invoice->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $invoice->contact_id = $request->contact;
        $invoice->user_id = $user->id;
        $invoice->save();
        $tax = 0;


        $invoiceProducts =array();
        // Invoice products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id',$inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            $invoiceProducts[]['id'] = $product_id;

            // Check if product has taxes
            $taxes = ProductTax::where('product_id',$product_id)->with('tax')->get();
            if ($taxes){
                foreach ($taxes as $product_tax){
                    $product_tax_value = doubleval($product_tax->tax->amount) * 0.01 * $item['amount'];
                    $tax = doubleval($tax) + doubleval($product_tax_value);
                }
            }

            // Check if album tag exists
            $saleProductExists = SaleProduct::where('sale_id',$invoice->id)->where('product_id',$product_id)->first();

            if($saleProductExists === null) {

                $invoiceProduct = new SaleProduct();
                $invoiceProduct->rate = $item['rate'];
                $invoiceProduct->quantity = $item['quantity'];
                $invoiceProduct->amount = $item['amount'];
                $invoiceProduct->sale_id = $invoice->id;
                $invoiceProduct->warehouse_id = $warehouse_id;
                $invoiceProduct->product_id = $product_id;
                $invoiceProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $invoiceProduct->user_id = $user->id;
                $invoiceProduct->save();
            }
        }

        // Parse the deleted album tags into an array
        $invoiceProductsIds = SaleProduct::where('sale_id',$invoice->id)->whereNotIn('product_id',$invoiceProducts)->select('id')->get()->toArray();

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $invoiceProductsIds)->delete();

        // Set invoice tax
        $invoiceTaxSet = Sale::findOrFail($invoice->id);
        $invoiceTaxSet->tax = $tax;
        $invoiceTaxSet->save();

        return back()->withSuccess(__('Invoice successfully updated.'));

    }

    public function invoiceConvertToSale($portal, $invoice_id)
    {

        // User
        $user = $this->getUser();

        // Create invoice
        $invoice = Sale::where('id',$invoice_id)->first();
        $invoice->is_sale = True;
        $invoice->user_id = $user->id;
        $invoice->save();

        return back()->withSuccess(__('Invoice successfully converted to sale.'));
    }

    public function invoiceDelete($portal, $invoice_id)
    {
        return back()->withSuccess(__('Invoice successfully deleted.'));
    }

    public function invoiceProductDelete($portal, $invoice_product_id)
    {
//        return $invoice_product_id;
        $invoiceProduct = SaleProduct::findOrFail($invoice_product_id);

        // update invoice
        $invoice = Sale::where('id',$invoiceProduct->sale_id)->first();
        $invoice->total = floatval($invoice->total)-floatval($invoiceProduct->amount);
        $invoice->subtotal =  floatval($invoice->subtotal)-floatval($invoiceProduct->amount);
        $invoice->save();

        $invoiceProduct->delete();
        return back()->withSuccess(__('Invoice product successfully deleted.'));
    }

    public function invoicePrint($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','contact','sale_products.product')->withCount('sale_products')->first();
//        return $invoice;
        return view('business.invoice_print',compact('user','institution','invoice'));
    }




    public function sales($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Sales
        $sales = Sale::where('institution_id',$institution->id)->where('is_sale',True)->with('status','contact')->get();

        return view('business.sales',compact('user','institution','sales'));
    }

    public function saleCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.sale_create',compact('user','institution','products','inventories','contacts','taxes'));
    }

    public function saleStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // Create sale
        $sale = new Sale();
        $sale->reference = $reference;
        $sale->customer_notes = $request->customer_notes;
        $sale->terms_and_conditions = $request->terms_and_conditions;
        $sale->date = date('Y-m-d', strtotime($request->date));
        $sale->due_date = date('Y-m-d', strtotime($request->due_date));
        $sale->subtotal = $request->subtotal;
        $sale->discount = $request->discount;
        $sale->total = $request->grand_total;
        $sale->refund = 0;
        $sale->is_returned = False;
        $sale->is_refunded = False;
        $sale->is_product = True;
        $sale->is_project = False;

        $sale->is_estimate = False;
        $sale->is_invoice = False;
        $sale->is_sale = True;
        $sale->is_order = False;
        // Todo impliment uploads for attachments
        $sale->has_uploads = False;
        // if paid
        if ($request->paid == "on"){
            $sale->paid = $request->grand_total;
            $sale->balance = 0;
        }else{
            $sale->paid = 0;
            $sale->balance = 0;
        }
        // Check if draft
        if ($request->is_draft == "on"){
            $sale->is_draft = True;
            $sale->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $sale->is_draft = False;
            $sale->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        // Check if draft
        if ($request->sample == "on"){
            $sale->is_sample = True;
        }else{
            $sale->is_sample = False;
        }
        $sale->contact_id = $request->contact;
        $sale->institution_id = $institution->id;
        $sale->user_id = $user->id;
        // sale tax default
        $tax = 0;
        $sale->tax = $tax;
        $sale->save();

        // record payment received
        if ($sale->paid > 0){
            $paymentReceived = new PaymentReceived();
            $paymentReceived->initial_balance = 0;
            $paymentReceived->paid = $request->grand_total;
            $paymentReceived->current_balance = 0;
            $paymentReceived->date = date('Y-m-d', strtotime(now()));
            $paymentReceived->user_id = $user->id;
            $paymentReceived->status_id = '383aaf7-a45b-4931-918f-fab3daa8a97a';
            $paymentReceived->sale_id = $sale->id;
            $paymentReceived->is_refunded = False;
            $paymentReceived->save();
        }

        // to do check if its a service or a product
        // Invoice products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id',$inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }

            // Check if product has taxes
            $taxes = ProductTax::where('product_id',$product_id)->with('tax')->get();
            if ($taxes){
                foreach ($taxes as $product_tax){
                    $product_tax_value = doubleval($product_tax->tax->amount) * 0.01 * $item['amount'];
                    $tax = doubleval($tax) + doubleval($product_tax_value);
                }
            }

            $saleProduct =  new SaleProduct();
            $saleProduct->rate = $item['rate'];
            $saleProduct->quantity = $item['quantity'];
            $saleProduct->amount = $item['amount'];
            $saleProduct->sale_id = $sale->id;
            $saleProduct->refund_amount = 0;
            $saleProduct->warehouse_id = $warehouse_id;
            $saleProduct->is_product = True;
            $saleProduct->is_refunded = False;
            $saleProduct->is_returned = False;
            $saleProduct->product_id = $product_id;
            $saleProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $saleProduct->user_id = $user->id;
            $saleProduct->save();
        }

        // Set sale tax
        $saleTaxSet = Sale::findOrFail($sale->id);
        $saleTaxSet->tax = $tax;
        $saleTaxSet->save();

        return redirect()->route('business.sale.show',['portal'=>$institution->portal,'id'=>$sale->id])->withSuccess(__('Sale successfully created.'));
    }

    public function saleShow($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead',False)->with('organization','title')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get sale
        $sale = Sale::where('institution_id',$institution->id)->where('id',$sale_id)->with('status','user','contact','sale_products.product.product_taxes','payments_received.status')->withCount('sale_products')->first();
        // payments
        $payments = Payment::where('sale_id',$sale->id)->with('user','status','account')->get();
        return view('business.sale_show',compact('user','institution','sale','payments'));
    }

    public function salePrint($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id',$invoice_id)->with('status','user','contact','sale_products.product')->withCount('sale_products')->first();
//        return $sale;
        return view('business.sale_print',compact('user','institution','sale'));
    }

    public function salePaymentCreate($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // sales
        $sale = Sale::where('id',$sale_id)->first();
        return view('business.sale_payment_create',compact('user','institution','accounts','sale'));
    }

    public function saleEdit($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.sale_show',compact('user','institution'));
    }

    public function saleUpdate($portal, $sale_id)
    {
        return back()->withSuccess(__('Order successfully updated.'));
    }

    public function saleDelete($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return back()->withSuccess(__('Sale successfully deleted.'));
    }

    public function saleProductDelete($portal, $sale_product_id)
    {
//        return $sale_product_id;
        $saleProduct = SaleProduct::findOrFail($sale_product_id);

        // update sale
        $sale = Sale::where('id',$saleProduct->sale_id)->first();
        $sale->total = floatval($sale->total)-floatval($saleProduct->amount);
        $sale->subtotal =  floatval($sale->subtotal)-floatval($saleProduct->amount);
        $sale->save();

        $saleProduct->delete();
        return back()->withSuccess(__('Sale product successfully deleted.'));
    }

    public function saleRecordPayment(Request $request, $portal, $sale_id)
    {

        // User
        $user = $this->getUser();
        // Check if sale exists
        $sale = Sale::findOrFail($sale_id);
        // Get amount paid
        $paid = PaymentReceived::where('sale_id', $sale->id)->sum('paid');
        // record payment received
        $paymentReceived = new PaymentReceived();
        $paymentReceived->initial_balance = floatval($sale->total) - floatval($paid);
        $paymentReceived->paid = $request->amount;
        $paymentReceived->current_balance = floatval($sale->total) - floatval($paid) - floatval($request->amount);
        $paymentReceived->date = date('Y-m-d', strtotime(now()));
        $paymentReceived->date_refunded = date('Y-m-d', strtotime(now()));
        $paymentReceived->user_id = $user->id;
        $paymentReceived->status_id = '383aaf7-a45b-4931-918f-fab3daa8a97a';
        $paymentReceived->sale_id = $sale->id;
        $paymentReceived->is_refunded = False;
        $paymentReceived->save();

        return back()->withSuccess(__('Sale payment successfully registered.'));
    }

    public function saleRecordPaymentRefund(Request $request, $portal, $payment_received_id)
    {

        // User
        $user = $this->getUser();
        // Check if sale exists
        $paymentReceived = PaymentReceived::findOrFail($payment_received_id);
        $paymentReceived->refunded = $request->amount;
        $paymentReceived->date_refunded = date('Y-m-d', strtotime(now()));
        $paymentReceived->user_id = $user->id;
        $paymentReceived->status_id = '276b2772-7230-4f83-bbd7-ec45e3da2ae4';
        $paymentReceived->is_refunded = True;
        $paymentReceived->save();

        return back()->withSuccess(__('Sale product successfully refunded.'));
    }


    public function paymentsReceived($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // Get received payments
        $saleIds = Sale::where('institution_id',$institution->id)->select('id')->get()->toArray();
        if ($saleIds){
            $paymentsReceived = PaymentReceived::where('sale_id',$saleIds)->with('sale','status','user')->get();
        }
        else{
            $paymentsReceived = [];
        }

        return view('business.payments_received',compact('user','institution','paymentsReceived'));
    }

    public function paymentsReceivedStore(Request $request, $portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if sale exists
        $sale = Sale::findOrFail($sale_id);

        $balance = doubleval($sale->total)- doubleval($institution->sales->payment_received->sum('paid'));

        // Create payment received record
        $payment_received = new PaymentReceived();
        $payment_received->initial_balance = $balance;
        $payment_received->paid = $request->amount;
        $payment_received->current_balance = doubleval($balance)-doubleval($request->amount);
        $payment_received->user_id = $user->id;
        $payment_received->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $payment_received->sale_id = $sale->id;
        $payment_received->save();

        // If wasn't paid
        if ($sale->is_paid == 0)
        {
            $sale->is_paid = True;
        }
        // If completely paid off
        elseif ($sale->is_paid == 0 && doubleval($sale->total) == doubleval($request->amount)){
            $sale->is_paid = True;
            $sale->is_cleared = True;
        }
        elseif ($sale->is_paid == 1 && doubleval($balance) == doubleval($request->amount)){
            $sale->is_paid = True;
            $sale->is_cleared = True;
        }
        $sale->save();

        return back()->withSuccess(__('Payment successfully received.'));
    }

}
