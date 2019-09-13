<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaccoController extends Controller
{
    public function saccos()
    {
        return view('personal.saccos');
    }
    public function saccoCreate()
    {
        return view('personal.sacco_create');
    }
    public function saccoStore()
    {
        return back()->withStatus(__('Sacco successfully created.'));
    }
    public function saccoShow($sacco_id)
    {
        return view('personal.sacco_show');
    }
    public function saccoContributions($sacco_id)
    {
        return view('personal.sacco_contributions');
    }
    public function saccoContributionShow($contribution_id)
    {
        return view('personal.sacco_contribution_show');
    }
    public function saccoContributionCreate($sacco_id)
    {
        return view('personal.sacco_contribution_create');
    }
    public function saccoContributionStore($sacco_id)
    {
        return back()->withStatus(__('Sacco contribution successfully created.'));
    }
    public function saccoContributionUpdate($contribution_id)
    {
        return back()->withStatus(__('Sacco contribution successfully updated.'));
    }
    public function saccoContributionDelete($contribution_id)
    {
        return back()->withStatus(__('Sacco contribution successfully deleted.'));
    }

    public function saccoMembers($sacco_id)
    {
        return view('personal.sacco_members');
    }
    public function saccoMemberShow($member_id)
    {
        return view('personal.sacco_member_show');
    }
    public function saccoMemberCreate($sacco_id)
    {
        return view('personal.sacco_member_create');
    }
    public function saccoMemberStore($sacco_id)
    {
        return back()->withStatus(__('Sacco member successfully created.'));
    }
    public function saccoMemberUpdate($member_id)
    {
        return back()->withStatus(__('Sacco member successfully updated.'));
    }
    public function saccoMemberDelete($member_id)
    {
        return back()->withStatus(__('Sacco member successfully deleted.'));
    }


    public function saccoLoans($sacco_id)
    {
        return view('personal.sacco_loans');
    }
    public function saccoLoanShow($loan_id)
    {
        return view('personal.sacco_loan_show');
    }
    public function saccoLoanRequest($sacco_id)
    {
        return back()->withStatus(__('Sacco loan successfully requested.'));
    }
    public function saccoLoanAccept($sacco_id)
    {
        return back()->withStatus(__('Sacco loan successfully accepted.'));
    }
    public function saccoLoanReject($sacco_id)
    {
        return back()->withStatus(__('Sacco loan successfully rejected.'));
    }
    public function saccoLoanCreate($sacco_id)
    {
        return view('personal.sacco_loan_create');
    }
    public function saccoLoanStore($sacco_id)
    {
        return back()->withStatus(__('Sacco loan successfully created.'));
    }
    public function saccoLoanUpdate($loan_id)
    {
        return back()->withStatus(__('Sacco loan successfully updated.'));
    }
    public function saccoLoanPayment($loan_id)
    {
        return back()->withStatus(__('Sacco loan successfully paid.'));
    }
    public function saccoLoanWaiver($loan_id)
    {
        return back()->withStatus(__('Sacco loan successfully waiver.'));
    }
    public function saccoLoanDefault($loan_id)
    {
        return back()->withStatus(__('Sacco loan successfully defaulted.'));
    }
    public function saccoLoanDelete($loan_id)
    {
        return back()->withStatus(__('Sacco loan successfully deleted.'));
    }

    public function saccoReconciliations($sacco_id)
    {
        return view('personal.sacco_reconciliations');
    }
    public function saccoReconciliationCreate($sacco_id)
    {
        return view('personal.sacco_reconciliations');
    }
    public function saccoReconciliationStore($sacco_id)
    {
        return view('personal.sacco_reconciliations');
    }
    public function saccoReconciliationUpdate($reconciliation_id)
    {
        return back()->withStatus(__('Sacco loan successfully updated.'));
    }
    public function saccoReconciliationDelete($reconciliation_id)
    {
        return back()->withStatus(__('Sacco loan successfully deleted.'));
    }

    public function saccoEdit($sacco_id)
    {
        return view('personal.sacco_show');
    }
    public function saccoUpdate($sacco_id)
    {
        return back()->withStatus(__('Sacco successfully updated.'));
    }
    public function saccoDelete($sacco_id)
    {
        return back()->withStatus(__('Sacco successfully deleted.'));
    }
}
