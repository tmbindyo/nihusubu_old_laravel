<?php

namespace App\Http\Controllers\Personal;

use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{

    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function budget()
    {
        // User
        $user = $this->getUser();
        return view('personal.budget',compact('user'));
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
