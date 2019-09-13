<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToDoController extends Controller
{
    public function toDos()
    {
        return view('personal.to_dos');
    }
    public function toDoStore()
    {
        return back()->withStatus(__('To do successfully stored.'));
    }
}
