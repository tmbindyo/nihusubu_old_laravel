<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
