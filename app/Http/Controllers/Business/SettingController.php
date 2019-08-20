<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function organizationProfile()
    {
        return view('business.organization.profile');
    }
    public function openingBalances()
    {
        return view('business.opening_balances');
    }
    public function usersAndRoles()
    {
        return view('business.users_and_roles');
    }
    public function currencies()
    {
        return view('business.currencies');
    }
    public function taxes()
    {
        return view('business.taxes');
    }
    public function emails()
    {
        return view('business.emails');
    }
    public function reminders()
    {
        return view('business.reminders');
    }
}
