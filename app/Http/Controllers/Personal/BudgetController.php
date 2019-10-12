<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{
    public function budget()
    {
        return view('personal.budget');
    }
    public function budgetStore()
    {
        return back()->withSuccess(__('Budget successfully created.'));
    }
    public function budgetShow($budget_id)
    {
        return view('personal.budget_show');
    }
    public function budgetEdit($budget_id)
    {
        return view('personal.budget_show');
    }
    public function budgetUpdate($budget_id)
    {
        return back()->withSuccess(__('Budget successfully updated.'));
    }
    public function budgetDelete($budget_id)
    {
        return back()->withStatus(__('Budget successfully deleted.'));
    }
}
