<?php

namespace App\Http\Controllers\Business;

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

class SaleController extends Controller
{

    use UserTrait;
    use InstitutionTrait;
    use ReferenceNumberTrait;

    public function clients()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get individual clients
        $individualContacts = Contact::where('institution_id',$institution->id)->where('is_customer',True)->where('is_business',False)->with('billing_address','shipping_address','status','user')->get();
        // Get company clients
        $businessContacts = Contact::where('institution_id',$institution->id)->where('is_customer',True)->where('is_business',True)->with('billing_address','shipping_address','status','user')->get();

        return view('business.clients',compact('user','institution','individualContacts','businessContacts'));
    }

    public function clientCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Payment terms
        $paymentTerms = PaymentTerm::where('institution_id',$institution->id)->get();

        return view('business.client_create',compact('user','institution','paymentTerms'));
    }

    public function clientStore(Request $request)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // Billing Address
        $billingAddress = new Address();
        $billingAddress->attention = $request->attention;
        $billingAddress->street = $request->billing_street;
        $billingAddress->town = $request->billing_town;
        $billingAddress->po_box = $request->billing_po_box;
        $billingAddress->postal_code = $request->billing_postal_code;
        $billingAddress->address_line_1 = $request->billing_address_line_1;
        $billingAddress->address_line_2 = $request->billing_address_line_2;
        $billingAddress->email = $request->billing_email;
        $billingAddress->phone_number = $request->billing_phone_number;
        $billingAddress->user_id = $user->id;
        $billingAddress->address_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        $billingAddress->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $billingAddress->save();


        // Shipping address
        $shippingAddress = new Address();
        $shippingAddress->attention = $request->attention;
        $shippingAddress->street = $request->shipping_street;
        $shippingAddress->town = $request->shipping_town;
        $shippingAddress->po_box = $request->shipping_po_box;
        $shippingAddress->postal_code = $request->shipping_postal_code;
        $shippingAddress->address_line_1 = $request->shipping_address_line_1;
        $shippingAddress->address_line_2 = $request->shipping_address_line_2;
        $shippingAddress->email = $request->shipping_email;
        $shippingAddress->phone_number = $request->shipping_phone_number;
        $shippingAddress->user_id = $user->id;
        $shippingAddress->address_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
        $shippingAddress->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $shippingAddress->save();

        // Register client
        $client = new Contact();
        if ($request->customer_type == "individual")
        {
            $client->is_business = False;
        }elseif ($request->customer_type == "business")
        {
            $client->is_business = True;
        }
        $client->is_customer = True;
        // $client->salutation_id = $request->salutation;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->company_name = $request->company_name;
        $client->email = $request->email;
        $client->phone_number = $request->phone_number;
        $client->opening_balance = $request->opening_balance;
        $client->balance = $request->opening_balance;
        $client->website = $request->website;
        $client->payment_term_id = $request->payment_term;
        $client->shipping_address_id = $shippingAddress->id;
        $client->billing_address_id = $billingAddress->id;
        $client->user_id = $user->id;
        $client->institution_id = $institution->id;
        $client->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $client->save();

        return redirect()->route('business.clients')->withSuccess(__('Client successfully created.'));
    }

    public function clientShow($client_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.client_show',compact('user','institution'));
    }

    public function clientContactPersonShow($contact_person_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.client_contact_person_show',compact('user','institution'));
    }

    public function clientContactPersonMessage($contact_person_id)
    {
        return back()->withSuccess(__('Message sent to .'));
    }

    public function clientEdit()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.client_edit',compact('user','institution'));
    }

    public function clientUpdate(Request $request, $client_id)
    {
        return back()->withSuccess(__('Client successfully updated.'));
    }

    public function clientDelete($client_id)
    {
        return back()->withSuccess(__('Client successfully deleted.'));
    }


    public function estimates()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Estimates
        $estimates = Sale::where('institution_id',$institution->id)->where('is_estimate',True)->with('status','customer')->get();

