<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
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
        return view('business.bill_show');
    }
    public function billUpdate($bill_id)
    {
        return back()->withStatus(__('Bill successfully updated.'));
    }
    public function billDelete($bill_id)
    {
        return back()->withStatus(__('Bill successfully deleted.'));
    }
}
