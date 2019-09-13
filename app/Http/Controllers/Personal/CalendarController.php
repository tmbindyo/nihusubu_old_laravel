<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function calendar()
    {
        return view('personal.calendar');
    }
    public function calendarStore()
    {
        return back()->withSuccess('Calender entry successfully created!');
    }
}