//        return $estimates;

        return view('business.estimates',compact('user','institution','estimates'));
    }

    public function estimateCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.estimate_create',compact('user','institution','customers','taxes','inventories','products'));
    }

    public function estimateStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

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
        $estimate->is_returned = False;
        $estimate->is_refunded = False;
        $estimate->is_product = True;
        $estimate->is_project = False;

        $estimate->is_estimate = True;
        $estimate->is_invoice = False;
        $estimate->is_order = False;
        $estimate->is_sale = False;
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
        $estimate->customer_id = $request->customer;
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

        return redirect()->route('business.estimate.show',$estimate->id)->withSuccess(__('Estimate successfully created.'));
    }

    public function estimateShow($estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','customer','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.estimate_show',compact('user','institution','estimate'));
    }

    public function estimateEdit($estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','customer','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.estimate_edit',compact('user','institution','customers','products','inventories','estimate'));
    }

    public function estimateUpdate(Request $request, $estimate_id)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Create estimate
        $estimate = Sale::where('id',$estimate_id)->first();
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
        $estimate->customer_id = $request->customer;
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

    public function estimateConvertToInvoice($estimate_id)
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

    public function estimateDelete($estimate_id)
    {
        return back()->withSuccess(__('Estimate successfully deleted.'));
    }

    public function estimateProductDelete($estimate_product_id)
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

    public function estimatePrint($estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get estimate
        $estimate = Sale::where('id',$estimate_id)->with('status','user','customer.billing_address','sale_products.product')->withCount('sale_products')->first();
//        return $estimate;
        return view('business.estimate_print',compact('user','institution','estimate'));
    }



    public function invoices()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Invoices
        $invoices = Sale::where('institution_id',$institution->id)->where('is_invoice',True)->with('status','customer')->get();

        return view('business.invoices',compact('user','institution','invoices'));
    }

    public function invoiceCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.invoice_create',compact('user','institution','products','inventories','customers','taxes'));
    }

    public function invoiceStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

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
        $invoice->is_returned = False;
        $invoice->is_refunded = False;
        $invoice->is_product = True;
        $invoice->is_project = False;

        $invoice->is_estimate = False;
        $invoice->is_invoice = True;
        $invoice->is_order = False;
        $invoice->is_sale = False;
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
        $invoice->customer_id = $request->customer;
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

        return redirect()->route('business.invoice.show',$invoice->id)->withSuccess(__('Invoice successfully created.'));
    }

    public function invoiceShow($invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','customer','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.invoice_show',compact('user','institution','invoice'));
    }

    public function invoiceEdit($invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','customer','sale_products.product.product_taxes')->withCount('sale_products')->first();

        return view('business.invoice_edit',compact('user','institution','customers','products','inventories','invoice'));
    }

    public function invoiceUpdate(Request $request, $invoice_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
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
        $invoice->customer_id = $request->customer;
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

    public function invoiceConvertToSale($invoice_id)
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

    public function invoiceDelete($invoice_id)
    {
        return back()->withSuccess(__('Invoice successfully deleted.'));
    }

    public function invoiceProductDelete($invoice_product_id)
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

    public function invoicePrint($invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get invoice
        $invoice = Sale::where('id',$invoice_id)->with('status','user','customer.billing_address','sale_products.product')->withCount('sale_products')->first();
//        return $invoice;
        return view('business.invoice_print',compact('user','institution','invoice'));
    }




    public function orders()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Orders
        $orders = Sale::where('institution_id',$institution->id)->where('is_order',True)->with('status','customer')->get();

        return view('business.orders',compact('user','institution','orders'));
    }

    public function orderCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();
        // Get Inventory
        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.order_create',compact('user','institution','inventories','products'));
    }

    public function orderStore()
    {
        return back()->withSuccess(__('Order successfully created.'));
    }

    public function orderShow($order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.order_show',compact('user','institution'));
    }

    public function orderEdit($order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.order_edit',compact('user','institution'));
    }

    public function orderUpdate($order_id)
    {
        return back()->withSuccess(__('Order successfully updated.'));
    }

    public function orderDelete($order_id)
    {
        return back()->withSuccess(__('Order successfully deleted.'));
    }

    public function orderPrint($order_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.order_print',compact('user','institution'));
    }


    public function sales()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Sales
        $sales = Sale::where('institution_id',$institution->id)->where('is_sale',True)->with('status','customer')->get();

        return view('business.sales',compact('user','institution','sales'));
    }

    public function saleCreate()
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();

        return view('business.sale_create',compact('user','institution','products','inventories','customers','taxes'));
    }

    public function saleStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

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
        $sale->is_order = False;
        $sale->is_sale = True;
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
        $sale->customer_id = $request->customer;
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

        return redirect()->route('business.sale.show',$sale->id)->withSuccess(__('Sale successfully created.'));
    }

    public function saleShow($sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get customers
        $customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting taxes
        $taxes = Tax::where('institution_id',$institution->id)->get();
        // Get Inventory
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();
        // Get sale
        $sale = Sale::where('id',$sale_id)->with('status','user','customer','sale_products.product.product_taxes','payments_received.status')->withCount('sale_products')->first();

        return view('business.sale_show',compact('user','institution','sale'));
    }

    public function saleEdit($sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.sale_show',compact('user','institution'));
    }

    public function saleUpdate($sale_id)
    {
        return back()->withSuccess(__('Order successfully updated.'));
    }

    public function saleDelete($sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return back()->withSuccess(__('Sale successfully deleted.'));
    }

    public function saleProductDelete($sale_product_id)
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

    public function saleRecordPayment(Request $request, $sale_id)
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

    public function saleRecordPaymentRefund(Request $request, $payment_received_id)
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


    public function paymentsReceived()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

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

    public function paymentsReceivedStore(Request $request, $sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
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
