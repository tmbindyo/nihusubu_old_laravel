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
    public function expenseCreate()
    {
        return view('business.expense_create');
    }
    public function expenseStore()
    {
        return back()->withStatus(__('Expense successfully created.'));
    }
    public function expense($expense_id)
    {
        return view('business.expense');
    }
    public function expensePrint($expense_id)
    {
        return view('business.expense_print');
    }

    public function bills()
    {
        return view('business.bills');
    }
    public function bill($bill_id)
    {
        return view('business.bill');
    }
    public function billPrint($bill_id)
    {
        return view('business.bill_print');
    }

    public function paymentsMade()
    {
        return view('business.payments_made');
    }
}
