<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrowthController extends Controller
{
    // Investments
    public function investments()
    {
        return view('personal.investments');
    }
    public function investmentCreate()
    {
        return view('personal.investment_create');
    }
    public function investmentStore()
    {
        return back()->withSuccess(__('Investment successfully created.'));
    }
    public function investmentShow($investment_id)
    {
        return view('personal.investment_show');
    }
    public function investmentEdit($investment_id)
    {
        return view('personal.investment_show');
    }
    public function investmentUpdate($investment_id)
    {
        return back()->withSuccess(__('Investment successfully updated.'));
    }
    public function investmentInvest($investment_id)
    {
        return back()->withSuccess(__('Investment successfully invested into.'));
    }
    public function investmentWithdraw($investment_id)
    {
        return back()->withSuccess(__('Investment successfully withdrawn.'));
    }
    public function investmentClose($investment_id)
    {
        return back()->withSuccess(__('Investment successfully closed.'));
    }
    public function investmentDelete($investment_id)
    {
        return back()->withSuccess(__('Investment successfully deleted.'));
    }


    // Goals
    public function goals()
    {
        return view('personal.goals');
    }
    public function goalCreate()
    {
        return view('personal.goal_create');
    }
    public function goalStore()
    {
        return back()->withSuccess(__('Goal successfully created.'));
    }
    public function goalShow($goal_id)
    {
        return view('personal.goal_show');
    }
    public function goalEdit($goal_id)
    {
        return view('personal.goal_show');
    }
    public function goalUpdate($goal_id)
    {
        return back()->withSuccess(__('Goal successfully updated.'));
    }
    public function goalInvest($goal_id)
    {
        return back()->withSuccess(__('Goal successfully invested into.'));
    }
    public function goalWithdraw($goal_id)
    {
        return back()->withSuccess(__('Goal successfully withdrawn.'));
    }
    public function goalClose($goal_id)
    {
        return back()->withSuccess(__('Goal successfully closed.'));
    }
    public function goalDelete($goal_id)
    {
        return back()->withSuccess(__('Goal successfully deleted.'));
    }


    // Ways to save
    public function waysToSave()
    {
        return view('personal.ways_to_save');
    }

}
