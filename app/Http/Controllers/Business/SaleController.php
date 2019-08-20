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
    public function estimate($estimate_id)
    {
        return view('business.estimate');
    }
    public function invoices()
    {
        return view('business.invoices');
    }
    public function invoice()
    {
        return view('business.invoice');
    }
    public function invoicePrint()
    {
        return view('business.invoice_print');
    }
    public function orders()
    {
        return view('business.orders');
    }
    public function order($order_id)
    {
        return view('business.order');
    }
    public function sales()
    {
        return view('business.sales');
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
