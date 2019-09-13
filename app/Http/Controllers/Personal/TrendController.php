<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrendController extends Controller
{

    public function analysis()
    {
        return view('business.analysis');
    }
    public function analysisBreakDown()
    {
        return view('business.analysis_breakdown');
    }

    public function cashFlow()
    {
        return view('business.cash_flow');
    }
    public function cashFlowBreakDown()
    {
        return view('business.cash_flow_breakdown');
    }


}
