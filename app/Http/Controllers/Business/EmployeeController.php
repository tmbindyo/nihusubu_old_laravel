<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function employees()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employees',compact('user','institution'));
    }
    public function employeeCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employee_create',compact('user','institution'));
    }
    public function employeeStore(Request $request)
    {
        return back()->withStatus(__('Employee successfully stored.'));
    }
    public function employeeShow($employee_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employee_show',compact('user','institution'));
    }
    public function employeeEdit($employee_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employee_edit',compact('user','institution'));
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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.leave',compact('user','institution'));
    }
    public function leaveCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.leave_create',compact('user','institution'));
    }
    public function leaveStore(Request $request)
    {
        return back()->withStatus(__('Leave successfully stored.'));
    }
    public function leaveShow($leave_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.leave_show',compact('user','institution'));
    }
    public function leaveEdit($leave_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.leave_edit',compact('user','institution'));
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
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payroll',compact('user','institution'));
    }
    public function payrollHistory()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payroll_history',compact('user','institution'));
    }
    public function employeePayrollHistory()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employee_payroll_history',compact('user','institution'));
    }
    public function payrollAnnualSalaryStatement()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payroll_annual_salary_statement',compact('user','institution'));
    }
    public function payrollProcess()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payroll_process',compact('user','institution'));
    }
    public function payrollProcessPayment()
    {
        return back()->withStatus(__('Payroll successfully processed.'));
    }
    public function payrollSalaryAdjustment()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.payroll_salary_adjustment',compact('user','institution'));
    }

    public function employer()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.employer',compact('user','institution'));
    }

    public function humanResourceSettings()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.human_resource_settings',compact('user','institution'));
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
