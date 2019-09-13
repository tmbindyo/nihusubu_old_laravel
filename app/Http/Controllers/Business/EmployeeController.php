<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function employees()
    {
        return view('business.employees');
    }
    public function employeeCreate()
    {
        return view('business.employee_create');
    }
    public function employeeStore(Request $request)
    {
        return back()->withStatus(__('Employee successfully stored.'));
    }
    public function employeeShow($employee)
    {
        return view('business.employee_show');
    }
    public function employeeEdit($employee)
    {
        return view('business.employee_edit');
    }
    public function employeeUpdate(Request $request)
    {
        return back()->withStatus(__('Employee successfully updated.'));
    }
    public function employeeDelete($product_group_id)
    {
        return back()->withStatus(__('Employee successfully deleted.'));
    }
}
