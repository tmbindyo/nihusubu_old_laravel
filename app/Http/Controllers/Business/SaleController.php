<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function clients()
    {
        return view('business.clients');
    }
    public function clientCreate()
    {
        return view('business.client_create');
    }
    public function clientStore(Request $request)
    {
        return back()->withSuccess(__('Client successfully created.'));
    }
    public function clientShow($client_id)
    {
        return view('business.client_show');
    }
    public function clientContactPersonShow($contact_person_id)
    {
        return view('business.client_contact_person_show');
    }
    public function clientContactPersonMessage($contact_person_id)
    {
        return back()->withSuccess(__('Message sent to .'));
    }
    public function clientEdit()
    {
        return view('business.client_edit');
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
        return view('business.estimates');
    }
    public function estimateCreate()
    {
        return view('business.estimate_create');
    }
    public function estimateStore(Request $request)
    {
        return back()->withSuccess(__('Estimate successfully created.'));
    }
    public function estimateShow($estimate_id)
    {
        return view('business.estimate_show');
    }
    public function estimateEdit()
    {
        return view('business.estimate_edit');
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
        return view('business.invoices');
    }
    public function invoiceCreate()
    {
        return view('business.invoice_create');
    }
    public function invoiceStore()
    {
        return back()->withSuccess(__('Invoice successfully created.'));
    }
    public function invoiceShow($invoice_id)
    {
        return view('business.invoice');
    }
    public function invoiceEdit($invoice_id)
    {
        return view('business.invoice');
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
        return view('business.invoice_print');
    }




    public function orders()
    {
        return view('business.orders');
    }
    public function orderCreate()
    {
        return view('business.order_create');
    }
    public function orderStore()
    {
        return back()->withSuccess(__('Order successfully created.'));
    }
    public function orderShow($order_id)
    {
        return view('business.order_show');
    }
    public function orderEdit($order_id)
    {
        return view('business.order_edit');
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
        return view('business.order_print');
    }


    public function sales()
    {
        return view('business.sales');
    }
    public function saleCreate()
    {
        return view('business.sale_create');
    }
    public function saleStore()
    {
        return back()->withSuccess(__('Sale successfully created.'));
    }
    public function saleShow($sale_id)
    {
        return view('business.sale_show');
    }
    public function saleEdit($sale_id)
    {
        return view('business.sale_show');
    }
    public function saleUpdate($sale_id)
    {
        return back()->withSuccess(__('Order successfully updated.'));
    }
    public function saleDelete($sale_id)
    {
        return view('business.sale_show');
    }


    public function paymentsReceived()
    {
        return view('business.payments_received');
    }

}
