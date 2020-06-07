<?php

namespace App\Http\Controllers\Personal;

use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToDo;

class CalendarController extends Controller
{
    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar()
    {
        // User
        $user = $this->getUser();
        // to does
        $toDos = ToDo::with('user', 'status', 'assignee', 'product', 'productGroup', 'warehouse', 'sale')->where('is_user', true)->where('user_id',$user->id)->get();
        return view('personal.calendar',compact('user', 'toDos'));

    }
}
