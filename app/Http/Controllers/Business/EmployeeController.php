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

    public function attendance()
    {
        return view('business.attendance');
    }
    public function attendanceCreate()
    {
        return view('business.attendance_create');
    }
    public function attendanceStore(Request $request)
    {
        return back()->withStatus(__('Attendance successfully stored.'));
    }
    public function attendanceShow($attendance_id)
    {
        return view('business.attendance_show');
    }
    public function attendanceEdit($attendance_id)
    {
        return view('business.attendance_edit');
    }
    public function attendanceUpdate(Request $request)
    {
        return back()->withStatus(__('Attendance successfully updated.'));
    }
    public function attendanceDelete($attendance_id)
    {
        return back()->withStatus(__('Attendance successfully deleted.'));
    }

    public function documentWorkflow()
    {
        return view('business.document_workflow');
    }
    public function documentWorkflowCreate()
    {
        return view('business.document_workflow_create');
    }
    public function documentWorkflowStore(Request $request)
    {
        return back()->withStatus(__('Document workflow successfully stored.'));
    }
    public function documentWorkflowShow($document_workflow_id)
    {
        return view('business.document_workflow_show');
    }
    public function documentWorkflowEdit($document_workflow_id)
    {
        return view('business.document_workflow_edit');
    }
    public function documentWorkflowUpdate(Request $request)
    {
        return back()->withStatus(__('Document workflow successfully updated.'));
    }
    public function documentWorkflowDelete($document_workflow_id)
    {
        return back()->withStatus(__('Document workflow successfully deleted.'));
    }

    public function teams()
    {
        return view('business.teams');
    }
    public function teamCreate()
    {
        return view('business.team_create');
    }
    public function teamStore(Request $request)
    {
        return back()->withStatus(__('Team successfully stored.'));
    }
    public function teamShow($team_id)
    {
        return view('business.team_show');
    }
    public function teamEdit($team_id)
    {
        return view('business.team_edit');
    }
    public function teamUpdate(Request $request)
    {
        return back()->withStatus(__('Team successfully updated.'));
    }
    public function teamDelete($team_id)
    {
        return back()->withStatus(__('Team successfully deleted.'));
    }

    public function payroll()
    {
        return view('business.payroll');
    }
    public function payrollCreate()
    {
        return view('business.payroll_create');
    }
    public function payrollStore(Request $request)
    {
        return back()->withStatus(__('Payroll successfully stored.'));
    }
    public function payrollShow($payroll_id)
    {
        return view('business.payroll_show');
    }
    public function payrollEdit($payroll_id)
    {
        return view('business.payroll_edit');
    }
    public function payrollUpdate(Request $request)
    {
        return back()->withStatus(__('Payroll successfully updated.'));
    }
    public function payrollDelete($payroll_id)
    {
        return back()->withStatus(__('Payroll successfully deleted.'));
    }

    public function employer()
    {
        return view('business.employer');
    }

    public function humanResourceSettings()
    {
        return view('business.human_resource_settings');
    }
}
