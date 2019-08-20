<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function contacts()
    {
        return view('business.contacts');
    }
    public function clients()
    {
        return view('business.clients');
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
