<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentAccountabilty;
use Illuminate\Http\Request;

class SchoolEquipmentAccountabiltyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_type_id' => 'required|integer',
            'school_equipment_id' => 'required|integer',
            'accountable_employee_id' => 'required|integer',
            'date_assigned_to_accountable_employee' => 'required|date',

            'receiver_type_id' => 'nullable|integer',
            'date_received' => 'nullable|date',

            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'date_assigned' => 'nullable|date',

        ]);
        $school_equipment_accountability = SchoolEquipmentAccountabilty::create([
            'transaction_type_id' => $validated['transaction_type_id'],
            'school_equipment_id' => $validated['school_equipment_id'],
            'accountable_employee_id' => $validated['accountable_employee_id'],
            'date_assigned_to_accountable_employee' => $validated['date_assigned_to_accountable_employee'],
            'receiver_type_id' => $validated['receiver_type_id'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
        ]);
        // Create end user record
        $school_equipment_accountability->endUser()->create([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'suffix' => $validated['suffix'] ?? null,
            'date_assigned' => $validated['date_assigned'] ?? null,
        ]);
        if ($school_equipment_accountability) {
            return redirect()->back()->with('success', 'School Equipment Accountability created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create School Equipment Accountability.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $school_equipment_accountability = SchoolEquipmentAccountabilty::with([
            'accountableEmployee',
            'schoolEquipment',
            'transactionType',
            'endUser',
            'receiverType'
        ])->where('school_equipment_id', $id)->first();

        return response()->json(['success' => true, 'data' => $school_equipment_accountability]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentAccountabilty $schoolEquipmentAccountabilty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'transaction_type_id' => 'required|integer',
            'school_equipment_id' => 'required|integer',
            'accountable_employee_id' => 'required|integer',
            'date_assigned_to_accountable_employee' => 'required|date',

            'receiver_type_id' => 'nullable|integer',
            'date_received' => 'nullable|date',

            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'date_assigned' => 'nullable|date',
        ]);

        // Find the main record by ID
        $schoolEquipmentAccountability = SchoolEquipmentAccountabilty::findOrFail($id);

        // Update main accountability record
        $schoolEquipmentAccountability->update([
            'transaction_type_id' => $validated['transaction_type_id'],
            'school_equipment_id' => $validated['school_equipment_id'],
            'accountable_employee_id' => $validated['accountable_employee_id'],
            'date_assigned_to_accountable_employee' => $validated['date_assigned_to_accountable_employee'],
            'receiver_type_id' => $validated['receiver_type_id'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
        ]);

        // Update associated end user
        $schoolEquipmentAccountability->endUser()->update([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'suffix' => $validated['suffix'] ?? null,
            'date_assigned' => $validated['date_assigned'] ?? null,
        ]);
        if (!$schoolEquipmentAccountability) {
            return redirect()->back()->with('error', 'Failed to update School Equipment Accountability.');
        }
        return redirect()->back()->with('success', 'School Equipment Accountability updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolEquipmentAccountabilty $schoolEquipmentAccountabilty)
    {
        //
    }
}
