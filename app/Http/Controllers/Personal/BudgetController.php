<?php

namespace App\Http\Controllers\Personal;

use App\Budget;
use App\Expense;
use App\ExpenseAccount;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\ReferenceNumberTrait;
use App\Http\Controllers\Controller;
use App\ToDo;

class BudgetController extends Controller
{

    use UserTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function budget()
    {
        // User
        $user = $this->getUser();
        // get budgets
        $budgets = Budget::where('is_user', true)->where('user_id', $user->id)->with('expenseAccount.budget')->get();
        return view('personal.budgets', compact('user', 'budgets'));
    }

    public function budgetCreate()
    {
        // User
        $user = $this->getUser();
        // expense accounts
        // account types
        $billExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '163fa506-9762-422a-a981-cce20b21f1ad')->where('is_user', true)->with('accountType', 'budget')->get();
        $cashExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '8c0c1829-b6cf-4d38-b640-755db25460ae')->where('is_user', true)->with('accountType', 'budget')->get();
        $feesExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '17401c1e-1423-40bc-846a-008b0e72373c')->where('is_user', true)->with('accountType', 'budget')->get();
        $foodExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '008315c2-ee90-4e55-80cc-de2a8bc0472a')->where('is_user', true)->with('accountType', 'budget')->get();
        $healthExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', 'af7b5592-8c36-4746-b369-a3985c90fd0b')->where('is_user', true)->with('accountType', 'budget')->get();
        $homeLivingExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '1c523f60-ab8f-4dd7-88ca-a70863507a3b')->where('is_user', true)->with('accountType', 'budget')->get();
        $incomeExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '6943fd67-ba09-4fc3-986a-3550ae959b33')->where('is_user', true)->with('accountType', 'budget')->get();
        $kidsExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8')->where('is_user', true)->with('accountType', 'budget')->get();
        $leisureExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '55faadc5-6275-4d19-809e-dc56e555929f')->where('is_user', true)->with('accountType', 'budget')->get();
        $loansExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e')->where('is_user', true)->with('accountType', 'budget')->get();
        $noExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', 'c7c1a0a0-8775-45a7-a84b-92a8dac302d3')->where('is_user', true)->with('accountType', 'budget')->get();
        $shoppingExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '83569f71-59dc-46f0-a92f-fdac4ad922aa')->where('is_user', true)->with('accountType', 'budget')->get();
        $transportExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '7b05bf74-08e0-4692-becd-799b11d24dba')->where('is_user', true)->with('accountType', 'budget')->get();
        $wealthCreationExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '46089cb5-ef46-4d9f-af5c-9676d7a55ed4')->where('is_user', true)->with('accountType', 'budget')->get();

        return view('personal.budget_create', compact('wealthCreationExpenseAccounts', 'transportExpenseAccounts', 'shoppingExpenseAccounts', 'noExpenseAccounts', 'loansExpenseAccounts', 'leisureExpenseAccounts', 'kidsExpenseAccounts', 'incomeExpenseAccounts', 'homeLivingExpenseAccounts', 'healthExpenseAccounts', 'foodExpenseAccounts', 'feesExpenseAccounts', 'cashExpenseAccounts', 'billExpenseAccounts', 'user'));
    }

    public function budgetStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $budget = new Budget();
        $budget->amount = $request->amount;
        $budget->expense_account_id = $request->expense_account;
        $budget->user_id = $user->id;
        $budget->is_user = true;
        $budget->is_institution = false;
        $budget->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $budget->save();

        $expenseAccount = ExpenseAccount::findOrFail($request->expense_account);
        $expenseAccount->is_set = true;
        $expenseAccount->save();

        return redirect()->route('personal.budget.show', $budget->id)->withSuccess(__('Budget successfully created.'));
    }

    public function budgetShow($budget_id)
    {
        // User
        $user = $this->getUser();
        // budget
        $budget = Budget::findOrFail($budget_id);
        $budget = Budget::where('id', $budget_id)->with('expenseAccount', 'status', 'user')->first();

        // expense accounts
        // account types
        $billExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '163fa506-9762-422a-a981-cce20b21f1ad')->where('is_user', true)->with('accountType')->get();
        $cashExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '8c0c1829-b6cf-4d38-b640-755db25460ae')->where('is_user', true)->with('accountType')->get();
        $feesExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '17401c1e-1423-40bc-846a-008b0e72373c')->where('is_user', true)->with('accountType')->get();
        $foodExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '008315c2-ee90-4e55-80cc-de2a8bc0472a')->where('is_user', true)->with('accountType')->get();
        $healthExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', 'af7b5592-8c36-4746-b369-a3985c90fd0b')->where('is_user', true)->with('accountType')->get();
        $homeLivingExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '1c523f60-ab8f-4dd7-88ca-a70863507a3b')->where('is_user', true)->with('accountType')->get();
        $incomeExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '6943fd67-ba09-4fc3-986a-3550ae959b33')->where('is_user', true)->with('accountType')->get();
        $kidsExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8')->where('is_user', true)->with('accountType')->get();
        $leisureExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '55faadc5-6275-4d19-809e-dc56e555929f')->where('is_user', true)->with('accountType')->get();
        $loansExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e')->where('is_user', true)->with('accountType')->get();
        $noExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', 'c7c1a0a0-8775-45a7-a84b-92a8dac302d3')->where('is_user', true)->with('accountType')->get();
        $shoppingExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '83569f71-59dc-46f0-a92f-fdac4ad922aa')->where('is_user', true)->with('accountType')->get();
        $transportExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '7b05bf74-08e0-4692-becd-799b11d24dba')->where('is_user', true)->with('accountType')->get();
        $wealthCreationExpenseAccounts = ExpenseAccount::where('user_id', $user->id)->where('account_type_id', '46089cb5-ef46-4d9f-af5c-9676d7a55ed4')->where('is_user', true)->with('accountType')->get();

        $expenseAccountExpenses = Expense::where('expense_account_id', $budget->expense_account_id)->get();

        // Pending to dos
        $pendingToDos = ToDo::where('user_id', $user->id)->where('is_user', true)->with('user', 'status', 'budget')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('budget_id', $budget->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id', $user->id)->where('is_user', true)->with('user', 'status', 'budget')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('budget_id', $budget->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id', $user->id)->where('is_user', true)->with('user', 'status', 'budget')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('budget_id', $budget->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id', $user->id)->where('is_user', true)->with('user', 'status', 'budget')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('budget_id', $budget->id)->get();

        return view('personal.budget_show', compact('wealthCreationExpenseAccounts', 'transportExpenseAccounts', 'shoppingExpenseAccounts', 'noExpenseAccounts', 'loansExpenseAccounts', 'leisureExpenseAccounts', 'kidsExpenseAccounts', 'incomeExpenseAccounts', 'homeLivingExpenseAccounts', 'healthExpenseAccounts', 'foodExpenseAccounts', 'feesExpenseAccounts', 'cashExpenseAccounts', 'billExpenseAccounts', 'budget', 'user', 'expenseAccountExpenses', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos'));
    }

    public function budgetUpdate(Request $request, $budget_id)
    {
        // User
        $user = $this->getUser();
        // Budget
        $budget = Budget::findOrFail($budget_id);
        $budget->amount = $request->amount;
        $budget->save();

        return back()->withSuccess(__('Budget successfully updated.'));
    }

    public function budgetDelete($budget_id)
    {
        // User
        $user = $this->getUser();
        return back()->withStatus(__('Budget successfully deleted.'));
    }

}
