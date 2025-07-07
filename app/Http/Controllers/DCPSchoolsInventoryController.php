<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\School;
use Illuminate\Http\Request;

class DCPSchoolsInventoryController extends Controller
{
    public function index()
    {

        $school_items = DCPBatchItem::all()->groupBy('dcp_batch_id');

        return view('AdminSide.SchoolsInventory.inventory', compact('school_items'));
    }

    public function inventory(Request $request)
    {
        $schools =  School::all();
        $selectedSchool = $request->input('school');
        $school_items = collect(); // always initialize

        if ($selectedSchool) {
            // If a specific school is selected
            $batches =  DCPBatch::with('dcpBatchItems', 'school')
                ->where('school_id', $selectedSchool)
                ->get();
        } else {
            // Otherwise, show all
            $batches =  DCPBatch::with('dcpBatchItems', 'school')->get();
        }

        // Transform for Blade view
        $school_items = $batches->map(function ($batch) {
            return [
                'batch_label' => $batch->batch_label,
                'school_name' => $batch->school->SchoolName ?? 'Unknown',
                'items' => $batch->dcpBatchItems ?? collect(), // fallback to empty collection
            ];
        });

        return view('AdminSide.SchoolsInventory.inventory', compact('schools', 'school_items', 'selectedSchool'));
    }
    public function showItems($code)
    {
        $items =  DCPBatchItem::where('generated_code', $code)->get();

        $batch = DCPBatch::where('pk_dcp_batches_id', $items[0]->dcp_batch_id)->first();
        $schoolName = School::where('pk_school_id', $batch->school_id)->value('SchoolName');
        $batchName = $batch->batch_label;
        $school_pk = $batch->school_id;
        return view('AdminSide.SchoolsInventory.inventory-item', compact('school_pk', 'items', 'batchName', 'schoolName'));
    }
}
