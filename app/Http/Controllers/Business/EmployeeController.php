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
    public function employeeShow($employee_id)
    {
        return view('business.employee_show');
    }
    public function employeeEdit($employee_id)
    {
        return view('business.employee_edit');
    }
    public function employeeUpdate(Request $request)
    {
        return back()->withStatus(__('Employee successfully updated.'));
    }
    public function employeeDelete($employee_id)
    {
        return back()->withStatus(__('Employee successfully deleted.'));
    }

    public function leave()
    {
        return view('business.leave');
    }
    public function leaveCreate()
    {
        return view('business.leave_create');
    }
    public function leaveStore(Request $request)
    {
        return back()->withStatus(__('Leave successfully stored.'));
    }
    public function leaveShow($leave_id)
    {
        return view('business.leave_show');
    }
    public function leaveEdit($leave_id)
    {
        return view('business.leave_edit');
    }
    public function leaveUpdate(Request $request)
    {
        return back()->withStatus(__('Leave successfully updated.'));
    }
    public function leaveDelete($leave_id)
    {
        return back()->withStatus(__('Leave successfully deleted.'));
    }

    public function payroll()
    {
        return view('business.payroll');
    }
    public function payrollHistory()
    {
        return view('business.payroll_history');
    }
    public function employeePayrollHistory()
    {
        return view('business.employee_payroll_history');
    }
    public function payrollAnnualSalaryStatement()
    {
        return view('business.payroll_annual_salary_statement');
    }
    public function payrollProcess()
    {
        return view('business.payroll_process');
    }
    public function payrollProcessPayment()
    {
        return back()->withStatus(__('Payroll successfully processed.'));
    }
    public function payrollSalaryAdjustment()
    {
        return view('business.payroll_salary_adjustment');
    }

    public function employer()
    {
        return view('business.employer');
    }

    public function humanResourceSettings()
    {
        return view('business.human_resource_settings');
    }

    public function workdaysUpdate()
    {
        return back()->withStatus(__('Workday successfully updated.'));
    }

    public function holidayStore()
    {
        return back()->withStatus(__('Holiday successfully created.'));
    }
    public function holidayUpdate()
    {
        return back()->withStatus(__('Holiday successfully updated.'));
    }
    public function holidayDelete()
    {
        return back()->withStatus(__('Holiday successfully deleted.'));
    }

    public function leaveTypeStore()
    {
        return back()->withStatus(__('Leave Type successfully created.'));
    }
    public function leaveTypeUpdate()
    {
        return back()->withStatus(__('Leave Type successfully updated.'));
    }
    public function leaveTypeDelete()
    {
        return back()->withStatus(__('Leave Type successfully deleted.'));
    }

    public function earningPolicyStore()
    {
        return back()->withStatus(__('Earning policy successfully created.'));
    }
    public function earningPolicyUpdate()
    {
        return back()->withStatus(__('Earning policy successfully updated.'));
    }
    public function earningPolicyDelete()
    {
        return back()->withStatus(__('Earning policy successfully deleted.'));
    }
}
