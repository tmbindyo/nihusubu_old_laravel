<?php

namespace App\Http\Controllers\Landing;
use App\InstitutionModule;
use App\UserAccount;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use App\Action;
use App\Liability;
use App\Loan;
use App\LoanType;
use App\User;
use DB;
use App\Address;
use App\EmailSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institution;
use App\Warehouse;

class LandingController extends Controller
{
    public function landing()
    {
        return view('landing.landing');
    }
    public function about()
    {
        return view('landing.about');
    }
    public function services()
    {
        return view('landing.services');
    }
    public function contacts()
    {
        return view('landing.contacts');
    }
    public function events()
    {
        return view('landing.events');
    }
    public function lawyer()
    {
        return view('landing.lawyer');
    }
    public function event($event_id)
    {
        return view('landing.event');
    }
    public function faq()
    {
        return view('landing.faq');
    }
    public function corporate()
    {
        return view('landing.corporate');
    }
    public function team()
    {
        return view('landing.team');
    }
    public function portfolio()
    {
        return view('landing.portfolio');
    }
    public function comingSoon()
    {
        return view('landing.coming_soon');
    }
    public function termsAndConditions()
    {
        return view('landing.terms_and_conditions');
    }

    public function emailSubscribe(Request $request)
    {
        $emailSubscription = new EmailSubscribe();
        $emailSubscription->email = $request->email;
        $emailSubscription->status_id = '276b2772-7230-4f83-bbd7-ec45e3da2ae4';
        $emailSubscription->save();
        return back()->withSuccess(__('You have sucessfully been subscribed.'));
    }

    public function emailUnubscribe(Request $request)
    {
        $emailSubscription = EmailSubscribe::where('email', $request->email)->first();
        if ($emailSubscription) {
            $emailSubscription->status_id = 'e0050238-1d7b-4420-b297-ce4c41c700a3';
            $emailSubscription->save();
            return back()->withSuccess(__('You have sucessfully been subscribed.'));
        } else {
            return back()->withError(__("We don't seem to have a record of this email subscribed."));
        }
    }

    public function contactUs(Request $request)
    {
        $emailSubscription = new EmailSubscribe();
        $emailSubscription->name = $request->name;
        $emailSubscription->email = $request->email;
        $emailSubscription->message = $request->message;
        $emailSubscription->status_id = '8932f8c3-226a-47c9-9796-5ba50662fdea';
        $emailSubscription->save();
        return back()->withSuccess(__('You have sucessfully been subscribed.'));
    }

    public function addressPopulation()
    {
        $institutions = Institution::all();
        foreach ($institutions as $institution) {
            // check if address
            if ($institution->address_id) {
                print "good";
            } else {
                // get primary warehouse
                $primaryWarehouse = Warehouse::where('institution_id', $institution->id)
                    ->where('is_primary', true)->first();
                // get warehouse address
                $warehouseAddress = Address::where('id', $primaryWarehouse->address_id)->first();

                // institution address
                // warehouse address
                $primaryAddress = new Address();
                $primaryAddress->address_type_id = '804af9cb-0333-4926-87ab-ef7e8c13f462';
                $primaryAddress->address_line_1 = $warehouseAddress->address_line_1;
                $primaryAddress->address_line_2 = $warehouseAddress->address_line_2;
                $primaryAddress->postal_code = $warehouseAddress->postal_code;
                $primaryAddress->phone_number = $warehouseAddress->business_phone_number;
                $primaryAddress->po_box = $warehouseAddress->po_box;
                $primaryAddress->town = $warehouseAddress->town;
                $primaryAddress->street = $warehouseAddress->street;
                $primaryAddress->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $primaryAddress->user_id = $warehouseAddress->user_id;
                $primaryAddress->save();

                $institutionUpdate = Institution::where('id', $institution->id)
                    ->update(['address_id' => $primaryAddress->id]);
            }
        }
        return "Done";
    }

