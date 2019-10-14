<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function calendar()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.calendar',compact('user','institution'));
    }
    public function calendarStore()
    {
        return back()->withSuccess('Calender entry successfully created!');
    }
}
