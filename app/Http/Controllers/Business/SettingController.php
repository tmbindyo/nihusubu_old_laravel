<?php

namespace App\Http\Controllers\Business;

use App\CampaignType;
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

        return view('business.organization.profile',compact('user','institution'));
    }
    public function openingBalances($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.opening_balances',compact('user','institution'));
    }
    public function usersAndRoles($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.users_and_roles',compact('user','institution'));
    }
    public function currencies($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.currencies',compact('user','institution'));
    }
    public function taxes($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.taxes',compact('user','institution'));
    }
    public function emails($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.emails',compact('user','institution'));
    }
    public function reminders($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.reminders',compact('user','institution'));
    }





    // campaign types
    public function campaignTypes($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // get campaign types
        $campaignTypes = CampaignType::where('institution_id',$institution->id)->with('user','status')->get();
        // get campaign types
        $deletedCampaignTypes = CampaignType::where('institution_id',$institution->id)->with('user','status')->onlyTrashed()->get();
        return view('business.campaign_types',compact('campaignTypes','user','institution','deletedCampaignTypes'));
    }

    public function campaignTypeCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.campaign_type_create',compact('user','institution'));
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

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal,'id'=>$campaignType->id])->withSuccess('Campaign type updated!');
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
        $campaignType = CampaignType::with('user','status','campaigns.user')->where('is_institution',True)->where('id',$campaign_type_id)->withCount('campaigns')->first();
        return view('business.campaign_type_show',compact('campaignType','user','institution'));
    }

    public function campaignTypeUpdate(Request $request, $portal, $campaign_type_id)
    {
        // Get institutions
        $institution = $this->getInstitution($portal);

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->name = $request->name;
        $campaignType->save();

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal,'id'=>$campaignType->id])->withSuccess('Campaign type updated!');
    }

    public function campaignTypeDelete($portal, $campaign_type_id)
    {

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->delete();

        return back()->withSuccess(__('Campaign type '.$campaignType->name.' successfully deleted.'));
    }
    public function campaignTypeRestore($portal, $campaign_type_id)
    {

        $campaignType = CampaignType::withTrashed()->findOrFail($campaign_type_id);
        $campaignType->restore();

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
        $contactTypes = ContactType::with('user','status')->where('institution_id',$institution->id)->where('is_institution',True)->get();
        // deleted contact types
        $deletedContactTypes = ContactType::with('user','status')->where('institution_id',$institution->id)->where('is_institution',True)->onlyTrashed()->get();
        return view('business.contact_types',compact('contactTypes','user','institution','deletedContactTypes'));
    }

    public function contactTypeCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.contact_type_create',compact('user','institution'));
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
        $contactType->save();

        return redirect()->route('business.contact.type.show',['portal'=>$institution->portal,'id'=>$contactType->id])->withSuccess('Contact type created!');
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
        $contactType = ContactType::with('user','status')->where('id',$contact_type_id)->withCount('contact_type_contacts')->first();
        // contact type contacts
        $contactContactTypes = ContactContactType::with('user','status','contact')->where('contact_type_id',$contact_type_id)->get();
        return view('business.contact_type_show',compact('contactType','user','contactContactTypes','institution'));
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
        $contactType->description = $request->description;
        $contactType->user_id = $user->id;
        $contactType->save();

        return redirect()->route('business.contact.type.show',['portal'=>$institution->portal,'id'=>$contactType->id])->withSuccess('Contact type updated!');
    }

    public function contactTypeDelete($portal, $contact_type_id)
    {

        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->delete();
        return back()->withSuccess(__('Contact type '.$contactType->name.' successfully deleted.'));
    }

    public function contactTypeRestore($portal, $contact_type_id)
    {

        $contactType = ContactType::withTrashed()->findOrFail($contact_type_id);
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
        $frequencies = Frequency::with('user')->where('institution_id',$institution->id)->where('is_institution',true)->get();
        // get deleted frequencies
        $deletedFrequencies = Frequency::with('user')->where('institution_id',$institution->id)->where('is_institution',true)->onlyTrashed()->get();
        return view('business.frequencies',compact('frequencies','user','institution','deletedFrequencies'));
    }

    public function frequencyCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        return view('business.frequency_create',compact('user','institution'));
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
        $frequency->user_id = $user->id;
        $frequency->institution_id = $institution->id;
        $frequency->save();

        return redirect()->route('business.frequency.show',['portal'=>$institution->portal,'id'=>$frequency->id])->withSuccess('Frequency created!');
    }

    public function frequencyShow($portal, $Frequency_id)
    {
        // Check if frequency exists
        $frequencyExists = Frequency::findOrFail($Frequency_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get frequency
        $frequency = Frequency::with('user','expenses')->where('institution_id',$institution->id)->where('is_institution',true)->where('id',$Frequency_id)->withCount('expenses')->first();
        return view('business.frequency_show',compact('frequency','user','institution'));
    }

    public function frequencyUpdate(Request $request, $portal, $Frequency_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $frequency = Frequency::findOrFail($Frequency_id);
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->save();

        return redirect()->route('business.frequency.show',['portal'=>$institution->portal,'id'=>$frequency->id])->withSuccess('Frequency updated!');
    }

    public function frequencyDelete($portal, $Frequency_id)
    {

        $frequency = Frequency::findOrFail($Frequency_id);
        $frequency->delete();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully deleted.'));
    }
    public function frequencyRestore($portal, $Frequency_id)
    {

        $frequency = Frequency::withTrashed()->findOrFail($Frequency_id);
        $frequency->restore();

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
        $leadSources = LeadSource::with('user','status')->where('institution_id',$institution->id)->get();
        // deleted lead sources
        $deletedLeadSources = LeadSource::with('user','status')->where('institution_id',$institution->id)->onlyTrashed()->get();
        return view('business.lead_sources',compact('leadSources','deletedLeadSources','user','institution'));
    }

    public function leadSourceCreate($portal)
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.lead_source_create',compact('user','institution'));
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

        return redirect()->route('business.lead.source.show',['portal'=>$institution->portal,'id'=>$leadSource->id])->withSuccess('Expense account created!');
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
        $leadSource = LeadSource::with('user','status','contacts')->where('id',$lead_source_id)->withCount('contacts')->first();
        return view('business.lead_source_show',compact('leadSource','user','institution'));
    }

    public function leadSourceUpdate(Request $request, $portal, $lead_source_id)
    {

        // Institution
        $institution = $this->getInstitution($portal);

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->name = $request->name;
        $leadSource->save();
        return redirect()->route('business.lead.source.show',['portal'=>$institution->portal,'id'=>$leadSource->id])->withSuccess('Expense account updated!');
    }

    public function leadSourceDelete($portal, $lead_source_id)
    {

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->delete();
        return back()->withSuccess(__('Lead source '.$leadSource->name.' successfully deleted.'));
    }
    public function leadSourceRestore($portal, $lead_source_id)
    {

        $leadSource = LeadSource::withTrashed()->findOrFail($lead_source_id);
        $leadSource->restore();
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
        $titles = Title::where('institution_id',$institution->id)->where('is_institution',true)->with('user','status')->get();
        // get deleted titles
        $deletedTitles = Title::where('institution_id',$institution->id)->where('is_institution',true)->with('user','status')->onlyTrashed()->get();

        return view('business.titles',compact('titles','user','institution','titles','deletedTitles'));
    }

    public function titleCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.title_create',compact('user','institution'));
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
        $title->is_user = False;
        $title->is_institution = True;
        $title->save();
        return redirect()->route('business.title.show',['portal'=>$institution->portal,'id'=>$title->id])->withSuccess(__('Title '.$title->name.' successfully created.'));
    }

    public function titleShow($portal, $title_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Check if title exists
        $titleExists = Title::findOrFail($title_id);
        $title = Title::with('user','status','contacts')->where('institution_id',$institution->id)->where('is_institution',true)->withCount('contacts')->where('id',$title_id)->first();
        return view('business.title_show',compact('title','user','institution'));
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

        return redirect()->route('business.title.show',['portal'=>$institution->portal,'id'=>$title->id])->withSuccess('Title '.$title->name.' updated!');
    }

    public function titleDelete($portal, $title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->delete();

        return back()->withSuccess(__('Title '.$title->name.' successfully deleted.'));
    }

    public function titleRestore($portal, $title_id)
    {

        $title = Title::withTrashed()->findOrFail($title_id);
        $title->restore();

        return back()->withSuccess(__('Title '.$title->name.' successfully restored.'));
    }

    // units
    public function units($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Units
        $units = Unit::where('institution_id',$institution->id)->with('status','user')->get();
        $deletedUnits = Unit::onlyTrashed()->get();
        return view('business.units',compact('user','institution','units','deletedUnits'));
    }

    public function unitCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.unit_create',compact('user','institution'));
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

        return redirect()->route('business.unit.show',['portal'=>$institution->portal,'id'=>$unit->id])->withSuccess(__('Unit successfully created.'));
    }

    public function unitShow($portal, $unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Get unit
        $unit = Unit::where('id',$unit_id)->with('status','user','products','product_groups')->first();

        return view('business.unit_show',compact('user','institution','unit'));
    }

    public function unitUpdate(Request $request,$portal,  $unit_id)
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
        $unit->delete();

        return back()->withSuccess(__('Unit successfully deleted.'));
    }

    public function unitRestore($portal, $unit_id)
    {
        // restore the unit
        $unit = Unit::withTrashed()->findOrFail($unit_id);
        $unit->restore();
        return back()->withSuccess(__('Unit successfully restored.'));
    }
}
