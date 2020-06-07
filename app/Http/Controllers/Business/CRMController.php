<?php

namespace App\Http\Controllers\Business;

use DB;
use App\Tax;
use App\Loan;
use App\Sale;
use App\ToDo;
use App\Title;
use App\Status;
use App\Upload;
use App\Contact;
use App\Product;
use App\Account;
use App\Campaign;
use App\Liability;
use App\Frequency;
use App\Inventory;
use App\UploadType;
use App\LeadSource;
use App\ContactType;
use App\CampaignType;
use App\Organization;
use App\ExpenseAccount;
use App\Traits\UserTrait;
use App\ContactContactType;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Http\Controllers\Controller;
use App\Traits\DocumentExtensionTrait;
use App\Transfer;
use Illuminate\Support\Facades\Storage;

class CRMController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;
    use DocumentExtensionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // leads
    public function leads($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // Get contacts
        $leads = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->where('is_lead', true)->with('status', 'contactType', 'title')->get();
        // Get contacts
        $deletedLeads = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->where('is_lead', true)->with('status', 'contactType', 'title')->get();

        return view('business.leads',compact('leads', 'user', 'contactTypes', 'institution', 'deletedLeads'));
    }

    public function leadCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::with('user', 'status', 'contactType')->where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // get organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('institution_id',$institution->id)->get();
        return view('business.lead_create',compact('contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns'));
    }

    // campaigns
    public function campaigns($portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user', 'status', 'campaignType')->where('institution_id',$institution->id)->get();
        // get deleted campaigns
        $deletedCampaigns = Campaign::with('user', 'status', 'campaignType')->where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id',$institution->id)->get();
        return view('business.campaigns',compact('campaigns', 'user', 'institution', 'deletedCampaigns'));

    }

    public function campaignCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // campaign types
        $campaignTypes = CampaignType::where('institution_id',$institution->id)->get();
        return view('business.campaign_create',compact('user', 'institution', 'campaignTypes'));

    }

    public function campaignStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->start_date = date('Y-m-d', strtotime($request->start_date));
        $campaign->end_date = date('Y-m-d', strtotime($request->end_date));
        $campaign->campaign_type_id = $request->type;
        $campaign->expected_revenue = $request->expected_revenue;
        $campaign->actual_cost = 0;
        $campaign->budgeted_cost = $request->budgeted_cost;
        $campaign->description = $request->description;
        $campaign->expected_response = $request->expected_response;
        $campaign->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaign->user_id = $user->id;
        $campaign->institution_id = $institution->id;
        $campaign->save();
        return redirect()->route('business.campaign.show',['portal'=>$institution->portal, 'id'=>$campaign->id])->withSuccess('Campaign created!');

    }

    public function campaignShow($portal, $campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get campaign types
        $campaignTypes = CampaignType::where('institution_id',$institution->id)->get();
        // Get campaigns
        $campaign = Campaign::where('institution_id',$institution->id)->with('user', 'status', 'campaignType', 'campaignUploads', 'contacts', 'expenses', 'organizations', 'toDos')->withCount('campaignUploads', 'contacts', 'expenses', 'organizations', 'toDos')->where('id',$campaign_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'campaign')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('campaign_id',$campaign->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'campaign')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('campaign_id',$campaign->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'campaign')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('campaign_id',$campaign->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'campaign')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('campaign_id',$campaign->id)->get();

        return view('business.campaign_show',compact('campaign', 'user', 'institution', 'campaignTypes', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos'));
    }

    public function campaignContactCreate($portal, $campaign_id)
    {
        // get Campaign
        $contactCampaign = Campaign::findOrFail($campaign_id);
        if($contactCampaign->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$contactCampaign->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contactType')->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        return view('business.contact_create',compact('contactCampaign', 'contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns'));
    }

    public function campaignExpenseCreate($portal, $campaign_id)
    {
        // get Campaign
        $campaignExists = Campaign::findOrFail($campaign_id);
        if($campaignExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$campaignExists->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get orders
        $sales = Sale::where('institution_id',$institution->id)->with('status')->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id', '7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get campaign
        $campaign = Campaign::where('institution_id',$institution->id)->where('id',$campaign_id)->first();
        // get campaign
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        // get frequencies
        $frequencies = Frequency::where("status_id","c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id',$institution->id)->where('is_institution', true)->get();
        // accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get sales
        $sales = Sale::where('institution_id',$institution->id)->with('status')->get();
        // get liabilities
        $liabilities = Liability::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get transfers
        $transfers = Transfer::where('institution_id',$institution->id)->where('is_institution', true)->get();

        return view('business.expense_create',compact('campaignExists', 'campaign', 'user', 'institution', 'frequencies', 'expenseAccounts', 'expenseStatuses', 'accounts', 'sales', 'liabilities', 'transfers', 'campaigns'));
    }

    public function campaignOrganizationCreate($portal, $campaign_id)
    {
        // get Campaign
        $campaignExists = Campaign::findOrFail($campaign_id);
        if($campaignExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$campaignExists->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get campaign
        $campaign = Campaign::where('institution_id',$institution->id)->where('id',$campaign_id)->first();
        // campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        return view('business.organization_create',compact('campaigns', 'campaignExists', 'campaign', 'user', 'institution', 'organizations'));

    }

    public function campaignUploads($portal, $campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get campaign types
        $campaignTypes = CampaignType::where('institution_id',$institution->id)->get();
        // Get campaigns
        $campaign = Campaign::where('institution_id',$institution->id)->with('user', 'status', 'campaignType', 'campaignUploads', 'contacts', 'expenses', 'organizations', 'toDos')->withCount('campaignUploads', 'contacts', 'expenses', 'organizations', 'toDos')->where('id',$campaign_id)->first();
        // Campaign uploads
        $campaignUploads = Upload::with('user', 'status')->where('id',$campaign_id)->get();

        return view('business.campaign_uploads',compact('campaign', 'user', 'institution', 'campaignTypes', 'campaignUploads'));
    }

    public function campaignUpload($portal, $campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get campaign types
        $campaignTypes = CampaignType::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // Get campaigns
        $campaign = Campaign::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'campaignType', 'campaign_upload', 'contacts', 'expenses', 'organizations', 'toDos')->withCount('campaign_upload', 'contacts', 'expenses', 'organizations', 'toDos')->where('id',$campaign_id)->first();
        // Campaign uploads
        $campaignUploads = Upload::with('user', 'status')->where('id',$campaign_id)->first();
        // upload types
        $uploadTypes = UploadType::get();

        return view('business.campaign_uploads',compact('campaign', 'user', 'institution', 'campaignTypes', 'uploadTypes'));
    }

    public function campaignUploadStore(Request $request,$portal,$campaign_id)
    {
        // get Campaign
        $contactUpload = Campaign::findOrFail($campaign_id);
        if($contactUpload->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$contactUpload->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $campaign = Campaign::where('institution_id',$institution->id)->where('id',$campaign_id)->first();
        $originalFolderName = str_replace(' ', '', $portal.'/campaigns/'.$campaign->name."/");

        return $originalFolderName;

        $file = $request->file('file');
        $file_name_extension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        Storage::disk('local')->putFileAs(
            $originalFolderName,
            $file,
            $file_name_extension
        );

        $path = public_path().$originalFolderName.$file_name_extension;

        return $path;

        $size = $request->file('file')->getSize();
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $image_name = $file_name.'.'.$extension;

        $upload = new Upload();
        // Get the extension type
        $extensionType = $this->uploadExtension($extension);
        $upload->file_type = $extensionType;

        $upload->name = $file_name;
        $upload->extension = $extension;
        $upload->size = $size;

        $upload->original = $originalFolderName.$image_name;

        $upload->campaign_id = $campaign_id;
        $upload->upload_type_id = "11bde94f-e686-488e-9051-bc52f37df8cf";
        $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $upload->user_id = $user->id;
        $upload->save();

        return back()->withSuccess(__('Campaign file successfully uploaded.'));
    }

    public function campaignUploadDownload($portal, $upload_id)
    {
        $uploadExists = Upload::findOrFail($upload_id);
        $upload = Upload::where('id',$upload_id)->first();

        // return $upload->original;
        $file_path = public_path($upload->original);
        // return asset('storage/'.$upload->original);

        return response()->download($file_path);
    }

    public function campaignUpdate(Request $request,$portal, $campaign_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $campaign = Campaign::findOrFail($campaign_id);
        $campaign->name = $request->name;
        $campaign->start_date = date('Y-m-d', strtotime($request->start_date));
        $campaign->end_date = date('Y-m-d', strtotime($request->end_date));
        $campaign->campaign_type_id = $request->type;
        $campaign->expected_revenue = $request->expected_revenue;
        $campaign->budgeted_cost = $request->budgeted_cost;
        $campaign->description = $request->description;
        $campaign->user_id = $user->id;
        $campaign->save();
        return redirect()->route('business.campaign.show',['portal'=>$institution->portal, 'id'=>$campaign->id])->withSuccess('Campaign updated!');

    }

    public function campaignDelete($portal, $campaign_id)
    {

        $campaign = Campaign::findOrFail($campaign_id);
        $campaign->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $campaign->save();

        return back()->withWarning(__('Campaign '.$campaign->name.' successfully deleted.'));
    }

    public function campaignRestore($portal, $campaign_id)
    {

        $campaign = Campaign::findOrFail($campaign_id);
        $campaign->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaign->save();

        return back()->withSuccess(__('Campaign '.$campaign->name.' successfully restored.'));
    }


    // contacts
    public function contacts($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // Get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->where('is_lead', false)->with('status', 'contactType', 'title')->get();
        // Get deleted contacts
        $deletedContacts = Contact::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id',$institution->id)->where('is_institution', true)->where('is_lead', false)->with('status', 'contactType', 'title')->get();

        return view('business.contacts',compact('contacts', 'user', 'contactTypes', 'institution', 'deletedContacts'));
    }

    public function contactCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user', 'status', 'contactType')->where('is_institution', true)->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // get organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        return view('business.contact_create',compact('contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns'));
    }

    public function contactStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

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
        $contact->is_institution = true;
        $contact->is_user = false;
        $contact->is_chama = false;
        $contact->institution_id = $institution->id;
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


        return redirect()->route('business.contact.show',['portal'=>$institution->portal, 'id'=>$contact->id])->withSuccess(__('Contact '.$contact->name.' successfully created.'));
    }

    public function contactShow($portal, $contact_id)
    {
        // Check if project type exists
        $contactExists = Contact::findOrFail($contact_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // contacts
        $contact = Contact::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status')->where('id',$contact_id)->first();
        // contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // get organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        // contact sales
        $sales = Sale::where('institution_id',$institution->id)->with('status', 'saleProducts', 'contact.organization')->withCount('saleProducts')->where('contact_id',$contact_id)->get();
        // ontact owed liability
        $liabilities = Liability::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'account')->where('contact_id',$contact_id)->get();
        // contact loans
        $loans = Loan::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status')->where('contact_id',$contact_id)->get();
        // contact contact types
        $contactContactTypes = ContactContactType::with('user', 'status', 'contactType')->where('contact_id',$contact_id)->get();
        // Pending to dos
        $pendingToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contact')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('contact_id',$contact->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contact')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('contact_id',$contact->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contact')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('contact_id',$contact->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contact')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('contact_id',$contact->id)->get();
        return view('business.contact_show',compact('loans', 'overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'contactContactTypes', 'liabilities', 'sales', 'campaigns', 'leadSources', 'titles', 'organizations', 'contact', 'user', 'contactTypes', 'institution', 'loans'));
    }

    public function contactLiabilityCreate($portal, $contact_id)
    {
        $contactExists = Contact::findOrFail($contact_id);
        if($contactExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Contact '.$contactExists->first_name.' '.$contactExists->last_name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->with('organization')->get();
        return view('business.liability_create',compact('contactExists', 'user', 'institution', 'accounts', 'contacts'));
    }

    public function contactLoanCreate($portal, $contact_id)
    {
        $contactExists = Contact::findOrFail($contact_id);
        if($contactExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Contact '.$contactExists->first_name.' '.$contactExists->last_name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get accounts
        $accounts = Account::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('organization')->where('is_institution', true)->where('institution_id',$institution->id)->get();
        return view('business.loan_create',compact('contactExists', 'user', 'institution', 'accounts', 'contacts'));
    }

    public function contactSaleCreate($portal, $contact_id)
    {
        $contactExists = Contact::findOrFail($contact_id);
        if($contactExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Contact '.$contactExists->first_name.' '.$contactExists->last_name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get contacts
        $contacts = Contact::where('institution_id',$institution->id)->where('is_lead', false)->with('organization', 'title')->get();
        // Getting taxes
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        // contacts
        $contact = Contact::where('id',$contact_id)->where('is_institution', true)->with('organization')->first();
        // Getting Products
        $products = Product::where('institution_id',$institution->id)->with('inventory.warehouse')->get();

        $productIds = Product::where('institution_id',$institution->id)->select('id')->get()->toArray();
        $inventories = Inventory::with('product', 'warehouse')->get();

        return view('business.sale_create',compact('contactExists', 'contact', 'user', 'institution', 'products', 'inventories', 'contacts', 'taxes'));
    }

    public function contactUpdate(Request $request, $portal, $contact_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

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
        if($request->is_lead == "on"){
            $contact->is_lead = true;
        }else{
            $contact->is_lead = false;
        }
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


        return redirect()->route('business.contact.show',['portal'=>$institution->portal, 'id'=>$contact->id])->withSuccess('Contact updated!');
    }

    public function contactUpdateLeadToContact($portal, $contact_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $contact = Contact::findOrFail($contact_id);
        $contact->is_lead = false;
        $contact->save();
        return redirect()->route('business.contact.show',['portal'=>$institution->portal, 'id'=>$contact->id])->withSuccess('Contact updated!');
    }

    public function contactContactTypeStore(Request $request, $portal, $contact_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $contact = Contact::findOrFail($contact_id);
        $contactContactType = new ContactContactType();
        $contactContactType->contact_id;
        $contactContactType->contact_type_id = $request->contact_type;
        $contactContactType->save();
        return redirect()->route('business.contact.show',['portal'=>$institution->portal, 'id'=>$contact->id])->withSuccess('Contact updated!');

    }

    public function contactDelete($portal, $contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contact->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $contact->save();

        return back()->withSuccess(__('Contact '.$contact->name.' successfully deleted.'));
    }

    public function contactRestore($portal, $contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contact->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contact->restore();

        return back()->withSuccess(__('Contact '.$contact->name.' successfully restored.'));
    }

    // organizations
    public function organizations($portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get organizations
        $organizations = Organization::where('status_id',"c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id',$institution->id)->with('user', 'status')->withCount('contacts')->get();
        // get deleted organizations
        $deletedOrganizations = Organization::where('status_id',"d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->where('institution_id',$institution->id)->with('user', 'status')->withCount('contacts')->get();
        return view('business.organizations',compact('organizations', 'user', 'institution', 'deletedOrganizations'));

    }


    public function organizationCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        return view('business.organization_create',compact('user', 'institution', 'organizations', 'campaigns'));

    }

    public function organizationStore(Request $request, $portal)
    {
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $organization = new Organization();
        $organization->name = $request->name;
        $organization->reference = $reference;
        $organization->phone_number = $request->phone_number;
        $organization->website = $request->website;
        $organization->email = $request->email;
        $organization->parent_organization_id = $request->parent_organization;
        $organization->campaign_id = $request->campaign;
        $organization->street = $request->street;
        $organization->city = $request->city;
        $organization->description = $request->description;
        $organization->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $organization->user_id = $user->id;
        $organization->institution_id = $institution->id;
        $organization->is_institution = true;
        $organization->is_chama = false;
        $organization->save();
        return redirect()->route('business.organization.show',['portal'=>$institution->portal, 'id'=>$organization->id])->withSuccess('Organization created!');

    }

    public function organizationShow($portal, $organization_id)
    {
        // Check if contact type exists
        $organizationExists = Organization::findOrFail($organization_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get organization
        $organization = Organization::where('institution_id',$institution->id)->with('user', 'status', 'contacts')->withCount('contacts')->where('id',$organization_id)->first();
        $organizations = Organization::where('institution_id',$institution->id)->with('user', 'status', 'contacts')->withCount('contacts')->get();
        // Pending to dos
        $pendingToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'organization')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('organization_id',$organization->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'organization')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('organization_id',$organization->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'organization')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('organization_id',$organization->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'organization')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('organization_id',$organization->id)->get();

        return view('business.organization_show',compact('organization', 'organizations', 'user', 'institution', 'pendingToDos', 'inProgressToDos', 'completedToDos', 'overdueToDos'));
    }

    public function organizationContactCreate($portal, $organization_id)
    {
        $contactOrganization = Organization::findOrFail($organization_id);
        if($contactOrganization->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Deposit '.$contactOrganization->name.' is deleted.'));
        }

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->where('is_institution', true)->with('user', 'status', 'contactType')->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get organization
        $organization = Organization::findOrFail($organization_id);
        // get titles
        $titles = Title::where('institution_id',$institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->get();
        // organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        return view('business.contact_create',compact('contactOrganization', 'contacts', 'user', 'contactTypes', 'institution', 'organization', 'titles', 'leadSources', 'campaigns', 'organizations'));
    }

    public function organizationUpdate(Request $request, $portal, $organization_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $organization = Organization::findOrFail($organization_id);
        $organization->name = $request->name;
        $organization->phone_number = $request->phone_number;
        $organization->website = $request->website;
        $organization->email = $request->email;
        $organization->organization_type_id = $request->organization_type;
        $organization->parent_organization_id = $request->parent_organization;
        $organization->street = $request->street;
        $organization->city = $request->city;
        $organization->description = $request->description;
        $organization->user_id = $user->id;
        $organization->save();
        return redirect()->route('business.organization.show',['portal'=>$institution->portal, 'id'=>$organization->id])->withSuccess('Organization updated!');

    }

    public function organizationDelete($portal, $organization_id)
    {

        $organization = Organization::findOrFail($organization_id);
        $organization->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $organization->save();

        return back()->withSuccess(__('Organization '.$organization->name.' successfully deleted.'));
    }

    public function organizationRestore($portal, $organization_id)
    {

        $organization = Organization::findOrFail($organization_id);
        $organization->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $organization->save();

        return back()->withSuccess(__('Organization '.$organization->name.' successfully restored.'));
    }
}
