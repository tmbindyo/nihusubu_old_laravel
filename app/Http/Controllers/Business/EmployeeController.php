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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employees($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employees',compact('user','institution'));
    }
    public function employeeCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employee_create',compact('user','institution'));
    }
    public function employeeStore(Request $request, $portal)
    {
        return back()->withStatus(__('Employee successfully stored.'));
    }
    public function employeeShow($portal, $employee_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employee_show',compact('user','institution'));
    }
    public function employeeEdit($portal, $employee_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employee_edit',compact('user','institution'));
    }
    public function employeeUpdate(Request $request, $portal)
    {
        return back()->withStatus(__('Employee successfully updated.'));
    }
    public function employeeDelete($portal, $employee_id)
    {
        return back()->withStatus(__('Employee successfully deleted.'));
    }

    public function leave($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.leave',compact('user','institution'));
    }
    public function leaveCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.leave_create',compact('user','institution'));
    }
    public function leaveStore(Request $request, $portal)
    {
        return back()->withStatus(__('Leave successfully stored.'));
    }
    public function leaveShow($portal, $leave_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.leave_show',compact('user','institution'));
    }
    public function leaveEdit($portal, $leave_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.leave_edit',compact('user','institution'));
    }
    public function leaveUpdate(Request $request, $portal)
    {
        return back()->withStatus(__('Leave successfully updated.'));
    }
    public function leaveDelete($portal, $leave_id)
    {
        return back()->withStatus(__('Leave successfully deleted.'));
    }

    public function payroll($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.payroll',compact('user','institution'));
    }
    public function payrollHistory($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.payroll_history',compact('user','institution'));
    }
    public function employeePayrollHistory($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employee_payroll_history',compact('user','institution'));
    }
    public function payrollAnnualSalaryStatement($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.payroll_annual_salary_statement',compact('user','institution'));
    }
    public function payrollProcess($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.payroll_process',compact('user','institution'));
    }
    public function payrollProcessPayment($portal)
    {
        return back()->withStatus(__('Payroll successfully processed.'));
    }
    public function payrollSalaryAdjustment($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.payroll_salary_adjustment',compact('user','institution'));
    }

    public function employer($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.employer',compact('user','institution'));
    }

    public function humanResourceSettings($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.human_resource_settings',compact('user','institution'));
    }

    public function workdaysUpdate($portal)
    {
        return back()->withStatus(__('Workday successfully updated.'));
    }

    public function holidayStore($portal)
    {
        return back()->withStatus(__('Holiday successfully created.'));
    }
    public function holidayUpdate($portal)
    {
        return back()->withStatus(__('Holiday successfully updated.'));
    }
    public function holidayDelete($portal)
    {
        return back()->withStatus(__('Holiday successfully deleted.'));
    }

    public function leaveTypeStore($portal)
    {
        return back()->withStatus(__('Leave Type successfully created.'));
    }
    public function leaveTypeUpdate($portal)
    {
        return back()->withStatus(__('Leave Type successfully updated.'));
    }
    public function leaveTypeDelete($portal)
    {
        return back()->withStatus(__('Leave Type successfully deleted.'));
    }

    public function earningPolicyStore($portal)
    {
        return back()->withStatus(__('Earning policy successfully created.'));
    }
    public function earningPolicyUpdate($portal)
    {
        return back()->withStatus(__('Earning policy successfully updated.'));
    }
    public function earningPolicyDelete($portal)
    {
        return back()->withStatus(__('Earning policy successfully deleted.'));
    }
}
