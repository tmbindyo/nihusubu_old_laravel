<?php

namespace App\Http\Controllers\Landing;

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
        return "done";
    }

    public function roles()
    {
        // section
        // exists
        DB::table('sections')->insert([
            'id' => '0c03b583-1d71-4d50-a626-10563cf4e454',
            'name' => 'To Do',
            'icon' => 'fa fa-list',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        // exists
        DB::table('sections')->insert([
            'id' => '17c0880e-b299-414d-908d-13154a10ac96',
            'name' => 'Calender',
            'icon' => 'fa fa-calendar',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        // exists
        DB::table('sections')->insert([
            'id' => 'd1644afa-b1a5-4a2d-b95d-e4d43acbce25',
            'name' => 'Products',
            'icon' => 'fa fa-tags',
            'is_business' => true,
            'is_user' => false,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        // exists
        DB::table('sections')->insert([
            'id' => '0f7784cb-3b01-4aa7-a304-e0f1d330f9aa',
            'name' => 'Inventory',
            'icon' => 'fa fa-database',
            'is_business' => true,
            'is_user' => false,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => 'fb5f0204-459b-4366-bf78-11f057db0db2',
            'name' => 'CRM',
            'icon' => 'fa fa-user',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => '040d3a7c-c0d5-4f92-b92d-5c1f751fae13',
            'name' => 'Sales',
            'icon' => 'fa fa-shopping-cart',
            'is_business' => true,
            'is_user' => false,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => 'b97a8640-154e-4c09-95c7-0a9c6c690b82',
            'name' => 'Accounting',
            'icon' => 'fa fa-dollar',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => 'cce99489-053b-45c7-b4df-1589ea2e3318',
            'name' => 'Settings',
            'icon' => 'fa fa-sliders',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => '773f6cbb-7641-40bc-9158-3132fc4bd122',
            'name' => 'Feedback',
            'icon' => 'fa fa-mail-reply-all',
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => '773f6cbb-7641-40bc-9158-3132fc4bd122',
            'name' => 'Budgeting',
            'icon' => 'fa fa-money',
            'is_business' => false,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('sections')->insert([
            'id' => '773f6cbb-7641-40bc-9158-3132fc4bd122',
            'name' => 'Chamas',
            'icon' => 'fa fa-users',
            'is_business' => false,
            'is_user' => true,
            'is_admin' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        // menu
        DB::table('menus')->insert([
            'id' => '773f6cbb-7641-40bc-9158-3132fc4bd122',
            'name' => 'Chamas',
            'url' => 'fa fa-users',
            'is_business' => false,
            'is_user' => true,
            'is_admin' => false,
            'section_id' => '0c03b583-1d71-4d50-a626-10563cf4e454',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        // feature
    }
}
