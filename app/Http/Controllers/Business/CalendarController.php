<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToDo;

class CalendarController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar($portal)
    {
        // User
        $user = $this->getUser();
        // return $user;
        // Institution
        $institution = $this->getInstitution($portal);
        // to does
        $toDos = ToDo::with('user','status','assignee','institution','product','product_group','warehouse','sale')->where('institution_id',$institution->id)->where('user_id',$user->id)->where('is_institution',True)->get();
        return view('business.calendar',compact('user','institution','toDos'));

    }
}
