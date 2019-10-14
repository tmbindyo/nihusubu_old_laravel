<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountingController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function chartOfAccounts()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.chart_of_accounts',compact('user','institution'));
    }
    public function chartOfAccountStore()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Chart of account successfully created!');
    }
    public function chartOfAccountUpdate($chart_of_account_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Chart of account successfully updated!');
    }
    public function chartOfAccountDelete($chart_of_account_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Chart of account successfully deleted!');
    }


    public function manualJournals()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return view('business.manual_journals',compact('user','institution'));
    }
    public function manualJournalStore()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Manual journal successfully created!');
    }
    public function manualJournalUpdate($manual_journal_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Manual journal successfully updated!');
    }
    public function manualJournalDelete($manual_journal_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        return back()->withSuccess('Manual journal successfully deleted!');
    }
}
