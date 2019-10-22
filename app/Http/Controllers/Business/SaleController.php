<?php

namespace App\Http\Controllers\Business;

use App\Estimate;
use App\Invoice;
use App\Order;
use App\Sale;
use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function clients()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get individual clients

        // Get company clients


        return view('business.clients',compact('user','institution'));
    }
    public function clientCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.client_create',compact('user','institution'));
    }
    public function clientStore(Request $request)
    {
        return back()->withSuccess(__('Client successfully created.'));
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
        $estimates = Estimate::where('institution_id',$institution->id)->with('status','customer')->get();

        return view('business.estimates',compact('user','institution','estimates'));
    }
    public function estimateCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.estimate_create',compact('user','institution'));
    }
    public function estimateStore(Request $request)
    {
        return back()->withSuccess(__('Estimate successfully created.'));
    }
    public function estimateShow($estimate_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.estimate_show',compact('user','institution'));
    }
    public function estimateEdit()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.estimate_edit',compact('user','institution'));
    }
    public function estimateUpdate(Request $request, $estimate_id)
    {
        return back()->withSuccess(__('Estimate successfully updated.'));
    }
    public function estimateDelete($estimate_id)
    {
        return back()->withSuccess(__('Estimate successfully deleted.'));
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
        $institution = $this->getInstitution();

        return view('business.invoice_create',compact('user','institution'));
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

        return view('business.order_create',compact('user','institution'));
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

        return view('business.sale_create',compact('user','institution'));
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

        return view('business.sale_show',compact('user','institution'));
    }


    public function paymentsReceived()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payments_received',compact('user','institution'));
    }

}
