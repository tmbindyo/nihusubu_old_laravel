<?php

namespace App\Http\Controllers\Commerce;

use App\Address;
use App\Mail\OrderEmails;
use App\Mail\OrderSummary;
use App\PaymentReceived;
use App\Sale;
use App\SaleProduct;
use App\Traits\ReferenceNumberTrait;
use App\Traits\ViewTrait;
use Cookie;
use App\Product;
use Darryldecode\Cart\Cart;
//use http\Cookie;
use App\PriceList;
use App\Contact;
use Illuminate\Http\Request;
use App\CommerceTemplateFile;
use App\CommerceTemplateType;
use App\Traits\InstitutionTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;

class CommerceController extends Controller
{

    use ViewTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function cart (Request $request, $portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        if($institution){
            // check if institution can view this page
            // check if the template has this file
            // get the
            $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','cart')->first();

            // track user

            // Get cookie
            $cookie = $this->getCookie($request);
            // Get user cart
            $cart = \Cart::session($cookie)->getContent();
            // get user total
            $total = \Cart::session($cookie)->getSubTotal();

            return view($commerceFile->view,compact('institution', 'cart', 'total'));
        }
    }

    public function checkout (Request $request, $portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        if($institution){
            // check if institution can view this page

            // check if the template has this file

            // get the
            $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','checkout')->first();
            // get user cookie
            $cookie = $this->getCookie($request);
            // get cart
            $cart = \Cart::session($cookie)->getContent();
            // get user total
            $total = \Cart::session($cookie)->getSubTotal();

            return view($commerceFile->view,compact('institution', 'cart', 'total'));
        }
    }

