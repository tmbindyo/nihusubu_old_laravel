<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function accounts()
    {
        return view('personal.accounts');
    }
    public function accountCreate()
    {
        return view('personal.account_create');
    }
    public function accountStore()
    {
        return back()->withSuccess(__('Account successfully created.'));
    }
    public function accountShow($account_id)
    {
        return view('personal.account_show');
    }
    public function accountEdit($account_id)
    {
        return view('personal.account_show');
    }
    public function accountUpdate($account_id)
    {
        return back()->withSuccess(__('Account successfully updated.'));
    }
    public function accountDeposit($account_id)
    {
        return back()->withSuccess(__('Account successfully deposited into.'));
    }
    public function accountWithdraw($account_id)
    {
        return back()->withSuccess(__('Account successfully withdrawn from.'));
    }
    public function accountClose($account_id)
    {
        return back()->withSuccess(__('Account successfully closed.'));
    }
    public function accountDelete($account_id)
    {
        return back()->withSuccess(__('Account successfully deleted.'));
    }
}
