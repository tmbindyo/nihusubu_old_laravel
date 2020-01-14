<?php

namespace App\Http\Controllers\Business;

use DB;
use App\Loan;
use App\Sale;
use App\ToDo;
use App\Title;
use App\Status;
use App\Upload;
use App\Contact;
use App\Account;
use App\Campaign;
use App\Liability;
use App\Frequency;
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
use App\Http\Controllers\Controller;
use App\Traits\ReferenceNumberTrait;

class CRMController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    // leads
    public function leads()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // Get contact types
        $contactTypes = ContactType::all();
        // Get all contacts
        $leads = Contact::where('is_lead',True)->with('status','contact_type','title')->get();
        // Get all contacts
        $deletedLeads = Contact::where('is_lead',True)->with('status','contact_type','title')->onlyTrashed()->get();

        return view('business.leads',compact('leads','user','contactTypes','institution','deletedLeads'));
    }

    public function leadCreate()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get contacts
        $contacts = Contact::with('user','status','contact_type')->get();
        // get contact types
        $contactTypes = ContactType::all();
        // get organizations
        $organizations = Organization::all();
        // get titles
        $titles = Title::all();
        // get lead sources
        $leadSources = LeadSource::all();
        // get campaigns
        $campaigns = Campaign::all();
        return view('business.lead_create',compact('contacts','user','contactTypes','institution','organizations','titles','leadSources','campaigns'));
    }

    // campaigns
    public function campaigns()
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get campaigns
        $campaigns = Campaign::with('user','status','campaign_type')->get();
        // get deleted campaigns
        $deletedCampaigns = Campaign::with('user','status','campaign_type')->onlyTrashed()->get();
        return view('business.campaigns',compact('campaigns','user','institution','deletedCampaigns'));

    }

    public function campaignCreate()
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // campaign types
        $campaignTypes = CampaignType::all();
        return view('business.campaign_create',compact('user','institution','campaignTypes'));

    }

    public function campaignStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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
        return redirect()->route('business.campaign.show',$campaign->id)->withSuccess('Campaign created!');

    }

    public function campaignShow($campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get campaign types
        $campaignTypes = CampaignType::all();
        // Get campaigns
        $campaign = Campaign::with('user','status','campaign_type','campaign_uploads','contacts','expenses','organizations','to_dos')->withCount('campaign_uploads','contacts','expenses','organizations','to_dos')->where('id',$campaign_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::with('user','status','campaign')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('campaign_id',$campaign->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::with('user','status','campaign')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('campaign_id',$campaign->id)->get();
        // Completed to dos
        $completedToDos = ToDo::with('user','status','campaign')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('campaign_id',$campaign->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::with('user','status','campaign')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('campaign_id',$campaign->id)->get();

        return view('business.campaign_show',compact('campaign','user','institution','campaignTypes','pendingToDos','inProgressToDos','completedToDos','overdueToDos'));
    }

    public function campaignContactCreate($campaign_id)
    {
        // get Campaign
        $campaign = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get contacts
        $contacts = Contact::with('user','status','contact_type')->get();
        // get contact types
        $contactTypes = ContactType::all();
        // get organizations
        $organizations = Organization::all();
        // get titles
        $titles = Title::all();
        // get lead sources
        $leadSources = LeadSource::all();
        // get campaigns
        $campaigns = Campaign::all();
        return view('business.campaign_contact_create',compact('campaign','contacts','user','contactTypes','institution','organizations','titles','leadSources','campaigns'));
    }

    public function campaignExpenseCreate($campaign_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // expense accounts
        $expenseAccounts = ExpenseAccount::all();
        // get orders
        $sales = Sale::with('status')->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get campaign
        $campaign = Campaign::where('id',$campaign_id)->first();
        // get frequencies
        $frequencies = Frequency::all();

        return view('business.campaign_expense_create',compact('campaign','user','institution','frequencies','expenseAccounts','expenseStatuses'));
    }

    public function campaignOrganizationCreate($campaign_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // organizations
        $organizations = Organization::all();
        // get campaign
        $campaign = Campaign::where('id',$campaign_id)->first();
        return view('business.campaign_organization_create',compact('campaign','user','institution','organizations'));

    }

    public function campaignUploads($campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get campaign types
        $campaignTypes = CampaignType::all();
        // Get campaigns
        $campaign = Campaign::with('user','status','campaign_type','campaign_uploads','contacts','expenses','organizations','to_dos')->withCount('campaign_uploads','contacts','expenses','organizations','to_dos')->where('id',$campaign_id)->first();
        // Campaign uploads
        $campaignUploads = Upload::with('user','status')->where('id',$campaign_id)->get();


        return view('business.campaign_uploads',compact('campaign','user','institution','campaignTypes','campaignUploads'));
    }

    public function campaignUpload($campaign_id)
    {
        // Check if contact type exists
        $campaignExists = Campaign::findOrFail($campaign_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get campaign types
        $campaignTypes = CampaignType::all();
        // Get campaigns
        $campaign = Campaign::with('user','status','campaign_type','campaign_upload','contacts','expenses','organizations','to_dos')->withCount('campaign_upload','contacts','expenses','organizations','to_dos')->where('id',$campaign_id)->first();
        // Campaign uploads
        $campaignUploads = Upload::with('user','status')->where('id',$campaign_id)->first();
        // upload types
        $uploadTypes = UploadType::all();


        return view('business.campaign_uploads',compact('campaign','user','institution','campaignTypes','uploadTypes'));
    }

    public function campaignUploadStore(Request $request,$campaign_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

        $campaign = Campaign::where('id',$campaign_id)->first();
        $originalFolderName = str_replace(' ', '', $campaign->name."/");

        $file = $request->file('file');
        $file_name_extension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        Storage::disk('local')->putFileAs(
            'work/campaign/'.$originalFolderName,
            $file,
            $file_name_extension
        );

        $path = public_path()."/work/campaign/".$originalFolderName.$file_name_extension;

        $size = $request->file('file')->getSize();
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $image_name = $file_name.'.'.$extension;



        $Artist = "Pending";
        $ApertureFNumber = "Pending";
        $Copyright = "Pending";
        $Height = "Pending";
        $Width = "Pending";
        $DateTime = "Pending";
        $ShutterSpeed = "Pending";
        $FileName = "Pending";
        $FileSize = "Pending";
        $ISOSpeedRatings = "Pending";
        $FocalLength = "Pending";
        $LightSource = "Pending";
        $MaxApertureValue = "Pending";
        $MimeType = "Pending";
        $Make = "Pending";
        $Model = "Pending";
        $Software = "Pending";


        $upload = new Upload();
        $upload->artist = $Artist;
        $upload->aperture_f_number = $ApertureFNumber;
        $upload->copyright = $Copyright;
        $upload->height = $Height;
        $upload->width = $Width;
        $upload->date_time = $DateTime;
        $upload->file_name = $FileName;
        $upload->file_size = $FileSize;
        $upload->iso = $ISOSpeedRatings;
        $upload->focal_length = $FocalLength;
        $upload->light_source = $LightSource;
        $upload->max_aperture_value = $MaxApertureValue;
        $upload->mime_type = $MimeType;
        $upload->make = $Make;
        $upload->model = $Model;
        $upload->software = $Software;
        $upload->shutter_speed = $ShutterSpeed;

        // Get the extension type
        $extensionType = $this->uploadExtension($extension);
        $upload->file_type = $extensionType;

        $upload->name = $file_name;
        $upload->extension = $extension;
        $upload->orientation = "";
        $upload->size = $size;

        $upload->original = "work/campaign/".$originalFolderName.$image_name;

        $upload->is_restrict_to_specific_email = False;
        $upload->is_album_set_image = False;
        $upload->campaign_id = $campaign_id;
        $upload->upload_type_id = "11bde94f-e686-488e-9051-bc52f37df8cf";
        $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $upload->user_id = $user->id;
        $upload->save();

        return back()->withSuccess(__('Campaign file successfully uploaded.'));
    }

    public function campaignUploadDownload($upload_id)
    {
        $uploadExists = Upload::findOrFail($upload_id);
        $upload = Upload::where('id',$upload_id)->first();
        $file_path = public_path($upload->original);
        return response()->download($file_path);
    }

    public function campaignUpdate(Request $request, $campaign_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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
        return redirect()->route('business.campaign.show',$campaign->id)->withSuccess('Campaign updated!');

    }

    public function campaignDelete($campaign_id)
    {

        $campaign = Campaign::findOrFail($campaign_id);
        $campaign->delete();

        return back()->withSuccess(__('Campaign '.$campaign->name.' successfully deleted.'));
    }

    public function campaignRestore($campaign_id)
    {

        $campaign = Campaign::findOrFail($campaign_id);
        $campaign->restore();

        return back()->withSuccess(__('Campaign '.$campaign->name.' successfully restored.'));
    }


    // contacts
    public function contacts()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // Get contact types
        $contactTypes = ContactType::all();
        // Get all contacts
        $contacts = Contact::where('is_lead',False)->with('status','contact_type','title')->get();
        // Get deleted all contacts
        $deletedContacts = Contact::where('is_lead',False)->with('status','contact_type','title')->onlyTrashed()->get();

        return view('business.contacts',compact('contacts','user','contactTypes','institution','deletedContacts'));
    }

    public function contactCreate()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get contacts
        $contacts = Contact::with('user','status','contact_type')->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id',$institution->id)->get();
        // get organizations
        $organizations = Organization::where('institution_id',$institution->id)->get();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id',$institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('institution_id',$institution->id)->get();
        return view('business.contact_create',compact('contacts','user','contactTypes','institution','organizations','titles','leadSources','campaigns'));
    }

    public function contactStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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
            $contact->is_organization = True;
        }else{
            $contact->is_organization = False;
        }
        if($request->is_lead == "on"){
            $contact->is_lead = True;
        }else{
            $contact->is_lead = False;
        }

        $contact->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contact->user_id = $user->id;
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


        return redirect()->route('business.contact.show',$contact->id)->withSuccess(__('Contact '.$contact->name.' successfully created.'));
    }

    public function contactShow($contact_id)
    {
        // Check if project type exists
        $contactExists = Contact::findOrFail($contact_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // contacts
        $contact = Contact::with('user','status')->where('id',$contact_id)->first();
        // contact types
        $contactTypes = ContactType::all();
        // get organizations
        $organizations = Organization::all();
        // get titles
        $titles = Title::all();
        // get lead sources
        $leadSources = LeadSource::all();
        // get campaigns
        $campaigns = Campaign::all();
        // contact sales
        $sales = Sale::with('status','sale_products','contact.organization')->withCount('sale_products')->where('contact_id',$contact_id)->get();
        // ontact owed liability
        $liabilities = Liability::with('user','status')->where('contact_id',$contact_id)->get();
        // contact loans
        $loans = Loan::with('user','status')->where('contact_id',$contact_id)->get();
        // contact contact types
        $contactContactTypes = ContactContactType::with('user','status','contact_type')->where('contact_id',$contact_id)->get();
        // Pending to dos
        $pendingToDos = ToDo::with('user','status','contact')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('contact_id',$contact->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::with('user','status','contact')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('contact_id',$contact->id)->get();
        // Completed to dos
        $completedToDos = ToDo::with('user','status','contact')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('contact_id',$contact->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::with('user','status','contact')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('contact_id',$contact->id)->get();
        return view('business.contact_show',compact('loans','overdueToDos','completedToDos','inProgressToDos','pendingToDos','contactContactTypes','liabilities','sales','campaigns','leadSources','titles','organizations','contact','user','contactTypes','institution','loans'));
    }

    public function contactLiabilityCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::all();
        // get contact
        $contactLiability = Contact::where('id',$contact_id)->with('organization')->first();
        // get contacts
        $contacts = Contact::with('organization')->get();
        return view('business.contact_liability_create',compact('contactLiability','user','institution','accounts','contacts'));
    }

    public function contactLoanCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::all();
        // get contacts
        $contact = Contact::with('organization')->where('id',$contact_id)->first();
        return view('business.contact_loan_create',compact('user','institution','accounts','contact'));
    }

    public function contactSaleCreate($contact_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // products
        $priceLists = PriceList::with('product.status','sub_type','size','status')->get();
        // contacts
        $contact = Contact::where('id',$contact_id)->with('organization')->first();

        return view('business.contact_sale_create',compact('contact','priceLists','user','institution'));
    }

    public function contactUpdate(Request $request, $contact_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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


        return redirect()->route('business.contact.show',$contact->id)->withSuccess('Contact updated!');
    }

    public function contactUpdateLeadToContact($contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contact->is_lead = True;
        $contact->save();
        return redirect()->route('business.contact.show',$contact->id)->withSuccess('Contact updated!');
    }

    public function contactContactTypeStore(Request $request, $contact_id)
    {

        $contact = Contact::findOrFail($contact_id);
        $contactContactType = new ContactContactType();
        $contactContactType->contact_id;
        $contactContactType->contact_type_id = $request->contact_type;
        $contactContactType->save();
        return redirect()->route('business.contact.show',$contact->id)->withSuccess('Contact updated!');

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

    // organizations
    public function organizations()
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get organizations
        $organizations = Organization::with('user','status','organization_type')->withCount('contacts')->get();
        // get deleted organizations
        $deletedOrganizations = Organization::with('user','status','organization_type')->withCount('contacts')->onlyTrashed()->get();
        return view('business.organizations',compact('organizations','user','institution','deletedOrganizations'));

    }

    public function organizationCreate()
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // organizations
        $organizations = Organization::all();
        return view('business.organization_create',compact('user','institution','organizations'));

    }

    public function organizationStore(Request $request)
    {
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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
        $organization->save();
        return redirect()->route('business.organization.show',$organization->id)->withSuccess('Organization created!');

    }

    public function organizationShow($organization_id)
    {
        // Check if contact type exists
        $organizationExists = Organization::findOrFail($organization_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // organizations
        $organizations = Organization::all();
        // Get organizations
        $organization = Organization::with('user','status','contacts')->withCount('contacts')->where('id',$organization_id)->first();
        // Pending to dos
        $pendingToDos = ToDo::with('user','status','organization')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('organization_id',$organization->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::with('user','status','organization')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('organization_id',$organization->id)->get();
        // Completed to dos
        $completedToDos = ToDo::with('user','status','organization')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('organization_id',$organization->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::with('user','status','organization')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('organization_id',$organization->id)->get();

        return view('business.organization_show',compact('organization','organizations','user','institution','pendingToDos','inProgressToDos','completedToDos','overdueToDos'));
    }

    public function organizationContactCreate($organization_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get contacts
        $contacts = Contact::with('user','status','contact_type')->get();
        // get contact types
        $contactTypes = ContactType::all();
        // get organization
        $organization = Organization::findOrFail($organization_id);
        // get titles
        $titles = Title::all();
        // get lead sources
        $leadSources = LeadSource::all();
        // get campaigns
        $campaigns = Campaign::all();
        return view('business.organization_contact_create',compact('contacts','user','contactTypes','institution','organization','titles','leadSources','campaigns'));
    }

    public function organizationUpdate(Request $request, $organization_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

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
        return redirect()->route('business.organization.show',$organization->id)->withSuccess('Organization updated!');

    }

    public function organizationDelete($organization_id)
    {

        $organization = Organization::findOrFail($organization_id);
        $organization->delete();

        return back()->withSuccess(__('Organization '.$organization->name.' successfully deleted.'));
    }

    public function organizationRestore($organization_id)
    {

        $organization = Organization::findOrFail($organization_id);
        $organization->restore();

        return back()->withSuccess(__('Organization '.$organization->name.' successfully restored.'));
    }
}
