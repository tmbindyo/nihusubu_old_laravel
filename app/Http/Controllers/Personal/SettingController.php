<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    // Family
    public function family()
    {
        return view('business.family');
    }
    public function familyCreate()
    {
        return view('business.family_create');
    }
    public function familyStore()
    {
        return back()->withSuccess(__('Family successfully created.'));
    }
    public function familyMemberShow($family_id)
    {
        return view('business.family_show');
    }
    public function familyMemberEdit($family_id)
    {
        return view('business.family_show');
    }
    public function familyMemberUpdate($family_id)
    {
        return back()->withSuccess(__('Family member successfully updated.'));
    }
    public function familyMemberDelete($family_id)
    {
        return back()->withSuccess(__('Family member successfully deleted.'));
    }


    public function commitments()
    {
        return view('personal.commitments');
    }
    public function commitmentCreate()
    {
        return view('personal.commitment_create');
    }
    public function commitmentStore()
    {
        return back()->withSuccess(__('Commitment successfully created.'));
    }
    public function commitmentShow($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentEdit($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentUpdate($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully updated.'));
    }
    public function commitmentDelete($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully deleted.'));
    }
}
