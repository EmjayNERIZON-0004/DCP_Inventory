<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolDCPBatchController extends Controller
{
   public function index()
   {

     $school = Auth::guard('school')->user()->school;
        $batch = DB::table('dcp_batches')
            ->join('dcp_package_types', 'dcp_batches.dcp_package_type_id', '=', 'dcp_package_types.pk_dcp_package_types_id')
            ->join('schools', 'dcp_batches.school_id', '=', 'schools.pk_school_id')
            ->select(
                'dcp_batches.*',
                'dcp_package_types.name as package_type_name',
                'schools.SchoolName as school_name',
                'schools.SchoolLevel as school_level',
                'schools.SchoolID as school_id',
                'dcp_batches.pk_dcp_batches_id as id'
            )
             ->where('dcp_batches.school_id', $school->pk_school_id) // Only batches for this school
            ->orderBy('dcp_batches.created_at', 'desc')
            ->get();  
    
       return view('SchoolSide.DCPBatch.Batch',compact('batch'));
   }

     public function items($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        
        $itemTypes = DCPItemTypes::all();
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->get();
        $conditions = DCPDeliveryCondintion::all();
       

        return view('SchoolSide.DCPBatch.Items', compact('batch', 'items', 'itemTypes','conditions'));
    }
    
    public function updateItem(Request $request, $itemId)
    {
        $item = DCPBatchItem::findOrFail($itemId);

        $validated = $request->validate([
            'unit' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer',
            'condition_id' => 'nullable|integer',
            'brand' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'iar_ref_code' => 'nullable|string|max:100',
            'iar_value' => 'nullable|string|max:100',
            'iar_date' => 'nullable|date',
            'itr_value' => 'nullable|string|max:100',

            'itr_ref_code' => 'nullable|string|max:100',
            'itr_date' => 'nullable|date',
            'certificate_of_completion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'date_approved' => 'nullable|date',
        ]);

        // Handle file upload if present
         if ($request->hasFile('certificate_of_completion')) {
        $file = $request->file('certificate_of_completion');
        $filename = date('d-m-Y') . '_' . $file->getClientOriginalName();
        $destination = public_path('certificates');
        $file->move($destination, $filename);
        $validated['certificate_of_completion'] =  $filename;
    }

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully!',
            'data' => $item
        ]);

    }
}
