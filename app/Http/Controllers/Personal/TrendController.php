<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrendController extends Controller
{

    public function analysis()
    {
        return view('personal.analysis');
    }
    public function analysisBreakDown()
    {
        return view('personal.analysis_breakdown');
    }

    public function cashFlow()
    {
        return view('personal.cash_flow');
    }
    public function cashFlowBreakDown()
    {
        return view('personal.cash_flow_breakdown');
    }


}
