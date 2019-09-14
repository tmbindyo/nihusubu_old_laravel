<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountingController extends Controller
{
    public function chartOfAccounts()
    {
        return view('business.chart_of_accounts');
    }
    public function chartOfAccountStore()
    {
        return back()->withSuccess('Chart of account successfully created!');
    }
    public function chartOfAccountUpdate($chart_of_account_id)
    {
        return back()->withSuccess('Chart of account successfully updated!');
    }
    public function chartOfAccountDelete($chart_of_account_id)
    {
        return back()->withSuccess('Chart of account successfully deleted!');
    }


    public function manualJournals()
    {
        return view('business.manual_journals');
    }
    public function manualJournalStore()
    {
        return back()->withSuccess('Manual journal successfully created!');
    }
    public function manualJournalUpdate($manual_journal_id)
    {
        return back()->withSuccess('Manual journal successfully updated!');
    }
    public function manualJournalDelete($manual_journal_id)
    {
        return back()->withSuccess('Manual journal successfully deleted!');
    }
}
