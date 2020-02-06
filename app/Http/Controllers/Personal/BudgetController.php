<?php

namespace App\Http\Controllers\Personal;

use App\Budget;
use App\ExpenseAccount;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\ReferenceNumberTrait;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{

    use UserTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function budget()
    {
        // User
        $user = $this->getUser();
        // get budgets
        $budgets = Budget::where('is_user',True)->where('user_id',$user->id)->with('expense_accounts')->get();
        return view('personal.budgets',compact('user','budgets'));
    }

    public function budgetCreate()
    {
        // User
        $user = $this->getUser();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('is_user',True)->where('user_id',$user->id)->get();
        return view('personal.budget_create',compact('user','expenseAccounts'));
    }

    public function budgetStore()
    {
        // User
        $user = $this->getUser();
        return back()->withSuccess(__('Budget successfully created.'));
    }

    public function budgetShow($budget_id)
    {
        // User
        $user = $this->getUser();
        return view('personal.budget_show');
    }
    public function budgetEdit($budget_id)
    {
        return view('personal.budget_show');
    }

    public function budgetUpdate($budget_id)
    {
        // User
        $user = $this->getUser();
        return back()->withSuccess(__('Budget successfully updated.'));
    }

    public function budgetDelete($budget_id)
    {
        // User
        $user = $this->getUser();
        return back()->withStatus(__('Budget successfully deleted.'));
    }

}
