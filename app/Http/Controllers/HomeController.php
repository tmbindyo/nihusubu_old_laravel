<?php

namespace App\Http\Controllers;

use App\InstitutionModule;
use App\Module;
use App\Traits\InstitutionCreationTrait;
use Auth;
use App\Account;
use App\Address;
use App\CampaignType;
use App\ContactType;
use App\Frequency;
use App\UserAccount;
use App\ExpenseAccount;
use App\Institution;
use App\LeadSource;
use App\Reason;
use App\Tax;
use App\Title;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\ReferenceNumberTrait;
use App\Unit;
use App\Warehouse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    use InstitutionCreationTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    use UserTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // check if numerous accounts
        $user = $this->getUser();
        foreach ($user->userAccounts as $userAccount){
            if($userAccount->is_active == 1){
                if ($userAccount->userType->name == "Admin"){
                    return redirect()->route('admin.dashboard');
                }
                elseif ($userAccount->userType->name == "Personal"){
                    return redirect()->route('personal.calendar');
                }
                elseif ($userAccount->userType->name == "Business"){
                    return redirect()->route('business.calendar', $userAccount->institution->portal);
                }
            }
        }

        // deactivate all accounts
        $deactivateUserAccounts = $this->deactivateUserAccounts();
        // redirect to account selection
        return redirect()->route('view.user.accounts');

    }

    public function activeUserAccount()
    {
        return view('dashboard');
    }

    public function createUserAccount()
    {
        // User
        $user = Auth::user();

        // Get personal user account
        $personalUserAccount = UserAccount::where('user_id', $user->id)->where('user_type_id', '5f29e668-9029-4278-a5e7-9ba9f96a20df')->with('institution', 'userType')->first();
        // get user accountsupdate user_accounts set
        $userAccounts = UserAccount::where('user_id', $user->id)->with('institution', 'userType')->get();
        return view('auth.account_type_addition', compact('userAccounts', 'user', 'personalUserAccount'));
    }

    public function viewUserAccounts()
    {

        // User
        $user = Auth::user();
        // get user accountsupdate user_accounts set
        $userAccounts = UserAccount::where('user_id', $user->id)->with('institution', 'userType')->get();
        return view('auth.lockscreen', compact('userAccounts', 'user'));
    }

    public function activateUserAccount($user_account_id)
    {
        // User
        $user = Auth::user();
        // update all user accounts as false
        $userAccounts = UserAccount::where('user_id', $user->id)->update(['is_active' => false]);
        // activate user account
        $userAccounts = UserAccount::where('id', $user_account_id)->update(['is_active' => true]);
        return redirect()->route('home');
    }

    public function deactivateUserAccounts()
    {
        // User
        $user = Auth::user();
        // deactivate user accounts
        $userAccounts = UserAccount::where('user_id', $user->id)->update(['is_active' => false]);
        // redirect to account selection
        return redirect()->route('view.user.accounts');
    }

    public function addInstitution(Request $request){
        // get user
        $user = Auth::user();

        $validatedInstitutionData = $request->validate([
            'business_name' => ['required', 'string', 'max:255', 'unique:institutions,name'],
            'portal' => ['required', 'string', 'max:255', 'unique:institutions'],
        ]);

        // create address
        $address = $this->addressSeeder($request, $user);


        // create address
        $address = $this->addressSeeder($request, $user);
        // create institution
        $institution = $this->institutionSeeder($request, $user, $address);
        // create units
        $this->unitSeeder($user, $institution);
        // create taxes
        $this->taxesSeeder($user, $institution);
        // create warehouses
        $this->warehousesSeeder($request, $user, $institution);
        // create lead sources
        $this->leadSourcesSeeder($user, $institution);
        // create titles
        $this->titlesSeeder($user, $institution);
        // create contact types
        $this->contactTypesSeeder($user, $institution);
        // create campaign types
        $this->campaignTypesSeeder($user, $institution);
        // create accounts
        $this->accountsSeeder($user, $institution);
        // create frequencies
        $this->frequenciesSeeder($user, $institution);
        // create reasons
        $this->reasonsSeeder($user, $institution);
        // create payment chedules
        $this->paymentScheduleSeeder($user, $institution);
        // create expense account
        $this->expenseAccountsSeeder($user, $institution);
        // institution modules
        $this->institutionModuleSeeder($user, $institution);
        // institution admin role
        $this->institutionAdminRoleSeeder($user, $institution);
        // create user account
        $userAccount = $this->userAccountSeeder($user, $institution);

        // account creation
        return redirect()->route('activate.user.account', $userAccount->id);
    }





    public function addPersonal(Request $request){
        // return $request;
        // get user
        $user = Auth::user();

        // create accounts
        $userAccounts = $this->userAccountsSeeder($request, $user);
        // create frequencies
        $userFrequencies = $this->userFrequenciesSeeder($request, $user);
        // create expense account
        $userExpenseAccounts = $this->userExpenseAccountsSeeder($request, $user);
        // create user account
        $userAccount = $this->userUserAccountSeeder($request, $user);
        // create user titles
        $titlesAccount = $this->userTitlesSeeder($request, $user);
        // create user contact types
        $userContactType = $this->useContactTypeSeeder($request, $user);

        // account creation
        auth()->login($user);
        return redirect()->route('home');
    }

    private function userAccountsSeeder($request, $user){

        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        $account = new Account();
        $account->reference = $reference;
        $account->name = "Petty cash";
        $account->notes = "Petty cash";
        $account->balance = 0;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->is_institution = false;
        $account->is_user = true;
        $account->is_chama = true;
        $account->user_id = $user->id;
        $account->save();

    }

    private function userFrequenciesSeeder($request, $user){

        $frequencies = new Frequency();
        $frequencies->name = 'Daily';
        $frequencies->type = 'day';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '2';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Monthly';
        $frequencies->type = 'month';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Quarterly';
        $frequencies->type = 'month';
        $frequencies->frequency = '3';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Semiannually';
        $frequencies->type = 'month';
        $frequencies->frequency = '6';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '2';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = false;
        $frequencies->is_user = true;
        $frequencies->save();

    }

    private function userExpenseAccountsSeeder($request, $user){

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Domestic Wages';
        $expenseAccount->code = 'DW';
        $expenseAccount->description = 'Domestic Wages';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Electricity';
        $expenseAccount->code = 'E';
        $expenseAccount->description = 'Electricity';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Gas';
        $expenseAccount->code = 'G';
        $expenseAccount->description = 'Gas';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Internet';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Internet';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Phone, Mobile';
        $expenseAccount->code = 'P';
        $expenseAccount->description = 'Phone, Mobile';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Religious Commitments';
        $expenseAccount->code = 'RC';
        $expenseAccount->description = 'Religious Commitments';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Rent';
        $expenseAccount->code = 'R';
        $expenseAccount->description = 'Rent';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Service Charge';
        $expenseAccount->code = 'SC';
        $expenseAccount->description = 'Service Charge';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'TV';
        $expenseAccount->code = 'TV';
        $expenseAccount->description = 'TV';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Water';
        $expenseAccount->code = 'W';
        $expenseAccount->description = 'Water';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'TV and Internet';
        $expenseAccount->code = 'TV&I';
        $expenseAccount->description = 'TV and Internet';
        $expenseAccount->account_type_id = '163fa506-9762-422a-a981-cce20b21f1ad';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // cash transfers
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Cash Withdrawal';
        $expenseAccount->code = 'CW';
        $expenseAccount->description = 'Cash Withdrawal';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Contribution';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Contribution';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Credit Card, Loan Payment';
        $expenseAccount->code = 'CC,LP';
        $expenseAccount->description = 'Credit Card, Loan Payment';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Internal Money Transfer';
        $expenseAccount->code = 'IMT';
        $expenseAccount->description = 'Internal Money Transfer';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Loan Repayment';
        $expenseAccount->code = 'LR';
        $expenseAccount->description = 'Loan Repayment';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Mobile Money';
        $expenseAccount->code = 'MM';
        $expenseAccount->description = 'Mobile Money';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Transfer';
        $expenseAccount->code = 'T';
        $expenseAccount->description = 'Transfer';
        $expenseAccount->account_type_id = '8c0c1829-b6cf-4d38-b640-755db25460ae';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // fees, government payments
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bank Fees';
        $expenseAccount->code = 'BF';
        $expenseAccount->description = 'Bank Fees';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Consultancy';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Consultancy';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Land Rates';
        $expenseAccount->code = 'LR';
        $expenseAccount->description = 'Land Rates';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Legal Fees';
        $expenseAccount->code = 'LF';
        $expenseAccount->description = 'Legal Fees';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Taxes';
        $expenseAccount->code = 'T';
        $expenseAccount->description = 'Taxes';
        $expenseAccount->account_type_id = '17401c1e-1423-40bc-846a-008b0e72373c';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();


        // food and dinning
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Business Meeting';
        $expenseAccount->code = 'BM';
        $expenseAccount->description = 'Business Meeting';
        $expenseAccount->account_type_id = '008315c2-ee90-4e55-80cc-de2a8bc0472a';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Celebration';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Celebration';
        $expenseAccount->account_type_id = '008315c2-ee90-4e55-80cc-de2a8bc0472a';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Eating Out';
        $expenseAccount->code = 'EO';
        $expenseAccount->description = 'Eating Out';
        $expenseAccount->account_type_id = '008315c2-ee90-4e55-80cc-de2a8bc0472a';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Groceries';
        $expenseAccount->code = 'G';
        $expenseAccount->description = 'Groceries';
        $expenseAccount->account_type_id = '008315c2-ee90-4e55-80cc-de2a8bc0472a';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '008315c2-ee90-4e55-80cc-de2a8bc0472a';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // Health, Personal Care
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Dentist';
        $expenseAccount->code = 'De';
        $expenseAccount->description = 'Dentist';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Doctor';
        $expenseAccount->code = 'Do';
        $expenseAccount->description = 'Doctor';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Eye Care';
        $expenseAccount->code = 'EC';
        $expenseAccount->description = 'Eye Care';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Gym';
        $expenseAccount->code = 'G';
        $expenseAccount->description = 'Gym';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Hair';
        $expenseAccount->code = 'H';
        $expenseAccount->description = 'Hair';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Insurance';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Insurance';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Medical Care';
        $expenseAccount->code = 'MC';
        $expenseAccount->description = 'Medical Care';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Pets';
        $expenseAccount->code = 'Pe';
        $expenseAccount->description = 'Pets';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Pharmacy';
        $expenseAccount->code = 'Ph';
        $expenseAccount->description = 'Pharmacy';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Spa and Beauty';
        $expenseAccount->code = 'S&B';
        $expenseAccount->description = 'Spa and Beauty';
        $expenseAccount->account_type_id = 'af7b5592-8c36-4746-b369-a3985c90fd0b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // Home and Living
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Construction';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Construction';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Electronics';
        $expenseAccount->code = 'E';
        $expenseAccount->description = 'Electronics';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Furniture';
        $expenseAccount->code = 'F';
        $expenseAccount->description = 'Furniture';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Home Improvement';
        $expenseAccount->code = 'HI';
        $expenseAccount->description = 'Home Improvement';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Insurance';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Insurance';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Laundry';
        $expenseAccount->code = 'L';
        $expenseAccount->description = 'Laundry';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Maintenance';
        $expenseAccount->code = 'M';
        $expenseAccount->description = 'Maintenance';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Mortgage, Rent';
        $expenseAccount->code = 'M,R';
        $expenseAccount->description = 'Mortgage, Rent';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'M,R';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '1c523f60-ab8f-4dd7-88ca-a70863507a3b';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // income
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bonus';
        $expenseAccount->code = 'B';
        $expenseAccount->description = 'Bonus';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Commission';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Commission';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Farming';
        $expenseAccount->code = 'F';
        $expenseAccount->description = 'Farming';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Interest, Dividends';
        $expenseAccount->code = 'I,D';
        $expenseAccount->description = 'Interest, Dividends';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Salary, Retirement';
        $expenseAccount->code = 'S,R';
        $expenseAccount->description = 'Salary, Retirement';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Savings';
        $expenseAccount->code = 'S';
        $expenseAccount->description = 'Savings';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Side Hustle';
        $expenseAccount->code = 'SH';
        $expenseAccount->description = 'Side Hustle';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Stipend, Allowances';
        $expenseAccount->code = 'S,A';
        $expenseAccount->description = 'Stipend, Allowances';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Support';
        $expenseAccount->code = 'S';
        $expenseAccount->description = 'Support';
        $expenseAccount->account_type_id = '6943fd67-ba09-4fc3-986a-3550ae959b33';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // Kids, family
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Allowances';
        $expenseAccount->code = 'A';
        $expenseAccount->description = 'Allowances';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Child Care';
        $expenseAccount->code = 'CC';
        $expenseAccount->description = 'Child Care';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Family Support';
        $expenseAccount->code = 'FS';
        $expenseAccount->description = 'Family Support';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'School';
        $expenseAccount->code = 'Sc';
        $expenseAccount->description = 'School';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Toys, Gift';
        $expenseAccount->code = 'T,G';
        $expenseAccount->description = 'Toys, Gift';
        $expenseAccount->account_type_id = '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // Leisure, Entertainment
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bars, Clubs';
        $expenseAccount->code = 'B, c';
        $expenseAccount->description = 'Bars, Clubs';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Cinema, Theater And Concerts';
        $expenseAccount->code = 'C,T&C';
        $expenseAccount->description = 'Cinema, Theater And Concerts';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Hotels';
        $expenseAccount->code = 'H';
        $expenseAccount->description = 'Hotels';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Memberships';
        $expenseAccount->code = 'M';
        $expenseAccount->description = 'Memberships';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Purchases';
        $expenseAccount->code = 'P';
        $expenseAccount->description = 'Purchases';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Sports, Hobbies';
        $expenseAccount->code = 'S,H';
        $expenseAccount->description = 'Sports, Hobbies';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Vacation';
        $expenseAccount->code = 'V';
        $expenseAccount->description = 'Vacation';
        $expenseAccount->account_type_id = '55faadc5-6275-4d19-809e-dc56e555929f';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // Loans
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Home Improvement, Renovation';
        $expenseAccount->code = 'HI,R';
        $expenseAccount->description = 'Home Improvement, Renovation';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Insurance';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Insurance';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Medical';
        $expenseAccount->code = 'M';
        $expenseAccount->description = 'Medical';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Business';
        $expenseAccount->code = 'B';
        $expenseAccount->description = 'Business';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Construction';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Construction';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Family Support';
        $expenseAccount->code = 'FS';
        $expenseAccount->description = 'Family Support';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Mortgage deposit';
        $expenseAccount->code = 'MD';
        $expenseAccount->description = 'Mortgage deposit';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'School Fees';
        $expenseAccount->code = 'SF';
        $expenseAccount->description = 'School Fees';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Vacation';
        $expenseAccount->code = 'Va';
        $expenseAccount->description = 'Vacation';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Vehicle';
        $expenseAccount->code = 'VE';
        $expenseAccount->description = 'Vehicle';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Wedding';
        $expenseAccount->code = 'We';
        $expenseAccount->description = 'Wedding';
        $expenseAccount->account_type_id = '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // no category
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'No Category';
        $expenseAccount->code = 'NC';
        $expenseAccount->description = 'No Category';
        $expenseAccount->account_type_id = 'c7c1a0a0-8775-45a7-a84b-92a8dac302d3';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // shopping
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Books, Music and DVDs';
        $expenseAccount->code = 'B,M&D';
        $expenseAccount->description = 'Books, Music and DVDs';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Clothing, Accessories';
        $expenseAccount->code = 'C,A';
        $expenseAccount->description = 'Clothing, Accessories';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Electronics, Gadgets';
        $expenseAccount->code = 'E,G';
        $expenseAccount->description = 'Electronics, Gadgets';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Gifts, Charity';
        $expenseAccount->code = 'G, c';
        $expenseAccount->description = 'Gifts, Charity';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Pets';
        $expenseAccount->code = 'P';
        $expenseAccount->description = 'Pets';
        $expenseAccount->account_type_id = '83569f71-59dc-46f0-a92f-fdac4ad922aa';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // transport
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Airfare';
        $expenseAccount->code = 'A';
        $expenseAccount->description = 'Airfare';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Fuel';
        $expenseAccount->code = 'F';
        $expenseAccount->description = 'Fuel';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Insurance';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Insurance';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Maintenance';
        $expenseAccount->code = 'M';
        $expenseAccount->description = 'Maintenance';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other';
        $expenseAccount->code = 'O';
        $expenseAccount->description = 'Other';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Parking';
        $expenseAccount->code = 'P';
        $expenseAccount->description = 'Parking';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Public Transport';
        $expenseAccount->code = 'PT';
        $expenseAccount->description = 'Public Transport';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'School Bus';
        $expenseAccount->code = 'SB';
        $expenseAccount->description = 'School Bus';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Taxi, Car hire';
        $expenseAccount->code = 'T, cH';
        $expenseAccount->description = 'Taxi, Car hire';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Train Ticket';
        $expenseAccount->code = 'TT';
        $expenseAccount->description = 'Train Ticket';
        $expenseAccount->account_type_id = '7b05bf74-08e0-4692-becd-799b11d24dba';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        // wealth creation
        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Investment';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Investment';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Savings';
        $expenseAccount->code = 'S';
        $expenseAccount->description = 'Savings';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Side Hustle';
        $expenseAccount->code = 'SH';
        $expenseAccount->description = 'Side Hustle';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Chamas';
        $expenseAccount->code = 'C';
        $expenseAccount->description = 'Chamas';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Insurance';
        $expenseAccount->code = 'I';
        $expenseAccount->description = 'Insurance';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Sacco';
        $expenseAccount->code = 'S';
        $expenseAccount->description = 'Sacco';
        $expenseAccount->account_type_id = '46089cb5-ef46-4d9f-af5c-9676d7a55ed4';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = false;
        $expenseAccount->is_user = true;
        $expenseAccount->save();


    }

    private function userUserAccountSeeder ($request, $user){
        // account
        $userAccount = new UserAccount();
        $userAccount->user_id = $user->id;
        $userAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $userAccount->is_institution = false;
        $userAccount->is_active = true;
        $userAccount->is_user = true;
        $userAccount->is_admin = false;
        $userAccount->user_type_id = '5f29e668-9029-4278-a5e7-9ba9f96a20df';

        $userAccount->save();

        $userAccount = $this->activateUserAccount($userAccount->id);



    }

    private function userTitlesSeeder($request, $user){

        $titles = new Title();
        $titles->name = 'Mr';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = false;
        $titles->is_user = true;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Mrs';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = false;
        $titles->is_user = true;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Ms';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = false;
        $titles->is_user = true;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Dr';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = false;
        $titles->is_user = true;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Prof';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = false;
        $titles->is_user = true;
        $titles->save();

    }

    private function useContactTypeSeeder($request, $user){

        $contactType = new ContactType();
        $contactType->name = 'Spouse';
        $contactType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $contactType->is_institution = false;
        $contactType->user_id = $user->id;
        $contactType->is_user = true;
        $contactType->save();

    }


}
