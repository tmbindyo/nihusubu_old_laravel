<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function calendar()
    {
        return view('business.calendar');
    }
    public function calendarSave()
    {
        return back()->withSuccess('Calender entry successfully created!');
    }
}
