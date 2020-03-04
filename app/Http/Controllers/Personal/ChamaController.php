<?php

namespace App\Http\Controllers\Personal;

use App\ToDo;
use App\Account;
use App\ChamaMember;
use App\Transaction;
use App\Traits\UserTrait;
use App\AccountAdjustment;
use App\Chama;
use App\User;
use App\ChamaMemberRole;
use App\Contact;
use App\Deposit;
use App\ExpenseAccount;
use App\Frequency;
use App\Traits\ChamaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Liability;
use App\Loan;
use App\Status;
use App\Traits\ReferenceNumberTrait;
use App\Transfer;
use App\WelfareType;
use App\Withdrawal;

class ChamaController extends Controller
{
    use UserTrait;
    use ChamaTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }


    // chamas
    public function chamas()
    {
        // User
        $user = $this->getUser();
        // chama members
        $userChamas = ChamaMember::where('user_id',$user->id)->select('chama_id')->get()->toArray();

        // return $userChamas;
        // get chamas
        $chamas = Chama::whereIn('id',$userChamas)->with('user','status')->get();

        // return $chamas;
        // get deleted chamas
        $deletedChamas = Chama::whereIn('id',$userChamas)->with('user','status')->onlyTrashed()->get();

        return view('personal.chamas',compact('chamas','user','chamas','deletedChamas'));
    }

    public function chamaCreate()
    {
        // User
        $user = $this->getUser();

        return view('personal.chama_create',compact('user'));
    }

    public function chamaStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $chama = new Chama();
        $chama->name = ($request->name);
        $chama->description = ($request->description);
        $chama->share_price = ($request->share_price);
        $chama->interest = ($request->interest);
        $chama->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chama->user_id = $user->id;
        $chama->save();

        // chama welfare types
        $walfareType = new WelfareType();
        $walfareType->name = "Funeral";
        $walfareType->user_id = $user->id;
        $walfareType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $walfareType->chama_id = $chama->id;
        $walfareType->save();

        // chama welfare types
        $walfareType = new WelfareType();
        $walfareType->name = "Wedding";
        $walfareType->user_id = $user->id;
        $walfareType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $walfareType->chama_id = $chama->id;
        $walfareType->save();

        // chama member roles
        $chamaMemberChairRole = new ChamaMemberRole();
        $chamaMemberChairRole->name = "Chair";
        $chamaMemberChairRole->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMemberChairRole->chama_id = $chama->id;
        $chamaMemberChairRole->user_id = $user->id;
        $chamaMemberChairRole->save();

        $chamaMemberTreasurerRole = new ChamaMemberRole();
        $chamaMemberTreasurerRole->name = "Treasurer";
        $chamaMemberTreasurerRole->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMemberTreasurerRole->chama_id = $chama->id;
        $chamaMemberTreasurerRole->user_id = $user->id;
        $chamaMemberTreasurerRole->save();

        $chamaMemberSecretaryRole = new ChamaMemberRole();
        $chamaMemberSecretaryRole->name = "Secretary";
        $chamaMemberSecretaryRole->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMemberSecretaryRole->chama_id = $chama->id;
        $chamaMemberSecretaryRole->user_id = $user->id;
        $chamaMemberSecretaryRole->save();

        $chamaMemberMemberRole = new ChamaMemberRole();
        $chamaMemberMemberRole->name = "Member";
        $chamaMemberMemberRole->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMemberMemberRole->chama_id = $chama->id;
        $chamaMemberMemberRole->user_id = $user->id;
        $chamaMemberMemberRole->save();


        // add user as membber
        $chamaMember = new ChamaMember();
        $chamaMember->shares = 0;
        $chamaMember->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";

        // Chama member type
        if($request->member_role == "chair"){
            // chair
            $chamaMember->member_role_id = $chamaMemberChairRole->id;
        }elseif($request->member_role == "tresurer"){
            // tresurer
            $chamaMember->member_role_id = $chamaMemberTreasurerRole->id;
        }elseif($request->member_role == "secretary"){
            // secretary
            $chamaMember->member_role_id = $chamaMemberSecretaryRole->id;
        }elseif($request->member_role == "member"){
            // member
            $chamaMember->member_role_id = $chamaMemberMemberRole->id;
        }

        $chamaMember->name = $user->name;
        $chamaMember->email = $user->email;
        $chamaMember->phone_number = $user->phone_number;

        $chamaMember->member_id = 1;
        $chamaMember->is_user = True;
        $chamaMember->user_id = $user->id;
        $chamaMember->chama_id = $chama->id;
        $chamaMember->save();

        return redirect()->route('personal.chama.show',$chama->id)->withSuccess(__('Chama '.$chama->name.' successfully created.'));
    }

    public function chamaShow($chama_id)
    {
        // User
        $user = $this->getUser();
        // Check if chama exists
        $chamaExists = Chama::findOrFail($chama_id);
        $chama = Chama::with('user','status','chama_members')->where('id',$chama_id)->withCount('chama_members')->first();
        return view('personal.chama_show',compact('chama','user'));
    }

    public function chamaUpdate(Request $request, $chama_id)
    {
        // User
        $user = $this->getUser();

        $chama = Chama::findOrFail($chama_id);
        $chama->name = ($request->name);
        $chama->user_id = $user->id;
        $chama->save();

        return redirect()->route('personal.chama.show',$chama->id)->withSuccess('Chama '.$chama->name.' updated!');
    }

    public function chamaDelete($portal, $chama_id)
    {

        $chama = Chama::findOrFail($chama_id);
        $chama->delete();

        return back()->withSuccess(__('Chama '.$chama->name.' successfully deleted.'));
    }

    public function chamaRestore($portal, $chama_id)
    {

        $chama = Chama::withTrashed()->findOrFail($chama_id);
        $chama->restore();

        return back()->withSuccess(__('Chama '.$chama->name.' successfully restored.'));
    }


    // Chama members
    public function chamaMembers($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Members
        $members = ChamaMember::where('chama_id',$chama->id)->with('status','user','chama_member_role')->get();
        $deletedMembers = ChamaMember::onlyTrashed()->get();
        return view('personal.chama_members',compact('user','chama','members','deletedMembers'));

    }

    public function chamaMemberCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // chama member roles
        $chamaMemberRoles = ChamaMemberRole::where('chama_id',$chama->id)->get();
        // get Chama members
        return view('personal.chama_member_create',compact('user','chama','chamaMemberRoles'));

    }

    public function chamaMemberStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Create chama member
        $chamaMember = new ChamaMember();
        $chamaMember->name = $request->name;
        $chamaMember->email = $request->email;
        $chamaMember->phone_number = $request->phone_number;
        $chamaMember->member_role_id = $request->member_role;
        $chamaMember->shares = $request->shares;
        $chamaMember->is_user = False;
        $chamaMember->member_id = 1;
        $chamaMember->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMember->chama_id = $chama->id;
        $chamaMember->user_id = $user->id;
        $chamaMember->save();

        // check if email registered
        $user = User::where('email',$request->email)->first();
        // send invite link
        if ($user){
            // user invitation link
        }else{
            // non user invitation link
        }

        return redirect()->route('personal.chama.member.show',['chama'=>$chama->portal,'id'=>$chamaMember->id])->withSuccess(__('Chama Member successfully created.'));

    }

    public function chamaMemberShow($chama_id, $unit_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get chama member
        $unit = ChamaMember::where('id',$unit_id)->with('status','user','products','product_groups')->first();
        return view('personal.unit_show',compact('user','chama','unit'));

    }

    public function chamaMemberUpdate(Request $request, $chama_id, $chama_member_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $chama = $this->getInstitution($chama_id);
        // Create chama member
        $chamaMember = ChamaMember::findOrFail($chama_member_id);
        $chamaMember->chama_id = $chama->id;
        $chamaMember->user_id = $user->id;
        $chamaMember->save();
        return back()->withSuccess(__('Unit '.$chamaMember->name.' successfully updated.'));

    }

    public function chamaMemberDelete($chama_id, $chama_member_id)
    {

        // delete the chama member
        $chamaMember = ChamaMember::findOrFail($chama_member_id);
        $chamaMember->delete();
        return back()->withSuccess(__('Chama Member successfully deleted.'));

    }

    public function chamaMemberRestore($chama_id, $chama_member_id)
    {

        // restore the chama member
        $chamaMember = ChamaMember::withTrashed()->findOrFail($chama_member_id);
        $chamaMember->restore();
        return back()->withSuccess(__('Chama Member successfully restored.'));

    }



    public function chamaAccounts($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get accounts
        $accounts = Account::with('user','status')->where('is_chama',true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_accounts',compact('accounts','user','chama'));

    }

    public function chamaAccountCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        return view('personal.chama_account_create',compact('user','chama'));
        
    }

    public function chamaAccountStore(Request $request, $chama_id)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // select account type
        $account = new Account();
        $account->reference = $reference;
        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->notes = $request->notes;
        $account->is_user = False;
        $account->is_institution = False;
        $account->is_chama = True;
        $account->user_id = $user->id;
        $account->chama_id = $chama->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();
        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id,'account_id'=>$account->id])->withSuccess('Account '.$account->reference.' successfully created!');
    }

    public function chamaAccountShow($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->with('status','user','loans','account_adjustments','destination_account.source_account','transactions.account','transactions.expense','payments','source_account.destination_account','deposits','withdrawals','liabilities.contact','refunds','transactions')->first();


        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama',True)->with('user','status','account')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('account_id',$account->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama',True)->with('user','status','account')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('account_id',$account->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama',True)->with('user','status','account')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('account_id',$account->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama',True)->with('user','status','account')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('account_id',$account->id)->get();

        return view('personal.chama_account_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','account','user','chama'));
    }

    public function chamaAccountDepositCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();

        return view('personal.chama_deposit_create',compact('account','user','chama'));
    }

    public function chamaAccountLiabilityCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user',True)->where('user_id',$user->id)->get();
        return view('personal.chama_account_liability_create',compact('user','account','contacts','chama'));
    }

    public function chamaAccountLoanCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user',True)->where('user_id',$user->id)->get();
        return view('personal.chama_account_loan_create',compact('user','account','contacts','chama'));
    }

    public function chamaAccountWithdrawalCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        return view('personal.chama_withdrawal_create',compact('account','user','chama'));
    }

    public function chamaAccountUpdate(Request $request, $chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // select account type
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        $account->name = $request->name;
        $account->goal = $request->goal;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id,'account_id'=>$account->id])->withSuccess('Account '.$account->reference.' successfully updated!');
    }

    public function chamaAccountDelete($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // delete account
        $account = Account::findOrFail($account_id);
        $account->delete();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function chamaAccountRestore($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

        $account = Account::withTrashed()->findOrFail($account_id);
        $account->restore();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function chamaAccountAdjustmentCreate($chama_id, $account_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_chama',True)->where('chama_id',$chama->id)->get();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();

        return view('personal.chama_account_adjustment_create',compact('account','user','accounts','chama'));

    }

    public function chamaAccountAdjustmentStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);

        // get account
        $account = Account::where('id',$request->account)->where('is_chama',True)->where('chama_id',$chama->id)->first();
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
        $accountAdjustment->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $accountAdjustment->account_id = $request->account;
        $accountAdjustment->is_user = False;
        $accountAdjustment->is_institution = False;
        $accountAdjustment->save();

        // update account
        $account = Account::where('id',$request->account)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($request->amount);
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id,'account_id'=>$account->id])->withSuccess('Account Adjustment successfully created!');

    }

    public function chamaAccountAdjustmentEdit($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // get accounts
        $accounts = Account::where('is_user',True)->where('user_id',$user->id)->get();
        // Get transactions
        $transactions = Transaction::with('user','status','source_account','destination_account','account','expense')->where('user_id',$user->id)->where('is_user',True)->get();
        return view('personal.chama_account_adjustment_create',compact('transactions','user','journalsStatusCount','transactions','accounts','chama'));

    }

    public function chamaAccountAdjustmentUpdate(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
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
                $account = Account::where('id',$request->account)->where('is_user',True)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();
            } elseif ($request->is_transfer == "on")
            {

                // credit source
                $account = Account::where('id',$request->source_account)->where('is_user',True)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)-doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();


                // debit destination
                $account = Account::where('id',$request->destination_account)->where('is_user',True)->where('user_id',$user->id)->first();
                $account->balance = doubleval($account->balance)+doubleval($request->amount);
                $account->user_id = $user->id;
                $account->save();

            }
        }
        // account subtraction

        return redirect()->route('personal.chama.transaction.show',['chama_id'=>$chama->id,'transaction_id'=>$transaction->id])->withSuccess('Transaction '.$transaction->reference.' successfully updated!');

    }

    public function chamaAccountAdjustmentDelete($chama_id, $account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse
        $account = Account::where('id',$accountAdjustment->account_id)->first();
        $account->balance = doubleval($account->balance)-doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();
        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully deleted.'));
    }

    public function chamaAccountAdjustmentRestore($chama_id, $account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse account
        $account = Account::where('id',$accountAdjustment->account_id)->first();
        $account->balance = doubleval($account->balance)+doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();

        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully restored.'));
    }


    // deposits
    public function chamaDepositStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

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
        $deposit->is_user = False;
        $deposit->is_institution = False;
        $deposit->is_income = True;
        $deposit->is_chama = True;
        $deposit->save();

        return redirect()->route('personal.chama.deposit.show',['chama_id'=>$chama->id,'deposit_id'=>$deposit->id])->withSuccess('Deposit updated!');
    }

    public function chamaDepositShow($chama_id, $deposit_id)
    {
        // Check if action type exists
        $depositExists = Deposit::findOrFail($deposit_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get deposit
        $deposit = Deposit::with('user','status','account','account_adjustments')->where('is_chama',True)->where('id',$deposit_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','deposit')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('deposit_id',$deposit->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','deposit')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('deposit_id',$deposit->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','deposit')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('deposit_id',$deposit->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','deposit')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('deposit_id',$deposit->id)->get();

        return view('personal.chama_deposit_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','deposit','user','chama'));
    }

    public function chamaDepositAccountAdjustmentCreate($chama_id, $deposit_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_user',True)->where('user_id',$user->id)->get();
        // get deposit
        $depositExists = Deposit::findOrFail($deposit_id);
        $deposit = Deposit::with('user','status','account','account_adjustments')->where('is_user',True)->where('user_id',$user->id)->where('id',$deposit_id)->first();
        // get account
        $accountExists = Account::findOrFail($deposit->account_id);
        $account = Account::where('id',$deposit->account_id)->where('is_user',True)->where('user_id',$user->id)->first();

        return view('personal.chama_deposit_account_adjustment_create',compact('deposit','account','user','accounts','chama'));

    }

    public function chamaDepositUpdate(Request $request, $chama_id, $deposit_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

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

        return redirect()->route('personal.chama.deposit.show',['chama_id'=>$chama->id,'deposit_id'=>$deposit->id])->withSuccess('Deposit '. $deposit->name .' updated!');
    }


    public function chamaDepositDelete($chama_id, $deposit_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $deposit = Deposit::findOrFail($deposit_id);
        $deposit->delete();

        return back()->withSuccess(__('Deposit '.$deposit->name.' successfully deleted.'));
    }

    public function chamaDepositRestore($chama_id, $deposit_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $deposit = Deposit::withTrashed()->findOrFail($deposit_id);
        $deposit->restore();

        return back()->withSuccess(__('Deposit '.$deposit->name.' successfully restored.'));
    }


    // withdrawals
    public function chamaWithdrawalStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

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
        $withdrawal->is_user = False;
        $withdrawal->is_institution = False;
        $withdrawal->is_chama = True;
        $withdrawal->save();

        return redirect()->route('personal.chama.withdrawal.show',['chama_id'=>$chama->id,'withdrawal_id'=>$withdrawal->id])->withSuccess('Withdrawal updated!');
    }

    public function chamaWithdrawalShow($chama_id, $withdrawal_id)
    {
        // Check if action type exists
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get withdrawal
        $withdrawal = Withdrawal::with('user','status','account','account_adjustments')->where('is_chama',True)->where('id',$withdrawal_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','withdrawal')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('withdrawal_id',$withdrawal->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','withdrawal')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('withdrawal_id',$withdrawal->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','withdrawal')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('withdrawal_id',$withdrawal->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','withdrawal')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('withdrawal_id',$withdrawal->id)->get();

        return view('personal.chama_withdrawal_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','withdrawal','user','chama'));
    }

    public function chamaWithdrawalAccountAdjustmentCreate($chama_id, $withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_chama',True)->where('chama_id',$chama->id)->get();
        // get withdrawal
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal = Withdrawal::with('user','status','account','account_adjustments')->where('is_chama',True)->where('id',$withdrawal_id)->first();
        // get account
        $accountExists = Account::findOrFail($withdrawal->account_id);
        $account = Account::where('id',$withdrawal->account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();

        return view('personal.chama_withdrawal_account_adjustment_create',compact('withdrawal','account','user','accounts','chama'));

    }

    public function chamaWithdrawalUpdate(Request $request, $chama_id, $withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

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

        return redirect()->route('personal.chama.withdrawal.show',['chama_id'=>$chama->id,'withdrawal_id'=>$withdrawal->id])->withSuccess('Withdrawal '. $withdrawal->name .' updated!');
    }

    public function chamaWithdrawalDelete($chama_id, $withdrawal_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $withdrawal = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal->delete();

        return back()->withSuccess(__('Withdrawal '.$withdrawal->name.' successfully deleted.'));
    }

    public function chamaWithdrawalRestore($chama_id, $withdrawal_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $withdrawal = Withdrawal::withTrashed()->findOrFail($withdrawal_id);
        $withdrawal->restore();

        return back()->withSuccess(__('Withdrawal '.$withdrawal->name.' successfully restored.'));
    }


    //liabilities
    public function chamaLiabilities($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get liabilities
        $liabilities = Liability::with('user','status','account','account')->where('is_user',True)->where('user_id',$user->id)->get();

        return view('personal.chama_liabilities',compact('liabilities','user','chama'));
    }

    public function chamaLiabilityCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_user',True)->where('user_id',$user->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user',True)->where('user_id',$user->id)->get();
        return view('personal.chama_liability_create',compact('user','accounts','contacts','chama'));
    }

    public function chamaLiabilityStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
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

        $liability->is_institution = False;
        $liability->is_user = False;
        $liability->is_chama = True;
        $liability->chama_id = $chama->id;

        $liability->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.chama.liability.show',['chama_id'=>$chama->id,'liability_id'=>$liability->id])->withSuccess('Liability created!');
    }

    public function chamaLiabilityShow($chama_id, $liability_id)
    {
        // Check if contact type exists
        $liabilityExists = Liability::findOrFail($liability_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_chama',True)->where('chama_id',$chama->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user',True)->where('user_id',$user->id)->get();
        // Get contact type
        $liability = Liability::with('user','status','account','contact.organization','expenses.transactions')->where('is_chama',True)->where('chama_id',$chama->id)->where('id',$liability_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','liability')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('liability_id',$liability->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','liability')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('liability_id',$liability->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','liability')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('liability_id',$liability->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama',True)->where('chama_id',$chama->id)->with('user','status','liability')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('liability_id',$liability->id)->get();

        return view('personal.chama_liability_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','accounts','contacts','liability','user','chama'));
    }

    // TODO expense for liability
    public function chamaLiabilityExpenseCreate($chama_id, $liability_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('is_user',True)->where('user_id',$user->id)->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get transfers
        $transfers = Transfer::where('is_user',True)->where('user_id',$user->id)->get();
        // get liabilities
        $liability = Liability::where('id',$liability_id)->where('is_user',True)->where('user_id',$user->id)->first();
        // get frequencies
        $frequencies = Frequency::where('is_user',True)->where('user_id',$user->id)->get();

        return view('personal.chama_liability_expense_create',compact('liability','campaigns','sales','user','frequencies','expenseAccounts','transfers','expenseStatuses','chama'));
    }

    public function chamaLiabilityUpdate(Request $request, $chama_id, $liability_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $liability = Liability::findOrFail($liability_id);

        return back();
    }

    public function chamaLiabilityDelete($chama_id, $liability_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $liability = Liability::findOrFail($liability_id);
        $liability->delete();

        return back()->withSuccess(__('Liability '.$liability->name.' successfully deleted.'));
    }
    public function chamaLiabilityRestore($chama_id, $liability_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $liability = Liability::withTrashed()->findOrFail($liability_id);
        $liability->restore();

        return back()->withSuccess(__('Liability '.$liability->name.' successfully restored.'));
    }


    // loans
    public function chamaLoans($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get loans
        $loans = Loan::with('user','status','account')->where('user_id',$user->id)->where('is_user',true)->get();
        return view('personal.chama_loans',compact('loans','user','chama'));
    }

    public function chamaLoanCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',True)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('user_id',$user->id)->where('is_user',True)->get();
        return view('personal.chama_loan_create',compact('user','accounts','contacts','chama'));
    }

    public function chamaLoanStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
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
        $loan->paid = 0;

        $loan->date = date('Y-m-d', strtotime($request->date));
        $loan->due_date = date('Y-m-d', strtotime($request->due_date));

        $loan->contact_id = $request->contact;
        $loan->account_id = $request->account;

        $loan->is_user = False;
        $loan->is_institution = False;
        $loan->is_chama = True;

        $loan->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $loan->user_id = $user->id;
        $loan->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.chama.loan.show',['chama_id'=>$chama->id,'loan_id'=>$loan->id])->withSuccess('Loan created!');
    }

    public function chamaLoanShow($chama_id, $loan_id)
    {
        // Check if contact type exists
        $loanExists = Loan::findOrFail($loan_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',True)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('user_id',$user->id)->where('is_user',True)->get();
        // Get contact type
        $loan = Loan::with('user','status','account','contact.organization','payments')->where('id',$loan_id)->where('user_id',$user->id)->where('is_user',True)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','loan')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('loan_id',$loan->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','loan')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('loan_id',$loan->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','loan')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('loan_id',$loan->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','loan')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('loan_id',$loan->id)->get();
        return view('personal.chama_loan_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','accounts','contacts','loan','user','chama'));
    }

    public function chamaLoanPaymentCreate($chama_id, $loan_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',True)->get();
        // loans
        $loan = Loan::findOrFail($loan_id);
        return view('personal.chama_loan_payment_create',compact('user','accounts','loan','chama'));
    }

    public function chamaLoanUpdate(Request $request, $chama_id, $loan_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $loan = Loan::findOrFail($loan_id);
        return back();

    }

    public function chamaLoanDelete($chama_id, $loan_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $loan = Loan::findOrFail($loan_id);
        $loan->delete();

        return back()->withSuccess(__('Loan '.$loan->name.' successfully deleted.'));
    }
    public function chamaLoanRestore($chama_id, $loan_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $loan = Loan::withTrashed()->findOrFail($loan_id);
        $loan->restore();

        return back()->withSuccess(__('Loan '.$loan->name.' successfully restored.'));
    }


    //transfers
    public function chamaTransfers($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // transfers
        $transfers = Transfer::with('user','status','source_account','destination_account')->where('user_id',$user->id)->where('is_user',true)->get();
        return view('personal.chama_transfers',compact('transfers','user','chama'));
    }

    public function chamaTransferCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',true)->get();
        return view('personal.chama_transfer_create',compact('user','accounts','chama'));
    }

    public function chamaTransferStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

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
        $transfer->is_user = False;
        $transfer->is_institution = False;
        $transfer->save();

        // update accounts balance
        $sourceAccount->balance = $sourceAccountSubsequentAmount;
        $sourceAccount->user_id = $user->id;
        $sourceAccount->save();
        $destinationAccount->balance = $destinationAccountSubsequentAmount;
        $destinationAccount->user_id = $user->id;
        $destinationAccount->save();

        return redirect()->route('personal.chama.transfer.show',['chama_id'=>$chama->id,'transfer_id'=>$transfer->id])->withSuccess('Transfer created!');
    }

    public function chamaTransferShow($chama_id, $transfer_id)
    {
        // Check if contact type exists
        $transferExists = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get contact type
        $transfer = Transfer::with('user','status','source_account','destination_account','expenses')->where('user_id',$user->id)->where('is_user',True)->where('id',$transfer_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','transfer')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('transfer_id',$transfer->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','transfer')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('transfer_id',$transfer->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','transfer')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('transfer_id',$transfer->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','transfer')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('transfer_id',$transfer->id)->get();

        return view('personal.chama_transfer_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','transfer','user','chama'));
    }

    public function chamaTransferExpenseCreate($chama_id, $transfer_id)
    {
        // get transfer
        $transfer = Transfer::findOrFail($transfer_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('user_id',$user->id)->where('is_user',True)->get();
        return view('personal.chama_transfer_expense_create',compact('transfer','user','journalsStatusCount','expenseStatuses','expenseAccounts','chama'));
    }

    public function chamaTransferUpdate(Request $request, $chama_id, $transfer_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $transfer = Transfer::findOrFail($transfer_id);
        // $transfer->name = $request->name;
        // $transfer->save();

        return back();
    }

    public function chamaTransferDelete($chama_id, $transfer_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $transfer = Transfer::findOrFail($transfer_id);
        $transfer->delete();

        return back()->withSuccess(__('Transfer '.$transfer->name.' successfully deleted.'));
    }
    public function chamaTransferRestore($chama_id, $transfer_id)
    {
        // Chama
        $chama = $this->getChama($chama_id);

        $transfer = Transfer::withTrashed()->findOrFail($transfer_id);
        $transfer->restore();

        return back()->withSuccess(__('Transfer '.$transfer->name.' successfully restored.'));
    }


}