    public function index (Request $request, $portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        if($institution){
            // check if institution can view this page

            // check if the template has this file

            // get the commerce file
            $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','index')->first();
            // get institution products
            $products = Product::where('institution_id',$institution->id)->where('is_product_group_child',false)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'saleProducts', 'user', 'inventoryAdjustmentProducts', 'transferOrderProducts', 'productImages.upload', 'productGroupProducts', 'productGroupProductMax', 'productGroupProductMin')->take(9)->get();
            return view($commerceFile->view,compact('institution','products'));
        }
    }

    public function productDetail (Request $request, $portal, $product_id){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        if($institution){

            // product view
            $productExists = Product::findOrFail($product_id);
            $productExists->views++;
            $productExists->save();

            $cookie = Cookie::forever('nihusubu', 'value');

            // check if institution can view this page

            // check if the template has this file

            // get the
            $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','product-details')->first();
            // get institution products
            $product = Product::where('id',$product_id)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'saleProducts', 'user', 'inventoryAdjustmentProducts', 'transferOrderProducts', 'productImages.upload', 'productGroupProducts', 'productGroupProductMax', 'productGroupProductMin', 'productSubCategory.productCategory')->take(9)->first();
            return view($commerceFile->view,compact('institution', 'product'));
        }
    }

    public function shop (Request $request, $portal){
        // Get the institution information
        $institution = $this->getPublicInstitution($portal);
        if($institution){
            // check if institution can view this page

            // check if the template has this file

            // get the
            $commerceFile = CommerceTemplateFile::where('commerce_template_id',$institution->commerce_template_id)->where('type','shop')->first();

            return view($commerceFile->view,compact('institution'));
        }
    }

    public function checkoutStore(Request $request, $portal)
    {
        $institution = $this->getPublicInstitution($portal);
        // save that user visited
        $view_type = "382da08a-1149-4178-9e7a-92539705f436";
        $view_id = '';
        $view = $this->trackView($request,$view_type,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);
        // get cart
        $cart = \Cart::session($cookie)->getContent();
        // get user total
        $total = \Cart::session($cookie)->getSubTotal();
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // check if contact exists
        $contact = Contact::where('email',$request->email)->first();
        if (!$contact){
            // create contact
            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone_number = $request->phone_number;
            $contact->user_id = 1;
            $contact->is_user = False;
            $contact->is_organization = False;
            $contact->is_institution = true;
            $contact->institution_id = $institution->id;
            $contact->is_chama = False;
            $contact->about = '';
            $contact->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $contact->save();
            // address
            $address = new Address();
            $address->email = $request->email;
            $address->phone_number = $request->phone_number;
            $address->town = $request->town;
            $address->street = $request->street;
            $address->po_box = $request->po_box;
            $address->postal_code = $request->postal_code;
            $address->address_line_1 = $request->address_line_1;
            $address->address_line_2 = $request->address_line_2;
            $address->address_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
            $address->user_id = 1;
            $address->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $address->save();
        }

        // order
        $order = new Sale();
        $order->reference = $reference;
        $order->customer_notes = $request->comment;

        $order->total = $total;
        $order->subtotal = $total;
        $order->refund = 0;
        // discount is based on promo codes
        $order->discount = 0;

        $order->is_returned = false;
        $order->is_refunded = false;
        $order->is_product = true;
        $order->is_project = false;
        $order->is_estimate = false;
        $order->is_invoice = false;
        $order->is_sale = false;
        $order->is_order = true;

        $order->date = date('Y-m-d', strtotime(date('Y-m-d')));
//        $order->expiry_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 5 days'));
        $order->due_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 15 days'));

        $order->is_draft = false;
        $order->is_sample = false;
        $order->status_id = "3033d8f4-88e0-4ca9-9ed1-62e0b9c61547";
        $order->institution_id = $institution->id;
        $order->contact_id = $contact->id;

//        if ($request->delivery_method == "pickup"){
//            $order->is_delivery = False;
//        }else{
//            $order->is_delivery = True;
//        }
        $order->is_returned = False;
        $order->is_refunded = False;
//        $order->is_paid = False;
        $order->is_draft = False;
        $order->paid = 0;
        $order->user_id = 1;
        $order->balance = $total;
        $order->has_uploads = false;
        $tax = 0;
        $order->tax = $tax;
        $order->save();


        foreach ($cart as $item){

            // get product
            $estimateSaleProduct = Product::findOrFail($item->attributes['id']);
            // get the product taxes
            $tax += doubleval($estimateSaleProduct->tax_amount);

            // order product
            $orderProduct = new SaleProduct();
            $orderProduct->rate = $item['price'];
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->amount = ($item['quantity']) * ($item['price']);
            $orderProduct->refund_amount = 0;
            $orderProduct->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $orderProduct->warehouse_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $orderProduct->sale_id = $order->id;
            $orderProduct->product_id = $item->attributes['id'];
            $orderProduct->is_product = true;
            $orderProduct->is_returned = False;
            $orderProduct->is_refunded = False;
            $orderProduct->user_id = 1;
            $orderProduct->save();
        }

        // Set estimate tax
        $estimateTaxSet = Sale::findOrFail($order->id);
        $estimateTaxSet->tax = $tax;
        $estimateTaxSet->subtotal = $estimateTaxSet->total-$tax;
        $estimateTaxSet->save();

        // clear cart
//        \Cart::session($cookie)->clear();

        $orderData = Sale::where('id',$order->id)->with('saleProducts.product.productImages.upload', 'institution')->first();
        // todo replace email with $order->email
        Mail::to('tmbindyo@fluidtechglobal.com')->send(new OrderSummary($orderData));


        // https://github.com/srmklive/laravel-paypal
        // To use express checkout.
        $provider = new ExpressCheckout();
        // To use express checkout(used by default).
        $provider = PayPal::setProvider('express_checkout');
        // Additional PayPal API Parameters
        $options = [
            'BRANDNAME' => 'Nihusubu',
            'LOGOIMG' => 'https://www.dropbox.com/s/264z7mcs6d14j3f/logo_transparent%20%28copy%29.png?dl=0',
            'CHANNELTYPE' => 'Merchant'
        ];

        $data['items'] = [];
        foreach ($orderData->saleProducts as $item){
            $data['items'][] = [
                'name' => $item->product->name,
                'price' => $item->product->selling_price,
                'desc'  => $item->product->description,
                'qty' => $item->quantity
            ];
        }

        $data['invoice_id'] = $order->reference;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/payment/success');
        $data['cancel_url'] = url('/cart');

        $data['total'] = $order->total;

        // Express Checkout
        $response = $provider->setExpressCheckout($data);
        // clear cart
        \Cart::session($cookie)->clear();
        // This will redirect user to PayPal
        return redirect($response['paypal_link']);

    }

    public function orderPayment(Request $request, $order_id)
    {
        // save that user visited
        $orderData = Sale::where('id',$order_id)->first();
        $orderData->is_paid = True;
        // todo replace email with $order->email
        // send successfulpayment email
        Mail::to('tmbindyo@fluidtechglobal.com')->send(new OrderEmails($orderData));

        if ($orderData->paid > 0){
            $paymentReceived = new PaymentReceived();
            $paymentReceived->initial_balance = 0;
            $paymentReceived->paid = $request->grand_total;
            $paymentReceived->current_balance = 0;
            $paymentReceived->date = date('Y-m-d', strtotime(now()));
            $paymentReceived->user_id = 1;
            $paymentReceived->status_id = '383aaf7-a45b-4931-918f-fab3daa8a97a';
            $paymentReceived->sale_id = $orderData->id;
            $paymentReceived->is_refunded = false;
            $paymentReceived->save();
        }

    }

    public function addToCart(Request $request, $portal, $product_id)
    {

        // save that user visited
        $view_id = '';
        $view = $this->trackView($request,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);

        if($request->product){
            // Get product
            $product = Product::findOrFail($request->product);
            $product = Product::where('id',$request->product)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'saleProducts', 'user', 'inventoryAdjustmentProducts', 'transferOrderProducts', 'productImages.upload', 'productGroupProducts', 'productGroupProductMax', 'productGroupProductMin', 'productSubCategory.productCategory')->first();
        }else{
            // Get product
            $product = Product::findOrFail($product_id);
            $product = Product::where('id',$product_id)->with('status', 'inventory.warehouse', 'inventory.status', 'restock', 'unit', 'saleProducts', 'user', 'inventoryAdjustmentProducts', 'transferOrderProducts', 'productImages.upload', 'productGroupProducts', 'productGroupProductMax', 'productGroupProductMin', 'productSubCategory.productCategory')->first();
        }



        // todo check if product already exists
        $cart = \Cart::session($cookie)->getContent();

        if(!$cart->isEmpty()){
            // $cart is not empty
            foreach ($cart as $item){
                if ($item->name == $product->id){
                    $quantity = doubleval($item->quantity);
                    \Cart::session($cookie)->update($item->id, array(
                        'quantity' => +$request->quantity, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
                    ));
                }else{
                    // product doesn't exist
                    $options = $request->except('_token', 'productId', 'price', 'qty');
                    $options = array();

                    // add to cart
                    \Cart::session($cookie)->add(uniqid(), $product->id, $product->taxed_selling_price, $request->quantity, $product);
                }
            }
        } else {
            // $cart is empty
            // product doesn't exist
            $options = $request->except('_token', 'productId', 'price', 'qty');
            $options = array();

            // add to cart
            \Cart::session($cookie)->add(uniqid(), $product->id, $product->taxed_selling_price, $request->quantity, $product);
        }

        return back()->withSuccess(__('Item added to cart successfully.'));

    }

    public function subtractCartItemQuantity(Request $request, $portal, $item_id)
    {

        // save that user visited
        $view_id = '';
        $view = $this->trackView($request,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);

        // get item
        $item = \Cart::session($cookie)->get($item_id);
        return $item;

        if ($item->quantity == 1){
            \Cart::session($cookie)->remove($item_id);
        }else{
            \Cart::session($cookie)->update($item_id, array(
                'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
            ));
            $item = \Cart::session($cookie)->get($item_id);
        }
        return $item;
        // if quantity is 0, remove item
    }

    public function addCartItemQuantity(Request $request, $portal, $item_id)
    {

        // save that user visited
        $view_id = '';
        $view = $this->trackView($request,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);

        // get item
        $item = \Cart::session($cookie)->get($item_id);
        \Cart::session($cookie)->update($item_id, array(
            'quantity' => +1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
        ));
        return $item;
        return "Item quantity successfully added.";
    }

    public function removeItem(Request $request, $id)
    {

        // save that user visited
        $view_id = '';
        $view = $this->trackView($request,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);
        // get item
        \Cart::session($cookie)->remove($id);

        if (\Cart::session($cookie)->isEmpty()) {
            return redirect()->back()->with('message', 'Your shopping cart is empty, if problems persist please send us an email. Sorry for any inconveniences caused.');
        }
        return back()->withSuccess(__('Item removed from cart successfully.'));

    }

    public function clearCart(Request $request)
    {

        // save that user visited
        $view_id = '';
        $view = $this->trackView($request,$view_id);
        // get user cookie
        $cookie = $this->getCookie($request);
        // clear cart
        \Cart::session($cookie)->clear();
        return back()->withSuccess(__('The cart has been cleared.'));

    }
}
