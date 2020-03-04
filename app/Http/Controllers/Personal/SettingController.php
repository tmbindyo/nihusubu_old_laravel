<?php

namespace App\Http\Controllers\Personal;

use App\AccountType;
use App\Budget;
use App\Expense;
use App\ExpenseAccount;
use App\Frequency;
use App\Title;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // titles
    public function titles()
    {
        // User
        $user = $this->getUser();
        // get titles
        $titles = Title::where('is_user',true)->where('user_id',$user->id)->with('user','status')->get();
        // get deleted titles
        $deletedTitles = Title::where('is_user',true)->where('user_id',$user->id)->with('user','status')->onlyTrashed()->get();

        return view('personal.titles',compact('titles','user','titles','deletedTitles'));
    }

    public function titleCreate()
    {
        // User
        $user = $this->getUser();
        return view('personal.title_create',compact('user'));
    }

    public function titleStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $title = new Title();
        $title->name = ($request->name);
        $title->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $title->user_id = $user->id;
        $title->is_user = True;
        $title->is_institution = False;
        $title->save();
        return redirect()->route('personal.title.show',$title->id)->withSuccess(__('Title '.$title->name.' successfully created.'));
    }

    public function titleShow($title_id)
    {
        // User
        $user = $this->getUser();
        // Check if title exists
        $titleExists = Title::findOrFail($title_id);
        $title = Title::with('user','status','contacts')->where('is_user',true)->withCount('contacts')->where('id',$title_id)->first();
        return view('personal.title_show',compact('title','user'));
    }

    public function titleUpdate(Request $request,$title_id)
    {
        // User
        $user = $this->getUser();

        $title = Title::findOrFail($title_id);
        $title->name = ($request->name);
        $title->user_id = $user->id;
        $title->save();

        return redirect()->route('personal.title.show',$title->id)->withSuccess('Title '.$title->name.' updated!');
    }

    public function titleDelete($title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->delete();

        return back()->withSuccess(__('Title '.$title->name.' successfully deleted.'));
    }

    public function titleRestore($title_id)
    {

        $title = Title::withTrashed()->findOrFail($title_id);
        $title->restore();

        return back()->withSuccess(__('Title '.$title->name.' successfully restored.'));
    }




    // expenseAccounts
    public function expenseAccounts()
    {
        // User
        $user = $this->getUser();
        // get expenseAccounts
        $expenseAccounts = ExpenseAccount::where('is_user',true)->where('user_id',$user->id)->with('user','status','account_type')->get();
        // get deleted expenseAccounts
        $deletedExpenseAccounts = ExpenseAccount::where('is_user',true)->where('user_id',$user->id)->with('user','status','account_type')->onlyTrashed()->get();

        return view('personal.expense_accounts',compact('expenseAccounts','user','expenseAccounts','deletedExpenseAccounts'));
    }

    public function expenseAccountCreate()
    {
        // User
        $user = $this->getUser();
        // Account types
        $accountTypes = AccountType::where('is_user',True)->get();
        return view('personal.expense_account_create',compact('user','accountTypes'));
    }

    public function expenseAccountStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = ($request->name);
        $expenseAccount->code = ($request->code);
        $expenseAccount->description = ($request->description);
        $expenseAccount->account_type_id = ($request->account_type);
        $expenseAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_user = True;
        $expenseAccount->is_institution = False;
        $expenseAccount->save();
        return redirect()->route('personal.expense.account.show',$expenseAccount->id)->withSuccess(__('Expense account '.$expenseAccount->name.' successfully created.'));
    }

    public function expenseAccountShow($expenseAccount_id)
    {
        // User
        $user = $this->getUser();
        // Account types
        $accountTypes = AccountType::where('is_user',True)->get();
        // Check if expenseAccount exists
        $expenseAccountExists = ExpenseAccount::findOrFail($expenseAccount_id);
        $expenseAccount = ExpenseAccount::with('user','status','budget','expenses')->where('is_user',true)->withCount('expenses')->where('id',$expenseAccount_id)->first();
        // expense account expenses
        $expenseAccountExpenses = Expense::where('expense_account_id',$expenseAccount->id)->get();
        // expense account budget
        $expenseAccountBudget = Budget::where('expense_account_id',$expenseAccount->id)->get();
        return view('personal.expense_account_show',compact('expenseAccount','user','accountTypes','expenseAccountExpenses','expenseAccountBudget'));
    }

    public function expenseAccountUpdate(Request $request,$expenseAccount_id)
    {
        // User
        $user = $this->getUser();

        $expenseAccount = ExpenseAccount::findOrFail($expenseAccount_id);
        $expenseAccount->name = ($request->name);
        $expenseAccount->code = ($request->code);
        $expenseAccount->description = ($request->description);
        $expenseAccount->account_type_id = ($request->account_type);
        $expenseAccount->user_id = $user->id;
        $expenseAccount->save();

        return redirect()->route('personal.expense.account.show',$expenseAccount->id)->withSuccess('Expense account '.$expenseAccount->name.' updated!');
    }

    public function expenseAccountDelete($expenseAccount_id)
    {

        $expenseAccount = ExpenseAccount::findOrFail($expenseAccount_id);
        $expenseAccount->delete();

        return back()->withSuccess(__('Expense account '.$expenseAccount->name.' successfully deleted.'));
    }

    public function expenseAccountRestore($expenseAccount_id)
    {

        $expenseAccount = ExpenseAccount::withTrashed()->findOrFail($expenseAccount_id);
        $expenseAccount->restore();

        return back()->withSuccess(__('Expense account '.$expenseAccount->name.' successfully restored.'));
    }




    // frequency
    public function Frequencies()
    {
        // User
        $user = $this->getUser();
        // get frequencies
        $frequencies = Frequency::with('user')->where('user_id',$user->id)->where('is_user',true)->get();
        // get deleted frequencies
        $deletedFrequencies = Frequency::with('user')->where('user_id',$user->id)->where('is_user',true)->onlyTrashed()->get();
        return view('personal.frequencies',compact('frequencies','user','deletedFrequencies'));
    }

    public function frequencyCreate()
    {
        // User
        $user = $this->getUser();
        return view('personal.frequency_create',compact('user'));
    }

    public function frequencyStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $frequency = new Frequency();
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->is_institution = False;
        $frequency->is_user = True;
        $frequency->save();

        return redirect()->route('personal.frequency.show',$frequency->id)->withSuccess('Frequency created!');
    }

    public function frequencyShow($frequency_id)
    {
        // Check if frequency exists
        $frequencyExists = Frequency::findOrFail($frequency_id);
        // User
        $user = $this->getUser();
        // Get frequency
        $frequency = Frequency::with('user','expenses')->where('user_id',$user->id)->where('is_user',true)->where('id',$frequency_id)->withCount('expenses')->first();

        return view('personal.frequency_show',compact('frequency','user'));
    }

    public function frequencyUpdate(Request $request, $frequency_id)
    {
        // User
        $user = $this->getUser();

        $frequency = Frequency::findOrFail($frequency_id);
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->save();

        return redirect()->route('personal.frequency.show',$frequency->id)->withSuccess('Frequency updated!');
    }

    public function frequencyDelete($frequency_id)
    {

        $frequency = Frequency::findOrFail($frequency_id);
        $frequency->delete();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully deleted.'));
    }
    public function frequencyRestore($frequency_id)
    {

        $frequency = Frequency::withTrashed()->findOrFail($frequency_id);
        $frequency->restore();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully restored.'));
    }


    // Family
    public function family()
    {
        return view('personal.family');
    }
    public function familyCreate()
    {
        return view('personal.family_create');
    }
    public function familyStore()
    {
        return back()->withSuccess(__('Family successfully created.'));
    }
    public function familyMemberShow($family_id)
    {
        return view('personal.family_show');
    }
    public function familyMemberEdit($family_id)
    {
        return view('personal.family_show');
    }
    public function familyMemberUpdate($family_id)
    {
        return back()->withSuccess(__('Family member successfully updated.'));
    }
    public function familyMemberDelete($family_id)
    {
        return back()->withSuccess(__('Family member successfully deleted.'));
    }


    public function commitments()
    {
        return view('personal.commitments');
    }
    public function commitmentCreate()
    {
        return view('personal.commitment_create');
    }
    public function commitmentStore()
    {
        return back()->withSuccess(__('Commitment successfully created.'));
    }
    public function commitmentShow($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentEdit($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentUpdate($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully updated.'));
    }
    public function commitmentDelete($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully deleted.'));
    }
}
