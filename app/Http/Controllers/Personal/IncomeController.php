<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function income()
    {
        return view('personal.income');
    }
    public function incomeCreate()
    {
        return view('personal.income_create');
    }
    public function incomeStore()
    {
        return back()->withStatus(__('Income successfully created.'));
    }
    public function incomeShow($income_id)
    {
        return view('personal.income_show');
    }
    public function incomeEdit($income_id)
    {
        return view('personal.income_show');
    }
    public function incomeUpdate($income_id)
    {
        return back()->withStatus(__('Income successfully updated.'));
    }
    public function incomeDelete($income_id)
    {
        return back()->withStatus(__('Income successfully deleted.'));
    }
}
