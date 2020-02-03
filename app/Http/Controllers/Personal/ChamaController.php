<?php

namespace App\Http\Controllers\Personal;

use App\ToDo;
use App\Account;
use App\ChamaMember;
use App\Transaction;
use App\Traits\UserTrait;
use App\AccountAdjustment;
use App\Chama;
use App\ChamaMemberRole;
use App\Traits\ChamaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ReferenceNumberTrait;
use App\WelfareType;

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
    public function chamas($portal)
    {
        // User
        $user = $this->getUser();
        // chama members
        $userChamas = ChamaMember::where('user_id',$user->id)->select('id')->get()->toArray();
        // get chamas
        $chamas = Chama::whereIn('id',$userChamas)->with('user','status')->get();
        // get deleted chamas
        $deletedChamas = Chama::whereIn('id',$userChamas)->with('user','status')->onlyTrashed()->get();

        return view('personal.chamas',compact('chamas','user','institution','chamas','deletedChamas'));
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
        $chamaMember->member_role_id = $chamaMemberChairRole->id;
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
        $chama = Chama::with('user','status','contacts')->where('id',$chama_id)->withCount('chama_members')->first();
        return view('personal.chama_show',compact('chama','user','institution'));
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
    public function chamaMembers($chama)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Units
        $units = Unit::where('chama_id',$chama->id)->with('status','user')->get();
        $deletedUnits = Unit::onlyTrashed()->get();
        return view('business.units',compact('user','chama','units','deletedUnits'));
    }

    public function chamaMemberCreate($chama)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get Chama members
        return view('business.unit_create',compact('user','chama'));
    }

    public function chamaMemberStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Create chama member
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $unit->chama_id = $chama->id;
        $unit->user_id = $user->id;
        $unit->save();

        return redirect()->route('business.unit.show',['chama'=>$chama->portal,'id'=>$unit->id])->withSuccess(__('Unit successfully created.'));
    }

    public function chamaMemberShow($chama, $unit_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Get chama member
        $unit = Unit::where('id',$unit_id)->with('status','user','products','product_groups')->first();

        return view('business.unit_show',compact('user','institution','unit'));
    }

    public function chamaMemberUpdate(Request $request,$chama,  $unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($chama);
        // Create chama member
        $unit = Unit::findOrFail($unit_id);
        $unit->chama_id = $chama->id;
        $unit->user_id = $user->id;
        $unit->save();
        return back()->withSuccess(__('Unit '.$unit->name.' successfully updated.'));
    }

    public function chamaMemberDelete($chama, $unit_id)
    {

        // delete the chama member
        $unit = Unit::findOrFail($unit_id);
        $unit->delete();

        return back()->withSuccess(__('Unit successfully deleted.'));
    }

    public function chamaMemberRestore($chama, $unit_id)
    {
        // restore the chama member
        $unit = Unit::withTrashed()->findOrFail($unit_id);
        $unit->restore();
        return back()->withSuccess(__('Unit successfully restored.'));
    }



    public function accounts($chama)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Get accounts
        $accounts = Account::with('user','status')->where('chama_id',$chama->id)->where('is_chama',true)->get();

        return view('personal.chama_accounts',compact('accounts','user'));
    }

    public function accountCreate($chama)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);

        return view('personal.chama_account_create',compact('user'));
    }

    public function accountStore(Request $request, $chama)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // select account type
        $account = new Account();
        $account->reference = $reference;
        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->notes = $request->notes;
        $account->is_institution = False;
        $account->is_chama = True;
        $account->chama_id = $chama->id;
        $account->is_user = True;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();
        return redirect()->route('personal.chama.account.show',['chama'=>$chama->id, 'transaction'=>$account->id])->withSuccess('Account '.$account->reference.' successfully created!');

    }

    public function accountShow($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get account
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->with('status','user','loans','account_adjustments','destination_account.source_account','transactions.account','transactions.expense','payments','source_account.destination_account','deposits','withdrawals','liabilities.contact','refunds','transactions')->first();
        $goal = $account->goal;
        $balance = $account->balance;
        if ($balance == 0){
            $percentage = 0;
        }else{
            $percentage = doubleval($goal)/$balance/100;
        }

        // Pending to dos
        $pendingToDos = ToDo::where('is_user',True)->with('user','status','account')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('account_id',$account->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_user',True)->with('user','status','account')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('account_id',$account->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_user',True)->with('user','status','account')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('account_id',$account->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_user',True)->with('user','status','account')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('account_id',$account->id)->get();

        return view('personal.chama_account_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','account','user','percentage'));
    }

    // public function accountDepositCreate($account_id)
    // {
    //     // User
    //     $user = $this->getUser();
    //     // get account
    //     $account = Account::findOrFail($account_id);
    //     $account = Account::where('id',$account_id)->where('is_user',True)->where('user_id',$user->id)->first();

    //     return view('personal.deposit_create',compact('account','user'));
    // }

    public function accountLiabilityCreate($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        // get members
        $members = ChamaMember::with('status','user')->where('chama_id',$chama->id)->get();
        return view('personal.chama_account_liability_create',compact('user','account','members'));
    }

    public function accountLoanCreate($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        // get members
        $members = ChamaMember::with('status','user')->where('chama_id',$chama->id)->get();
        return view('personal.account_loan_create',compact('user','account','members'));
    }

    public function accountWithdrawalCreate($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        return view('personal.withdrawal_create',compact('account','user'));
    }

    public function accountUpdate(Request $request, $chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // select account type
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();
        $account->name = $request->name;
        $account->goal = $request->goal;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('personal.account.show',['chama'=>$chama->id, 'transaction'=>$account->id])->withSuccess('Account '.$account->reference.' successfully updated!');
    }

    public function accountDelete($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // delete account
        $account = Account::findOrFail($account_id);
        $account->delete();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountRestore($chama, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);

        $account = Account::withTrashed()->findOrFail($account_id);
        $account->restore();

        return back()->withSuccess(__('Account '.$account->name.' successfully restored.'));
    }

    public function accountAdjustmentCreate($chama, $account_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // get accounts
        $accounts = Account::where('is_chama',True)->where('chama_id',$chama->id)->get();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama',True)->where('chama_id',$chama->id)->first();

        return view('personal.account_adjustment_create',compact('account','user','accounts'));

    }

    public function accountAdjustmentStore(Request $request, $chama)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
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
        $accountAdjustment->chama_id = $chama->id;
        $accountAdjustment->is_user = False;
        $accountAdjustment->is_chama = True;
        $accountAdjustment->is_institution = False;
        $accountAdjustment->save();

        // update account
        $account = Account::where('id',$request->account)->where('is_user',True)->where('user_id',$user->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($request->amount);
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.account.show',['chama'=>$chama->id, 'transaction'=>$account->id])->withSuccess('Account Adjustment successfully created!');

    }

    public function accountAdjustmentEdit($chama)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Get the design status counts
        $journalsStatusCount = $this->expensesStatusCount();
        // get accounts
        $accounts = Account::where('is_chama',True)->where('chama_id',$chama->id)->get();
        // Get transactions
        $transactions = Transaction::with('user','status','source_account','destination_account','account','expense')->where('chama_id',$chama->id)->where('is_chama',True)->get();
        return view('personal.account_adjustment_create',compact('transactions','user','journalsStatusCount','transactions','accounts'));

    }

    public function accountAdjustmentUpdate(Request $request, $chama)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
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

        return redirect()->route('personal.transaction.show',['chama'=>$chama->id, 'transaction'=>$transaction->id])->withSuccess('Expense '.$transaction->reference.' successfully updated!');

    }

    public function accountAdjustmentDelete($chama, $account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('is_user',True)->where('user_id',$user->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse
        $account = Account::where('id',$accountAdjustment->account_id)->where('is_user',True)->where('user_id',$user->id)->first();
        $account->balance = doubleval($account->balance)-doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();
        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully deleted.'));
    }

    public function accountAdjustmentRestore($chama, $account_adjustment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama);
        // Check if exists
        $accountAdjustmentExists = AccountAdjustment::findOrFail($account_adjustment_id);
        // get adjustment account
        $accountAdjustment = AccountAdjustment::where('id',$account_adjustment_id)->where('is_user',True)->where('user_id',$user->id)->first();
        $accountAdjustment->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        // reinburse account
        $account = Account::where('id',$accountAdjustment->account_id)->where('is_user',True)->where('user_id',$user->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($accountAdjustment->amount);
        $account->user_id = $user->id;
        $account->save();

        return back()->withSuccess(__('Account adjustment '.$accountAdjustment->reference.' successfully restored.'));
    }


}
