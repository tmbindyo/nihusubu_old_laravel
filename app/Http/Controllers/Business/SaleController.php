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
use App\Salutation;
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
        $individualContacts = Contact::where('institution_id',$institution->id)->where('is_customer',True)->where('is_business',False)->with('billing_address','shipping_address','salutation','status','user')->get();
        // Get company clients
        $businessContacts = Contact::where('institution_id',$institution->id)->where('is_customer',True)->where('is_business',True)->with('billing_address','shipping_address','salutation','status','user')->get();

        return view('business.clients',compact('user','institution','individualContacts','businessContacts'));
    }
    public function clientCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        //Salutation
        $salutations = Salutation::get();
        // Payment terms
        $paymentTerms = PaymentTerm::where('institution_id',$institution->id)->get();

        return view('business.client_create',compact('user','institution','salutations','paymentTerms'));
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
        $client->salutation_id = $request->salutation;
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

        return redirect()->route('business.estimates')->withSuccess(__('Estimate successfully created.'));
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
        }

        // Parse the deleted album tags into an array
        $estimateProductsIds = SaleProduct::where('sale_id',$estimate->id)->whereNotIn('product_id',$estimateProducts)->select('id')->get()->toArray();

//        return $estimateProductsIds;

        // Delete removed album tags
        DB::table('sale_products')->whereIn('id', $estimateProductsIds)->delete();

        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($estimate->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->save();

        return back()->withSuccess(__('Estimate successfully updated.'));
    }
    public function estimateDelete($estimate_id)
    {
        return back()->withSuccess(__('Estimate successfully deleted.'));
    }
    public function estimateProductDelete($estimate_product_id)
    {
        $estimateProduct = EstimateProduct::findOrFail($estimate_product_id);
        // update estimate
        $estimate = Estimate::where('id',$estimateProduct->estimate_id)->first();
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
        $estimate = Estimate::where('id',$estimate_id)->with('status','user','customer','estimate_products.product')->withCount('estimate_products')->first();

        return view('business.estimate_print',compact('user','institution','estimate'));
    }



    public function invoices()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Invoices
        $invoices = Invoice::where('institution_id',$institution->id)->with('status','customer')->get();

        return view('business.invoices',compact('user','institution','invoices'));
    }
    public function invoiceCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();$customers = Contact::where('institution_id',$institution->id)->where('is_customer',True)->with('billing_address','shipping_address')->get();
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();
        // Get Inventory
        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product','warehouse')->get();


        return view('business.invoice_create',compact('user','institution','products','inventories'));
    }
    public function invoiceStore()
    {
        return back()->withSuccess(__('Invoice successfully created.'));
    }
    public function invoiceShow($invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.invoice',compact('user','institution'));
    }
    public function invoiceEdit($invoice_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.invoice',compact('user','institution'));
    }
    public function invoiceUpdate($invoice_id)
    {
        return back()->withSuccess(__('Invoice successfully updated.'));
    }
    public function invoiceDelete($invoice_id)
    {
        return back()->withSuccess(__('Invoice successfully deleted.'));
    }
    public function invoicePrint()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.invoice_print',compact('user','institution'));
    }




    public function orders()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Orders
        $orders = Order::where('institution_id',$institution->id)->with('status','customer')->get();

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
        $sales = Sale::where('institution_id',$institution->id)->with('status','customer')->get();

        return view('business.sales',compact('user','institution','sales'));
    }
    public function saleCreate()
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

        return view('business.sale_create',compact('user','institution','products','inventories'));
    }
    public function saleStore()
    {
        return back()->withSuccess(__('Sale successfully created.'));
    }
    public function saleShow($sale_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.sale_show',compact('user','institution'));
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


    public function paymentsReceived()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get received payments
        $paymentsReceived = PaymentReceived::where('institution_id',$institution->id)->with('sale','status','user')->get();

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
