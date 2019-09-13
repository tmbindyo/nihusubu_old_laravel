<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaccoController extends Controller
{
    public function saccos()
    {
        return view('business.saccos');
    }
    public function saccoCreate()
    {
        return view('business.sacco_create');
    }
    public function saccoStore()
    {
        return back()->withStatus(__('Sacco successfully created.'));
    }
    public function saccoShow($sacco_id)
    {
        return view('business.sacco_show');
    }
    public function saccoEdit($sacco_id)
    {
        return view('business.sacco_show');
    }
    public function saccoUpdate($sacco_id)
    {
        return back()->withStatus(__('Sacco successfully updated.'));
    }
    public function saccoDelete($sacco_id)
    {
        return back()->withStatus(__('Sacco successfully deleted.'));
    }
}
