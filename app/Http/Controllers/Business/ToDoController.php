<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToDoController extends Controller
{
    public function toDos()
    {
        return view('business.to_dos');
    }
    public function toDoStore()
    {
        return back()->withStatus(__('To do successfully stored.'));
    }
}
