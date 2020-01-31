<?php

namespace App\Http\Controllers\Personal;

use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChamaController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accounts()
    {
        // User
        $user = $this->getUser();
        // Get accounts
        $accounts = Account::with('user','status')->where('user_id',$user->id)->where('is_user',true)->get();

        return view('personal.accounts',compact('accounts','user'));
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
        $account->is_user = True;
        $account->is_institution = False;
        $account->is_chama = False;
        $account->user_id = $user->id;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->save();
        return redirect()->route('personal.account.show',$account->id)->withSuccess('Expense '.$account->reference.' successfully created!');
    }

    public function accountShow($account_id)
    {
        // User
        $user = $this->getUser();
        // get account
        $account = Account::where('id',$account_id)->where('is_user',True)->where('user_id',$user->id)->with('status','user','loans','account_adjustments','destination_account.source_account','transactions.account','transactions.expense','payments','source_account.destination_account','deposits','withdrawals','liabilities.contact','refunds','transactions')->first();
        $goal = $account->goal;
        $balance = $account->balance;
        if ($balance == 0){
            $percentage = 0;
        }else{
            $percentage = doubleval($goal)/$balance/100;
        }

        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','account')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('account_id',$account->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','account')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('account_id',$account->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','account')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('account_id',$account->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user',True)->with('user','status','account')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('account_id',$account->id)->get();

        return view('personal.account_show',compact('overdueToDos','completedToDos','inProgressToDos','pendingToDos','account','user','percentage'));
    }

    
}