    public function loanTypeSeeder()
    {
        $loanerTypeExists = LoanType::where('id','4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->first();
        if ($loanerTypeExists === null){
            DB::table('loan_types')->insert([
                'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                'name' => 'Loaner',
                'label' => 'label-warning',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $loneeTypeExists = LoanType::where('id','07c99d10-8e09-4861-83df-fdd3700d7e48')->first();
        if ($loneeTypeExists === null) {
            DB::table('loan_types')->insert([
                'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
                'name' => 'Lonee',
                'label' => 'label-danger',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }


        Loan::where('loan_type_id',null)
        ->update(['loan_type_id' => '07c99d10-8e09-4861-83df-fdd3700d7e48']);

        // get all current liabilities
        $liabilities = Liability::all();
        foreach ($liabilities as $liability){
            $loanExists = Loan::where('id',$liability->id)->first();
            if ($loanExists === null){
                DB::table('loans')->insert([
                    'id' => $liability->id,
                    'reference' => $liability->reference,
                    'about' => $liability->about,
                    'total' => $liability->total,
                    'principal' => $liability->principal,
                    'interest' => $liability->interest,
                    'interest_amount' => $liability->interest_amount,
                    'paid' => $liability->paid,
                    'date' => $liability->date,
                    'due_date' => $liability->due_date,
                    'is_user' => $liability->is_user,
                    'user_id' => $liability->user_id,
                    'is_institution' => $liability->is_institution,
                    'institution_id' => $liability->institution_id,
                    'loan_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                    'is_chama' => $liability->is_chama,
                    'chama_id' => $liability->chama_id,
                    'status_id' => $liability->status_id,
                    'contact_id' => $liability->contact_id,
                    'account_id' => $liability->account_id,
                    'member_id' => $liability->member_id,
                    'created_at' => $liability->created_at
                ]);
            }
        }
        return "done";
    }

    public function modules()
    {
        // module
        // exists
        $moduleExists = Module::where('id','47b313f1-2324-4231-a25e-dd31c057daef')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '47b313f1-2324-4231-a25e-dd31c057daef',
                'name' => 'POS',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }

        // exists
        $moduleExists = Module::where('id','99f59a14-1e3b-4b54-a33d-29cbb5431182')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182',
                'name' => 'To Do',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','eaa241d4-0834-4ec3-80b1-e8e416cc324b')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b',
                'name' => 'Settings',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','2e22600b-f8fb-493a-8de8-ba33d279e882')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '2e22600b-f8fb-493a-8de8-ba33d279e882',
                'name' => 'Budgeting',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','33c5f6c2-fe9a-4b32-843b-d243d8dae58a')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '33c5f6c2-fe9a-4b32-843b-d243d8dae58a',
                'name' => 'Chama',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','803a3317-6f4c-4ba7-aa2f-60ff01477be7')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7',
                'name' => 'Accounting',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'name' => 'CRM',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','1e19eb1c-e299-4e2e-a22b-fb97a4b066a5')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '1e19eb1c-e299-4e2e-a22b-fb97a4b066a5',
                'name' => 'Ecommerce',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','9acedca8-5320-4b4e-b088-ec44467344a0')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
                'name' => 'Sales',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','b018d16c-4ef2-44dc-9c5e-be8e7d896bf3')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3',
                'name' => 'Product Management',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $moduleExists = Module::where('id','2d89966e-c6f2-4967-b278-f65df98448db')->first();
        if ($moduleExists === null) {
            DB::table('modules')->insert([
                'id' => '2d89966e-c6f2-4967-b278-f65df98448db',
                'name' => 'Inventory Management',
                'price' => '',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'is_paid' => true,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
    }

    public function businessUserInvitation(Request $request, $user_id ,$institution_id)
    {
        $user = User::findOrFail(decrypt($user_id));
        $institution = Institution::findOrFail($institution_id);

        $userAccount = UserAccount::where('user_id',$user->id)->where('institution_id',$institution->id)->first();

        // update user password and phone number and verified_at
        return view('auth.business_add_user', compact('user','institution'));
//        return $userAccount;
    }

    public function businessStoreUserAccount(Request $request, $user_id ,$institution_id)
    {
        $user = User::findOrFail(decrypt($user_id));

        if ($user->phone_number != $request->phone_number){
            $validatedUserData = $request->validate([
                'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
            $user->phone_number = $request->phone_number;
        }
        $validatedUserData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // update user verified_at, set user password
        $user->email_verified_at = now();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        // set user account active
        $user = User::findOrFail(decrypt($user_id));
        $institution = Institution::findOrFail($institution_id);
        $userUserAccounts = UserAccount::where('user_id',$user->id)->update(['is_active' => false]);

        $userAccount = UserAccount::where('user_id',$user->id)->where('institution_id',$institution->id)->first();
        $userAccount->is_active = true;
        $userAccount->save();

        // log in user
        auth()->login($user);
        // update user password and phone number and verified_at
        return redirect('home');
//        return $userAccount;
    }

    public function testRoles(){
        // create role
        $institution = Institution::findOrFail('9e2c5296-0b01-4d06-ada7-6fd90e7bc843');
        $institutionModules = InstitutionModule::where('institution_id',$institution->id)->select('module_id')->get()->toArray();
        $permissions = Permission::whereIn('module_id',$institutionModules)->get();
        return $permissions;
    }

    public function roleSeed(){

//        $users = User::permission('add to dos')->get();
        $user = Auth::user();
//        $permissionNames = $user->getPermissionNames();
//        $user->assignRole('admin');
//        $permissions = $user->permissions;

        $role = Role::findByName('admin');
//        $role->revokePermissionTo('view to dos');
//        return $role;
        // get role


        // to dos
        $permission = Permission::create(['name' => 'add to do','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'view to do','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view to dos','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $role->givePermissionTo($permission);
        // calendar
        $permission = Permission::create(['name' => 'view calendar','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $role->givePermissionTo($permission);
        // product groups
        $permission = Permission::create(['name' => 'add product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view product groups','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        // products
        $permission = Permission::create(['name' => 'add product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view products','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        // composite products
        $permission = Permission::create(['name' => 'add composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view composite products','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $role->givePermissionTo($permission);
        // stock
        $permission = Permission::create(['name' => 'view stock','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view restock','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        // inventory adjustments
        $permission = Permission::create(['name' => 'add inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view inventory adjustments','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        // transfer orders
        $permission = Permission::create(['name' => 'add transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view transfer orders','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        // warehouses
        $permission = Permission::create(['name' => 'add warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view warehouses','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $role->givePermissionTo($permission);
        // campaign
        $permission = Permission::create(['name' => 'add campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view campaigns','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'add campaign uploads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view campaign uploads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        // contacts
        $permission = Permission::create(['name' => 'add contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view contacts','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        // leads
        $permission = Permission::create(['name' => 'add lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view leads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        // organizations
        $permission = Permission::create(['name' => 'add organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view organizations','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $role->givePermissionTo($permission);
        // estimates
        $permission = Permission::create(['name' => 'add estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view estimates','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'print estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'convert to invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        // invoices
        $permission = Permission::create(['name' => 'add invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view invoices','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'print invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'convert to sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        // sales
        $permission = Permission::create(['name' => 'add sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view sales','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'print sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'add sale payment','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $role->givePermissionTo($permission);
        // accounts
        $permission = Permission::create(['name' => 'add account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view accounts','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // account adjustments
        $permission = Permission::create(['name' => 'add account adjustment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view account adjustments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // withdrawals
        $permission = Permission::create(['name' => 'add withdrawal','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view withdrawal','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view withdrawals','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // deposits
        $permission = Permission::create(['name' => 'add deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view deposits','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // expenses
        $permission = Permission::create(['name' => 'add expenses','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view expenses','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // expense payments
        $permission = Permission::create(['name' => 'add expense payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view expense payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view expense payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // loans
        $permission = Permission::create(['name' => 'add loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view loans','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'add loan payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // payments
        $permission = Permission::create(['name' => 'add payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view pending payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // refunds
        $permission = Permission::create(['name' => 'add refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view refunds','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // transfers
        $permission = Permission::create(['name' => 'add transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view transfers','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $role->givePermissionTo($permission);
        // campaign types
        $permission = Permission::create(['name' => 'add campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view campaign types', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // contact types
        $permission = Permission::create(['name' => 'add contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view contact types', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // frequency
        $permission = Permission::create(['name' => 'add frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view frequencies', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // lead sources
        $permission = Permission::create(['name' => 'add lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view lead sources', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // taxes
        $permission = Permission::create(['name' => 'add tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view taxes', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // titles
        $permission = Permission::create(['name' => 'add title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view titles', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        // units
        $permission = Permission::create(['name' => 'add unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'view units','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'edit unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'delete unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $role->givePermissionTo($permission);

    }
}
