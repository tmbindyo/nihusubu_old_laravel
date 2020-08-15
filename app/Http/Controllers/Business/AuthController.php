<?php

namespace App\Http\Controllers\Business;

use App\InstitutionModule;
use App\Module;
use App\PaymentSchedule;
use App\Tax;
use App\Plan;
use App\Traits\InstitutionCreationTrait;
use App\Unit;
use App\User;
use App\Title;
use App\Reason;
use App\Account;
use App\Address;
use App\Frequency;
use App\Warehouse;
use App\LeadSource;
use App\Institution;
use App\UserAccount;
use App\ContactType;
use App\CampaignType;
use App\ExpenseAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    use InstitutionCreationTrait;

    public function businessSignup()
    {

        $plans = Plan::where('plan_type_id', '7dd05c3c-7526-498b-9fbb-d0c766a678ac')->get();
        return view('auth.register', compact('plans'));
    }

    public function standardSignup()
    {

        $plan = Plan::where('id', '410f31ed-47be-4658-930a-a47f2839ebf5')->first();
        return view('auth.business_register', compact('plan'));
    }

    public function professionalSignup()
    {
        $plan = Plan::where('id', '34ae6893-5329-46b4-99a9-3cde1367fb55')->first();
        return view('auth.business_register', compact('plan'));
    }

    public function personalSignup()
    {
        return back()->withErrors("Coming soon");
    }

    public function businessAdd()
    {
        $plans = Plan::where('plan_type_id', '7dd05c3c-7526-498b-9fbb-d0c766a678ac')->get();
        return view('auth.create_new_account', compact('plans'));
    }


    public function createInstitution(Request $request){
//         return $request;
        // user account validation
        $validatedUserData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // return $validatedData;

        // user account creation
        $user = new User();
        $user->phone_number = $request->phone_number;
        // $user->timezone = $request->timezone;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $validatedInstitutionData = $request->validate([
            'business_name' => ['required', 'string', 'max:255', 'unique:institutions,name'],
            'portal' => ['required', 'string', 'max:255', 'unique:institutions'],
        ]);

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
        $this->userAccountSeeder($user, $institution);

        // login user
        auth()->login($user);
        // send verification email
        $user->sendEmailVerificationNotification();

        return redirect()->route('home');
    }


}

