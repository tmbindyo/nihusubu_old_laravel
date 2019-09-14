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
    public function chartOfAccountsStore()
    {
        return back()->withSuccess('Chart of account successfully created!');
    }
    public function chartOfAccountsUpdate()
    {
        return back()->withSuccess('Chart of account successfully updated!');
    }
    public function chartOfAccountsDeleted()
    {
        return back()->withSuccess('Chart of account successfully deleted!');
    }


    public function manualJournals()
    {
        return view('business.manual_journals');
    }
    public function manualJournalsStore()
    {
        return back()->withSuccess('Manual journal successfully created!');
    }
    public function manualJournalsUpdate()
    {
        return back()->withSuccess('Manual journal successfully updated!');
    }
    public function manualJournalsDeleted()
    {
        return back()->withSuccess('Manual journal successfully deleted!');
    }
}
