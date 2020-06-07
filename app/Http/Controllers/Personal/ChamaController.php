<?php

namespace App\Http\Controllers\Personal;

use DB;
use App\ToDo;
use App\Account;
use App\ChamaMember;
use App\Transaction;
use App\Traits\UserTrait;
use App\AccountAdjustment;
use App\Chama;
use App\ChamaMeeting;
use App\ChamaMeetingMember;
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
use App\Payment;
use App\Penalty;
use App\SharesPayment;
use App\Status;
use App\Traits\ReferenceNumberTrait;
use App\Transfer;
use App\Welfare;
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
        $chamas = Chama::whereIn('id',$userChamas)->with('user', 'status')->get();

        // return $chamas;
        // get deleted chamas
        $deletedChamas = Chama::whereIn('id',$userChamas)->with('user', 'status')->onlyTrashed()->get();

        return view('personal.chamas',compact('chamas', 'user', 'chamas', 'deletedChamas'));
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
        $chamaMember->shares = $request->shares;
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

        $chamaMember->member_id = $user->id;
        $chamaMember->is_user = true;
        $chamaMember->user_id = $user->id;
        $chamaMember->chama_id = $chama->id;
        $chamaMember->save();

        // chama member shares
        $date = date('Y-m-d');
        $sharePayment = new SharesPayment();
        $sharePayment->shares = $request->shares;
        $sharePayment->amount = $chama->share_price;
        $value = doubleval($chama->share_price)*doubleval($request->shares);
        $sharePayment->value = $value;
        $sharePayment->date = $date;
        $sharePayment->member_id = $chamaMember->id;
        $sharePayment->chama_id = $chama->id;
        $sharePayment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $sharePayment->user_id = $user->id;
        $sharePayment->save();

        return redirect()->route('personal.chama.show',$chama->id)->withSuccess(__('Chama '.$chama->name.' successfully created.'));
    }

    public function chamaShow($chama_id)
    {
        // User
        $user = $this->getUser();
        // Check if chama exists
        $chamaExists = Chama::findOrFail($chama_id);
        $chama = Chama::with('user', 'status', 'chamaMembers')->where('id',$chama_id)->withCount('chamaMembers')->first();

        //chama accounts
        $chamaAccounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        //chama loans
        $chamaLoans = Loan::with('user', 'status', 'account', 'chamaMember')->where('is_chama', true)->get();
        //chama meetings
        $chamaMeetings = ChamaMeeting::where('chama_id',$chama->id)->with('user', 'status', 'chama')->get();
        //chama members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('status', 'user', 'chamaMemberRole')->get();
        //chama penalties
        $chamaPenalties = Penalty::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama', 'account')->get();
        //chama shares
        $chamaSharePayments = SharesPayment::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama')->get();
        //chama welfare
        $chamaWelfares = Welfare::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama', 'account', 'welfareType')->get();

        return view('personal.chama_show',compact('chama', 'user', 'chamaAccounts', 'chamaLoans', 'chamaMeetings', 'chamaMembers', 'chamaPenalties', 'chamaSharePayments', 'chamaWelfares'));
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
        $members = ChamaMember::where('chama_id',$chama->id)->with('status', 'user', 'chamaMemberRole')->get();
        // deleted members
        $deletedMembers = ChamaMember::onlyTrashed()->get();
        return view('personal.chamaMembers',compact('user', 'chama', 'members', 'deletedMembers'));

    }

    public function chamaMemberCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // chama member roles
        $chamaMemberRoles = ChamaMemberRole::where('chama_id',$chama->id)->get();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_member_create',compact('user', 'chama', 'chamaMemberRoles', 'accounts'));

    }

    public function chamaMemberStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

        // check if member has an user account


        // Create chama member
        $chamaMember = new ChamaMember();
        $chamaMember->name = $request->name;
        $chamaMember->email = $request->email;
        $chamaMember->phone_number = $request->phone_number;
        $chamaMember->member_role_id = $request->chama_member_role;
        $chamaMember->shares = $request->shares;
        $chamaMember->is_user = false;
        $chamaMember->member_id = 1;
        $chamaMember->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMember->chama_id = $chama->id;
        $chamaMember->user_id = $user->id;
        $chamaMember->save();

        if($request->shares>0){

            // TODO track if this is an account deposit or not
            // chama member shares
            $date = date('Y-m-d');
            $sharePayment = new SharesPayment();
            $sharePayment->shares = $request->shares;
            $sharePayment->amount = $chama->share_price;
            $value = doubleval($chama->share_price)*doubleval($request->shares);
            $sharePayment->value = $value;
            $sharePayment->date = $date;
            $sharePayment->member_id = $chamaMember->id;
            $sharePayment->chama_id = $chama->id;
            $sharePayment->account_id = $request->account;
            $sharePayment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $sharePayment->user_id = $user->id;
            $sharePayment->save();
        }

        // check if email registered
        $user = User::where('email',$request->email)->first();
        // send invite link
        if ($user){
            // user invitation link
        }else{
            // non user invitation link
        }

        return redirect()->route('personal.chama.member.show',['chama'=>$chama->id, 'id'=>$chamaMember->id])->withSuccess(__('Chama Member successfully created.'));

    }

    public function chamaMemberShow($chama_id, $member_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get chama member
        $chamaMember = ChamaMember::where('id',$member_id)->with('status', 'user', 'chamaMemberRole', 'penalties.account', 'sharesPayments.account', 'welfare.account', 'welfare.welfareType', 'loans.account', 'chamaMemberMeetings.chamaMeeting')->first();
        // return $chamaMember;

        // Pending to dos
        $pendingToDos = ToDo::where('chama_member_id',$chamaMember->id)->where('is_chama_member', true)->with('user', 'status', 'account')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_member_id',$chamaMember->id)->where('is_chama_member', true)->with('user', 'status', 'account')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_member_id',$chamaMember->id)->where('is_chama_member', true)->with('user', 'status', 'account')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_member_id',$chamaMember->id)->where('is_chama_member', true)->with('user', 'status', 'account')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->get();

        return view('personal.chama_member_show',compact('user', 'chama', 'chamaMember', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos'));

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
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_accounts',compact('accounts', 'user', 'chama'));

    }

    public function chamaAccountCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        return view('personal.chama_account_create',compact('user', 'chama'));

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
        $account->is_user = false;
        $account->is_institution = false;
        $account->is_chama = true;
        $account->user_id = $user->id;
        $account->chama_id = $chama->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();
        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id, 'account_id'=>$account->id])->withSuccess('Account '.$account->reference.' successfully created!');
    }

    public function chamaAccountShow($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->with('status', 'user', 'loans.chamaMember.member', 'accountAdjustments', 'destinationAccount.sourceAccount', 'transactions.account', 'transactions.expense', 'payments', 'sourceAccount.destinationAccount', 'deposits', 'withdrawals', 'liabilities.contact', 'refunds', 'transactions')->first();


        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'account')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('account_id',$account->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'account')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('account_id',$account->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'account')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('account_id',$account->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'account')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('account_id',$account->id)->get();

        return view('personal.chama_account_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'account', 'user', 'chama'));
    }

    public function chamaAccountDepositCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();

        return view('personal.chama_deposit_create',compact('account', 'user', 'chama'));
    }

    public function chamaAccountLiabilityCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.chama_account_liability_create',compact('user', 'account', 'contacts', 'chama'));
    }

    public function chamaAccountLoanCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.chama_account_loan_create',compact('user', 'account', 'contacts', 'chama'));
    }

    public function chamaAccountWithdrawalCreate($chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get account
        $account = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();
        return view('personal.chama_withdrawal_create',compact('account', 'user', 'chama'));
    }

    public function chamaAccountUpdate(Request $request, $chama_id, $account_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // select account type
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();
        $account->name = $request->name;
        $account->goal = $request->goal;
        $account->notes = $request->notes;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();

        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id, 'account_id'=>$account->id])->withSuccess('Account '.$account->reference.' successfully updated!');
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
        $accounts = Account::where('is_chama', true)->where('chama_id',$chama->id)->get();
        // get account
        $accountExists = Account::findOrFail($account_id);
        $account = Account::where('id',$account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();

        return view('personal.chama_account_adjustment_create',compact('account', 'user', 'accounts', 'chama'));

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
        $account = Account::where('id',$request->account)->where('is_chama', true)->where('chama_id',$chama->id)->first();
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
        $accountAdjustment->is_user = false;
        $accountAdjustment->is_institution = false;
        $accountAdjustment->save();

        // update account
        $account = Account::where('id',$request->account)->where('is_chama', true)->where('chama_id',$chama->id)->first();
        $account->balance = doubleval($account->balance)+doubleval($request->amount);
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.chama.account.show',['chama_id'=>$chama->id, 'account_id'=>$account->id])->withSuccess('Account Adjustment successfully created!');

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
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // Get transactions
        $transactions = Transaction::with('user', 'status', 'sourceAccount', 'destinationAccount', 'account', 'expense')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.chama_account_adjustment_create',compact('transactions', 'user', 'journalsStatusCount', 'transactions', 'accounts', 'chama'));

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
                $account = Account::where('id',$request->source_account)->where('is_user', true)->where('user_id',$user->id)->first();
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

        return redirect()->route('personal.chama.transaction.show',['chama_id'=>$chama->id, 'transaction_id'=>$transaction->id])->withSuccess('Transaction '.$transaction->reference.' successfully updated!');

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
        $deposit->is_user = false;
        $deposit->is_institution = false;
        $deposit->is_income = true;
        $deposit->is_chama = true;
        $deposit->save();

        return redirect()->route('personal.chama.deposit.show',['chama_id'=>$chama->id, 'deposit_id'=>$deposit->id])->withSuccess('Deposit updated!');
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
        $deposit = Deposit::with('user', 'status', 'account', 'accountAdjustments')->where('is_chama', true)->where('id',$deposit_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'deposit')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('deposit_id',$deposit->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'deposit')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('deposit_id',$deposit->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'deposit')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('deposit_id',$deposit->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'deposit')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('deposit_id',$deposit->id)->get();

        return view('personal.chama_deposit_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'deposit', 'user', 'chama'));
    }

    public function chamaDepositAccountAdjustmentCreate($chama_id, $deposit_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get deposit
        $depositExists = Deposit::findOrFail($deposit_id);
        $deposit = Deposit::with('user', 'status', 'account', 'accountAdjustments')->where('is_user', true)->where('user_id',$user->id)->where('id',$deposit_id)->first();
        // get account
        $accountExists = Account::findOrFail($deposit->account_id);
        $account = Account::where('id',$deposit->account_id)->where('is_user', true)->where('user_id',$user->id)->first();

        return view('personal.chama_deposit_account_adjustment_create',compact('deposit', 'account', 'user', 'accounts', 'chama'));

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
        $accountAdjustment->is_deposit = true;
        $accountAdjustment->deposit_id = $deposit->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        return redirect()->route('personal.chama.deposit.show',['chama_id'=>$chama->id, 'deposit_id'=>$deposit->id])->withSuccess('Deposit '. $deposit->name .' updated!');
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
        $withdrawal->is_user = false;
        $withdrawal->is_institution = false;
        $withdrawal->is_chama = true;
        $withdrawal->save();

        return redirect()->route('personal.chama.withdrawal.show',['chama_id'=>$chama->id, 'withdrawal_id'=>$withdrawal->id])->withSuccess('Withdrawal updated!');
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
        $withdrawal = Withdrawal::with('user', 'status', 'account', 'accountAdjustments')->where('is_chama', true)->where('id',$withdrawal_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'withdrawal')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('withdrawal_id',$withdrawal->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'withdrawal')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('withdrawal_id',$withdrawal->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'withdrawal')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('withdrawal_id',$withdrawal->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'withdrawal')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('withdrawal_id',$withdrawal->id)->get();

        return view('personal.chama_withdrawal_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'withdrawal', 'user', 'chama'));
    }

    public function chamaWithdrawalAccountAdjustmentCreate($chama_id, $withdrawal_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_chama', true)->where('chama_id',$chama->id)->get();
        // get withdrawal
        $withdrawalExists = Withdrawal::findOrFail($withdrawal_id);
        $withdrawal = Withdrawal::with('user', 'status', 'account', 'accountAdjustments')->where('is_chama', true)->where('id',$withdrawal_id)->first();
        // get account
        $accountExists = Account::findOrFail($withdrawal->account_id);
        $account = Account::where('id',$withdrawal->account_id)->where('is_chama', true)->where('chama_id',$chama->id)->first();

        return view('personal.chama_withdrawal_account_adjustment_create',compact('withdrawal', 'account', 'user', 'accounts', 'chama'));

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
        $accountAdjustment->is_withdrawal = true;
        $accountAdjustment->withdrawal_id = $withdrawal->id;

        $accountAdjustment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $accountAdjustment->user_id = $user->id;
        $accountAdjustment->save();

        return redirect()->route('personal.chama.withdrawal.show',['chama_id'=>$chama->id, 'withdrawal_id'=>$withdrawal->id])->withSuccess('Withdrawal '. $withdrawal->name .' updated!');
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
        $liabilities = Liability::with('user', 'status', 'account', 'account')->where('is_user', true)->where('user_id',$user->id)->get();

        return view('personal.chama_liabilities',compact('liabilities', 'user', 'chama'));
    }

    public function chamaLiabilityCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('is_user', true)->where('user_id',$user->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.chama_liability_create',compact('user', 'accounts', 'contacts', 'chama'));
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

        $liability->is_institution = false;
        $liability->is_user = false;
        $liability->is_chama = true;
        $liability->chama_id = $chama->id;

        $liability->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('personal.chama.liability.show',['chama_id'=>$chama->id, 'liability_id'=>$liability->id])->withSuccess('Liability created!');
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
        $accounts = Account::where('is_chama', true)->where('chama_id',$chama->id)->get();
        // get contacts
        $contacts = Contact::with('organization')->where('is_user', true)->where('user_id',$user->id)->get();
        // Get contact type
        $liability = Liability::with('user', 'status', 'account', 'contact.organization', 'expenses.transactions')->where('is_chama', true)->where('chama_id',$chama->id)->where('id',$liability_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'liability')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('liability_id',$liability->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'liability')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('liability_id',$liability->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'liability')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('liability_id',$liability->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('is_chama', true)->where('chama_id',$chama->id)->with('user', 'status', 'liability')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('liability_id',$liability->id)->get();

        return view('personal.chama_liability_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'accounts', 'contacts', 'liability', 'user', 'chama'));
    }

    // TODO expense for liability
    public function chamaLiabilityExpenseCreate($chama_id, $liability_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
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

        return view('personal.chama_liability_expense_create',compact('liability', 'campaigns', 'sales', 'user', 'frequencies', 'expenseAccounts', 'transfers', 'expenseStatuses', 'chama'));
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
        $loans = Loan::with('user', 'status', 'account', 'chamaMember')->where('is_chama', true)->get();
        return view('personal.chama_loans',compact('loans', 'user', 'chama'));

    }

    public function chamaLoanCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('chama_id',$chama->id)->where('is_chama', true)->get();
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        return view('personal.chama_loan_create',compact('user', 'accounts', 'chamaMembers', 'chama'));

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
        $loan->interest_amount = $request->interest_amount;
        $loan->balance = $request->total;
        $loan->paid = 0;

        $loan->date = date('Y-m-d', strtotime($request->date));
        $loan->due_date = date('Y-m-d', strtotime($request->due_date));

        $loan->account_id = $request->account;
        $loan->member_id = $request->member;
        $loan->chama_id = $chama->id;

        $loan->is_user = false;
        $loan->is_institution = false;
        $loan->is_chama = true;

        $loan->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $loan->user_id = $user->id;
        $loan->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->user_id = $user->id;
        $account->save();
        return redirect()->route('personal.chama.loan.show',['chama_id'=>$chama->id, 'loan_id'=>$loan->id])->withSuccess('Loan created!');

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
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // Get contact type
        $loan = Loan::with('user', 'status', 'account', 'contact.organization', 'payments', 'chamaMember.chamaMemberRole')->where('id',$loan_id)->where('chama_id',$chama->id)->where('is_chama', true)->first();

        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'loan')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('loan_id',$loan->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'loan')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('loan_id',$loan->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'loan')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('loan_id',$loan->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'loan')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('loan_id',$loan->id)->get();

        return view('personal.chama_loan_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'accounts', 'chamaMembers', 'loan', 'user', 'chama'));

    }

    public function chamaLoanPaymentCreate($chama_id, $loan_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('chama_id',$chama->id)->where('is_chama', true)->get();
        // loans
        $loan = Loan::findOrFail($loan_id);
        return view('personal.chama_loan_payment_create',compact('user', 'accounts', 'loan', 'chama'));

    }

    public function chamaLoanPaymentStore(Request $request,$chama_id,$loan_id)
    {


        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // get account
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) + doubleval($request->amount);
        $payment = new Payment();
        $payment->reference = $reference;
        $payment->notes = $request->notes;
        $payment->date = date('Y-m-d', strtotime($request->date));
        $payment->initial_balance = $account->balance;
        $payment->amount = $request->amount;
        $payment->current_balance = $accountBalance;

        $payment->is_sale = false;
        $payment->is_loan = true;
        $payment->loan_id = $loan_id;
        // update loan as paid
        $loan = Loan::findOrFail($request->loan_id);
        $paid = doubleval($request->amount) + doubleval($loan->paid);
        $balance = doubleval($loan->principal) - $paid;
        $loan->balance = $balance;
        $loan->paid = $paid;
        $loan->save();


        $payment->account_id = $request->account;
        $payment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $payment->user_id = $user->id;
        $payment->chama_id = $chama->id;
        $payment->is_user = false;
        $payment->is_chama = true;
        $payment->is_institution = false;
        $payment->save();

        // credit account
        $account->balance = $accountBalance;
        $account->save();

        return redirect()->route('personal.chama.loan.payment.show',['chama_id'=>$chama->id, 'payment_id'=>$payment->id])->withSuccess('Payment created!');
    }

    public function chamaLoanPaymentShow($chama_id, $payment_id)
    {
        // Check if contact type exists
        $paymentExists = Payment::findOrFail($payment_id);
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Get contact type
        $payment = Payment::with('user', 'status', 'refunds.account', 'loan', 'sale')->where('id',$payment_id)->where('chama_id',$chama->id)->where('is_chama', true)->first();

        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'payment')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('payment_id',$payment->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'payment')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('payment_id',$payment->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'payment')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('payment_id',$payment->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'payment')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('payment_id',$payment->id)->get();

        return view('personal.payment_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'payment', 'user'));
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
        $transfers = Transfer::with('user', 'status', 'sourceAccount', 'destinationAccount')->where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.chama_transfers',compact('transfers', 'user', 'chama'));
    }

    public function chamaTransferCreate($chama_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.chama_transfer_create',compact('user', 'accounts', 'chama'));
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
        $transfer->is_user = false;
        $transfer->is_institution = false;
        $transfer->save();

        // update accounts balance
        $sourceAccount->balance = $sourceAccountSubsequentAmount;
        $sourceAccount->user_id = $user->id;
        $sourceAccount->save();
        $destinationAccount->balance = $destinationAccountSubsequentAmount;
        $destinationAccount->user_id = $user->id;
        $destinationAccount->save();

        return redirect()->route('personal.chama.transfer.show',['chama_id'=>$chama->id, 'transfer_id'=>$transfer->id])->withSuccess('Transfer created!');
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
        $transfer = Transfer::with('user', 'status', 'sourceAccount', 'destinationAccount', 'expenses')->where('user_id',$user->id)->where('is_user', true)->where('id',$transfer_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('transfer_id',$transfer->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('transfer_id',$transfer->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('transfer_id',$transfer->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user', true)->with('user', 'status', 'transfer')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('transfer_id',$transfer->id)->get();

        return view('personal.chama_transfer_show',compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'transfer', 'user', 'chama'));
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
        $expenseStatuses = Status::where('status_type_id', '7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('user_id',$user->id)->where('is_user', true)->get();
        return view('personal.chama_transfer_expense_create',compact('transfer', 'user', 'journalsStatusCount', 'expenseStatuses', 'expenseAccounts', 'chama'));
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


    // share payments
    public function chamaSharePayments($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get sharePayments
        $sharePayments = SharesPayment::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama')->get();
        // get deleted share payments
        $deletedSharePayments = SharesPayment::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama')->onlyTrashed()->get();

        return view('personal.chama_share_payments',compact('chama', 'user', 'sharePayments', 'deletedSharePayments'));

    }

    public function chamaSharePaymentCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_share_payment_create',compact('user', 'chama', 'chamaMembers', 'accounts'));

    }

    public function chamaSharePaymentStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get member
        $chamaMember = ChamaMember::findOrFail($request->member);

        // Add to account
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) +doubleval($request->share_value);
        $account->balance = $accountBalance;
        $account->save();

        // Register share payment
        $sharePayment = new SharesPayment();
        $sharePayment->shares = $request->shares;
        $sharePayment->amount = $request->share_price;
        $sharePayment->value = $request->share_value;
        $sharePayment->date = date('Y-m-d', strtotime($request->date));
        $sharePayment->member_id = $request->member;
        $sharePayment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $sharePayment->account_id = $request->account;
        $sharePayment->chama_id = $chama->id;
        $sharePayment->user_id = $user->id;
        $sharePayment->save();

        // get new shares amount
        $shares = doubleval($chamaMember->shares) + doubleval($request->shares);
        // update member
        $chamaMember->shares = $shares;
        $chamaMember->save();
        return redirect()->route('personal.share.payment.show',$sharePayment->id)->withSuccess(__('Share payment '.$sharePayment->name.' successfully created.'));

    }

    public function chamaSharePaymentShow($chama_id, $share_payment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if share payment exists
        $sharePaymentExists = SharesPayment::findOrFail($share_payment_id);
        $sharePayment = SharesPayment::with('user', 'status', 'account', 'chamaMember')->where('id',$share_payment_id)->first();

        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_share_payment_show',compact('sharePayment', 'user', 'chama', 'accounts', 'chamaMembers'));
    }

    public function chamaSharePaymentUpdate(Request $request, $chama_id, $share_payment_id)
    {
        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

        $sharePayment = SharesPayment::findOrFail($share_payment_id);
        $sharePayment->name = ($request->name);
        $sharePayment->user_id = $user->id;
        $sharePayment->save();

        return redirect()->route('personal.share.payment.show',$sharePayment->id)->withSuccess('Share payment '.$sharePayment->name.' updated!');
    }

    public function chamaSharePaymentDelete($chama_id, $share_payment_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $sharePayment = SharesPayment::findOrFail($share_payment_id);
        $sharePayment->delete();

        return back()->withSuccess(__('Share payment '.$sharePayment->name.' successfully deleted.'));
    }

    public function chamaSharePaymentRestore($chama_id, $share_payment_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $sharePayment = SharesPayment::withTrashed()->findOrFail($share_payment_id);
        $sharePayment->restore();

        return back()->withSuccess(__('Share payment '.$sharePayment->name.' successfully restored.'));
    }





    // penalties
    public function chamaPenalties($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get penalties
        $penalties = Penalty::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama', 'account')->get();
        // get deleted penalties
        $deletedPenalties = Penalty::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama', 'account')->onlyTrashed()->get();

        return view('personal.chama_penalties',compact('chama', 'user', 'penalties', 'deletedPenalties'));

    }

    public function chamaPenaltyCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_penalty_create',compact('user', 'chama', 'chamaMembers', 'accounts'));

    }

    public function chamaPenaltyStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get member
        $chamaMember = ChamaMember::findOrFail($request->member);

        // Add to account
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) +doubleval($request->amount);
        $account->balance = $accountBalance;
        $account->save();

        // register penalty
        $penalty = new Penalty();
        $penalty->amount = $request->amount;
        $penalty->reason = $request->reason;
        $penalty->date = date('Y-m-d', strtotime($request->date));
        $penalty->member_id = $request->member;
        $penalty->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $penalty->account_id = $request->account;
        $penalty->chama_id = $chama->id;
        $penalty->user_id = $user->id;
        $penalty->save();


        return redirect()->route('personal.share.payment.show',$penalty->id)->withSuccess(__('Penalty '.$penalty->name.' successfully created.'));

    }

    public function chamaPenaltyShow($chama_id, $penalty_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if penalty exists
        $penaltyExists = Penalty::findOrFail($penalty_id);
        $penalty = Penalty::with('user', 'status', 'account')->where('id',$penalty_id)->first();
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // Get accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_penalty_show',compact('penalty', 'user', 'chama', 'chamaMembers', 'accounts'));

    }

    public function chamaPenaltyUpdate(Request $request, $chama_id, $penalty_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // penalty create
        $sharePayment = Penalty::findOrFail($penalty_id);
        $sharePayment->name = ($request->name);
        $sharePayment->user_id = $user->id;
        $sharePayment->save();
        return redirect()->route('personal.share.payment.show',$sharePayment->id)->withSuccess('Share payment '.$sharePayment->name.' updated!');

    }

    public function chamaPenaltyDelete($chama_id, $penalty_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $sharePayment = SharesPayment::findOrFail($penalty_id);
        $sharePayment->delete();

        return back()->withSuccess(__('Share payment '.$sharePayment->name.' successfully deleted.'));
    }

    public function chamaPenaltyRestore($chama_id, $penalty_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $sharePayment = SharesPayment::withTrashed()->findOrFail($penalty_id);
        $sharePayment->restore();

        return back()->withSuccess(__('Share payment '.$sharePayment->name.' successfully restored.'));
    }








    // welfares
    public function chamaWelfares($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get welfares
        $welfares = Welfare::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama', 'account', 'welfareType')->get();
        // get deleted welfares
        $deletedWelfares = Welfare::where('chama_id',$chama->id)->with('user', 'status', 'chamaMember.chamaMemberRole', 'chama')->onlyTrashed()->get();

        return view('personal.chama_welfares',compact('chama', 'user', 'welfares', 'deletedWelfares'));

    }

    public function chamaWelfareCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // welfare types
        $welfareTypes = WelfareType::where('chama_id',$chama->id)->get();
        // accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_welfare_create',compact('user', 'chama', 'chamaMembers', 'welfareTypes', 'accounts'));

    }

    public function chamaWelfareStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get member
        $chamaMember = ChamaMember::findOrFail($request->member);

        // deduct from account
        $account = Account::findOrFail($request->account);
        if($request->amount > $account->balance){
            return back()->withWarning(__('This transaction will overdraft the account.'));
        }
        $accountBalance = doubleval($account->balance) - doubleval($request->amount);
        $account->balance = $accountBalance;
        $account->save();

        // register welfare
        $welfare = new Welfare();
        $welfare->amount = $request->amount;
        $welfare->reason = $request->reason;
        $welfare->date = date('Y-m-d', strtotime($request->date));
        $welfare->member_id = $request->member;
        $welfare->account_id = $request->account;
        $welfare->welfare_type_id = $request->welfare_type;
        $welfare->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $welfare->chama_id = $chama->id;
        $welfare->user_id = $user->id;
        $welfare->save();
        return redirect()->route('personal.chama.welfare.show',['chama_id'=>$chama->id, 'welfare_id'=>$welfare->id])->withSuccess(__('Welfare '.$welfare->name.' successfully created.'));

    }

    public function chamaWelfareShow($chama_id, $welfare_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if welfare exists
        $welfareExists = Welfare::findOrFail($welfare_id);
        $welfare = Welfare::with('user', 'status', 'account', 'chamaMember', 'welfareType')->where('id',$welfare_id)->first();
        // members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('member', 'chamaMemberRole')->get();
        // welfare types
        $welfareTypes = WelfareType::where('chama_id',$chama->id)->get();
        // accounts
        $accounts = Account::with('user', 'status')->where('is_chama', true)->where('chama_id',$chama->id)->get();
        return view('personal.chama_welfare_show',compact('welfare', 'user', 'chama', 'chamaMembers', 'welfareTypes', 'accounts'));

    }

    public function chamaWelfareUpdate(Request $request, $chama_id, $welfare_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // welfare create
        $welfare = Welfare::findOrFail($welfare_id);
        $welfare->amount = $request->amount;
        $welfare->reason = $request->reason;
        $welfare->date = date('Y-m-d', strtotime($request->date));
        $welfare->member_id = $request->member;
        $welfare->account_id = $request->account;
        $welfare->welfare_type_id = $request->welfare_type;
        $welfare->save();
        return redirect()->route('personal.chama.welfare.show',['chama_id'=>$chama->id, 'welfare_id'=>$welfare->id])->withSuccess('Welfare '.$welfare->name.' updated!');

    }

    public function chamaWelfareDelete($chama_id, $welfare_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $welfare = Welfare::findOrFail($welfare_id);
        $welfare->delete();
        return back()->withSuccess(__('Welfare successfully deleted.'));

    }

    public function chamaWelfareRestore($chama_id, $welfare_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $welfare = Welfare::withTrashed()->findOrFail($welfare_id);
        $welfare->restore();
        return back()->withSuccess(__('Welfare successfully restored.'));

    }




    // meetings
    public function chamaMeetings($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // get sheduled meetings
        $scheduledChamaMeetings = ChamaMeeting::where('chama_id',$chama->id)->where('is_scheduled', true)->with('user', 'status', 'chama')->get();
        // get meetings
        $chamaMeetings = ChamaMeeting::where('chama_id',$chama->id)->where('is_scheduled', false)->with('user', 'status', 'chama')->get();
        // get deleted meetings
        $deletedChamaMeetings = ChamaMeeting::where('chama_id',$chama->id)->with('user', 'status', 'chama')->onlyTrashed()->get();
        return view('personal.chama_meetings',compact('chama', 'user', 'chamaMeetings', 'deletedChamaMeetings', 'scheduledChamaMeetings'));


    }

    public function chamaMeetingCreate($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('status', 'user', 'chamaMemberRole')->get();
        return view('personal.chama_meeting_create',compact('user', 'chama', 'chamaMembers'));

    }

    public function chamaMeetingSchedule($chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        return view('personal.chama_meeting_schedule',compact('user', 'chama'));

    }

    public function chamaMeetingScheduleStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

        // register meeting
        $chamaMeeting = new ChamaMeeting();
        $chamaMeeting->location = $request->location;
        $chamaMeeting->description = $request->description;
        $chamaMeeting->agenda = $request->agenda;
        $chamaMeeting->minutes = "Pending";
        $chamaMeeting->date = date('Y-m-d', strtotime($request->date));
        $chamaMeeting->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMeeting->is_scheduled = true;
        $chamaMeeting->chama_id = $chama->id;
        $chamaMeeting->user_id = $user->id;
        $chamaMeeting->save();
        return redirect()->route('personal.chama.meeting.show',$chamaMeeting->id)->withSuccess(__('Meeting '.$chamaMeeting->name.' successfully created.'));
    }

    public function chamaScheduledMeetingShow($chama_id, $chama_meeting_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if meeting exists
        $chamaMeetingExists = ChamaMeeting::findOrFail($chama_meeting_id);
        $chamaMeeting = ChamaMeeting::with('user', 'status', 'chamaMeetingMembers.chamaMember')->where('id',$chama_meeting_id)->first();
        // Members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('status', 'user', 'chamaMemberRole')->get();

        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('chama_meeting_id',$chamaMeeting->id)->get();

        return view('personal.chama_scheduled_meeting_show',compact('chamaMeeting', 'user', 'chama', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos', 'chamaMembers'));

    }

    public function chamaScheduledMeetingUpdate(Request $request, $chama_id, $chama_meeting_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // meeting create
        $chamaMeeting = ChamaMeeting::findOrFail($chama_meeting_id);
        $chamaMeeting->location = $request->location;
        $chamaMeeting->description = $request->description;
        $chamaMeeting->minutes = $request->minutes;
        $chamaMeeting->agenda = $request->agenda;
        $chamaMeeting->is_scheduled = false;
        $chamaMeeting->date = date('Y-m-d', strtotime($request->date));
        $chamaMeeting->save();


        // Product taxes update
        $chamaMeetingRequestMembers =array();
        foreach ($request->chama_members as $chamaMeetingProductMember){
            // Append to array
            $chamaMeetingRequestMembers[]['id'] = $chamaMeetingProductMember;

            // Check if product tax exists
            $chamaMeetingMember = ChamaMeetingMember::where('meeting_id',$chamaMeeting->id)->where('chama_member_id',$chamaMeetingProductMember)->first();

            if($chamaMeetingMember === null) {
                $chamaMeetingMember = new ChamaMeetingMember();
                $chamaMeetingMember->meeting_id = $chamaMeeting->id;
                $chamaMeetingMember->chama_member_id = $chamaMeetingProductMember;
                $chamaMeetingMember->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $chamaMeetingMember->user_id = $user->id;
                $chamaMeetingMember->save();
            }
        }

        $chamaMeetingMembersIds = ChamaMeetingMember::where('meeting_id',$chamaMeeting->id)->whereNotIn('chama_member_id',$chamaMeetingRequestMembers)->select('id')->get()->toArray();
        DB::table('chama_meeting_members')->whereIn('id', $chamaMeetingMembersIds)->delete();



        return redirect()->route('personal.chama.meeting.show',['chama_id'=>$chama->id, 'chama_meeting_id'=>$chamaMeeting->id])->withSuccess('Meeting '.$chamaMeeting->name.' updated!');

    }

    public function chamaMeetingStore(Request $request, $chama_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);

        // register meeting
        $chamaMeeting = new ChamaMeeting();
        $chamaMeeting->location = $request->location;
        $chamaMeeting->description = $request->description;
        $chamaMeeting->minutes = $request->minutes;
        $chamaMeeting->date = date('Y-m-d', strtotime($request->date));
        $chamaMeeting->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $chamaMeeting->is_scheduled = false;
        $chamaMeeting->chama_id = $chama->id;
        $chamaMeeting->user_id = $user->id;
        $chamaMeeting->save();

        // item details
        foreach ($request->chama_members as $chamaMeetingMemberId)
        {
            // chama meeting member
            $chamaMeetingMember = new ChamaMeetingMember();
            $chamaMeetingMember->chama_member_id = $chamaMeetingMemberId;
            $chamaMeetingMember->meeting_id = $chamaMeeting->id;
            $chamaMeetingMember->user_id = $user->id;
            $chamaMeetingMember->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $chamaMeetingMember->save();
        }

        return redirect()->route('personal.chama.meeting.show',['chama_id'=>$chama->id, 'chama_meeting_id'=>$chamaMeeting->id])->withSuccess(__('Meeting '.$chamaMeeting->name.' successfully created.'));

    }

    public function chamaMeetingShow($chama_id, $chama_meeting_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // Check if meeting exists
        $chamaMeetingExists = ChamaMeeting::findOrFail($chama_meeting_id);
        $chamaMeeting = ChamaMeeting::with('user', 'status', 'chamaMeetingMembers.chamaMember')->where('id',$chama_meeting_id)->first();
        // Members
        $chamaMembers = ChamaMember::where('chama_id',$chama->id)->with('status', 'user', 'chamaMemberRole')->get();

        // Pending to dos
        $pendingToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('chama_meeting_id',$chamaMeeting->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('chama_id',$chama->id)->where('is_chama', true)->with('user', 'status', 'chamaMeeting')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('chama_meeting_id',$chamaMeeting->id)->get();

        return view('personal.chama_meeting_show',compact('chamaMeeting', 'user', 'chama', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos', 'chamaMembers'));

    }

    public function chamaMeetingUpdate(Request $request, $chama_id, $chama_meeting_id)
    {

        // User
        $user = $this->getUser();
        // Chama
        $chama = $this->getChama($chama_id);
        // meeting create
        $chamaMeeting = ChamaMeeting::findOrFail($chama_meeting_id);
        $chamaMeeting->location = $request->location;
        $chamaMeeting->description = $request->description;
        $chamaMeeting->minutes = $request->minutes;
        $chamaMeeting->agenda = $request->agenda;
        $chamaMeeting->is_scheduled = false;
        $chamaMeeting->date = date('Y-m-d', strtotime($request->date));
        $chamaMeeting->save();


        // Product taxes update
        $chamaMeetingRequestMembers =array();
        foreach ($request->chama_members as $chamaMeetingProductMember){
            // Append to array
            $chamaMeetingRequestMembers[]['id'] = $chamaMeetingProductMember;

            // Check if product tax exists
            $chamaMeetingMember = ChamaMeetingMember::where('meeting_id',$chamaMeeting->id)->where('chama_member_id',$chamaMeetingProductMember)->first();

            if($chamaMeetingMember === null) {
                $chamaMeetingMember = new ChamaMeetingMember();
                $chamaMeetingMember->meeting_id = $chamaMeeting->id;
                $chamaMeetingMember->chama_member_id = $chamaMeetingProductMember;
                $chamaMeetingMember->status_id = "f6654b11-8f04-4ac9-993f-116a8a6ecaae";
                $chamaMeetingMember->user_id = $user->id;
                $chamaMeetingMember->save();
            }
        }

        $chamaMeetingMembersIds = ChamaMeetingMember::where('meeting_id',$chamaMeeting->id)->whereNotIn('chama_member_id',$chamaMeetingRequestMembers)->select('id')->get()->toArray();
        DB::table('chama_meeting_members')->whereIn('id', $chamaMeetingMembersIds)->delete();



        return redirect()->route('personal.chama.meeting.show',['chama_id'=>$chama->id, 'chama_meeting_id'=>$chamaMeeting->id])->withSuccess('Meeting '.$chamaMeeting->name.' updated!');

    }


    public function chamaMeetingDelete($chama_id, $chama_meeting_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $chamaMeeting = ChamaMeeting::findOrFail($chama_meeting_id);
        $chamaMeeting->delete();
        return back()->withSuccess(__('Meeting successfully deleted.'));

    }

    public function chamaMeetingRestore($chama_id, $chama_meeting_id)
    {

        // Chama
        $chama = $this->getChama($chama_id);

        $chamaMeeting = ChamaMeeting::withTrashed()->findOrFail($chama_meeting_id);
        $chamaMeeting->restore();
        return back()->withSuccess(__('Meeting successfully restored.'));

    }


}
