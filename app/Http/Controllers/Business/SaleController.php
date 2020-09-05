<?php

namespace App\Http\Controllers\Business;

use App\Account;
use App\Mail\OrderSummary;
use App\Mail\SendSaleEmail;
use App\PaymentSchedule;
use App\SaleEmail;
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
use Illuminate\Support\Facades\Mail;

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
        $estimates = Sale::where('institution_id', $institution->id)->where('is_estimate', true)->with('status', 'contact')->get();

//        return $estimates;

        return view('business.estimates', compact('user', 'institution', 'estimates'));
    }

    public function estimateCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        // Get Inventory
        $inventories = Inventory::with('product', 'warehouse')->get();

        return view('business.estimate_create', compact('user', 'institution', 'contacts', 'taxes', 'inventories', 'products', 'paymentSchedules'));
    }

    public function estimateStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Generate reference
        if($institution->is_sale_random){
            $size = 5;
            $reference = $this->getRandomString($size);
        }else{
            // get institution sale count
            $saleCount = Sale::where('institution_id',$institution->id)->count();
            $reference = $institution->sale_format + $saleCount;
        }
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
        $estimate->is_returned = false;
        $estimate->is_refunded = false;
        $estimate->is_product = true;
        $estimate->is_project = false;
        $estimate->is_estimate = true;
        $estimate->is_invoice = false;
        $estimate->is_sale = false;
        $estimate->is_order = false;
        $estimate->is_sample = false;
        // Todo impliment uploads for attachments
        $estimate->has_uploads = false;
        // Check if draft
        if ($request->is_draft == "on"){
            $estimate->is_draft = true;
            $estimate->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $estimate->is_draft = false;
            $estimate->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $estimate->payment_schedule_id = $request->payment_schedule;
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
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax = doubleval($tax) + doubleval($estimateSaleProduct->tax_amount);
            // Estimate products
            $estimateProduct =  new SaleProduct();
            $estimateProduct->rate = $item['rate'];
            $estimateProduct->quantity = $item['quantity'];
            $estimateProduct->amount = $item['amount'];
            $estimateProduct->sale_id = $estimate->id;
            $estimateProduct->refund_amount = 0;
            $estimateProduct->warehouse_id = $warehouse_id;
            $estimateProduct->is_product = true;
            $estimateProduct->is_refunded = false;
            $estimateProduct->is_returned = false;
            $estimateProduct->product_id = $product_id;
            $estimateProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $estimateProduct->user_id = $user->id;
            $estimateProduct->save();
        }
        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($estimate->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->subtotal = $estimateTaxSet->total-$tax;
        $estimateTaxSet->save();

//        return $estimateTaxSet;

        return redirect()->route('business.estimate.show',['portal'=>$institution->portal, 'id'=>$estimate->id])->withSuccess(__('Estimate successfully created.'));
    }

    public function estimateShow($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get estimate
        $estimate = Sale::where('id', $estimate_id)->with('status', 'user', 'contact.organization', 'saleProducts.product.productTaxes')->withCount('saleProducts')->first();

        return view('business.estimate_show', compact('user', 'institution', 'estimate'));
    }

    public function estimateEdit($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();
        // Get estimate
        $estimate = Sale::where('id', $estimate_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes')->withCount('saleProducts')->first();

        return view('business.estimate_edit', compact('user', 'institution', 'contacts', 'products', 'inventories', 'estimate', 'paymentSchedules'));
    }

    public function estimateUpdate(Request $request, $portal, $estimate_id)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create estimate
        $estimate = Sale::where('institution_id', $institution->id)->where('id', $estimate_id)->first();
        $estimate->customer_notes = $request->customer_notes;
        $estimate->terms_and_conditions = $request->terms_and_conditions;
        $estimate->date = date('Y-m-d', strtotime($request->date));
        $estimate->due_date = date('Y-m-d', strtotime($request->due_date));
        $estimate->subtotal = $request->subtotal;
        $estimate->discount = $request->discount;
        $estimate->total = $request->grand_total;
        $estimate->payment_schedule_id = $request->payment_schedule;


        // Todo impliment uploads for attachments
        $estimate->has_uploads = false;
        // Check if draft
        if ($request->is_draft == "on"){
            $estimate->is_draft = true;
            $estimate->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $estimate->is_draft = false;
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
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            $estimateProducts[]['id'] = $product_id;

            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax = doubleval($tax) + doubleval($estimateSaleProduct->tax_amount);

            // Check if sale product exists
            $saleProductExists = SaleProduct::where('sale_id', $estimate->id)->where('product_id', $product_id)->first();

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
            }else{
                $estimateProduct = SaleProduct::where('id',$saleProductExists->id)->first();
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
        $estimateProductsIds = SaleProduct::where('sale_id', $estimate->id)->whereNotIn('product_id', $estimateProducts)->select('id')->get()->toArray();

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $estimateProductsIds)->delete();

        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($estimate->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->subtotal = $estimateTaxSet->total-$tax;
        $estimateTaxSet->save();

        return redirect()->route('business.estimate.show',['portal'=>$institution->portal, 'id'=>$estimate->id])->withSuccess(__('Estimate '.$estimate->reference.' successfully updated.'));
    }

    public function estimateConvertToInvoice($portal, $estimate_id)
    {

        // User
        $user = $this->getUser();

        // Create estimate
        $estimate = Sale::where('id', $estimate_id)->first();
        $estimate->is_invoice = true;
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
        $estimate = Sale::where('id', $estimateProduct->sale_id)->first();
        $estimate->total = floatval($estimate->total)-floatval($estimateProduct->amount);
        $estimate->subtotal =  floatval($estimate->subtotal)-floatval($estimateProduct->amount);
        $estimate->save();

        $estimateProduct->delete();
        return back()->withSuccess(__('Estimate product successfully deleted.'));
    }

    public function estimateCompose($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        return view('business.estimate_send', compact('user', 'institution', 'sale'));

    }

    public function estimateSend(Request $request, $portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        $saleEmail = new SaleEmail();
        $saleEmail->to = $request->email;
        $saleEmail->subject = $request->subject;
        $saleEmail->body = $request->body;
        $saleEmail->user_id = $user->id;
        $saleEmail->sale_id = $sale->id;
        $saleEmail->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $saleEmail->save();
        $saleEmailDetails = SaleEmail::where('id',$saleEmail->id)->with('sale.saleProducts', 'sale.institution.currency')->first();
//        return $saleEmailDetails;

        // send email
        Mail::to($request->email)->send(new SendSaleEmail($saleEmailDetails));

        return redirect()->route('business.estimate.show',['portal'=>$institution->portal, 'id'=>$sale->id])->withSuccess(__('Estimate '.$sale->reference.' successfully sent to '.$request->email.'.'));

    }

    public function estimatePrint($portal, $estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get estimate
        $estimate = Sale::where('id', $estimate_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
//        return $estimate;
        return view('business.estimate_print', compact('user', 'institution', 'estimate'));
    }



    public function invoices($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Invoices
        $invoices = Sale::where('institution_id', $institution->id)->where('is_invoice', true)->with('status', 'contact')->get();

        return view('business.invoices', compact('user', 'institution', 'invoices'));
    }

    public function invoiceCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();

        return view('business.invoice_create', compact('user', 'institution', 'products', 'inventories', 'contacts', 'taxes', 'paymentSchedules'));
    }

    public function invoiceStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        if($institution->is_sale_random){
            $size = 5;
            $reference = $this->getRandomString($size);
        }else{
            // get institution sale count
            $saleCount = Sale::where('institution_id',$institution->id)->count();
            $reference = $institution->sale_format + $saleCount;
        }

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
        $invoice->is_returned = false;
        $invoice->is_refunded = false;
        $invoice->is_product = true;
        $invoice->is_project = false;

        $invoice->is_estimate = false;
        $invoice->is_invoice = true;
        $invoice->is_sale = false;
        $invoice->is_order = false;
        $invoice->is_sample = false;
        // Todo impliment uploads for attachments
        $invoice->has_uploads = false;
        // Check if draft
        if ($request->is_draft == "on"){
            $invoice->is_draft = true;
            $invoice->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $invoice->is_draft = false;
            $invoice->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $invoice->contact_id = $request->contact;
        $invoice->payment_schedule_id = $request->payment_schedule;
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
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }

            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax = doubleval($tax) + doubleval($estimateSaleProduct->tax_amount);

            $invoiceProduct =  new SaleProduct();
            $invoiceProduct->rate = $item['rate'];
            $invoiceProduct->quantity = $item['quantity'];
            $invoiceProduct->amount = $item['amount'];
            $invoiceProduct->sale_id = $invoice->id;
            $invoiceProduct->refund_amount = 0;
            $invoiceProduct->warehouse_id = $warehouse_id;
            $invoiceProduct->is_product = true;
            $invoiceProduct->is_refunded = false;
            $invoiceProduct->is_returned = false;
            $invoiceProduct->product_id = $product_id;
            $invoiceProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $invoiceProduct->user_id = $user->id;
            $invoiceProduct->save();
        }

        // Set invoice tax
        $invoiceTaxSet = Sale::findOrFail($invoice->id);
        $invoiceTaxSet->tax = $tax;
        $invoiceTaxSet->subtotal = $invoiceTaxSet->total-$tax;
        $invoiceTaxSet->save();

        return redirect()->route('business.invoice.show',['portal'=>$institution->portal, 'id'=>$invoice->id])->withSuccess(__('Invoice successfully created.'));
    }

    public function invoiceShow($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get invoice
        $invoice = Sale::where('id', $invoice_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes')->withCount('saleProducts')->first();

        return view('business.invoice_show', compact('user', 'institution', 'invoice'));
    }

    public function invoiceEdit($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();
        // Get invoice
        $invoice = Sale::where('id', $invoice_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes')->withCount('saleProducts')->first();

        return view('business.invoice_edit', compact('user', 'institution', 'contacts', 'products', 'inventories', 'invoice', 'paymentSchedules'));
    }

    public function invoiceUpdate(Request $request, $portal, $invoice_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create invoice
        $invoice = Sale::where('id', $invoice_id)->first();
        $invoice->customer_notes = $request->customer_notes;
        $invoice->terms_and_conditions = $request->terms_and_conditions;
        $invoice->date = date('Y-m-d', strtotime($request->date));
        $invoice->due_date = date('Y-m-d', strtotime($request->due_date));
        $invoice->subtotal = $request->subtotal;
        $invoice->discount = $request->discount;
        $invoice->total = $request->grand_total;
        $invoice->payment_schedule_id = $request->payment_schedule;


        // Todo impliment uploads for attachments
        $invoice->has_uploads = false;
        // Check if draft
        if ($request->is_draft == "on"){
            $invoice->is_draft = true;
            $invoice->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $invoice->is_draft = false;
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
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            $invoiceProducts[]['id'] = $product_id;

            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax += doubleval($estimateSaleProduct->tax_amount);

            // Check if album tag exists
            $saleProductExists = SaleProduct::where('sale_id', $invoice->id)->where('product_id', $product_id)->first();

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
            }else{
                $invoiceProduct = SaleProduct::where('id',$saleProductExists->id)->first();
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
        $invoiceProductsIds = SaleProduct::where('sale_id', $invoice->id)->whereNotIn('product_id', $invoiceProducts)->select('id')->get()->toArray();

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $invoiceProductsIds)->delete();

        // Set invoice tax
        $invoiceTaxSet = Sale::findOrFail($invoice->id);
        $invoiceTaxSet->tax = $tax;
        $invoiceTaxSet->subtotal = $invoiceTaxSet->total-$tax;
        $invoiceTaxSet->save();

        return redirect()->route('business.invoice.show',['portal'=>$institution->portal, 'id'=>$invoice->id])->withSuccess(__('Invoice '.$invoice->reference.' successfully updated.'));

    }

    public function invoiceConvertToSale($portal, $invoice_id)
    {

        // User
        $user = $this->getUser();

        // Create invoice
        $invoice = Sale::where('id', $invoice_id)->first();
        $invoice->is_sale = true;
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
        $invoice = Sale::where('id', $invoiceProduct->sale_id)->first();
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
        $invoice = Sale::where('id', $invoice_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
//        return $invoice;
        return view('business.invoice_print', compact('user', 'institution', 'invoice'));
    }

    public function invoiceCompose($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        return view('business.invoice_send', compact('user', 'institution', 'sale'));

    }

    public function invoiceSend(Request $request, $portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        $saleEmail = new SaleEmail();
        $saleEmail->to = $request->email;
        $saleEmail->subject = $request->subject;
        $saleEmail->body = $request->body;
        $saleEmail->user_id = $user->id;
        $saleEmail->sale_id = $sale->id;
        $saleEmail->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $saleEmail->save();
        $saleEmailDetails = SaleEmail::where('id',$saleEmail->id)->with('sale.saleProducts', 'sale.institution.currency')->first();
//        return $saleEmailDetails;

        // send email
        Mail::to($request->email)->send(new SendSaleEmail($saleEmailDetails));

        return redirect()->route('business.invoice.show',['portal'=>$institution->portal, 'id'=>$sale->id])->withSuccess(__('Invoice '.$sale->reference.' successfully sent to '.$request->email.'.'));

    }


    public function sales($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Sales
        $sales = Sale::where('institution_id', $institution->id)->where('is_sale', true)->with('status', 'contact')->get();

        return view('business.sales', compact('user', 'institution', 'sales'));
    }

    public function saleCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();

        return view('business.sale_create', compact('user', 'institution', 'products', 'inventories', 'contacts', 'taxes', 'paymentSchedules'));
    }

    public function saleStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        if($institution->is_sale_random){
            $size = 5;
            $reference = $this->getRandomString($size);
        }else{
            // get institution sale count
            $saleCount = Sale::where('institution_id',$institution->id)->count();
            $reference = $institution->sale_format + $saleCount;
        }

        // Generate reference


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
        $sale->is_returned = false;
        $sale->is_refunded = false;
        $sale->is_product = true;
        $sale->is_project = false;

        $sale->is_estimate = false;
        $sale->is_invoice = false;
        $sale->is_sale = true;
        $sale->is_order = false;
        // Todo impliment uploads for attachments
        $sale->has_uploads = false;
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
            $sale->is_draft = true;
            $sale->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $sale->is_draft = false;
            $sale->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        // Check if draft
        if ($request->sample == "on"){
            $sale->is_sample = true;
        }else{
            $sale->is_sample = false;
        }
        $sale->payment_schedule_id = $request->payment_schedule;
        $sale->contact_id = $request->contact;
        $sale->institution_id = $institution->id;
        $sale->user_id = $user->id;
        // sale tax default
        $tax = 0;
        $sale->tax = $tax;
        $sale->save();

        // get payment schedule
        $paymentSchedule = PaymentSchedule::where('id',$request->payment_schedule)->first();

        if($paymentSchedule){
            // create record for future payment?
        }else{
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
                $paymentReceived->is_refunded = false;
                $paymentReceived->save();
            }
            // if inventory deduct
        }



        // to do check if its a service or a product
        // Invoice products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }

            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax = doubleval($tax) + doubleval($estimateSaleProduct->tax_amount);

            $saleProduct =  new SaleProduct();
            $saleProduct->rate = $item['rate'];
            $saleProduct->quantity = $item['quantity'];
            $saleProduct->amount = $item['amount'];
            $saleProduct->sale_id = $sale->id;
            $saleProduct->refund_amount = 0;
            $saleProduct->warehouse_id = $warehouse_id;
            $saleProduct->is_product = true;
            $saleProduct->is_refunded = false;
            $saleProduct->is_returned = false;
            $saleProduct->product_id = $product_id;
            $saleProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $saleProduct->user_id = $user->id;
            $saleProduct->save();

            // check if product is inventory
            $product = Product::findOrFail($product_id);
            // deduct sales
            if ($request->is_paid && $product->is_inventory == true){
                $inventoryRecord = Inventory::where('product_id',$product_id)->where('warehouse_id',$warehouse_id)->first();
                // deduct
                $productAmount = $inventoryRecord->quantity;
                $remainingInventory = $productAmount-$item['amount'];
                $inventoryRecord->quantity = $remainingInventory;
                $inventoryRecord->save();
            }
        }

        // Set sale tax
        $saleTaxSet = Sale::findOrFail($sale->id);
        $saleTaxSet->tax = $tax;
        $saleTaxSet->subtotal = $saleTaxSet->total-$tax;
        $saleTaxSet->save();

        return redirect()->route('business.sale.show',['portal'=>$institution->portal, 'id'=>$sale->id])->withSuccess(__('Sale successfully created.'));
    }

    public function saleShow($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('institution_id', $institution->id)->where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes', 'paymentsReceived.status', 'payments')->withCount('saleProducts')->first();
        return view('business.sale_show', compact('user', 'institution', 'sale'));
    }

    public function salePrint($portal, $invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // return $institution;
        // Get sale
        $sale = Sale::where('id', $invoice_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
//        return $sale;
        return view('business.sale_print', compact('user', 'institution', 'sale'));

    }

    public function saleCompose($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        return view('business.sale_send', compact('user', 'institution', 'sale'));

    }

    public function saleSend(Request $request, $portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get sale
        $sale = Sale::where('id', $sale_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
        $saleEmail = new SaleEmail();
        $saleEmail->to = $request->email;
        $saleEmail->subject = $request->subject;
        $saleEmail->body = $request->body;
        $saleEmail->user_id = $user->id;
        $saleEmail->sale_id = $sale->id;
        $saleEmail->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $saleEmail->save();
        $saleEmailDetails = SaleEmail::where('id',$saleEmail->id)->with('sale.saleProducts', 'sale.institution.currency')->first();
//        return $saleEmailDetails;

        // send email
        Mail::to($request->email)->send(new SendSaleEmail($saleEmailDetails));

        return redirect()->route('business.sale.show',['portal'=>$institution->portal, 'id'=>$sale->id])->withSuccess(__('Sale '.$sale->reference.' successfully sent to '.$request->body.'.'));

    }

    public function salePaymentCreate($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // sales
        $sale = Sale::where('id', $sale_id)->first();
        return view('business.sale_payment_create', compact('user', 'institution', 'accounts', 'sale'));
    }

    public function saleEdit($portal, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.sale_show', compact('user', 'institution'));
    }

    public function saleUpdate($portal, $sale_id)
    {
        return back()->withSuccess(__('Sale successfully updated.'));
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
        $sale = Sale::where('id', $saleProduct->sale_id)->first();
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
        $paymentReceived->is_refunded = false;
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
        $paymentReceived->is_refunded = true;
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
        $saleIds = Sale::where('institution_id', $institution->id)->select('id')->get()->toArray();
        if ($saleIds){
            $paymentsReceived = PaymentReceived::where('sale_id', $saleIds)->with('sale', 'status', 'user')->get();
        }
        else{
            $paymentsReceived = [];
        }

        return view('business.payments_received', compact('user', 'institution', 'paymentsReceived'));
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
            $sale->is_paid = true;
        }
        // If completely paid off
        elseif ($sale->is_paid == 0 && doubleval($sale->total) == doubleval($request->amount)){
            $sale->is_paid = true;
            $sale->is_cleared = true;
        }
        elseif ($sale->is_paid == 1 && doubleval($balance) == doubleval($request->amount)){
            $sale->is_paid = true;
            $sale->is_cleared = true;
        }
        $sale->save();

        return back()->withSuccess(__('Payment successfully received.'));
    }


    public function orders($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Invoices
        $orders = Sale::where('institution_id', $institution->id)->where('is_order', true)->with('status', 'contact')->get();

        return view('business.orders', compact('user', 'institution', 'orders'));
    }

    public function orderShow($portal, $order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get order
        $order = Sale::where('id', $order_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes', 'payments')->withCount('saleProducts')->first();
        return view('business.order_show', compact('user', 'institution', 'order'));
    }

    public function orderEdit($portal, $order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id', $institution->id)->where('is_product_group',false)->where('is_item',false)->with('inventory.warehouse')->get();

        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id','c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->orderBy('period')->get();
        $productIds = Product::where('institution_id', $institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();
        // Get order
        $order = Sale::where('id', $order_id)->with('status', 'user', 'contact', 'saleProducts.product.productTaxes')->withCount('saleProducts')->first();

        return view('business.order_edit', compact('user', 'institution', 'contacts', 'products', 'inventories', 'order', 'paymentSchedules'));
    }

    public function orderUpdate(Request $request, $portal, $order_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create order
        $order = Sale::where('id', $order_id)->first();
        $order->customer_notes = $request->customer_notes;
        $order->terms_and_conditions = $request->terms_and_conditions;
        $order->date = date('Y-m-d', strtotime($request->date));
        $order->due_date = date('Y-m-d', strtotime($request->due_date));
        $order->subtotal = $request->subtotal;
        $order->discount = $request->discount;
        $order->total = $request->grand_total;
        $order->payment_schedule_id = $request->payment_schedule;


        // Todo impliment uploads for attachments
        $order->has_uploads = false;
        // Check if draft
        if ($request->is_draft == "on"){
            $order->is_draft = true;
            $order->status_id = "14efab17-4306-449b-bfc8-3e156b872a6d";
        }else{
            $order->is_draft = false;
            $order->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        }
        $order->contact_id = $request->contact;
        $order->user_id = $user->id;
        $order->save();
        $tax = 0;


        $orderProducts =array();
        // Order products
        foreach ($request->item_details as $item) {
            $data = $item['item'];
            if (strpos($data, ':') !== false){
                list($product_id, $inventory_id,) = explode(":", $data);
                $warehouse_id = Inventory::where('id', $inventory_id)->first()->warehouse_id;
            }else{
                $product_id = $data;
                $warehouse_id = '';
            }
            $orderProducts[]['id'] = $product_id;

            // get product
            $estimateSaleProduct = Product::findOrFail($product_id);
            // get the product taxes
            $tax += doubleval($estimateSaleProduct->tax_amount);

            // Check if album tag exists
            $saleProductExists = SaleProduct::where('sale_id', $order->id)->where('product_id', $product_id)->first();

            if($saleProductExists === null) {

                $orderProduct = new SaleProduct();
                $orderProduct->rate = $item['rate'];
                $orderProduct->quantity = $item['quantity'];
                $orderProduct->amount = $item['amount'];
                $orderProduct->sale_id = $order->id;
                $orderProduct->warehouse_id = $warehouse_id;
                $orderProduct->product_id = $product_id;
                $orderProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $orderProduct->user_id = $user->id;
                $orderProduct->save();
            }else{
                $orderProduct = SaleProduct::where('id',$saleProductExists->id)->first();
                $orderProduct->rate = $item['rate'];
                $orderProduct->quantity = $item['quantity'];
                $orderProduct->amount = $item['amount'];
                $orderProduct->sale_id = $order->id;
                $orderProduct->warehouse_id = $warehouse_id;
                $orderProduct->product_id = $product_id;
                $orderProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $orderProduct->user_id = $user->id;
                $orderProduct->save();
            }
        }

        // Parse the deleted album tags into an array
        $orderProductsIds = SaleProduct::where('sale_id', $order->id)->whereNotIn('product_id', $orderProducts)->select('id')->get()->toArray();

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $orderProductsIds)->delete();

        // Set order tax
        $orderTaxSet = Sale::findOrFail($order->id);
        $orderTaxSet->tax = $tax;
        $orderTaxSet->subtotal = $orderTaxSet->total-$tax;
        $orderTaxSet->save();

        return redirect()->route('business.order.show',['portal'=>$institution->portal, 'id'=>$order->id])->withSuccess(__('Order '.$order->reference.' successfully updated.'));

    }

    public function orderDelete($portal, $order_id)
    {
        return back()->withSuccess(__('Order successfully deleted.'));
    }

    public function orderProductDelete($portal, $order_product_id)
    {
//        return $order_product_id;
        $orderProduct = SaleProduct::findOrFail($order_product_id);

        // update order
        $order = Sale::where('id', $orderProduct->sale_id)->first();
        $order->total = floatval($order->total)-floatval($orderProduct->amount);
        $order->subtotal =  floatval($order->subtotal)-floatval($orderProduct->amount);
        $order->save();

        $orderProduct->delete();
        return back()->withSuccess(__('Order product successfully deleted.'));
    }

    public function orderPrint($portal, $order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get order
        $order = Sale::where('id', $order_id)->with('status', 'user', 'contact', 'saleProducts.product')->withCount('saleProducts')->first();
//        return $order;
        return view('business.order_print', compact('user', 'institution', 'order'));
    }

}
