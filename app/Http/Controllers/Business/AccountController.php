<?php

namespace App\Http\Controllers\Business;

use Auth;
use App\Loan;
use App\Status;
use App\Contact;
use App\Deposit;
use App\Expense;
use App\Account;
use App\Transfer;
use App\Liability;
use App\Withdrawal;
use App\Transaction;
use App\ExpenseAccount;
use App\Traits\UserTrait;
use App\AccountAdjustment;
use App\Campaign;
use App\Frequency;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Http\Controllers\Controller;
use App\Sale;

class AccountController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accounts()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();

        // Get accounts
        $accounts = Account::with('user','status')->where('institution_id',$institution->id)->get();

        return view('business.accounts',compact('accounts','user','institution'));
    }

    public function accountCreate()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();

        return view('business.account_create',compact('user','institution'));
    }

    public function accountStore(Request $request)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // select account type
        $account = new Account();
        $account->reference = $reference;
        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->institution_id = $institution->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('business.account.show',$account->id)->withSuccess('Expense '.$account->reference.' successfully created!');
    }

    public function accountShow($account_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get account
        $account = Account::where('id',$account_id)->where('institution_id',$institution->id)->with('status','user','loans','account_adjustments','destination_account.source_account','transactions.account','transactions.expense','payments','source_account.destination_account','deposits','withdrawals','liabilities.contact','refunds','transactions')->first();
        $goal = $account->goal;
        $balance = $account->balance;
        if ($balance == 0){
            $percentage = 0;
        }else{
            $percentage = doubleval($goal)/$balance/100;
        }
        return view('business.account_show',compact('account','user','institution','percentage'));
    }

    public function accountDepositCreate($account_id)
    {
        // get account
        $account = Account::findOrFail($account_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        return view('business.deposit_create',compact('account','user','institution'));
    }

    public function accountLiabilityCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $account = Account::findOrFail($account_id);
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        return view('business.account_liability_create',compact('user','institution','account','contacts'));
    }

    public function accountLoanCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $account = Account::findOrFail($account_id);
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        return view('business.account_loan_create',compact('user','institution','account','contacts'));
    }

    public function accountWithdrawalCreate($account_id)
    {
        // get account
        $account = Account::findOrFail($account_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        return view('business.withdrawal_create',compact('account','user','institution'));
    }

    public function accountUpdate(Request $request, $account_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // select account type
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('institution_id',$institution->id)->first();
        $account->name = $request->name;
        $account->goal = $request->goal;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('business.account.show',$account->id)->withSuccess('Account '.$account->reference.' successfully updated!');
    }

    public function accountDelete($account_id)
    {
        $account = Account::findOrFail($account_id);
        $account->delete();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountRestore($account_id)
    {

        $account = Account::withTrashed()->findOrFail($account_id);
        $account->restore();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountAdjustmentCreate($account_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('institution_id',$institution->id)->first();

        return view('business.account_adjustment_create',compact('account','user','institution','accounts'));

    }

    public function accountAdjustmentStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);

        // get account
        $account = Account::where('id',$request->account)->where('institution_id',$institution->id)->first();
        $accountAdjustment = new AccountAdjustment();

        if($request->is_deposit == "on"){
            $accountAdjustment->is_deposit = True;
            $accountAdjustment->deposit_id = $request->design;
        }else{
            $accountAdjustment->is_deposit = False;
        }

        if($request->is_withdrawal == "on"){
            $accountAdjustment->is_withdrawal = True;
            $accountAdjustment->withdrawal_id = $request->design;
        }else{
            $accountAdjustment->is_withdrawal = False;
        }

        $accountAdjustment->reference = $reference;
        $accountAdjustment->notes = $request->notes;
        $accountAdjustment->amount = $request->amount;
        $accountAdjustment->initial_account_amount = $account->balance;
        $accountAdjustment->subsequent_account_amount = doubleval($account->balance)+doubleval($request->amount);
        $accountAdjustment->date = date('Y-m-d', strtotime($request->date));

        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->institution_id = $institution->id;
        $accountAdjustment->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $accountAdjustment->account_id = $request->account;
        $accountAdjustment->save();

        // update account
        $account = Account::where('id',$request->account)->where('institution_id',$institution->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($request->amount);
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('business.account.show',$account->id)->withSuccess('Account Adjustment successfully created!');

    }

    public function accountAdjustmentEdit()
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // Get albums
        $transactions = Transaction::with('user','status','source_account','destination_account','account','expense')->where('institution_id',$institution->id)->get();
        return view('business.account_adjustment_create',compact('transactions','user','institution','journalsStatusCount','transactions','accounts'));

    }

    public function accountAdjustmentUpdate(Request $request)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);
        $transaction = new Transaction();
        if ($request->is_expense == "on")
        {
            $transaction->is_expense = True;
            $transaction->is_transfer = False;
            $transaction->expense_id = $request->expense;
        }
        $transaction->account_id = $request->account;
        $transaction->amount = $request->amount;
        $transaction->reference = $reference;
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->notes = $request->notes;
        if ($request->is_transfer == "on")
        {
            $transaction->is_transfer = True;
            $transaction->is_expense = False;
            $transaction->source_account_id = $request->source_account;
            $transaction->destination_account_id = $request->destination_account;
        }
        $transaction->user_id = $user->id;
        $transaction->status_id = $request->status;
        $transaction->save();

        if ($request->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2')
        {
            if ($request->is_expense == "on")
            {
                $account = Account::where('id',$request->account)->where('institution_id',$institution->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();
            } elseif ($request->is_transfer == "on")
            {

                // credit source
                $account = Account::where('id',$request->source_account)->where('institution_id',$institution->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();


                // debit destination
                $account = Account::where('id',$request->destination_account)->where('institution_id',$institution->id)->first();
                $account->balance = doubleval($account->balance)+doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();

            }
        }
        // account subtraction

        return redirect()->route('business.transaction.show')->withSuccess('Expense '.$transaction->reference.' successfully updated!');

    }

    public function accountAdjustmentDelete($account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('institution_id',$institution->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse
        $account = Account::where('id',$accountAdjustment->account_id)->where('institution_id',$institution->id)->first();
        $account->balance = doubleval($account->balance)-doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();
        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully deleted.'));
    }

    public function accountAdjustmentRestore($account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('institution_id',$institution->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse account
        $account = Account::where('id',$accountAdjustment->account_id)->where('institution_id',$institution->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();

        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully restored.'));
    }


    // deposits
    public function depositStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $size = 5;
        $reference = $this->getRandomString($size);

        // update account
        $account = Account::findOrFail($request->account);
        $initial_amount = $account->balance;
        $new = doubleval($account->balance) + doubleval($request->amount);
        $account->balance = $new;
        $account->user_id = $user->id;
        $account->save();

        $deposit = new Deposit();
        $deposit->reference = $reference;
        $deposit->about = $request->about;
        $deposit->date = date('Y-m-d', strtotime($request->date));
        $deposit->initial_amount = $initial_amount;
        $deposit->amount = $request->amount;
        $deposit->subsequent_amount = doubleval($account->balance) + doubleval($request->amount);
        $deposit->account_id = $account->id;
        $deposit->institution_id = $institution->id;
        $deposit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $deposit->user_id = $user->id;
        $deposit->save();

        return redirect()->route('business.deposit.show',$deposit->id)->withSuccess('Deposit updated!');
    }

    public function depositShow($deposit_id)
    {
        // Check if action type exists
        $depositExists = Deposit::findOrFail($deposit_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get deposit
        $deposit = Deposit::with('user','status','account','account_adjustments')->where('institution_id',$institution->id)->where('id',$deposit_id)->first();
        return view('business.deposit_show',compact('deposit','user','institution'));
    }

    public function depositAccountAdjustmentCreate($deposit_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get deposit
        $depositExists = Deposit::findOrFail($deposit_id);
        $deposit = Deposit::with('user','status','account','account_adjustments')->where('institution_id',$institution->id)->where('id',$deposit_id)->first();
        // get account
        $accountExists = Account::findOrFail($deposit->account_id);
        $account = Account::where('id',$deposit->account_id)->where('institution_id',$institution->id)->first();

        return view('business.deposit_account_adjustment_create',compact('deposit','account','user','institution','accounts'));

    }

    public function depositUpdate(Request $request, $deposit_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $deposit = Deposit::findOrFail($deposit_id);
        $deposit->about = $request->about;
        $deposit->amount = $request->amount;
        $deposit->user_id = $user->id;
        $deposit->save();

        $size = 5;
        $reference = $this->getRandomString($size);
        // create adjustment
        $accountAdjustment = new AccountAdjustment();
        $accountAdjustment->reference = $reference;
        $notes = 'Account adjustment for correction of deposit of '.$deposit->reference;
        $accountAdjustment->reference = $notes;
        $accountAdjustment->amount = $request->amount;

        // TODO figuring out initial amount for this
        $accountAdjustment->initial_account_amount = $deposit->initial_amount;
        $accountAdjustment->subsequent_account_amount = $deposit->subsequent_amount;

        $accountAdjustment->date = date('Y-m-d', strtotime($request->date));

        $accountAdjustment->account_id = $deposit->account_id;
        $accountAdjustment->is_deposit = True;
        $accountAdjustment->deposit_id = $deposit->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();


        // update account

        // add transaction record

        return redirect()->route('business.deposit.show',$deposit_id)->withSuccess('Deposit '. $deposit->name .' updated!');
    }


    public function depositDelete($deposit_id)
    {

        $deposit = Deposit::findOrFail($deposit_id);
        $deposit->delete();

        return back()->withSuccess(__('Deposit '.$deposit->name.' successfully deleted.'));
    }

    public function depositRestore($deposit_id)
    {

        $deposit = Deposit::withTrashed()->findOrFail($deposit_id);
        $deposit->restore();

        return back()->withSuccess(__('Deposit '.$deposit->name.' successfully restored.'));
    }


    // withdrawals
    public function withdrawalStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $size = 5;
        $reference = $this->getRandomString($size);

        // update account
        $account = Account::findOrFail($request->account);
        $initial_amount = $account->balance;
        $new = doubleval($account->balance) - doubleval($request->amount);
        $account->balance = $new;
        $account->user_id = $user->id;
        $account->save();

        $withdrawal = new Withdrawal();
        $withdrawal->reference = $reference;
        $withdrawal->about = $request->about;
        $withdrawal->date = date('Y-m-d', strtotime($request->date));
        $withdrawal->initial_amount = $initial_amount;
        $withdrawal->amount = $request->amount;
        $withdrawal->subsequent_amount = doubleval($account->balance) + doubleval($request->amount);
        $withdrawal->account_id = $account->id;
        $withdrawal->institution_id = $institution->id;
        $withdrawal->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $withdrawal->user_id = $user->id;
        $withdrawal->save();

        return redirect()->route('business.withdrawal.show',$withdrawal->id)->withSuccess('Withdrawal updated!');
    }

    public function withdrawalShow($withdrawal_id)
    {
        // Check if action type exists
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get withdrawal
        $withdrawal = Withdrawal::with('user','status','account','account_adjustments')->where('institution_id',$institution->id)->where('id',$withdrawal_id)->first();
        return view('business.withdrawal_show',compact('withdrawal','user','institution'));
    }

    public function withdrawalAccountAdjustmentCreate($withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get withdrawal
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal = Withdrawal::with('user','status','account','account_adjustments')->where('institution_id',$institution->id)->where('id',$withdrawal_id)->first();
        // get account
        $accountExists = Account::findOrFail($withdrawal->account_id);
        $account = Account::where('id',$withdrawal->account_id)->where('institution_id',$institution->id)->first();

        return view('business.withdrawal_account_adjustment_create',compact('withdrawal','account','user','institution','accounts'));

    }

    public function withdrawalUpdate(Request $request, $withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $withdrawal = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal->about = $request->about;
        $withdrawal->amount = $request->amount;
        $withdrawal->user_id = $user->id;
        $withdrawal->save();

        $size = 5;
        $reference = $this->getRandomString($size);
        // create adjustment
        $accountAdjustment = new AccountAdjustment();
        $accountAdjustment->reference = $reference;
        $notes = 'Account adjustment for correction of withdrawal of '.$withdrawal->reference;
        $accountAdjustment->reference = $notes;
        $accountAdjustment->amount = $request->amount;

        // TODO figuring out initial amount for this
        $accountAdjustment->initial_account_amount = $withdrawal->initial_amount;
        $accountAdjustment->subsequent_account_amount = $withdrawal->subsequent_amount;

        $accountAdjustment->date = date('Y-m-d', strtotime($request->date));

        $accountAdjustment->account_id = $withdrawal->account_id;
        $accountAdjustment->is_withdrawal = True;
        $accountAdjustment->withdrawal_id = $withdrawal->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();


        // update account

        // add transaction record

        return redirect()->route('business.withdrawal.show',$withdrawal_id)->withSuccess('Withdrawal '. $withdrawal->name .' updated!');
    }

    public function withdrawalDelete($withdrawal_id)
    {

        $withdrawal = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal->delete();

        return back()->withSuccess(__('Withdrawal '.$withdrawal->name.' successfully deleted.'));
    }

    public function withdrawalRestore($withdrawal_id)
    {

        $withdrawal = Withdrawal::withTrashed()->findOrFail($withdrawal_id);
        $withdrawal->restore();

        return back()->withSuccess(__('Withdrawal '.$withdrawal->name.' successfully restored.'));
    }


    //liabilities
    public function liabilities()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        $liabilities = Liability::with('user','status','account','account')->where('institution_id',$institution->id)->get();
        return view('business.liabilities',compact('liabilities','user','institution'));
    }

    public function liabilityCreate()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        return view('business.liability_create',compact('user','institution','accounts','contacts'));
    }

    public function liabilityStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // calculations
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) + doubleval($request->amount);

        // store liability record
        $liability = new Liability();
        $liability->reference = $reference;
        $liability->about = $request->about;

        $liability->amount = $request->amount;
        $liability->paid = 0;

        $liability->date = date('Y-m-d', strtotime($request->date));
        $liability->due_date = date('Y-m-d', strtotime($request->due_date));

        $liability->contact_id = $request->contact;
        $liability->account_id = $request->account;

        $liability->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $liability->user_id = $user->id;
        $liability->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('business.liability.show',$liability->id)->withSuccess('Liability created!');
    }

    public function liabilityShow($liability_id)
    {
        // Check if contact type exists
        $liabilityExists = Liability::findOrFail($liability_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        // Get contact type
        $liability = Liability::with('user','status','account','contact.organization','expenses.transactions')->where('institution_id',$institution->id)->where('id',$liability_id)->first();
        return view('business.liability_show',compact('accounts','contacts','liability','user','institution'));
    }

    // TODO expense for liability
    public function liabilityExpenseCreate($liability_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('institution_id',$institution->id)->get();
        // get sales
        $sales = Sale::with('status')->where('institution_id',$institution->id)->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get transfers
        $transfers = Transfer::where('institution_id',$institution->id)->get();
        // get campaign
        $campaigns = Campaign::where('institution_id',$institution->id)->get();
        // get liabilities
        $liability = Liability::where('id',$liability_id)->where('institution_id',$institution->id)->first();
        // get frequencies
        $frequencies = Frequency::where('institution_id',$institution->id)->get();

        return view('business.liability_expense_create',compact('liability','campaigns','sales','user','institution','frequencies','expenseAccounts','transfers','expenseStatuses'));
    }

    public function liabilityUpdate(Request $request, $liability_id)
    {

        $liability = Liability::findOrFail($liability_id);

        return redirect()->route('business.liability.show',$liability->id)->withSuccess('Liability updated!');
    }

    public function liabilityDelete($liability_id)
    {

        $liability = Liability::findOrFail($liability_id);
        $liability->delete();

        return back()->withSuccess(__('Liability '.$liability->name.' successfully deleted.'));
    }
    public function liabilityRestore($liability_id)
    {

        $liability = Liability::withTrashed()->findOrFail($liability_id);
        $liability->restore();

        return back()->withSuccess(__('Liability '.$liability->name.' successfully restored.'));
    }


    // loans
    public function loans()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        $loans = Loan::with('user','status','account')->where('institution_id',$institution->id)->get();
        return view('business.loans',compact('loans','user','institution'));
    }

    public function loanCreate()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        return view('business.loan_create',compact('user','institution','accounts','contacts'));
    }

    public function loanStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // calculations
        $account = Account::findOrFail($request->account);
        // check if this is an overdraft
        if($request->amount > $account->balance){
            return back()->withWarning(__('This loan will overdraft the account.'));
        }
        $accountBalance = doubleval($account->balance) - doubleval($request->amount);

        // store loan record
        $loan = new Loan();
        $loan->reference = $reference;
        $loan->about = $request->about;

        $loan->amount = $request->amount;
        $loan->paid = 0;

        $loan->date = date('Y-m-d', strtotime($request->date));
        $loan->due_date = date('Y-m-d', strtotime($request->due_date));

        $loan->contact_id = $request->contact;
        $loan->account_id = $request->account;

        $loan->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $loan->user_id = $user->id;
        $loan->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('business.loan.show',$loan->id)->withSuccess('Loan created!');
    }

    public function loanShow($loan_id)
    {
        // Check if contact type exists
        $loanExists = Loan::findOrFail($loan_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('institution_id',$institution->id)->get();
        // Get contact type
        $loan = Loan::with('user','status','account','contact.organization','payments')->where('id',$loan_id)->where('institution_id',$institution->id)->first();
        return view('business.loan_show',compact('accounts','contacts','loan','user','institution'));
    }

    public function loanPaymentCreate($loan_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // loans
        $loan = Loan::findOrFail($loan_id);
        return view('business.loan_payment_create',compact('user','institution','accounts','loan'));
    }

    public function loanUpdate(Request $request, $loan_id)
    {

        $loan = Loan::findOrFail($loan_id);
        return redirect()->route('business.loan.show',$loan->id)->withSuccess('Loan updated!');

    }

    public function loanDelete($loan_id)
    {

        $loan = Loan::findOrFail($loan_id);
        $loan->delete();

        return back()->withSuccess(__('Loan '.$loan->name.' successfully deleted.'));
    }
    public function loanRestore($loan_id)
    {

        $loan = Loan::withTrashed()->findOrFail($loan_id);
        $loan->restore();

        return back()->withSuccess(__('Loan '.$loan->name.' successfully restored.'));
    }


    //transfers
    public function transfers()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        $transfers = Transfer::with('user','status','source_account','destination_account')->where('institution_id',$institution->id)->get();
        return view('business.transfers',compact('transfers','user','institution'));
    }

    public function transferCreate()
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        return view('business.transfer_create',compact('user','institution','accounts'));
    }

    public function transferStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);
        // calculations
        $sourceAccount = Account::findOrFail($request->source_account);
        $sourceAccountInitialAmount = $sourceAccount->balance;
        $sourceAccountSubsequentAmount = doubleval($sourceAccount->balance) - doubleval($request->amount);
        $destinationAccount = Account::findOrFail($request->destination_account);
        $destinationAccountInitialAmount = $destinationAccount->balance;
        $destinationAccountSubsequentAmount = doubleval($destinationAccount->balance) + doubleval($request->amount);

        // store transfer record
        $transfer = new Transfer();
        $transfer->reference = $reference;
        $transfer->notes = $request->notes;
        $transfer->amount = $request->amount;
        $transfer->date = date('Y-m-d', strtotime($request->date));

        $transfer->source_initial_amount = $sourceAccountInitialAmount;
        $transfer->source_subsequent_amount = $sourceAccountSubsequentAmount;
        $transfer->destination_initial_amount = $destinationAccountInitialAmount;
        $transfer->destination_subsequent_amount = $destinationAccountSubsequentAmount;

        $transfer->source_account_id = $request->source_account;
        $transfer->destination_account_id = $request->destination_account;

        $transfer->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $transfer->user_id = $user->id;
        $transfer->institution_id = $institution->id;
        $transfer->save();

        // update accounts balance
        $sourceAccount->balance = $sourceAccountSubsequentAmount;
        $sourceAccount->user_id = $user->id;
        $sourceAccount->save();
        $destinationAccount->balance = $destinationAccountSubsequentAmount;
        $destinationAccount->user_id = $user->id;
        $destinationAccount->save();

        return redirect()->route('business.transfer.show',$transfer->id)->withSuccess('Transfer created!');
    }

    public function transferShow($transfer_id)
    {
        // Check if contact type exists
        $transferExists = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // Get contact type
        $transfer = Transfer::with('user','status','source_account','destination_account','expenses')->where('institution_id',$institution->id)->where('id',$transfer_id)->first();
        return view('business.transfer_show',compact('transfer','user','institution'));
    }

    public function transferExpenseCreate($transfer_id)
    {
        // get transfer
        $transfer = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution();
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('institution_id',$institution->id)->get();
        return view('business.transfer_expense_create',compact('transfer','user','institution','journalsStatusCount','expenseStatuses','expenseAccounts'));
    }

    public function transferUpdate(Request $request, $transfer_id)
    {

        $transfer = Transfer::findOrFail($transfer_id);
        // $transfer->name = $request->name;
        // $transfer->save();

        return redirect()->route('business.transfer.show',$transfer->id)->withSuccess('Contact type updated!');
    }

    public function transferDelete($transfer_id)
    {

        $transfer = Transfer::findOrFail($transfer_id);
        $transfer->delete();

        return back()->withSuccess(__('Transfer '.$transfer->name.' successfully deleted.'));
    }
    public function transferRestore($transfer_id)
    {

        $transfer = Transfer::withTrashed()->findOrFail($transfer_id);
        $transfer->restore();

        return back()->withSuccess(__('Transfer '.$transfer->name.' successfully restored.'));
    }
}
