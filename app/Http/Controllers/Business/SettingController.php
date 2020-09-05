<?php

namespace App\Http\Controllers\Business;

use App\Brand;
use App\Campaign;
use App\CampaignType;
use App\Contact;
use App\ContactContactType;
use App\ContactType;
use App\Currency;
use App\Frequency;
use App\InstitutionModule;
use App\Module;
use App\PaymentSchedule;
use App\Plan;
use App\Product;
use App\ProductCategory;
use App\ProductSubCategory;
use App\ProductTax;
use App\UserAccount;
use Auth;
use App\Unit;
use App\Title;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Http\Controllers\Controller;
use App\LeadSource;
use App\Organization;
use App\Tax;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // brands
    public function settings($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
//        $institution
//        return $institution;
        // get brands
        $brands = Brand::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('user', 'status')->get();
        // get deleted brands
        $deletedBrands = Brand::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('user', 'status')->get();
        // get campaign types
        $campaignTypes = CampaignType::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('user', 'status')->get();
        // get campaign types
        $deletedCampaignTypes = CampaignType::where('status_id', "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->where('institution_id', $institution->id)->with('user', 'status')->get();
        // contact types
        $contactTypes = ContactType::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user', 'status')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // deleted contact types
        $deletedContactTypes = ContactType::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->with('user', 'status')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get frequencies
        $frequencies = Frequency::where("status_id", "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->with('user')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get deleted frequencies
        $deletedFrequencies = Frequency::where("status_id", "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->with('user')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // lead sources
        $leadSources = LeadSource::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->with('user', 'status')->where('institution_id', $institution->id)->get();
        // deleted lead sources
        $deletedLeadSources = LeadSource::where("status_id", "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->with('user', 'status')->where('institution_id', $institution->id)->get();
        // product categories
        $productCategories = ProductCategory::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted product categories
        $deletedProductCategories = ProductCategory::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted payment schedules
        $deletedPaymentSchedules = PaymentSchedule::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        // product sub categories
        $productSubCategories = ProductSubCategory::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user','productCategory')->get();
        // deleted product sub categories
        $deletedProductSubCategories = ProductSubCategory::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user','productCategory')->get();
        // Taxes
        $taxes = Tax::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted taxes
        $deletedTaxes = Tax::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        // get titles
        $titles = Title::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status')->get();
        // get deleted titles
        $deletedTitles = Title::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status')->get();
        // Units
        $units = Unit::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted units
        $deletedUnits = Unit::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        // Get roles
        $roles = Role::where('institution_id', $institution->id)->with('permissions')->get();
        $roleNames = Role::where('institution_id', $institution->id)->pluck('name')->toArray();
        // return $roleNames;
        // return $roles;
        // users
        $users = UserAccount::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id',$institution->id)->with('user.roles')->get();
        // deleted users
        $deletedUsers = UserAccount::where('status_id', "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->where('institution_id',$institution->id)->with('user')->get();
        // plans
        $plans = Plan::get();
        // currency
        $currencies = Currency::get();
        // modules
        $modules = Module::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('is_business',true)->get();
        // get institution modules
        $institutionModulesIds = InstitutionModule::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id',$institution->id)->pluck('module_id')->toArray();
        return view('business.settings', compact('brands', 'user', 'institution', 'brands', 'deletedBrands', 'campaignTypes', 'deletedCampaignTypes', 'contactTypes', 'deletedContactTypes', 'frequencies', 'deletedFrequencies', 'leadSources', 'deletedLeadSources', 'productCategories', 'deletedProductCategories', 'productSubCategories', 'deletedProductSubCategories', 'taxes', 'deletedTaxes', 'titles', 'deletedTitles', 'units', 'deletedUnits', 'roles', 'users', 'deletedUsers', 'plans', 'currencies', 'modules', 'institutionModulesIds', 'paymentSchedules' ,'deletedPaymentSchedules', 'roleNames'));
    }


    public function brandCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.brand_create', compact('user', 'institution'));
    }

    public function brandStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $brand = new Brand();
        $brand->name = ($request->name);
        $brand->description = ($request->name);
        $brand->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $brand->user_id = $user->id;
        $brand->institution_id = $institution->id;
        $brand->save();
        $active = 'brands';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Brand '.$brand->name.' successfully created.'))->with( ['active' => $active] );
    }

    public function brandShow($portal, $brand_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if brand exists
        $brandExists = Brand::findOrFail($brand_id);
        $brand = Brand::with('user', 'status', 'products')->where('institution_id', $institution->id)->withCount('products')->where('id', $brand_id)->first();
        return view('business.brand_show', compact('brand', 'user', 'institution'));
    }

    public function brandUpdate(Request $request, $portal, $brand_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $brand = Brand::findOrFail($brand_id);
        $brand->name = ($request->name);
        $brand->user_id = $user->id;
        $brand->save();

        return redirect()->route('business.brand.show',['portal'=>$institution->portal, 'id'=>$brand->id])->withSuccess('Brand '.$brand->name.' updated!');
    }

    public function brandDelete($portal, $brand_id)
    {

        $brand = Brand::findOrFail($brand_id);
        $brand->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $brand->save();

        return back()->withSuccess(__('Brand '.$brand->name.' successfully deleted.'));
    }

    public function brandRestore($portal, $brand_id)
    {

        $brand = Brand::findOrFail($brand_id);
        $brand->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $brand->restore();

        return back()->withSuccess(__('Brand '.$brand->name.' successfully restored.'));
    }


    public function campaignTypeCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.campaign_type_create', compact('user', 'institution'));
    }

    public function campaignTypeStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);

        $campaignType = new CampaignType();
        $campaignType->name = $request->name;
        $campaignType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaignType->user_id = $user->id;
        $campaignType->institution_id = $institution->id;
        $campaignType->save();
        $active = 'campaignTypes';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Campaign type '.$campaignType->name.' successfully created!')->with( ['active' => $active] );
    }

    public function campaignTypeShow($portal, $campaign_type_id)
    {
        // Check if campaign type exists
        $campaignTypeExists = CampaignType::findOrFail($campaign_type_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // Get campaign type
        $campaignType = CampaignType::with('user', 'status', 'campaigns.user')->where('id', $campaign_type_id)->withCount('campaigns')->first();
        return view('business.campaign_type_show', compact('campaignType', 'user', 'institution'));
    }

    public function campaignTypeCampaignCreate($portal, $campaign_type_id)
    {
        // Check if campaign type exists
        $campaignTypeExists = CampaignType::findOrFail($campaign_type_id);
        if ( $campaignTypeExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$campaignTypeExists->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // campaign types
        $campaignType = CampaignType::with('user', 'status', 'campaigns.user')->where('id', $campaign_type_id)->withCount('campaigns')->first();
        $campaignTypes = CampaignType::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        return view('business.campaign_create', compact('campaignTypeExists', 'user', 'institution', 'campaignTypes', 'campaignType'));

    }

    public function campaignTypeUpdate(Request $request, $portal, $campaign_type_id)
    {
        // Get institutions
        $institution = $this->getInstitution($portal);

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->name = $request->name;
        $campaignType->save();

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal, 'id'=>$campaignType->id])->withSuccess('Campaign type updated!');
    }

    public function campaignTypeDelete($portal, $campaign_type_id)
    {
        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $campaignType->save();

        return back()->withSuccess(__('Campaign type '.$campaignType->name.' successfully deleted.'));
    }
    public function campaignTypeRestore($portal, $campaign_type_id)
    {

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaignType->save();

        return back()->withSuccess(__('Campaign type '.$campaignType->name.' successfully restored.'));
    }


    public function contactTypeCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.contact_type_create', compact('user', 'institution'));
    }

    public function contactTypeStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);

        $contactType = new ContactType();
        $contactType->name = $request->name;
        $contactType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contactType->user_id = $user->id;
        $contactType->institution_id = $institution->id;
        $contactType->is_institution = true;
        $contactType->is_user = false;
        $contactType->save();
        $active = 'contactTypes';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Contact type '.$contactType->name.' successfully created!')->with( ['active' => $active] );
    }

    public function contactTypeShow($portal, $contact_type_id)
    {
        // Check if contact type exists
        $contactTypeExists = ContactType::findOrFail($contact_type_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // Get contact type
        $contactType = ContactType::with('user', 'status')->where('id', $contact_type_id)->withCount('contactTypeContacts')->first();
        // contact type contacts
        $contactContactTypes = ContactContactType::with('user', 'status', 'contact')->where('contact_type_id', $contact_type_id)->get();
        return view('business.contact_type_show', compact('contactType', 'user', 'contactContactTypes', 'institution'));
    }

    public function contactTypeContactCreate($portal, $contact_type_id)
    {
        $contactTypeExists = ContactType::findOrFail($contact_type_id);
        if ( $contactTypeExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Contact type '.$contactTypeExists->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user', 'status', 'contactType')->where('is_institution', true)->get();
        // get contact types
        $contactTypes = ContactType::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // get organizations
        $organizations = Organization::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // get titles
        $titles = Title::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        return view('business.contact_create', compact('contactTypeExists', 'contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns'));
    }

    public function contactTypeUpdate(Request $request, $portal, $contact_type_id)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);

        // contact type update
        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->name = $request->name;
        $contactType->user_id = $user->id;
        $contactType->save();

        return redirect()->route('business.contact.type.show',['portal'=>$institution->portal, 'id'=>$contactType->id])->withSuccess('Contact type updated!');
    }

    public function contactTypeDelete($portal, $contact_type_id)
    {

        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $contactType->save();
        return back()->withSuccess(__('Contact type '.$contactType->name.' successfully deleted.'));
    }

    public function contactTypeRestore($portal, $contact_type_id)
    {

        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contactType->restore();
        return back()->withSuccess(__('Contact type '.$contactType->name.' successfully restored.'));
    }


    // frequency
    public function Frequencies($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get frequencies
        $frequencies = Frequency::where("status_id", "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->with('user')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get deleted frequencies
        $deletedFrequencies = Frequency::where("status_id", "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->with('user')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        return view('business.frequencies', compact('frequencies', 'user', 'institution', 'deletedFrequencies'));
    }

    public function frequencyCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        return view('business.frequency_create', compact('user', 'institution'));
    }

    public function frequencyStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $frequency = new Frequency();
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $frequency->user_id = $user->id;
        $frequency->institution_id = $institution->id;
        $frequency->is_institution = true;
        $frequency->is_user = false;
        $frequency->save();
        $active = 'frequencies';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Frequency '.$frequency->name.' successfully created!')->with( ['active' => $active] );
    }

    public function frequencyShow($portal, $frequency_id)
    {
        // Check if frequency exists
        $frequencyExists = Frequency::findOrFail($frequency_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get frequency
        $frequency = Frequency::with('user', 'expenses')->where('institution_id', $institution->id)->where('is_institution', true)->where('id', $frequency_id)->withCount('expenses')->first();
        return view('business.frequency_show', compact('frequency', 'user', 'institution'));
    }

    public function frequencyUpdate(Request $request, $portal, $frequency_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $frequency = Frequency::findOrFail($frequency_id);
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->save();

        return redirect()->route('business.frequency.show',['portal'=>$institution->portal, 'id'=>$frequency->id])->withSuccess('Frequency updated!');
    }

    public function frequencyDelete($portal, $frequency_id)
    {

        $frequency = Frequency::findOrFail($frequency_id);
        $frequency->status_id= "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $frequency->save();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully deleted.'));
    }
    public function frequencyRestore($portal, $frequency_id)
    {

        $frequency = Frequency::findOrFail($frequency_id);
        $frequency->status_id= "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $frequency->save();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully restored.'));
    }


    // lead sources
    public function leadSources($portal)
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution($portal);
        // lead sources
        $leadSources = LeadSource::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->with('user', 'status')->where('institution_id', $institution->id)->get();
        // deleted lead sources
        $deletedLeadSources = LeadSource::where("status_id", "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->with('user', 'status')->where('institution_id', $institution->id)->get();
        return view('business.lead_sources', compact('leadSources', 'deletedLeadSources', 'user', 'institution'));
    }

    public function leadSourceCreate($portal)
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.lead_source_create', compact('user', 'institution'));
    }

    public function leadSourceStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution($portal);

        $leadSource = new LeadSource();
        $leadSource->name = $request->name;
        $leadSource->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $leadSource->user_id = $user->id;
        $leadSource->institution_id = $institution->id;
        $leadSource->save();
        $active = 'leadSources';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Lead Source '.$leadSource->name.' successfully created!')->with( ['active' => $active] );
    }

    public function leadSourceShow($portal, $lead_source_id)
    {
        // Check if lead source exists
        $leadSourceExists = LeadSource::findOrFail($lead_source_id);
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution($portal);
        // Get lead source
        $leadSource = LeadSource::with('user', 'status', 'contacts')->where('id', $lead_source_id)->withCount('contacts')->first();
        return view('business.lead_source_show', compact('leadSource', 'user', 'institution'));
    }

    public function leadSourceContactCreate($portal, $lead_source_id)
    {
        // get Campaign
        $leadSourceExists = LeadSource::findOrFail($lead_source_id);
        if ( $leadSourceExists->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$leadSourceExists->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'contactType')->get();
        // get contact types
        $contactTypes = ContactType::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get organizations
        $organizations = Organization::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // get titles
        $titles = Title::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        return view('business.contact_create', compact( 'contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns', 'leadSourceExists'));
    }

    public function leadSourceUpdate(Request $request, $portal, $lead_source_id)
    {

        // Institution
        $institution = $this->getInstitution($portal);

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->name = $request->name;
        $leadSource->save();
        return redirect()->route('business.lead.source.show',['portal'=>$institution->portal, 'id'=>$leadSource->id])->withSuccess('Expense account updated!');
    }

    public function leadSourceDelete($portal, $lead_source_id)
    {

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $leadSource->save();
        return back()->withSuccess(__('Lead source '.$leadSource->name.' successfully deleted.'));
    }
    public function leadSourceRestore($portal, $lead_source_id)
    {

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $leadSource->save();
        return back()->withSuccess(__('Lead source '.$leadSource->name.' successfully restored.'));
    }


    // titles
    public function titles($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get titles
        $titles = Title::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status')->get();
        // get deleted titles
        $deletedTitles = Title::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status')->get();

        return view('business.titles', compact('titles', 'user', 'institution', 'titles', 'deletedTitles'));
    }

    public function titleCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.title_create', compact('user', 'institution'));
    }

    public function titleStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $title = new Title();
        $title->name = ($request->name);
        $title->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $title->user_id = $user->id;
        $title->institution_id = $institution->id;
        $title->is_user = false;
        $title->is_institution = true;
        $title->save();
        $active = 'titles';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Title '.$title->name.' successfully created.'))->with( ['active' => $active] );
    }

    public function titleShow($portal, $title_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if title exists
        $titleExists = Title::findOrFail($title_id);
        $title = Title::with('user', 'status', 'contacts')->where('institution_id', $institution->id)->where('is_institution', true)->withCount('contacts')->where('id', $title_id)->first();
        return view('business.title_show', compact('title', 'user', 'institution'));
    }

    public function titleUpdate(Request $request, $portal, $title_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        $title = Title::findOrFail($title_id);
        $title->name = ($request->name);
        $title->user_id = $user->id;
        $title->save();

        return redirect()->route('business.title.show',['portal'=>$institution->portal, 'id'=>$title->id])->withSuccess('Title '.$title->name.' updated!');
    }

    public function titleDelete($portal, $title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $title->save();

        return back()->withSuccess(__('Title '.$title->name.' successfully deleted.'));
    }

    public function titleRestore($portal, $title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $title->restore();

        return back()->withSuccess(__('Title '.$title->name.' successfully restored.'));
    }

    // taxes
    public function taxes($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Taxes
        $taxes = Tax::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted taxes
        $deletedTaxes = Tax::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        return view('business.taxes', compact('user', 'institution', 'taxes', 'deletedTaxes'));
    }

    public function taxCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.tax_create', compact('user', 'institution'));
    }

    public function taxStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create tax
        $tax = new Tax();
        $tax->name = $request->name;
        $tax->amount = $request->amount;

        if ($request->is_percentage == "on"){
            $tax->is_percentage = true;
        }else{
            $tax->is_percentage = false;
        }

        $tax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $tax->institution_id = $institution->id;
        $tax->user_id = $user->id;
        $tax->save();
        $active = 'taxes';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Tax '.$tax->name.' successfully created.'))->with( ['active' => $active] );
    }

    public function taxShow($portal, $tax_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get tax
        $tax = Tax::where('id', $tax_id)->with('status', 'user', 'productTaxes.product.unit', 'compositeProductTaxes.compositeProduct.unit')->first();

        return view('business.tax_show', compact('user', 'institution', 'tax'));
    }

    public function taxUpdate(Request $request, $portal,  $tax_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create tax
        $tax = Tax::findOrFail($tax_id);
        $tax->name = $request->name;
        $tax->amount = $request->amount;
        if ($request->is_percentage == "on"){
            $tax->is_percentage = true;
        }else{
            $tax->is_percentage = false;
        }
        $tax->user_id = $user->id;
        $tax->save();

        // update all products that use this tax
        // get all products with this as tax
        $productsWithTax = ProductTax::where('tax_id',$tax->id)->with('product.productTaxes.tax')->get();
        foreach ($productsWithTax as $product){
            $taxAmount = 0;
            foreach ($product->product->productTaxes as $productTax){
                $productTaxUpdate = Product::findOrFail($product->product->id);
//                return $productTax;
                $tax = Tax::findOrFail($productTax->tax_id);
                if ($tax->is_percentage){
                    $percentageTax = $tax->amount/100 * $productTaxUpdate->selling_price;
                    $taxAmount += $percentageTax;
                }else{
                    // amount
                    $taxAmount += $tax->amount;
                }
            }
            // set tax selling


            if($request->tax_method_id = 'b2004522-e7aa-41dd-b033-7252d0a642b7'){
                $productTaxUpdate->taxed_selling_price = ceil(floatval($taxAmount+$productTaxUpdate->selling_price));
                $productTaxUpdate->tax_amount = ceil(floatval($taxAmount));
            }else{
                $productTaxUpdate->taxed_selling_price = $productTaxUpdate->selling_price;
                $productTaxUpdate->tax_amount = ceil(floatval($taxAmount));
            }
            $productTaxUpdate->save();
        }
        return back()->withSuccess(__('Tax '.$tax->name.' successfully updated and all relevant product selling prices.'));
    }

    public function taxDelete($portal, $tax_id)
    {

        // delete the tax
        $tax = Tax::findOrFail($tax_id);
        $tax->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $tax->save();

        return back()->withSuccess(__('Tax successfully deleted.'));
    }

    public function taxRestore($portal, $tax_id)
    {
        // restore the tax
        $tax = Tax::findOrFail($tax_id);
        $tax->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $tax->restore();
        return back()->withSuccess(__('Tax successfully restored.'));
    }

    // product categories
    public function productCategories($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // product categories
        $productCategories = ProductCategory::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted product categories
        $deletedProductCategories = ProductCategory::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        return view('business.product_categories', compact('user', 'institution', 'productCategories', 'deletedProductCategories'));
    }

    public function productCategoryCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.product_category_create', compact('user', 'institution'));
    }

    public function productCategoryStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create product category
        $productCategory = new ProductCategory();
        $productCategory->name = $request->name;
        $productCategory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productCategory->institution_id = $institution->id;
        $productCategory->user_id = $user->id;
        $productCategory->save();
        $active = 'productCategories';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Product category '.$productCategory->name.' successfully created.'))->with( ['active'=>$active]);
    }

    public function productCategoryShow($portal, $product_category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get product category
        $productCategory = ProductCategory::where('id', $product_category_id)->with('status', 'user','productSubCategories')->first();

        return view('business.product_category_show', compact('user', 'institution', 'productCategory'));
    }

    public function productCategoryUpdate(Request $request, $portal,  $product_category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create product category
        $productCategory = ProductCategory::findOrFail($product_category_id);
        $productCategory->name = $request->name;
        $productCategory->user_id = $user->id;
        $productCategory->save();
        return back()->withSuccess(__('Product category '.$productCategory->name.' successfully updated.'));
    }

    public function productCategoryDelete($portal, $product_category_id)
    {

        // delete the product category
        $productCategory = ProductCategory::findOrFail($product_category_id);
        $productCategory->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $productCategory->save();

        return back()->withSuccess(__('Product category successfully deleted.'));
    }

    public function productCategoryRestore($portal, $product_category_id)
    {
        // restore the product category
        $productCategory = ProductCategory::findOrFail($product_category_id);
        $productCategory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productCategory->restore();
        return back()->withSuccess(__('Product category successfully restored.'));
    }

    // payment schedules
    public function paymentSchedules($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // payment schedules
        $paymentSchedules = PaymentSchedule::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted payment schedules
        $deletedPaymentSchedules = PaymentSchedule::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        return view('business.payment_schedules', compact('user', 'institution', 'paymentSchedules', 'deletedPaymentSchedules'));
    }

    public function paymentScheduleCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.payment_schedule_create', compact('user', 'institution'));
    }

    public function paymentScheduleStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create payment schedule
        $paymentSchedule = new PaymentSchedule();
        $paymentSchedule->name = $request->name;
        $paymentSchedule->period = $request->period;
        $paymentSchedule->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $paymentSchedule->institution_id = $institution->id;
        $paymentSchedule->user_id = $user->id;
        $paymentSchedule->save();
        $active = 'paymentSchedules';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Payment schedule '.$paymentSchedule->name.' successfully created.'))->with( ['active'=>$active]);
    }

    public function paymentScheduleShow($portal, $payment_schedule_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get payment schedule
        $paymentSchedule = PaymentSchedule::where('id', $payment_schedule_id)->with('status', 'user', 'expenses', 'sales')->first();

        return view('business.payment_schedule_show', compact('user', 'institution', 'paymentSchedule'));
    }

    public function paymentScheduleUpdate(Request $request, $portal,  $payment_schedule_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create payment schedule
        $paymentSchedule = PaymentSchedule::findOrFail($payment_schedule_id);
        $paymentSchedule->name = $request->name;
        $paymentSchedule->period = $request->period;
        $paymentSchedule->user_id = $user->id;
        $paymentSchedule->save();
        return back()->withSuccess(__('Payment schedule '.$paymentSchedule->name.' successfully updated.'));
    }

    public function paymentScheduleDelete($portal, $payment_schedule_id)
    {

        // delete the payment schedule
        $paymentSchedule = PaymentSchedule::findOrFail($payment_schedule_id);
        $paymentSchedule->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $paymentSchedule->save();

        return back()->withSuccess(__('Payment schedule successfully deleted.'));
    }

    public function paymentScheduleRestore($portal, $payment_schedule_id)
    {
        // restore the payment schedule
        $paymentSchedule = PaymentSchedule::findOrFail($payment_schedule_id);
        $paymentSchedule->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $paymentSchedule->restore();
        return back()->withSuccess(__('Payment schedule successfully restored.'));
    }

    // product sub categories
    public function productSubCategories($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // product sub categories
        $productSubCategories = ProductSubCategory::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user','productCategory')->get();
        // deleted product sub categories
        $deletedProductSubCategories = ProductSubCategory::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user','productCategory')->get();
        return view('business.product_sub_categories', compact('user', 'institution', 'productSubCategories', 'deletedProductSubCategories'));
    }

    public function productSubCategoryCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // product categories
        $productCategories = ProductCategory::where('institution_id',$institution->id)->where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user','status')->get();
        return view('business.product_sub_category_create', compact('user', 'institution', 'productCategories'));
    }

    public function productSubCategoryStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create product category
        $productSubCategory = new ProductSubCategory();
        $productSubCategory->name = $request->name;
        $productSubCategory->product_category_id = $request->product_category;
        $productSubCategory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productSubCategory->institution_id = $institution->id;
        $productSubCategory->user_id = $user->id;
        $productSubCategory->save();
        $active = 'productSubCategories';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Product sub category '.$productSubCategory->name.' successfully created.'))->with( ['active' => $active] );
    }

    public function productSubCategoryShow($portal, $product_sub_category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // product categories
        $productCategories = ProductCategory::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id',$institution->id)->with('user','status')->get();
        // Get product category
        $productSubCategory = ProductSubCategory::where('id', $product_sub_category_id)->with('status', 'user', 'products')->first();

        return view('business.product_sub_category_show', compact('user', 'institution', 'productSubCategory', 'productCategories'));
    }

    public function productSubCategoryUpdate(Request $request, $portal,  $product_sub_category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create product category
        $productSubCategory = ProductSubCategory::findOrFail($product_sub_category_id);
        $productSubCategory->name = $request->name;
        $productSubCategory->product_category_id = $request->product_category;
        $productSubCategory->user_id = $user->id;
        $productSubCategory->save();
        return back()->withSuccess(__('Product category '.$productSubCategory->name.' successfully updated.'));
    }

    public function productSubCategoryDelete($portal, $product_sub_category_id)
    {

        // delete the product category
        $productSubCategory = ProductSubCategory::findOrFail($product_sub_category_id);
        $productSubCategory->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $productSubCategory->save();

        return back()->withSuccess(__('Product category successfully deleted.'));
    }

    public function productSubCategoryRestore($portal, $product_sub_category_id)
    {
        // restore the product category
        $productSubCategory = ProductSubCategory::findOrFail($product_sub_category_id);
        $productSubCategory->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $productSubCategory->restore();
        return back()->withSuccess(__('Product category successfully restored.'));
    }

    // units
    public function units($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Units
        $units = Unit::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
        // deleted units
        $deletedUnits = Unit::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('institution_id', $institution->id)->with('status', 'user')->get();
        return view('business.units', compact('user', 'institution', 'units', 'deletedUnits'));
    }

    public function unitCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.unit_create', compact('user', 'institution'));
    }

    public function unitStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create unit
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();
        $active = 'units';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Unit '.$unit->name.' successfully created.'))->with( ['active' => $active] );
    }

    public function unitShow($portal, $unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get unit
        $unit = Unit::where('id', $unit_id)->with('status', 'user', 'products', 'productGroups')->first();

        return view('business.unit_show', compact('user', 'institution', 'unit'));
    }

    public function unitUpdate(Request $request, $portal,  $unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Create unit
        $unit = Unit::findOrFail($unit_id);
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->user_id = $user->id;
        $unit->save();
        return back()->withSuccess(__('Unit '.$unit->name.' successfully updated.'));
    }

    public function unitDelete($portal, $unit_id)
    {

        // delete the unit
        $unit = Unit::findOrFail($unit_id);
        $unit->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $unit->save();

        return back()->withSuccess(__('Unit successfully deleted.'));
    }

    public function unitRestore($portal, $unit_id)
    {
        // restore the unit
        $unit = Unit::withTrashed()->findOrFail($unit_id);
        $unit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $unit->restore();
        return back()->withSuccess(__('Unit successfully restored.'));
    }
}
