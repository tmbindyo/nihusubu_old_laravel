<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function purchaseOrders()
    {
        return view('business.purchase_orders');
    }
    public function purchaseOrder($purchase_order_id)
    {
        return view('business.purchase_order');
    }
    public function vendors()
    {
        return view('business.vendors');
    }
    public function expenses()
    {
        return view('business.expenses');
    }
    public function expense($expense_id)
    {
        return view('business.expense');
    }
    public function bills()
    {
        return view('business.bills');
    }
    public function bill($bill_id)
    {
        return view('business.bill');
    }
    public function paymentsMade()
    {
        return view('business.payments_made');
    }
}
