<?php

namespace App\Http\Controllers\Personal;

use Auth;
use App\Sale;
use App\Loan;
use App\ToDo;
use App\Status;
use App\Deposit;
use App\Contact;
use App\Expense;
use App\Account;
use App\Transfer;
use App\Campaign;
use App\Frequency;
use App\Liability;
use App\Withdrawal;
use App\Transaction;
use App\ExpenseAccount;
use App\Traits\UserTrait;
use App\AccountAdjustment;
use Illuminate\Http\Request;
use App\Traits\ReferenceNumberTrait;
use App\Http\Controllers\Controller;


class AccountController extends Controller
{

    use UserTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accounts()
    {
        // User
        $user = $this->getUser();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('user_id',$user->id)->where('is_user', true)->get();

        return view('personal.accounts',compact('accounts', 'user'));
    }

    public function accountCreate()
    {
        // User
        $user = $this->getUser();

        return view('personal.account_create',compact('user'));
    }

    public function accountStore(Request $request)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // select account type
        $account = new Account();
        $account->reference = $reference;
        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->notes = $request->notes;
        $account->is_user = true;
        $account->is_institution = false;
        $account->is_chama = false;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();
        return redirect()->route('personal.account.show',$account->id)->withSuccess('Account '.$account->reference.' successfully created!');
    }

    public function accountShow($account_id)
    {
        // User
        $user = $this->getUser();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->with('status', 'user', 'loans', 'accountAdjustments', 'destinationAccount.sourceAccount', 'transactions.account', 'transactions.expense', 'payments', 'sourceAccount.destinationAccount', 'deposits', 'withdrawals', 'liabilities.contact', 'refunds', 'transactions', 'incomeDebits.income', 'incomeDebits.account')->first();

        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'account')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('account_id',$account->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'account')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('account_id',$account->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'account')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('account_id',$account->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'account')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('account_id',$account->id)->get();

        return view('personal.account_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'account', 'user'));
    }

    public function accountDepositCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();

        return view('personal.deposit_create',compact('account', 'user'));
    }

    public function accountLiabilityCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.account_liability_create',compact('user', 'account', 'contacts'));
    }

    public function accountLoanCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.account_loan_create',compact('user', 'account', 'contacts'));
    }

    public function accountWithdrawalCreate($account_id)
    {
        // User
        $user = $this->getUser();
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();
        return view('personal.withdrawal_create',compact('account', 'user'));
    }

    public function accountUpdate(Request $request, $account_id)
    {
        // User
        $user = $this->getUser();
        // select account type
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();
        $account->name = $request->name;
        $account->goal = $request->goal;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('personal.account.show',$account->id)->withSuccess('Account '.$account->reference.' successfully updated!');
    }

    public function accountDelete($account_id)
    {
        // User
        $user = $this->getUser();
        // delete account
        $account = Account::findOrFail($account_id);
        $account->delete();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountRestore($account_id)
    {
        // User
        $user = $this->getUser();

        $account = Account::withTrashed()->findOrFail($account_id);
        $account->restore();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountAdjustmentCreate($account_id)
    {

        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('is_user', true)->get();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_user', true)->where('user_id',$user->id)->first();

        return view('personal.account_adjustment_create',compact('account', 'user', 'accounts'));

    }

    public function accountAdjustmentStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);

        // check if all required fields have been provided
        // $validatedInstitutionData = $request->validate([
        //     'account' => ['required'],
        //     'amount' => ['required', 'string', 'max:255'],
        //     'adjustment_date' => ['required', 'string'],
        //     'notes' => ['required', 'string', 'min:1'],
        // ]);

        // get account
        $account = Account::where('id',$request->account)->where('is_user', true)->where('user_id',$user->id)->first();
        $accountAdjustment = new AccountAdjustment();

        if($request->is_deposit == "on"){
            $accountAdjustment->is_deposit = true;
            $accountAdjustment->deposit_id = $request->design;
        }else{
            $accountAdjustment->is_deposit = false;
        }

        if($request->is_withdrawal == "on"){
            $accountAdjustment->is_withdrawal = true;
            $accountAdjustment->withdrawal_id = $request->design;
        }else{
            $accountAdjustment->is_withdrawal = false;
        }

        $accountAdjustment->reference = $reference;
        $accountAdjustment->notes = $request->notes;
        $accountAdjustment->amount = $request->amount;
        $accountAdjustment->initial_account_amount = $account->balance;
        $accountAdjustment->subsequent_account_amount = doubleval($account->balance)+doubleval($request->amount);
        $accountAdjustment->date = date('Y-m-d', strtotime($request->date));

        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $accountAdjustment->account_id = $request->account;
        $accountAdjustment->is_user = true;
        $accountAdjustment->is_institution = false;
        $accountAdjustment->save();

        // update account
        $account = Account::where('id',$request->account)->where('is_user', true)->where('user_id',$user->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($request->amount);
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.account.show',$account->id)->withSuccess('Account Adjustment successfully created!');

    }

    public function accountAdjustmentEdit()
    {

        // User
        $user = $this->getUser();
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // Get transactions
        $transactions = Transaction::with('user', 'status', 'sourceAccount', 'destinationAccount', 'account', 'expense')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.account_adjustment_create',compact('transactions', 'user', 'journalsStatusCount', 'transactions', 'accounts'));

    }

    public function accountAdjustmentUpdate(Request $request)
    {

        // User
        $user = $this->getUser();
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);
        $transaction = new Transaction();
        if ($request->is_expense == "on")
        {
            $transaction->is_expense = true;
            $transaction->is_transfer = false;
            $transaction->expense_id = $request->expense;
        }
        $transaction->account_id = $request->account;
        $transaction->amount = $request->amount;
        $transaction->reference = $reference;
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->notes = $request->notes;
        if ($request->is_transfer == "on")
        {
            $transaction->is_transfer = true;
            $transaction->is_expense = false;
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
                $account = Account::where('id',$request->account)->where('is_user', true)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();
            } elseif ($request->is_transfer == "on")
            {

                // credit source
                $account = Account::where('id',$request->sourceAccount)->where('is_user', true)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();


                // debit destination
                $account = Account::where('id',$request->destination_account)->where('is_user', true)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)+doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();

            }
        }
        // account subtraction

        return redirect()->route('personal.transaction.show',$transaction->id)->withSuccess('Transaction '.$transaction->reference.' successfully updated!');

    }

    public function accountAdjustmentDelete($account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('is_user', true)->where('user_id',$user->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse
        $account = Account::where('id',$accountAdjustment->account_id)->where('is_user', true)->where('user_id',$user->id)->first();
        $account->balance = doubleval($account->balance)-doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();
        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully deleted.'));
    }

    public function accountAdjustmentRestore($account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('is_user', true)->where('user_id',$user->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse account
        $account = Account::where('id',$accountAdjustment->account_id)->where('is_user', true)->where('user_id',$user->id)->first();
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
        $deposit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $deposit->user_id = $user->id;
        $deposit->is_user = true;
        $deposit->is_institution = false;
        $deposit->is_income = true;
        $deposit->is_chama = true;
        $deposit->save();

        return redirect()->route('personal.deposit.show',$deposit->id)->withSuccess('Deposit updated!');
    }

    public function depositShow($deposit_id)
    {
        // Check if action type exists
        $depositExists = Deposit::findOrFail($deposit_id);
        // User
        $user = $this->getUser();
        // get deposit
        $deposit = Deposit::with('user', 'status', 'account', 'accountAdjustments')->where('is_user', true)->where('user_id',$user->id)->where('id',$deposit_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'deposit')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('deposit_id',$deposit->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'deposit')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('deposit_id',$deposit->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'deposit')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('deposit_id',$deposit->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'deposit')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('deposit_id',$deposit->id)->get();

        return view('personal.deposit_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'deposit', 'user'));
    }

    public function depositAccountAdjustmentCreate($deposit_id)
    {

        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get deposit
        $depositExists = Deposit::findOrFail($deposit_id);
        $deposit = Deposit::with('user', 'status', 'account', 'accountAdjustments')->where('is_user', true)->where('user_id',$user->id)->where('id',$deposit_id)->first();
        // get account
        $accountExists = Account::findOrFail($deposit->account_id);
        $account = Account::where('id',$deposit->account_id)->where('is_user', true)->where('user_id',$user->id)->first();

        return view('personal.deposit_account_adjustment_create',compact('deposit', 'account', 'user', 'accounts'));

    }

    public function depositUpdate(Request $request, $deposit_id)
    {

        // User
        $user = $this->getUser();

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
        $accountAdjustment->is_deposit = true;
        $accountAdjustment->deposit_id = $deposit->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        return redirect()->route('personal.deposit.show',$deposit_id)->withSuccess('Deposit '. $deposit->name .' updated!');
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
        $withdrawal->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $withdrawal->user_id = $user->id;
        $withdrawal->is_user = true;
        $withdrawal->is_institution = false;
        $withdrawal->is_chama = false;
        $withdrawal->save();

        return redirect()->route('personal.withdrawal.show',$withdrawal->id)->withSuccess('Withdrawal updated!');
    }

    public function withdrawalShow($withdrawal_id)
    {
        // Check if action type exists
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        // User
        $user = $this->getUser();
        // get withdrawal
        $withdrawal = Withdrawal::with('user', 'status', 'account', 'accountAdjustments')->where('is_user', true)->where('user_id',$user->id)->where('id',$withdrawal_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'withdrawal')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('withdrawal_id',$withdrawal->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'withdrawal')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('withdrawal_id',$withdrawal->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'withdrawal')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('withdrawal_id',$withdrawal->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'withdrawal')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('withdrawal_id',$withdrawal->id)->get();

        return view('personal.withdrawal_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'withdrawal', 'user'));
    }

    public function withdrawalAccountAdjustmentCreate($withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get withdrawal
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal = Withdrawal::with('user', 'status', 'account', 'accountAdjustments')->where('is_user', true)->where('user_id',$user->id)->where('id',$withdrawal_id)->first();
        // get account
        $accountExists = Account::findOrFail($withdrawal->account_id);
        $account = Account::where('id',$withdrawal->account_id)->where('is_user', true)->where('user_id',$user->id)->first();

        return view('personal.withdrawal_account_adjustment_create',compact('withdrawal', 'account', 'user', 'accounts'));

    }

    public function withdrawalUpdate(Request $request, $withdrawal_id)
    {

        // User
        $user = $this->getUser();

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
        $accountAdjustment->is_withdrawal = true;
        $accountAdjustment->withdrawal_id = $withdrawal->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        return redirect()->route('personal.withdrawal.show',$withdrawal_id)->withSuccess('Withdrawal '. $withdrawal->name .' updated!');
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
        $liabilities = Liability::with('user', 'status', 'account', 'account')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.liabilities',compact('liabilities', 'user'));
    }

    public function liabilityCreate()
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.liability_create',compact('user', 'accounts', 'contacts'));
    }

    public function liabilityStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // calculations
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) + doubleval($request->total);

        // store liability record
        $liability = new Liability();
        $liability->reference = $reference;
        $liability->about = $request->about;

        $liability->total = $request->total;
        $liability->principal = $request->principal;
        $liability->interest = $request->interest;
        $liability->interest_amount = $request->interest_amount;
        $liability->paid = 0;

        $liability->date = date('Y-m-d', strtotime($request->date));
        $liability->due_date = date('Y-m-d', strtotime($request->due_date));

        $liability->contact_id = $request->contact;
        $liability->account_id = $request->account;

        $liability->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $liability->user_id = $user->id;

        $liability->is_institution = false;
        $liability->is_user = true;
        $liability->is_chama = true;

        $liability->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.liability.show',$liability->id)->withSuccess('Liability created!');
    }

    public function liabilityShow($liability_id)
    {
        // Check if contact type exists
        $liabilityExists = Liability::findOrFail($liability_id);
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        // Get contact type
        $liability = Liability::with('user', 'status', 'account', 'contact.organization', 'expenses.transactions')->where('is_user', true)->where('user_id',$user->id)->where('id',$liability_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'liability')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('liability_id',$liability->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'liability')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('liability_id',$liability->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'liability')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('liability_id',$liability->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_user', true)->where('user_id',$user->id)->with('user', 'status', 'liability')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('liability_id',$liability->id)->get();

        return view('personal.liability_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'accounts', 'contacts', 'liability', 'user'));
    }

    // TODO expense for liability
    public function liabilityExpenseCreate($liability_id)
    {
        // User
        $user = $this->getUser();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('is_user', true)->where('user_id',$user->id)->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id', '7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get transfers
        $transfers = Transfer::where('is_user', true)->where('user_id',$user->id)->get();
        // get liabilities
        $liability = Liability::where('id',$liability_id)->where('is_user', true)->where('user_id',$user->id)->first();
        // get frequencies
        $frequencies = Frequency::where("status_id","c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('is_user', true)->where('user_id',$user->id)->get();

        return view('personal.liability_expense_create',compact('liability', 'campaigns', 'sales', 'user', 'frequencies', 'expenseAccounts', 'transfers', 'expenseStatuses'));
    }

    public function liabilityUpdate(Request $request, $liability_id)
    {

        $liability = Liability::findOrFail($liability_id);

        return back();
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
        $loans = Loan::with('user', 'status', 'account')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.loans',compact('loans', 'user'));
    }

    public function loanCreate()
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.loan_create',compact('user', 'accounts', 'contacts'));
    }

    public function loanStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // calculations
        $account = Account::findOrFail($request->account);
        // check if this is an overdraft
        if($request->total > $account->balance){
            return back()->withWarning(__('This loan will overdraft the account.'));
        }
        $accountBalance = doubleval($account->balance) - doubleval($request->total);

        // store loan record
        $loan = new Loan();
        $loan->reference = $reference;
        $loan->about = $request->about;

        $loan->total = $request->total;
        $loan->principal = $request->principal;
        $loan->interest = $request->interest;
        $loan->interest_amount = $request->interest_amount;
        $loan->balance = $request->total;
        $loan->paid = 0;

        $loan->date = date('Y-m-d', strtotime($request->date));
        $loan->due_date = date('Y-m-d', strtotime($request->due_date));

        $loan->contact_id = $request->contact;
        $loan->account_id = $request->account;

        $loan->is_user = true;
        $loan->is_institution = false;
        $loan->is_chama = false;

        $loan->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $loan->user_id = $user->id;
        $loan->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.loan.show',$loan->id)->withSuccess('Loan created!');
    }

    public function loanShow($loan_id)
    {
        // Check if contact type exists
        $loanExists = Loan::findOrFail($loan_id);
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('user_id',$user->id)->where('is_user', true)->get();
        // Get contact type
        $loan = Loan::with('user', 'status', 'account', 'contact.organization', 'payments')->where('id',$loan_id)->where('user_id',$user->id)->where('is_user', true)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'loan')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('loan_id',$loan->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'loan')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('loan_id',$loan->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'loan')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('loan_id',$loan->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'loan')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('loan_id',$loan->id)->get();
        return view('personal.loan_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'accounts', 'contacts', 'loan', 'user'));
    }

    public function loanPaymentCreate($loan_id)
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        // loans
        $loan = Loan::findOrFail($loan_id);
        return view('personal.loan_payment_create',compact('user', 'accounts', 'loan'));
    }

    public function loanUpdate(Request $request, $loan_id)
    {

        $loan = Loan::findOrFail($loan_id);
        return back();

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
        $transfers = Transfer::with('user', 'status', 'sourceAccount', 'destinationAccount')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.transfers',compact('transfers', 'user'));
    }

    public function transferCreate()
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.transfer_create',compact('user', 'accounts'));
    }

    public function transferStore(Request $request)
    {

        // User
        $user = $this->getUser();

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
        $transfer->is_user = true;
        $transfer->is_institution = false;
        $transfer->save();

        // update accounts balance
        $sourceAccount->balance = $sourceAccountSubsequentAmount;
        $sourceAccount->user_id = $user->id;
        $sourceAccount->is_user = true;
        $sourceAccount->is_institution = false;
        $sourceAccount->save();
        $destinationAccount->balance = $destinationAccountSubsequentAmount;
        $destinationAccount->user_id = $user->id;
        $destinationAccount->save();

        return redirect()->route('personal.transfer.show',$transfer->id)->withSuccess('Transfer created!');
    }

    public function transferShow($transfer_id)
    {
        // Check if contact type exists
        $transferExists = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Get contact type
        $transfer = Transfer::with('user', 'status', 'sourceAccount', 'destinationAccount', 'expenses')->where('user_id',$user->id)->where('is_user', true)->where('id',$transfer_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('transfer_id',$transfer->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('transfer_id',$transfer->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('transfer_id',$transfer->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('transfer_id',$transfer->id)->get();

        return view('personal.transfer_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'transfer', 'user'));
    }

    public function transferExpenseCreate($transfer_id)
    {
        // get transfer
        $transfer = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id', '7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.transfer_expense_create',compact('transfer', 'user', 'journalsStatusCount', 'expenseStatuses', 'expenseAccounts'));
    }

    public function transferUpdate(Request $request, $transfer_id)
    {

        $transfer = Transfer::findOrFail($transfer_id);
        // $transfer->name = $request->name;
        // $transfer->save();

        return back();
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
