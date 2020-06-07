<?php

namespace App\Http\Controllers\Personal;

use DB;
use App\Loan;
use App\Sale;
use App\ToDo;
use App\Title;
use App\Status;
use App\Contact;
use App\Product;
use App\Account;
use App\Campaign;
use App\Liability;
use App\LeadSource;
use App\ContactType;
use App\Organization;
use App\Traits\UserTrait;
use App\ContactContactType;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Http\Controllers\Controller;
use App\Traits\ReferenceNumberTrait;

class CRMController extends Controller
{

    use UserTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }


    // contacts
    public function contacts()
    {
        // User
        $user = $this->getUser();
        // Get contacts
        $contacts = Contact::where('user_id',$user->id)->where('is_user',true)->where('is_lead', false)->with('status','contactType','title')->get();
        // Get deleted contacts
        $deletedContacts = Contact::where('user_id',$user->id)->where('is_user',true)->where('is_lead', false)->with('status','contactType','title')->onlyTrashed()->get();

        return view('personal.contacts',compact('contacts','user','deletedContacts'));
    }

    public function contactCreate()
    {
        // User
        $user = $this->getUser();
        // get contacts
        $contacts = Contact::where('user_id',$user->id)->where('is_user',true)->with('user','status','contactType')->get();
        // get titles
        $titles = Title::where('user_id',$user->id)->where('is_user',true)->get();
        // get contact types
        $contactTypes = ContactType::where('user_id',$user->id)->where('is_user',true)->get();
        return view('personal.contact_create',compact('contacts','user','titles','contactTypes'));
    }

    public function contactStore(Request $request)
    {

        // User
        $user = $this->getUser();

        $contact = new Contact();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone_number = $request->phone_number;
        $contact->phone_number = $request->phone_number;
        $contact->about = $request->about;
        $contact->title_id = $request->title;
        $contact->lead_source_id = $request->lead_source;
        $contact->organization_id = $request->organization;
        $contact->campaign_id = $request->campaign;

        if($request->organization){
            $contact->is_organization = true;
        }else{
            $contact->is_organization = false;
        }
        if($request->is_lead == "on"){
            $contact->is_lead = true;
        }else{
            $contact->is_lead = false;
        }

        $contact->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contact->user_id = $user->id;
        $contact->is_user = true;
        $contact->is_institution = false;
        $contact->is_chama = false;
        $contact->save();

        if($request->contact_types)
        {
            foreach ($request->contact_types as $contactContactTypes){
                $contactContactType = new ContactContactType();
                $contactContactType->contact_id = $contact->id;
                $contactContactType->contact_type_id = $contactContactTypes;
                $contactContactType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $contactContactType->user_id = $user->id;
                $contactContactType->save();
            }
        }

        // TODO figure out addresses
        // // Billing Address
        // $billingAddress = new Address();
        // $billingAddress->attention = $request->attention;
        // $billingAddress->street = $request->billing_street;
        // $billingAddress->town = $request->billing_town;
        // $billingAddress->po_box = $request->billing_po_box;
        // $billingAddress->postal_code = $request->billing_postal_code;
        // $billingAddress->address_line_1 = $request->billing_address_line_1;
        // $billingAddress->address_line_2 = $request->billing_address_line_2;
        // $billingAddress->email = $request->billing_email;
        // $billingAddress->phone_number = $request->billing_phone_number;
        // $billingAddress->user_id = $user->id;
        // $billingAddress->address_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
        // $billingAddress->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        // $billingAddress->save();


        // // Shipping address
        // $shippingAddress = new Address();
        // $shippingAddress->attention = $request->attention;
        // $shippingAddress->street = $request->shipping_street;
        // $shippingAddress->town = $request->shipping_town;
        // $shippingAddress->po_box = $request->shipping_po_box;
        // $shippingAddress->postal_code = $request->shipping_postal_code;
        // $shippingAddress->address_line_1 = $request->shipping_address_line_1;
        // $shippingAddress->address_line_2 = $request->shipping_address_line_2;
        // $shippingAddress->email = $request->shipping_email;
        // $shippingAddress->phone_number = $request->shipping_phone_number;
        // $shippingAddress->user_id = $user->id;
        // $shippingAddress->address_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
        // $shippingAddress->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        // $shippingAddress->save();


        return redirect()->route('personal.contact.show',$contact->id)->withSuccess(__('Contact '.$contact->name.' successfully created.'));
    }

    public function contactShow($contact_id)
    {
        // Check if project type exists
        $contactExists = Contact::findOrFail($contact_id);
        // User
        $user = $this->getUser();
        // contacts
        $contact = Contact::where('user_id',$user->id)->where('is_user',true)->with('user','status')->where('id',$contact_id)->first();
        // get titles
        $titles = Title::where('user_id',$user->id)->where('is_user',true)->get();

        // get contact types
        $contactTypes = ContactType::where('user_id',$user->id)->where('is_user',true)->get();

        // contact contact types
        $contactContactTypes = ContactContactType::with('user','status','contactType')->where('contact_id',$contact_id)->get();

        // ontact owed liability
        $liabilities = Liability::where('user_id',$user->id)->where('is_user',true)->with('user','status')->where('contact_id',$contact_id)->get();
        // contact loans
        $loans = Loan::where('user_id',$user->id)->where('is_user',true)->with('user','status')->where('contact_id',$contact_id)->get();
        // Pending to dos
        $pendingToDos = ToDo::where('user_id',$user->id)->where('is_user',true)->with('user','status','contact')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('contact_id',$contact->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('user_id',$user->id)->where('is_user',true)->with('user','status','contact')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('contact_id',$contact->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('user_id',$user->id)->where('is_user',true)->with('user','status','contact')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('contact_id',$contact->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('user_id',$user->id)->where('is_user',true)->with('user','status','contact')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('contact_id',$contact->id)->get();
        return view('personal.contact_show',compact('loans','overdueToDos','completedToDos','inProgressToDos','pendingToDos','liabilities','titles','contact','user','loans','contactTypes','contactContactTypes'));
    }

    public function contactLiabilityCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',true)->get();
        // get contact
        $contactLiability = Contact::where('user_id',$user->id)->where('is_user',true)->where('id',$contact_id)->with('organization')->first();
        // get contacts
        $contacts = Contact::where('user_id',$user->id)->where('is_user',true)->with('organization')->get();
        return view('personal.contact_liability_create',compact('contactLiability','user','accounts','contacts'));
    }

    public function contactLoanCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // get accounts
        $accounts = Account::where('user_id',$user->id)->where('is_user',true)->get();
        // get contacts
        $contact = Contact::where('user_id',$user->id)->where('is_user',true)->with('organization')->where('id',$contact_id)->first();
        return view('personal.contact_loan_create',compact('user','accounts','contact'));
    }

    public function contactSaleCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // products
        $products = Product::where('user_id',$user->id)->where('is_user',true)->with('sub_type','size','status')->get();
        // contacts
        $contact = Contact::where('user_id',$user->id)->where('is_user',true)->where('id',$contact_id)->with('organization')->first();

        return view('personal.contact_sale_create',compact('contact','products','user'));
    }

    public function contactUpdate(Request $request, $contact_id)
    {

        // User
        $user = $this->getUser();

        $contact = Contact::findOrFail($contact_id);
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone_number = $request->phone_number;
        $contact->phone_number = $request->phone_number;
        $contact->about = $request->about;
        $contact->title_id = $request->title;
        $contact->lead_source_id = $request->lead_source;
        $contact->organization_id = $request->organization;
        $contact->campaign_id = $request->campaign;
        $contact->save();

        // contact type contacts update
        $contactTypeRequestDate =array();
        foreach ($request->contact_types as $contactTypeContacts){
            // Append to array
            $contactTypeRequestDate[]['id'] = $contactTypeContacts;

            // Check if album tag exists
            $contactTypeContact = ContactContactType::where('contact_id',$contact->id)->where('contact_type_id',$contactTypeContacts)->first();

            if($contactTypeContact === null) {
                $contactTypeContact = new ContactContactType();
                $contactTypeContact->contact_id = $contact->id;
                $contactTypeContact->contact_type_id = $contactTypeContacts;
                $contactTypeContact->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $contactTypeContact->user_id = $user->id;
                $contactTypeContact->save();
            }
        }

        $contactContactTypeIds = ContactContactType::where('contact_id',$contact_id)->whereNotIn('contact_type_id',$contactTypeRequestDate)->select('id')->get()->toArray();
        DB::table('contact_contact_types')->whereIn('id', $contactContactTypeIds)->delete();


        return redirect()->route('personal.contact.show',$contact->id)->withSuccess('Contact updated!');
    }

    public function contactUpdateLeadToContact($contact_id)
    {

        // User
        $user = $this->getUser();

        $contact = Contact::findOrFail($contact_id);
        $contact->is_lead = true;
        $contact->save();
        return redirect()->route('personal.contact.show',$contact->id)->withSuccess('Contact updated!');
    }

    public function contactContactTypeStore(Request $request, $contact_id)
    {

        // User
        $user = $this->getUser();

        $contact = Contact::findOrFail($contact_id);
        $contactContactType = new ContactContactType();
        $contactContactType->contact_id;
        $contactContactType->contact_type_id = $request->contact_type;
        $contactContactType->save();
        return redirect()->route('personal.contact.show',$contact->id)->withSuccess('Contact updated!');

    }

    public function contactDelete($contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contact->delete();

        return back()->withSuccess(__('Contact '.$contact->name.' successfully deleted.'));
    }

    public function contactRestore($contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contact->restore();

        return back()->withSuccess(__('Contact '.$contact->name.' successfully restored.'));
    }


}
