<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function expenses()
    {
        return view('personal.expenses');
    }
    public function expenseCreate()
    {
        return view('personal.expense_create');
    }
    public function expenseStore()
    {
        return back()->withSuccess(__('Expense successfully created.'));
    }
    public function expenseShow($expense_id)
    {
        return view('personal.expense_show');
    }
    public function expenseEdit($expense_id)
    {
        return view('personal.expense_show');
    }
    public function expenseUpdate($expense_id)
    {
        return back()->withSuccess(__('Expense successfully updated.'));
    }
    public function expenseDelete($expense_id)
    {
        return back()->withSuccess(__('Expense successfully deleted.'));
    }





    public function bills()
    {
        return view('personal.bills');
    }
    public function billCreate()
    {
        return view('personal.bill_create');
    }
    public function billStore()
    {
        return back()->withSuccess(__('Bill successfully created.'));
    }
    public function billShow($bill_id)
    {
        return view('personal.bill_show');
    }
    public function billEdit($bill_id)
    {
        return view('personal.bill_show');
    }
    public function billUpdate($bill_id)
    {
        return back()->withSuccess(__('Bill successfully updated.'));
    }
    public function billDelete($bill_id)
    {
        return back()->withSuccess(__('Bill successfully deleted.'));
    }
}
