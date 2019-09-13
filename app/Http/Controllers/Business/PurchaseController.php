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
    public function purchaseOrderCreate()
    {
        return view('business.purchase_order_create');
    }
    public function purchaseOrderStore(Request $request)
    {
        return back()->withStatus(__('Purchase order successfully created.'));
    }
    public function purchaseOrderShow($purchase_order_id)
    {
        return view('business.purchase_order_show');
    }

    public function vendors()
    {
        return view('business.vendors');
    }
    public function vendorCreate()
    {
        return view('business.vendor_create');
    }
    public function vendorStore(Request $request)
    {
        return back()->withStatus(__('Vendor successfully created.'));
    }
    public function vendorShow($vendor_id)
    {
        return view('business.vendor_show');
    }
    public function vendorContactPersonShow($contact_person_id)
    {
        return view('business.vendor_contact_person_show');
    }
    public function vendorContactPersonMessage($contact_person_id)
    {
        return back()->withStatus(__('Message sent to .'));
    }
    public function vendorEdit()
    {
        return view('business.vendor_edit');
    }
    public function vendorUpdate(Request $request, $vendor_id)
    {
        return back()->withStatus(__('Vendor successfully updated.'));
    }
    public function vendorDelete($vendor_id)
    {
        return back()->withStatus(__('Vendor successfully deleted.'));
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
    public function expenseShow($expense_id)
    {
        return view('business.expense_show');
    }
    public function expenseEdit($expense_id)
    {
        return view('business.expense_show');
    }
    public function expenseUpdate($expense_id)
    {
        return back()->withStatus(__('Expense successfully updated.'));
    }
    public function expenseDelete($expense_id)
    {
        return back()->withStatus(__('Expense successfully deleted.'));
    }
    public function expensePrint($expense_id)
    {
        return view('business.expense_print');
    }

    public function bills()
    {
        return view('business.bills');
    }
    public function billCreate()
    {
        return view('business.bill_create');
    }
    public function billStore()
    {
        return back()->withStatus(__('Bill successfully created.'));
    }
    public function billShow($bill_id)
    {
        return view('business.bill_show');
    }
    public function billEdit($bill_id)
    {
        return view('business.bill_edit');
    }
    public function billUpdate($bill_id)
    {
        return back()->withStatus(__('Bill successfully updated.'));
    }
    public function billDelete($bill_id)
    {
        return back()->withStatus(__('Bill successfully deleted.'));
    }
    public function billPrint($bill_id)
    {
        return view('business.bill_print');
    }

    public function paymentsMade()
    {
        return view('business.payments_made');
    }

    public function expenseSettings()
    {
        return view('business.expense_settings');
    }
}
