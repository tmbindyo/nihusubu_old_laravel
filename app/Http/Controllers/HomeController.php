<?php

namespace App\Http\Controllers;

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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    use UserTrait;
    use ReferenceNumberTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // check if numerous accounts
        $user = $this->getUser();
        foreach ($user->user_accounts as $userAccount){
            if($userAccount->is_active == 1){
                if ($userAccount->user_type->name == "Admin"){
                    return redirect()->route('');
                }
                elseif ($userAccount->user_type->name == "Personal"){
                    return redirect()->route('personal.calendar');
                }
                elseif ($userAccount->user_type->name == "Business"){
                    return redirect()->route('business.calendar',$userAccount->institution->portal);
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
        $personalUserAccount = UserAccount::where('user_id',$user->id)->where('user_type_id','5f29e668-9029-4278-a5e7-9ba9f96a20df')->with('institution','user_type')->first();
        // get user accountsupdate user_accounts set
        $userAccounts = UserAccount::where('user_id',$user->id)->with('institution','user_type')->get();
        return view('auth.account_type_addition',compact('userAccounts','user','personalUserAccount'));
    }

    public function viewUserAccounts()
    {

        // User
        $user = Auth::user();
        // get user accountsupdate user_accounts set
        $userAccounts = UserAccount::where('user_id',$user->id)->with('institution','user_type')->get();
        return view('auth.lockscreen',compact('userAccounts'));
    }

    public function activateUserAccount($user_account_id)
    {
        // User
        $user = Auth::user();
        // update all user accounts as false
        $userAccounts = UserAccount::where('user_id',$user->id)->update(['is_active' => False]);
        // activate user account
        $userAccounts = UserAccount::where('id',$user_account_id)->update(['is_active' => True]);
        return redirect()->route('home');
    }

    public function deactivateUserAccounts()
    {
        // User
        $user = Auth::user();
        // get user accounts
        $userAccounts = UserAccount::where('user_id',$user->id)->update(['is_active' => False]);
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

        // create instiution
        $institution = new Institution();
        $institution->name = $request->business_name;
        $institution->portal = $request->portal;
        $institution->email = $request->business_email;
        $institution->phone_number = $request->business_phone_number;
        $institution->user_id = $user->id;
        $institution->currency_id = "0839e6c9-20b3-4442-b3b6-5137a4d309ec";
        $institution->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $institution->save();

        // create units
        $institutionUnits = $this->unitSeeder($request, $user,$institution);
        // create taxes
        $institutionTaxes = $this->taxesSeeder($request, $user,$institution);
        // create warehouses
        $institutionWarehouses = $this->warehousesSeeder($request, $user,$institution);
        // create lead sources
        $institutionLeadSources = $this->leadSourcesSeeder($request, $user, $institution);
        // create titles
        $institutionTitles = $this->titlesSeeder($request, $user, $institution);
        // create contact types
        $institutionContactTypes = $this->contactTypesSeeder($request, $user, $institution);
        // create campaign types
        $institutionCampaignTypes = $this->campaignTypesSeeder($request, $user, $institution);
        // create accounts
        $institutionAccounts = $this->accountsSeeder($request, $user, $institution);
        // create frequencies
        $institutionFrequencies = $this->frequenciesSeeder($request, $user, $institution);
        // create reasons
        $institutionReasons = $this->reasonsSeeder($request, $user, $institution);
        // create expense account
        $institutionExpenseAccounts = $this->expenseAccountsSeeder($request, $user, $institution);
        // create user account
        $userAccount = $this->userAccountSeeder($request, $user, $institution);
        // return $userAccount;

        // account creation
        return redirect()->route('activate.user.account',$userAccount->id);
    }

    private function unitSeeder ($request, $user, $institution){

        $unit = new Unit();
        $unit->name = 'ML';
        $unit->description = 'Millilitres';
        $unit->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

        $unit = new Unit();
        $unit->name = 'L';
        $unit->description = 'Litres';
        $unit->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

        $unit = new Unit();
        $unit->name = 'Dozen';
        $unit->description = 'Dozen';
        $unit->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

        $unit = new Unit();
        $unit->name = 'G';
        $unit->description = 'Grams';
        $unit->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

        $unit = new Unit();
        $unit->name = 'KG';
        $unit->description = 'KiloGrams';
        $unit->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

    }

    private function taxesSeeder ($request, $user, $institution){
        // Taxes
        $tax = new Tax();
        $tax->name = 'VAT';
        $tax->amount = '16';
        $tax->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $tax->institution_id = $institution->id;
        $tax->user_id = $user->id;
        $tax->is_percentage = True;
        $tax->save();

        $tax = new Tax();
        $tax->name = 'Catering Levy';
        $tax->amount = '6';
        $tax->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $tax->institution_id = $institution->id;
        $tax->user_id = $user->id;
        $tax->is_percentage = True;
        $tax->save();

    }

    private function warehousesSeeder($request, $user, $institution){

        // warehouse address
        $address = new Address();
        $address->address_type_id = 'f7e388be-1eaa-4acc-9929-daf50bb0b5d1';
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->postal_code = $request->postal_code;
        $address->po_box = $request->po_box;
        $address->town = $request->city;
        $address->street = $request->street;
        $address->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $address->user_id = $user->id;
        $address->save();

        // warehouse
        $warehouse = new Warehouse();
        $warehouse->name = $request->business_name;
        $warehouse->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $warehouse->institution_id = $institution->id;
        $warehouse->address_id = $address->id;
        $warehouse->user_id = $user->id;
        $warehouse->is_primary = True;
        $warehouse->save();

    }

    private function leadSourcesSeeder($request, $user, $institution){
        $leadSource = new LeadSource();
        $leadSource->name = 'Advertisment';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource = new LeadSource();
        $leadSource->name = 'Chat';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource = new LeadSource();
        $leadSource->name = 'Cold Call';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource = new LeadSource();
        $leadSource->name = 'Client Referral';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource = new LeadSource();
        $leadSource->name = 'Contact Referral';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource = new LeadSource();
        $leadSource->name = 'Referral';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource->name = 'Employee Referral';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource->name = 'Other';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource->name = 'Public Relations';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

        $leadSource->name = 'Website';
        $leadSource->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $leadSource->institution_id = $institution->id;
        $leadSource->user_id = $user->id;
        $leadSource->save();

    }

    private function titlesSeeder($request, $user, $institution){

        $titles = new Title();
        $titles->name = 'Mr';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->institution_id = $institution->id;
        $titles->user_id = $user->id;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Mrs';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->institution_id = $institution->id;
        $titles->user_id = $user->id;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Ms';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->institution_id = $institution->id;
        $titles->user_id = $user->id;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Dr';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->institution_id = $institution->id;
        $titles->user_id = $user->id;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Prof';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->institution_id = $institution->id;
        $titles->user_id = $user->id;
        $titles->save();

    }

    private function contactTypesSeeder($request, $user, $institution){

        $contactType = new ContactType();
        $contactType->name = 'Client';
        $contactType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $contactType->institution_id = $institution->id;
        $contactType->user_id = $user->id;
        $contactType->save();

        $contactType = new ContactType();
        $contactType->name = 'Partner';
        $contactType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $contactType->institution_id = $institution->id;
        $contactType->user_id = $user->id;
        $contactType->save();

        $contactType = new ContactType();
        $contactType->name = 'Supplier';
        $contactType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $contactType->institution_id = $institution->id;
        $contactType->user_id = $user->id;
        $contactType->save();

    }

    private function campaignTypesSeeder($request, $user, $institution){

        $campaignType = new CampaignType();
        $campaignType->name = 'Sell';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Conference';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Webniar';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Trade Show';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Public Relations';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Partners';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Advertisment';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Banner Ad';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Email';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Telemarketing';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Other';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

        $campaignType = new CampaignType();
        $campaignType->name = 'Other';
        $campaignType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $campaignType->institution_id = $institution->id;
        $campaignType->user_id = $user->id;
        $campaignType->save();

    }

    private function accountsSeeder($request, $user, $institution){

        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        $account = new Account();
        $account->reference = $reference;
        $account->name = "Petty cash";
        $account->notes = "Petty cash";
        $account->balance = 0;
        $account->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $account->is_institution = True;
        $account->is_user = False;
        $account->is_chama = False;
        $account->institution_id = $institution->id;
        $account->user_id = $user->id;
        $account->save();

    }

    private function frequenciesSeeder($request, $user, $institution){

        $frequencies = new Frequency();
        $frequencies->name = 'Daily';
        $frequencies->type = 'day';
        $frequencies->frequency = '1';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '1';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '2';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Monthly';
        $frequencies->type = 'month';
        $frequencies->frequency = '1';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Quarterly';
        $frequencies->type = 'month';
        $frequencies->frequency = '3';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Semiannually';
        $frequencies->type = 'month';
        $frequencies->frequency = '6';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '1';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '2';
        $frequencies->institution_id = $institution->id;
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = True;
        $frequencies->is_user = False;
        $frequencies->save();

    }

    private function reasonsSeeder($request, $user, $institution){

        $reason = new Reason();
        $reason->name = 'Stock on fire';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Stolen Goods';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Damaged Goods';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Stock written off';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Stocktaking results';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Inventory Reevaluation';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

        $reason = new Reason();
        $reason->name = 'Transfer Order';
        $reason->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $reason->institution_id = $institution->id;
        $reason->user_id = $user->id;
        $reason->save();

    }

    private function expenseAccountsSeeder($request, $user, $institution){

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Cost Of Goods Sold';
        $expenseAccount->code = 'COGS';
        $expenseAccount->description = 'Cost of goods sold (COGS) refers to the direct costs of producing the goods sold by a company. This amount includes the cost of the materials and labor directly used to create the good. It excludes indirect expenses, such as distribution costs and sales force costs.';
        $expenseAccount->account_type_id = 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Advertising and Marketing';
        $expenseAccount->code = 'A&M';
        $expenseAccount->description = 'Account to track the cost of advertising and marketing.';
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Automobile Expense';
        $expenseAccount->code = 'AE';
        $expenseAccount->description = "A deduction on actual cost of gas, oil, repairs, tires, washing, etc. plus a deduction for depreciation.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bad Debt';
        $expenseAccount->code = 'BD';
        $expenseAccount->description = "Bad debt occasionally called accounts expense is a monetary amount owed to a creditor that is unlikely to be paid and, or which the creditor is not willing to take action to collect for various reasons, often due to the debtor not having the money to pay, for example due to a company going into liquidation or insolvency.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bank Fees and Charges';
        $expenseAccount->code = 'BF&C';
        $expenseAccount->description = "Bank Fees and Charges.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Credit Card Charges';
        $expenseAccount->code = 'CCC';
        $expenseAccount->description = "Credit Card Charges.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Depreciation Expense';
        $expenseAccount->code = 'DE';
        $expenseAccount->description = "A depreciation expense is the amount deducted from gross profit to allow for a reduction in the value of something because of its age or how much it has been used.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'IT and Internet Expenses';
        $expenseAccount->code = 'IT&IE';
        $expenseAccount->description = "IT and Internet Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Janitorial Expense';
        $expenseAccount->code = 'JE';
        $expenseAccount->description = "Janitorial Expense.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Lodging';
        $expenseAccount->code = 'L';
        $expenseAccount->description = " Lodging expenses are usually a business expense that is incurred when someone must travel away from their home to do business.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Meals and Entertainment';
        $expenseAccount->code = 'M&E';
        $expenseAccount->description = " Expenses on meals and entertainment.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Office Supplies';
        $expenseAccount->code = 'OS';
        $expenseAccount->description = " Expenses on office supplies.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other Expenses';
        $expenseAccount->code = 'OE';
        $expenseAccount->description = "Other expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Parking';
        $expenseAccount->code = 'Pa';
        $expenseAccount->description = "Parking expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Postage';
        $expenseAccount->code = 'Po';
        $expenseAccount->description = "Postage expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Printing and Stationery';
        $expenseAccount->code = 'P&S';
        $expenseAccount->description = "Printing & stationery expenses include the cost of stationery items which are used daily in offices and the printed material for correspondence purposes.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Rent Expense';
        $expenseAccount->code = 'RE';
        $expenseAccount->description = "Rent expense is an account that lists the cost of occupying rental property.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Repairs and Maintenance';
        $expenseAccount->code = 'R&M';
        $expenseAccount->description = "The costs incurred to bring an asset back to an earlier condition or to keep the asset operating at its present condition (as opposed to improving the asset).";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Salaries and Employee Wages';
        $expenseAccount->code = 'S&EW';
        $expenseAccount->description = "Salaries and Employee Wages expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Telephone Expenses';
        $expenseAccount->code = 'TeE';
        $expenseAccount->description = "Telephone Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Travel Expense';
        $expenseAccount->code = 'TrE';
        $expenseAccount->description = "Travel Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Uncategorized';
        $expenseAccount->code = 'Un';
        $expenseAccount->description = "Uncategorized expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Uncategorized';
        $expenseAccount->code = 'Un';
        $expenseAccount->description = "Uncategorized expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Discount';
        $expenseAccount->code = 'D';
        $expenseAccount->description = 'Account to track discount';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'General Income';
        $expenseAccount->code = 'GE';
        $expenseAccount->description = 'Account to track general income';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Interest Income';
        $expenseAccount->code = 'IE';
        $expenseAccount->description = 'Account to track Interest income';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Late Fee Income';
        $expenseAccount->code = 'LFE';
        $expenseAccount->description = 'Account to track the late fee income';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other Charges';
        $expenseAccount->code = 'OC';
        $expenseAccount->description = 'Account to track the Other charges';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Sales';
        $expenseAccount->code = 'S';
        $expenseAccount->description = 'Account to track the Cost Of Sales';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Shipping Charge';
        $expenseAccount->code = 'SC';
        $expenseAccount->description = 'Account to track Shipping charges';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '798077ba-ae21-4df0-8079-5a7c82afd90e';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Finished Goods';
        $expenseAccount->code = 'FG';
        $expenseAccount->description = 'Account to track the Cost Of Goods Sold';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Finished Goods';
        $expenseAccount->code = 'FG';
        $expenseAccount->description = 'Account to track the Cost Of Goods Sold';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Inventory Asset';
        $expenseAccount->code = 'IA';
        $expenseAccount->description = 'Account to track the Cost Of Goods Sold';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Work In Progress';
        $expenseAccount->code = 'WIP';
        $expenseAccount->description = 'Account to track the Cost Of Goods Sold';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->account_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        $expenseAccount->institution_id = $institution->id;
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = True;
        $expenseAccount->is_user = False;
        $expenseAccount->save();

    }

    private function userAccountSeeder ($request, $user, $institution){
        // account
        $userAccount = new UserAccount();
        $userAccount->institution_id = $institution->id;
        $userAccount->user_id = $user->id;
        $userAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $userAccount->is_institution = true;
        $userAccount->is_active = true;
        $userAccount->is_user = false;
        $userAccount->is_admin = false;
        $userAccount->institution_id = $institution->id;
        $userAccount->user_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
        $userAccount->save();
        return $userAccount;

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
        $account->is_institution = False;
        $account->is_user = True;
        $account->is_chama = True;
        $account->user_id = $user->id;
        $account->save();

    }

    private function userFrequenciesSeeder($request, $user){

        $frequencies = new Frequency();
        $frequencies->name = 'Daily';
        $frequencies->type = 'day';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Weekly';
        $frequencies->type = 'week';
        $frequencies->frequency = '2';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Monthly';
        $frequencies->type = 'month';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Quarterly';
        $frequencies->type = 'month';
        $frequencies->frequency = '3';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Semiannually';
        $frequencies->type = 'month';
        $frequencies->frequency = '6';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '1';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

        $frequencies = new Frequency();
        $frequencies->name = 'Bi Annually';
        $frequencies->type = 'year';
        $frequencies->frequency = '2';
        $frequencies->user_id = $user->id;
        $frequencies->is_institution = False;
        $frequencies->is_user = True;
        $frequencies->save();

    }

    private function userExpenseAccountsSeeder($request, $user){

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Cost Of Goods Sold';
        $expenseAccount->code = 'COGS';
        $expenseAccount->description = 'Cost of goods sold (COGS) refers to the direct costs of producing the goods sold by a company. This amount includes the cost of the materials and labor directly used to create the good. It excludes indirect expenses, such as distribution costs and sales force costs.';
        $expenseAccount->account_type_id = 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Advertising and Marketing';
        $expenseAccount->code = 'A&M';
        $expenseAccount->description = 'Account to track the cost of advertising and marketing.';
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Automobile Expense';
        $expenseAccount->code = 'AE';
        $expenseAccount->description = "A deduction on actual cost of gas, oil, repairs, tires, washing, etc. plus a deduction for depreciation.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bad Debt';
        $expenseAccount->code = 'BD';
        $expenseAccount->description = "Bad debt occasionally called accounts expense is a monetary amount owed to a creditor that is unlikely to be paid and, or which the creditor is not willing to take action to collect for various reasons, often due to the debtor not having the money to pay, for example due to a company going into liquidation or insolvency.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Bank Fees and Charges';
        $expenseAccount->code = 'BF&C';
        $expenseAccount->description = "Bank Fees and Charges.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Credit Card Charges';
        $expenseAccount->code = 'CCC';
        $expenseAccount->description = "Credit Card Charges.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Depreciation Expense';
        $expenseAccount->code = 'DE';
        $expenseAccount->description = "A depreciation expense is the amount deducted from gross profit to allow for a reduction in the value of something because of its age or how much it has been used.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'IT and Internet Expenses';
        $expenseAccount->code = 'IT&IE';
        $expenseAccount->description = "IT and Internet Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Janitorial Expense';
        $expenseAccount->code = 'JE';
        $expenseAccount->description = "Janitorial Expense.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Lodging';
        $expenseAccount->code = 'L';
        $expenseAccount->description = " Lodging expenses are usually a business expense that is incurred when someone must travel away from their home to do business.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Meals and Entertainment';
        $expenseAccount->code = 'M&E';
        $expenseAccount->description = " Expenses on meals and entertainment.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Office Supplies';
        $expenseAccount->code = 'OS';
        $expenseAccount->description = " Expenses on office supplies.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Other Expenses';
        $expenseAccount->code = 'OE';
        $expenseAccount->description = "Other expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Parking';
        $expenseAccount->code = 'Pa';
        $expenseAccount->description = "Parking expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Postage';
        $expenseAccount->code = 'Po';
        $expenseAccount->description = "Postage expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Printing and Stationery';
        $expenseAccount->code = 'P&S';
        $expenseAccount->description = "Printing & stationery expenses include the cost of stationery items which are used daily in offices and the printed material for correspondence purposes.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Rent Expense';
        $expenseAccount->code = 'RE';
        $expenseAccount->description = "Rent expense is an account that lists the cost of occupying rental property.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Repairs and Maintenance';
        $expenseAccount->code = 'R&M';
        $expenseAccount->description = "The costs incurred to bring an asset back to an earlier condition or to keep the asset operating at its present condition (as opposed to improving the asset).";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Salaries and Employee Wages';
        $expenseAccount->code = 'S&EW';
        $expenseAccount->description = "Salaries and Employee Wages expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Telephone Expenses';
        $expenseAccount->code = 'TeE';
        $expenseAccount->description = "Telephone Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Travel Expense';
        $expenseAccount->code = 'TrE';
        $expenseAccount->description = "Travel Expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Uncategorized';
        $expenseAccount->code = 'Un';
        $expenseAccount->description = "Uncategorized expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

        $expenseAccount = new ExpenseAccount();
        $expenseAccount->name = 'Uncategorized';
        $expenseAccount->code = 'Un';
        $expenseAccount->description = "Uncategorized expenses.";
        $expenseAccount->account_type_id = 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd';
        $expenseAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $expenseAccount->user_id = $user->id;
        $expenseAccount->is_institution = False;
        $expenseAccount->is_user = True;
        $expenseAccount->save();

    }

    private function userUserAccountSeeder ($request, $user){
        // account
        $userAccount = new UserAccount();
        $userAccount->user_id = $user->id;
        $userAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $userAccount->is_institution = false;
        $userAccount->is_active = false;
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
        $titles->is_institution = False;
        $titles->is_user = True;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Mrs';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = False;
        $titles->is_user = True;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Ms';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = False;
        $titles->is_user = True;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Dr';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = False;
        $titles->is_user = True;
        $titles->save();

        $titles = new Title();
        $titles->name = 'Prof';
        $titles->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $titles->user_id = $user->id;
        $titles->is_institution = False;
        $titles->is_user = True;
        $titles->save();

    }

    private function useContactTypeSeeder($request, $user){

        $contactType = new ContactType();
        $contactType->name = 'Spouse';
        $contactType->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $contactType->is_institution = False;
        $contactType->user_id = $user->id;
        $contactType->is_user = True;
        $contactType->save();

    }


}
