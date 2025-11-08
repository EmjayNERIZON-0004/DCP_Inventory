<?php

namespace App\Http\Controllers;

use App\Models\SchoolEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolEmployeeController extends Controller
{
    public function index()
    {
        $employee = SchoolEmployee::where('school_id', Auth::guard('school')->user()->pk_school_id)->get();

        return view('SchoolSide.Employee.index', compact('employee'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'employee_number' => 'required|string|max:50|unique:schools_employee,employee_number',
            'position_title_id' => 'required|integer',
            'salary_grade' => 'required|integer',
            'sex' => 'required|string',
            'deped_email' => 'required|email|unique:schools_employee,deped_email',
            'deped_email_status' => 'required|string',
            'm365_email_status' => 'required|string',
            'canva_login_status' => 'required|string',
            'lr_portal_status' => 'required|string',
            'l4t_recipient' => 'required|string',
            'smart_tv_recipient' => 'required|string',
            'l4nt_recipient' => 'required|string',

        ]);
        $validated['school_id'] = Auth::guard('school')->user()->pk_school_id;
        $employee = SchoolEmployee::create($validated);
        if ($employee) {
            return back()->with('success', 'Employee added successfully.');
        } else {
            return back()->with('error', 'Failed to add employee. Please try again.');
        }
    }
    public function update(Request $request)
    {

        $validated = $request->validate([
            'primary_key' => 'required|integer',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'employee_number' => 'required|string|max:50',
            'position_title_id' => 'required|integer',
            'salary_grade' => 'required|integer',
            'sex' => 'required|string',
            'deped_email' => 'required|email ',
            'deped_email_status' => 'required|string',
            'm365_email_status' => 'required|string',
            'canva_login_status' => 'required|string',
            'lr_portal_status' => 'required|string',
            'l4t_recipient' => 'required|string',
            'smart_tv_recipient' => 'required|string',
            'l4nt_recipient' => 'required|string',
        ]);
        $employee = SchoolEmployee::where('pk_schools_employee_id', $validated['primary_key'])->first();
        if ($employee) {
            $employee->update($validated);
            return back()->with('success', 'Employee updated successfully.');
        } else {
            return back()->with('error', 'Failed to update employee. Please try again.');
        }
    }
    public function get_data()
    {
        $school_id = Auth::guard('school')->user()->school->pk_school_id;
        $active_deped_email = SchoolEmployee::where('school_id', $school_id)
            ->where('deped_email_status', 'Active')->count();
        $inactive_deped_email = SchoolEmployee::where('school_id', $school_id)
            ->where('deped_email_status', 'Inctive')->count();
        $m365_email_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('m365_email_status', 'Active')->count();
        $m365_email_status_inactive = SchoolEmployee::where('school_id', $school_id)
            ->where('m365_email_status', 'Inactive')->count();
        $canva_login_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('canva_login_status', 'Active')->count();
        $canva_login_status_inactive = SchoolEmployee::where('school_id', $school_id)
            ->where('canva_login_status', 'Inactive')->count();
        $lr_portal_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('lr_portal_status', 'Active')->count();
        $lr_portal_status_iactive = SchoolEmployee::where('school_id', $school_id)
            ->where('lr_portal_status', 'Inactive')->count();
        $l4t_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('l4t_recipient', 'Yes')->count();
        $smart_tv_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('smart_tv_recipient', 'Yes')->count();
        $l4nt_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('l4nt_recipient', 'Yes')->count();
        $employees = SchoolEmployee::where('school_id', $school_id)->count();
        return response()->json([
            'active_deped_email' => $active_deped_email,
            'inactive_deped_email' => $inactive_deped_email,
            'm365_email_status_active' => $m365_email_status_active,
            'm365_email_status_inactive' => $m365_email_status_inactive,
            'canva_login_status_active' => $canva_login_status_active,
            'canva_login_status_inactive' => $canva_login_status_inactive,
            'lr_portal_status_active' => $lr_portal_status_active,
            'lr_portal_status_iactive' => $lr_portal_status_iactive,
            'l4t_recipient' => $l4t_recipient,
            'smart_tv_recipient' => $smart_tv_recipient,
            'l4nt_recipient' => $l4nt_recipient,
            'employees' => $employees,
        ]);
    }
    public function destroy($id)
    {
        $employee = SchoolEmployee::findOrFail($id);
        $employee->delete();
        return response()->json([
            'success' => true,
            'message' => 'Employee Information removed successfully!',
        ]);
    }
}
