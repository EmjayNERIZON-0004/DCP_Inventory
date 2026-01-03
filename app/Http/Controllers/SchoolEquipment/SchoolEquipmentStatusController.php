<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentStatus;
use Illuminate\Http\Request;

class SchoolEquipmentStatusController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = SchoolEquipmentStatus::with(['equipmentCondition', 'dispositionStatus'])->where('school_equipment_id', $id)->first();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentStatus $schoolEquipmentStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolEquipmentStatus $schoolEquipmentStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolEquipmentStatus $schoolEquipmentStatus)
    {
        //
    }
}
