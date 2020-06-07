<?php

namespace App\Http\Controllers\Personal;

use App\Account;
use App\Frequency;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Income;
use App\IncomeDebit;
use App\IncomeType;
use App\Traits\ReferenceNumberTrait;

class IncomeController extends Controller
{

    use UserTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function income()
    {
        // User
        $user = $this->getUser();
        // get income
        $incomes = Income::where('user_id',$user->id)->with('incomeType')->get();
        return view('personal.incomes',compact('user','incomes'));
    }

    public function incomeCreate()
    {
        // User
        $user = $this->getUser();
        // Income types
        $incomeTypes = IncomeType::all();
        // Frequency
        $frequencies = Frequency::where("status_id","c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('user_id',$user->id)->where('is_user',true)->get();
        // Account
        $accounts = Account::where('user_id',$user->id)->where('is_user',true)->get();
        return view('personal.income_create',compact('user','incomeTypes','frequencies','accounts'));
    }

    public function incomeStore(Request $request)
    {

        // User
        $user = $this->getUser();
        $size = 5;
            $reference = $this->getRandomString($size);
        $income = new Income();
        $income->reference = $reference;
        $income->name = $request->name;
        $income->description = $request->description;
        $income->amount = $request->amount;
        $income->date = date('Y-m-d', strtotime($request->date));
        $income->income_type_id = $request->income_type;
        $income->is_debit = false;
        $income->user_id = $user->id;
        $income->account_id = $request->account;
        $income->frequency_id = $request->frequency;
        $income->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';

        if($request->is_variable == "variable"){
            $income->is_variable = true;
        }elseif($request->is_variable == "fixed"){
            $income->is_variable = false;
        }
        if($request->is_recurring == "on"){
            $income->is_recurring = true;
        }else{
            $income->is_recurring = false;
        }

        $income->save();


        $income = Income::findOrFail($income->id);
        // update account
        if($request->is_debit == "on"){
            $income->is_debit = false;
            // Generate reference
            $size = 5;
            $reference = $this->getRandomString($size);
            $incomeDebit = new IncomeDebit();
            $incomeDebit->reference = $reference;
            $incomeDebit->date = date('Y-m-d', strtotime($request->date));
            $incomeDebit->amount = $request->amount;
            $incomeDebit->account_id = $request->account;
            $incomeDebit->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2';
            $incomeDebit->income_id = $income->id;
            $incomeDebit->user_id = $user->id;
            $incomeDebit->is_debited = true;
            $incomeDebit->save();

            // account debit
            $account = Account::where('id',$request->account)->first();
            $account->balance = doubleval($account->balance)+doubleval($request->amount);
            $account->save();

        }else{
            $income->is_debit = false;
        }
        $income->save();

        return redirect()->route('personal.income.show',$income->id)->withSuccess(__('Income successfully created.'));
    }

    public function incomeShow($income_id)
    {

        // User
        $user = $this->getUser();
        // Income
        $incomeExists = Income::findOrFail($income_id);
        $income = Income::where('id',$income_id)->with('frequency','incomeType','account','status','user','incomeDebits')->first();
        // Income debits
        $incomeDebits = IncomeDebit::where('user_id',$user->id)->where('income_id',$income->id)->where('status_id','2fb4fa58-f73d-40e6-ab80-f0d904393bf2')->with('income','account','status')->get();
        // get pending payments
        $pendingIncomeDebits = IncomeDebit::where('user_id',$user->id)->where('income_id',$income->id)->where('status_id','a40b5983-3c6b-4563-ab7c-20deefc1992b')->with('income','account','status')->get();

        return view('personal.income_show',compact('user','income','incomeDebits','pendingIncomeDebits'));

    }

    public function incomeEdit($income_id)
    {
        return view('personal.income_show');
    }

    public function incomeUpdate($income_id)
    {
        return back()->withStatus(__('Income successfully updated.'));
    }

    public function incomeDelete($income_id)
    {
        return back()->withStatus(__('Income successfully deleted.'));
    }

}
