<?php

namespace App\Http\Controllers\Business;

use App\Campaign;
use App\CampaignType;
use App\Contact;
use App\ContactContactType;
use App\ContactType;
use App\Frequency;
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

class SettingController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function organizationProfile($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.organization.profile', compact('user', 'institution'));
    }

    public function openingBalances($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.opening_balances', compact('user', 'institution'));
    }
    public function usersAndRoles($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.users_and_roles', compact('user', 'institution'));
    }
    public function currencies($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.currencies', compact('user', 'institution'));
    }
    public function emails($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.emails', compact('user', 'institution'));
    }
    public function reminders($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.reminders', compact('user', 'institution'));
    }





    // campaign types
    public function campaignTypes($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // get campaign types
        $campaignTypes = CampaignType::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('user', 'status')->get();
        // get campaign types
        $deletedCampaignTypes = CampaignType::where('status_id', "d35b4cee-5594-4cfd-ad85-e489c9dcdeff")->where('institution_id', $institution->id)->with('user', 'status')->get();
        return view('business.campaign_types', compact('campaignTypes', 'user', 'institution', 'deletedCampaignTypes'));
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

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal, 'id'=>$campaignType->id])->withSuccess('Campaign type updated!');
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
        $campaigns = Campaign::with('user', 'status', 'campaignType')->where('institution_id', $institution->id)->where('campaign_type_id', $campaignType->id)->get();
        return view('business.campaign_type_show', compact('campaignType', 'user', 'institution', 'campaigns'));
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
        $campaignTypes = CampaignType::where('institution_id', $institution->id)->get();
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


    // contact types
    public function contactTypes($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // contact types
        $contactTypes = ContactType::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->with('user', 'status')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // deleted contact types
        $deletedContactTypes = ContactType::where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->with('user', 'status')->where('institution_id', $institution->id)->where('is_institution', true)->get();
        return view('business.contact_types', compact('contactTypes', 'user', 'institution', 'deletedContactTypes'));
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

        return redirect()->route('business.contact.type.show',['portal'=>$institution->portal, 'id'=>$contactType->id])->withSuccess('Contact type created!');
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
        $contactTypes = ContactType::where('institution_id', $institution->id)->get();
        // get organizations
        $organizations = Organization::where('institution_id', $institution->id)->get();
        // get titles
        $titles = Title::where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id', $institution->id)->get();
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

        return redirect()->route('business.frequency.show',['portal'=>$institution->portal, 'id'=>$frequency->id])->withSuccess('Frequency created!');
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

        return redirect()->route('business.lead.source.show',['portal'=>$institution->portal, 'id'=>$leadSource->id])->withSuccess('Expense account created!');
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
        $contactLeadSource = LeadSource::findOrFail($lead_source_id);
        if ( $contactLeadSource->status_id == "d35b4cee-5594-4cfd-ad85-e489c9dcdeff"){
            return back()->withWarning(__('Campaign '.$contactLeadSource->name.' is deleted.'));
        }
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // get contacts
        $contacts = Contact::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'contactType')->get();
        // get contact types
        $contactTypes = ContactType::where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get organizations
        $organizations = Organization::where('institution_id', $institution->id)->get();
        // get titles
        $titles = Title::where('institution_id', $institution->id)->where('is_institution', true)->get();
        // get lead sources
        $leadSources = LeadSource::where('institution_id', $institution->id)->get();
        // get campaigns
        $campaigns = Campaign::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('institution_id', $institution->id)->get();
        return view('business.contact_create', compact('contactCampaign', 'contacts', 'user', 'contactTypes', 'institution', 'organizations', 'titles', 'leadSources', 'campaigns'));
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
        return redirect()->route('business.title.show',['portal'=>$institution->portal, 'id'=>$title->id])->withSuccess(__('Title '.$title->name.' successfully created.'));
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
        $taxes = Tax::where('status_id', 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e')->where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('institution_id', $institution->id)->with('status', 'user')->get();
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

        return redirect()->route('business.tax.show',['portal'=>$institution->portal, 'id'=>$tax->id])->withSuccess(__('Tax successfully created.'));
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
        return back()->withSuccess(__('Tax '.$tax->name.' successfully updated.'));
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

        return redirect()->route('business.unit.show',['portal'=>$institution->portal, 'id'=>$unit->id])->withSuccess(__('Unit successfully created.'));
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
