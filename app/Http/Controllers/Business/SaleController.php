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
        return back()->withStatus(__('Client successfully created.'));
    }
    public function clientShow($client_id)
    {
        return view('business.client_show');
    }
    public function clientEdit()
    {
        return view('business.client_edit');
    }
    public function clientUpdate(Request $request, $client_id)
    {
        return back()->withStatus(__('Client successfully updated.'));
    }
    public function clientDelete($client_id)
    {
        return back()->withStatus(__('Client successfully deleted.'));
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
        return back()->withStatus(__('Estimate successfully created.'));
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
        return back()->withStatus(__('Estimate successfully updated.'));
    }
    public function estimateDelete($estimate_id)
    {
        return back()->withStatus(__('Estimate successfully deleted.'));
    }



    public function invoices()
    {
        return view('business.invoices');
    }
    public function invoiceCreate()
    {
        return view('business.invoice_create');
    }
    public function invoice($invoice_id)
    {
        return view('business.invoice');
    }
    public function invoiceStore()
    {
        return back()->withStatus(__('Invoice successfully created.'));
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
        return back()->withStatus(__('Order successfully created.'));
    }
    public function order($order_id)
    {
        return view('business.order');
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
        return back()->withStatus(__('Order successfully created.'));
    }
    public function sale($sale_id)
    {
        return view('business.sale');
    }


    public function paymentsReceived()
    {
        return view('business.payments_received');
    }

}
