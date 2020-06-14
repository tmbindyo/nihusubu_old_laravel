<?php

namespace App\Http\Controllers\Landing;

use App\Action;
use App\Liability;
use App\Loan;
use App\LoanType;
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

    public function sections()
    {
        // section
        // exists
        $sectionExists = Section::where('id','0c03b583-1d71-4d50-a626-10563cf4e454')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '0c03b583-1d71-4d50-a626-10563cf4e454',
                'name' => 'To Do',
                'icon' => 'fa fa-list',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $sectionExists = Section::where('id','17c0880e-b299-414d-908d-13154a10ac96')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '17c0880e-b299-414d-908d-13154a10ac96',
                'name' => 'Calender',
                'icon' => 'fa fa-calendar',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $sectionExists = Section::where('id','d1644afa-b1a5-4a2d-b95d-e4d43acbce25')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => 'd1644afa-b1a5-4a2d-b95d-e4d43acbce25',
                'name' => 'Products',
                'icon' => 'fa fa-tags',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $sectionExists = Section::where('id','0f7784cb-3b01-4aa7-a304-e0f1d330f9aa')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '2d89966e-c6f2-4967-b278-f65df98448db',
                'name' => 'Inventory',
                'icon' => 'fa fa-database',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','fb5f0204-459b-4366-bf78-11f057db0db2')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'name' => 'CRM',
                'icon' => 'fa fa-user',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','040d3a7c-c0d5-4f92-b92d-5c1f751fae13')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
                'name' => 'Sales',
                'icon' => 'fa fa-shopping-cart',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','b97a8640-154e-4c09-95c7-0a9c6c690b82')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'name' => 'Accounting',
                'icon' => 'fa fa-dollar',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','cce99489-053b-45c7-b4df-1589ea2e3318')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'name' => 'Settings',
                'icon' => 'fa fa-sliders',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','1dd5ed21-4232-409d-928c-2b637aef5ff9')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '1dd5ed21-4232-409d-928c-2b637aef5ff9',
                'name' => 'Feedback',
                'icon' => 'fa fa-mail-reply-all',
                'is_business' => true,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','49825984-bec8-4495-863f-ddd11ebb46f3')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '49825984-bec8-4495-863f-ddd11ebb46f3',
                'name' => 'Budgeting',
                'icon' => 'fa fa-money',
                'is_business' => false,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => '2e22600b-f8fb-493a-8de8-ba33d279e882',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        $sectionExists = Section::where('id','17cbc918-2b55-494b-a39b-a1297bac8317')->first();
        if ($sectionExists === null) {
            DB::table('sections')->insert([
                'id' => '17cbc918-2b55-494b-a39b-a1297bac8317',
                'name' => 'Chamas',
                'icon' => 'fa fa-users',
                'is_business' => false,
                'is_user' => true,
                'is_admin' => false,
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'module_id' => '33c5f6c2-fe9a-4b32-843b-d243d8dae58a',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
    }

    public function menu()
    {
        // menu
        // to dos section
        // exists
        $menuExists = Menu::where('id','46007dd0-9d9e-4a28-b1b8-f16b8cffb2a9')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '46007dd0-9d9e-4a28-b1b8-f16b8cffb2a9',
                'name' => 'To Dos',
                'url' => 'href="{{route(\'business.to.dos\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '0c03b583-1d71-4d50-a626-10563cf4e454',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // calendar section
        // exists
        $menuExists = Menu::where('id','5d17a52d-29d4-4960-b7da-52ff7c218b23')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '5d17a52d-29d4-4960-b7da-52ff7c218b23',
                'name' => 'Calendar',
                'url' => 'href="{{route(\'business.calendar\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '17c0880e-b299-414d-908d-13154a10ac96',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // product section
        // exists
        $menuExists = Menu::where('id','d92d1ca5-ba59-4194-af81-5d3ae1a188a3')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'd92d1ca5-ba59-4194-af81-5d3ae1a188a3',
                'name' => 'Product Groups',
                'url' => 'href="{{route(\'business.product.groups\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'd1644afa-b1a5-4a2d-b95d-e4d43acbce25',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','e6a5c5ae-3f13-4b47-93ff-7bee8d362b84')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'e6a5c5ae-3f13-4b47-93ff-7bee8d362b84',
                'name' => 'Products',
                'url' => 'href="{{route(\'business.products\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'd1644afa-b1a5-4a2d-b95d-e4d43acbce25',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','1f7915e0-7368-4b9e-bc34-59d903fb09c7')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '1f7915e0-7368-4b9e-bc34-59d903fb09c7',
                'name' => 'Composite Products',
                'url' => 'href="{{route(\'business.composite.products\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'd1644afa-b1a5-4a2d-b95d-e4d43acbce25',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // inventory
        // exists
        $menuExists = Menu::where('id','3b589c0f-42cb-460c-a24d-d3d3502dbd6d')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '3b589c0f-42cb-460c-a24d-d3d3502dbd6d',
                'name' => 'Inventory Adjustments',
                'url' => 'href="{{route(\'business.inventory.adjustments\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '2d89966e-c6f2-4967-b278-f65df98448db',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','db96c213-9d0f-4756-a33d-726ee45a293b')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'db96c213-9d0f-4756-a33d-726ee45a293b',
                'name' => 'Transfer Orders',
                'url' => 'href="{{route(\'business.transfer.orders\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '2d89966e-c6f2-4967-b278-f65df98448db',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','14ee29f5-6c2d-45b7-a5d4-bdcc990fb5ac')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '14ee29f5-6c2d-45b7-a5d4-bdcc990fb5ac',
                'name' => 'Warehouses',
                'url' => 'href="{{route(\'business.warehouses\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '2d89966e-c6f2-4967-b278-f65df98448db',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // CRM
        // exists
        $menuExists = Menu::where('id','8fc03481-e791-4183-860b-24433e392459')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '8fc03481-e791-4183-860b-24433e392459',
                'name' => 'Campaign',
                'url' => 'href="{{route(\'business.campaigns\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','499ba7cd-1868-4ade-8b7c-67e227f4f7ef')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '499ba7cd-1868-4ade-8b7c-67e227f4f7ef',
                'name' => 'Contacts',
                'url' => 'href="{{route(\'business.contacts\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','5084aa36-235d-4960-9f72-a5700c02d172')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '5084aa36-235d-4960-9f72-a5700c02d172',
                'name' => 'Leads',
                'url' => 'href="{{route(\'business.leads\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','5408aa80-032b-4a35-8748-f1e432684050')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '5408aa80-032b-4a35-8748-f1e432684050',
                'name' => 'Organizations',
                'url' => 'href="{{route(\'business.organizations\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // Sales
        // exists
        $menuExists = Menu::where('id','b7f9e260-0734-4787-b81a-2e74e980c81f')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'b7f9e260-0734-4787-b81a-2e74e980c81f',
                'name' => 'Estimates',
                'url' => 'href="{{route(\'business.estimates\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','bd02b1ae-baec-4d33-9364-bdbae4d43fd7')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'bd02b1ae-baec-4d33-9364-bdbae4d43fd7',
                'name' => 'Invoices',
                'url' => 'href="{{route(\'business.invoices\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','5658b249-e3d5-4408-92a4-2d44b43d3ec7')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '5658b249-e3d5-4408-92a4-2d44b43d3ec7',
                'name' => 'Sales',
                'url' => 'href="{{route(\'business.sales\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // Accounts
        // exists
        $menuExists = Menu::where('id','91d92dca-936a-405e-a044-026008abd49b')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '91d92dca-936a-405e-a044-026008abd49b',
                'name' => 'Accounts',
                'url' => 'href="{{route(\'business.accounts\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','51243714-7def-4a6b-86e8-48ed8d2e76d1')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '51243714-7def-4a6b-86e8-48ed8d2e76d1',
                'name' => 'Expenses',
                'url' => 'href="{{route(\'business.expenses\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','b318e4ab-5b29-47e7-bc9a-f191d95d5228')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'b318e4ab-5b29-47e7-bc9a-f191d95d5228',
                'name' => 'Loans',
                'url' => 'href="{{route(\'business.loans\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','7010f5a3-2824-4562-b251-2d76d0472158')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '7010f5a3-2824-4562-b251-2d76d0472158',
                'name' => 'Payments',
                'url' => 'href="{{route(\'business.payments\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','ce1a2420-8bd9-4ece-b393-0d44a4841095')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'ce1a2420-8bd9-4ece-b393-0d44a4841095',
                'name' => 'Refunds',
                'url' => 'href="{{route(\'business.refunds\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','79815c4b-ca3b-48a3-bfab-3d66c900eb5b')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '79815c4b-ca3b-48a3-bfab-3d66c900eb5b',
                'name' => 'Transactions',
                'url' => 'href="{{route(\'business.transactions\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','d554e5b6-b773-4c18-a812-5da372611d4a')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'd554e5b6-b773-4c18-a812-5da372611d4a',
                'name' => 'Transfers',
                'url' => 'href="{{route(\'business.transfers\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // Settings
        // exists
        $menuExists = Menu::where('id','3a2d80c5-20bd-4563-b81d-7ea061760484')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '3a2d80c5-20bd-4563-b81d-7ea061760484',
                'name' => 'Campaign Types',
                'url' => 'href="{{route(\'business.campaign.types\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','dc6effc8-a76c-4adb-8134-a65eb5edbc14')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'dc6effc8-a76c-4adb-8134-a65eb5edbc14',
                'name' => 'Contact Types',
                'url' => 'href="{{route(\'business.contact.types\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','63baac28-86ac-430a-a617-209e88dc2a0a')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '63baac28-86ac-430a-a617-209e88dc2a0a',
                'name' => 'Frequency',
                'url' => 'href="{{route(\'business.frequencies\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','c6fe7dbe-8a09-4b82-a98a-902e5137bd08')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'c6fe7dbe-8a09-4b82-a98a-902e5137bd08',
                'name' => 'Lead Sources',
                'url' => 'href="{{route(\'business.lead.sources\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','045ccdc1-9ced-4730-ab0c-bdb80c3e16ea')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '045ccdc1-9ced-4730-ab0c-bdb80c3e16ea',
                'name' => 'Taxes',
                'url' => 'href="{{route(\'business.taxes\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','ae813d64-0b83-421d-a352-5e39a8e50dbd')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => 'ae813d64-0b83-421d-a352-5e39a8e50dbd',
                'name' => 'Titles',
                'url' => 'href="{{route(\'business.titles\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $menuExists = Menu::where('id','4813c63d-ff0f-4286-8277-f25cc7d201e9')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '4813c63d-ff0f-4286-8277-f25cc7d201e9',
                'name' => 'Units',
                'url' => 'href="{{route(\'business.units\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // feedback
        // exists
        $menuExists = Menu::where('id','56af542b-a478-41a6-b59b-f2b85efa135f')->first();
        if ($menuExists === null) {
            DB::table('menus')->insert([
                'id' => '56af542b-a478-41a6-b59b-f2b85efa135f',
                'name' => 'Feedback',
                'url' => 'href="{{route(\'href="{{route(\'business.feedback\',$institution->portal)}}" ',
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'section_id' => '1dd5ed21-4232-409d-928c-2b637aef5ff9',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }



        // get users
        // user account


        // feature
    }

    public function actions()
    {

        // actions
        // To Do
        // Calendar
        // Products
        // Inventory
        // CRM


        // actions
        // To Do
        // exists
        $actionExists = Action::where('id','4717c092-9aa5-4353-a343-efaaf57109b3')->first();
        if ($actionExists === null) {
            DB::table('action')->insert([
                'id' => '4717c092-9aa5-4353-a343-efaaf57109b3',
                'name' => 'New',
                'description' => 'Add a new To Do',
                'value' => 'href="#" data-toggle="modal" data-target="#toDoRegistration" aria-expanded="false" ',
                'icon' => 'fa fa-plus',
                'is_url' => false,
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'parent_id' => null,
                'menu_id' => '46007dd0-9d9e-4a28-b1b8-f16b8cffb2a9',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // Product
        // exists
        $actionExists = Action::where('id','4717c092-9aa5-4353-a343-efaaf57109b3')->first();
        if ($actionExists === null) {
            DB::table('action')->insert([
                'id' => '4717c092-9aa5-4353-a343-efaaf57109b3',
                'name' => 'New',
                'description' => 'Add a new Product Group',
                'value' => 'href="{{route(\'business.product.group.create\',$institution->portal)}}"',
                'icon' => 'fa fa-plus',
                'is_url' => false,
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'parent_id' => null,
                'menu_id' => 'd92d1ca5-ba59-4194-af81-5d3ae1a188a3',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $actionExists = Action::where('id','4717c092-9aa5-4353-a343-efaaf57109b3')->first();
        if ($actionExists === null) {
            DB::table('action')->insert([
                'id' => '4717c092-9aa5-4353-a343-efaaf57109b3',
                'name' => 'New',
                'description' => 'Add a new Product Group',
                'value' => 'href="{{route(\'business.product.group.create\',$institution->portal)}}"',
                'icon' => 'fa fa-plus',
                'is_url' => false,
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'parent_id' => null,
                'menu_id' => 'd92d1ca5-ba59-4194-af81-5d3ae1a188a3',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
        // exists
        $actionExists = Action::where('id','4717c092-9aa5-4353-a343-efaaf57109b3')->first();
        if ($actionExists === null) {
            DB::table('action')->insert([
                'id' => '4717c092-9aa5-4353-a343-efaaf57109b3',
                'name' => 'View',
                'description' => 'View a Product Group',
                'value' => 'href="{{ route(\'business.product.group.show\', [\'portal\'=>$institution->portal, \'id\'=>$productGroup->id]) }}"',
                'icon' => 'fa fa-plus',
                'is_url' => true,
                'is_business' => true,
                'is_user' => false,
                'is_admin' => false,
                'parent_id' => null,
                'menu_id' => 'd92d1ca5-ba59-4194-af81-5d3ae1a188a3',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'created_at' => now()
            ]);
        }
    }
}
