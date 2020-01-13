<?php

namespace App\Http\Controllers\Business;

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

    public function organizationProfile()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.organization.profile',compact('user','institution'));
    }
    public function openingBalances()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.opening_balances',compact('user','institution'));
    }
    public function usersAndRoles()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.users_and_roles',compact('user','institution'));
    }
    public function currencies()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.currencies',compact('user','institution'));
    }
    public function taxes()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.taxes',compact('user','institution'));
    }
    public function emails()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.emails',compact('user','institution'));
    }
    public function reminders()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.reminders',compact('user','institution'));
    }





    // campaign types
    public function campaignTypes()
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        $campaignTypes = CampaignType::with('user','status')->get();
        return view('business.campaign_types',compact('campaignTypes','user','institution'));
    }

    public function campaignTypeCreate()
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        return view('business.campaign_type_create',compact('user','institution'));
    }

    public function campaignTypeStore(Request $request)
    {
        $campaignType = new CampaignType();
        $campaignType->name = $request->name;
        $campaignType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaignType->user_id = Auth::user()->id;
        $campaignType->save();

        return redirect()->route('business.campaign.type.show',$campaignType->id)->withSuccess('Campaign type updated!');
    }

    public function campaignTypeShow($campaign_type_id)
    {
        // Check if campaign type exists
        $campaignTypeExists = CampaignType::findOrFail($campaign_type_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        // Get campaign type
        $campaignType = CampaignType::with('user','status','campaigns.user')->where('id',$campaign_type_id)->withCount('campaigns')->first();
        return view('business.campaign_type_show',compact('campaignType','user','institution'));
    }

    public function campaignTypeUpdate(Request $request, $campaign_type_id)
    {

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->name = $request->name;
        $campaignType->save();

        return redirect()->route('business.campaign.type.show',$campaignType->id)->withSuccess('Campaign type updated!');
    }

    public function campaignTypeDelete($campaign_type_id)
    {

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->status_id = "b810f2f1-91c2-4fc9-b8e1-acc068caa03a";
        $campaignType->user_id = Auth::user()->id;
        $campaignType->save();

        return back()->withSuccess(__('Campaign type '.$campaignType->name.' successfully deleted.'));
    }
    public function campaignTypeRestore($campaign_type_id)
    {

        $campaignType = CampaignType::findOrFail($campaign_type_id);
        $campaignType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $campaignType->user_id = Auth::user()->id;
        $campaignType->save();

        return back()->withSuccess(__('Campaign type '.$campaignType->name.' successfully restored.'));
    }


    // contact types
    public function contactTypes()
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        // contact types
        $contactTypes = ContactType::with('user','status')->where('institution_id',$institution->id)->get();
        // deleted contact types
        $deletedContactTypes = ContactType::with('user','status')->where('institution_id',$institution->id)->onlyTrashed()->get();
        return view('business.contact_types',compact('contactTypes','user','institution','deletedContactTypes'));
    }

    public function contactTypeCreate()
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        return view('business.contact_type_create',compact('user','institution'));
    }

    public function contactTypeStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();

        $contactType = new ContactType();
        $contactType->name = $request->name;
        $contactType->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $contactType->user_id = $user->id;
        $contactType->institution_id = $institution->id;
        $contactType->save();

        return redirect()->route('business.contact.type.show',$contactType->id)->withSuccess('Contact type created!');
    }

    public function contactTypeShow($contact_type_id)
    {
        // Check if contact type exists
        $contactTypeExists = ContactType::findOrFail($contact_type_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution();
        // Get contact type
        $contactType = ContactType::with('user','status')->where('id',$contact_type_id)->withCount('contact_type_contacts')->first();
        // contact type contacts
        $contactContactTypes = ContactContactType::with('user','status','contact')->where('contact_type_id',$contact_type_id)->get();
        return view('business.contact_type_show',compact('contactType','user','contactContactTypes','institution'));
    }

    public function contactTypeUpdate(Request $request, $contact_type_id)
    {
        // User
        $user = $this->getUser();

        // contact type update
        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->name = $request->name;
        $contactType->description = $request->description;
        $contactType->user_id = $user->id;
        $contactType->save();

        return redirect()->route('business.contact.type.show',$contactType->id)->withSuccess('Contact type updated!');
    }

    public function contactTypeDelete($contact_type_id)
    {

        $contactType = ContactType::findOrFail($contact_type_id);
        $contactType->delete();
        return back()->withSuccess(__('Contact type '.$contactType->name.' successfully deleted.'));
    }

    public function contactTypeRestore($contact_type_id)
    {

        $contactType = ContactType::withTrashed()->findOrFail($contact_type_id);
        $contactType->restore();
        return back()->withSuccess(__('Contact type '.$contactType->name.' successfully restored.'));
    }


    // frequency
    public function Frequencies()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // get frequencies
        $frequencies = Frequency::with('user')->where('institution_id',$institution->id)->get();
        // get deleted frequencies
        $deletedFrequencies = Frequency::with('user')->where('institution_id',$institution->id)->onlyTrashed()->get();
        return view('business.frequencies',compact('frequencies','user','institution','deletedFrequencies'));
    }

    public function frequencyCreate()
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        return view('business.frequency_create',compact('user','institution'));
    }

    public function frequencyStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

        $frequency = new Frequency();
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->institution_id = $institution->id;
        $frequency->save();

        return redirect()->route('business.frequency.show',$frequency->id)->withSuccess('Frequency created!');
    }

    public function frequencyShow($Frequency_id)
    {
        // Check if contact type exists
        $frequencyExists = Frequency::findOrFail($Frequency_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();
        // Get contact type
        $frequency = Frequency::with('user','expenses')->where('id',$Frequency_id)->withCount('expenses')->first();
        return view('business.frequency_show',compact('frequency','user','institution'));
    }

    public function frequencyUpdate(Request $request, $Frequency_id)
    {
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution();

        $frequency = Frequency::findOrFail($Frequency_id);
        $frequency->name = $request->name;
        $frequency->type = $request->type;
        $frequency->frequency = $request->frequency;
        $frequency->user_id = $user->id;
        $frequency->save();

        return redirect()->route('business.frequency.show',$frequency->id)->withSuccess('Frequency updated!');
    }

    public function frequencyDelete($Frequency_id)
    {

        $frequency = Frequency::findOrFail($Frequency_id);
        $frequency->delete();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully deleted.'));
    }
    public function frequencyRestore($Frequency_id)
    {

        $frequency = Frequency::withTrashed()->findOrFail($Frequency_id);
        $frequency->restore();

        return back()->withSuccess(__('Frequeny '.$frequency->name.' successfully restored.'));
    }


    // lead sources
    public function leadSources()
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution();
        // lead sources
        $leadSources = LeadSource::with('user','status')->get();
        // deleted lead sources
        $deletedLeadSources = LeadSource::with('user','status')->where('institution_id',$institution->id)->onlyTrashed()->get();
        return view('business.lead_sources',compact('leadSources','deletedLeadSources','user','institution'));
    }

    public function leadSourceCreate()
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution();
        return view('business.lead_source_create',compact('user','institution'));
    }

    public function leadSourceStore(Request $request)
    {
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution();

        $leadSource = new LeadSource();
        $leadSource->name = $request->name;
        $leadSource->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $leadSource->user_id = $user->id;
        $leadSource->institution_id = $institution->id;
        $leadSource->save();

        return redirect()->route('business.lead.source.show',$leadSource->id)->withSuccess('Expense account created!');
    }

    public function leadSourceShow($lead_source_id)
    {
        // Check if lead source exists
        $leadSourceExists = LeadSource::findOrFail($lead_source_id);
        // User
        $user = $this->getUser();;
        // Institution
        $institution = $this->getInstitution();
        // Get lead source
        $leadSource = LeadSource::with('user','status','contacts')->where('id',$lead_source_id)->withCount('contacts')->first();
        return view('business.lead_source_show',compact('leadSource','user','institution'));
    }

    public function leadSourceUpdate(Request $request, $lead_source_id)
    {

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->name = $request->name;
        $leadSource->save();
        return redirect()->route('business.lead.source.show',$leadSource->id)->withSuccess('Expense account updated!');
    }

    public function leadSourceDelete($lead_source_id)
    {

        $leadSource = LeadSource::findOrFail($lead_source_id);
        $leadSource->delete();
        return back()->withSuccess(__('Lead source '.$leadSource->name.' successfully deleted.'));
    }
    public function leadSourceRestore($lead_source_id)
    {

        $leadSource = LeadSource::withTrashed()->findOrFail($lead_source_id);
        $leadSource->restore();
        return back()->withSuccess(__('Lead source '.$leadSource->name.' successfully restored.'));
    }


    // titles
    public function titles()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // get titles
        $titles = Title::where('institution_id',$institution->id)->with('user','status')->get();
        // get deleted titles
        $deletedTitles = Title::where('institution_id',$institution->id)->with('user','status')->onlyTrashed()->get();

        return view('business.titles',compact('titles','user','institution','titles','deletedTitles'));
    }
    public function titleCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.title_create',compact('user','institution'));
    }

    public function titleStore(Request $request)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        $title = new Title();
        $title->name = ($request->name);
        $title->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $title->user_id = $user->id;
        $title->institution_id = $institution->id;
        $title->save();
        return redirect()->route('business.title.show',$title->id)->withSuccess(__('Title '.$title->name.' successfully created.'));
    }

    public function titleShow($title_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Check if title exists
        $titleExists = Title::findOrFail($title_id);
        $title = Title::with('user','status','contacts')->withCount('contacts')->where('id',$title_id)->first();
        return view('business.title_show',compact('title','user','institution'));
    }

    public function titleUpdate(Request $request, $title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->name = ($request->name);
        $title->user_id = Auth::user()->id;
        $title->save();

        return redirect()->route('business.title.show',$title->id)->withSuccess('Title '.$title->name.' updated!');
    }

    public function titleDelete($title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->delete();

        return back()->withSuccess(__('Title '.$title->name.' successfully deleted.'));
    }

    public function titleRestore($title_id)
    {

        $title = Title::withTrashed()->findOrFail($title_id);
        $title->restore();

        return back()->withSuccess(__('Title '.$title->name.' successfully restored.'));
    }

    // units
    public function units()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Units
        $units = Unit::where('institution_id',$institution->id)->with('status','user')->get();
        $deletedUnits = Unit::onlyTrashed()->get();
        return view('business.units',compact('user','institution','units','deletedUnits'));
    }

    public function unitCreate()
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.unit_create',compact('user','institution'));
    }

    public function unitStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Create unit
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $unit->institution_id = $institution->id;
        $unit->user_id = $user->id;
        $unit->save();

        return redirect()->route('business.unit.show',$unit->id)->withSuccess(__('Unit successfully created.'));
    }

    public function unitShow($unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get unit
        $unit = Unit::where('id',$unit_id)->with('status','user','products','product_groups')->first();

        return view('business.unit_show',compact('user','institution','unit'));
    }

    public function unitUpdate(Request $request, $unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Create unit
        $unit = Unit::findOrFail($unit_id);
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->user_id = $user->id;
        $unit->save();
        return back()->withSuccess(__('Unit '.$unit->name.' successfully updated.'));
    }

    public function unitDelete($unit_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // delete the unit
        $unit = Unit::findOrFail($unit_id);
        $unit->delete();

        return back()->withSuccess(__('Unit successfully deleted.'));
    }

    public function unitRestore($unit_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // restore the unit
        $unit = Unit::withTrashed()->findOrFail($unit_id);
        $unit->restore();
        return back()->withSuccess(__('Unit successfully restored.'));
    }
}
