<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentDocument;
use Illuminate\Http\Request;

class SchoolEquipmentDocumentController extends Controller
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
            'school_equipment_id' => 'required|exists:school_equipment,id',
            'document_type_id' => 'required|integer|exists:school_equipment_document_types,id',
            'document_number' => 'required|string|max:255',
        ]);
        $document = SchoolEquipmentDocument::create($validated);
        if ($document) {
            return redirect()->back()->with('success', 'Document added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add document.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolEquipmentDocument $schoolEquipmentDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentDocument $schoolEquipmentDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'document_type_id' => 'required|integer|exists:school_equipment_document_types,id',
            'document_number' => 'required|string|max:255',
        ]);
        $document = SchoolEquipmentDocument::findOrFail($id);
        $document->update($validated);
        if ($document) {
            return redirect()->back()->with('success', 'Document updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update document.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = SchoolEquipmentDocument::findOrFail($id);
        $remove_document = $document->delete();

        if ($remove_document) {

            return redirect()->back()->with('success', 'Document deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete document.');
        }
    }
}
