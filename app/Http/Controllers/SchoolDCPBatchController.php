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
        $item->update($request->only(['brand', 'serial_number', 'condition_id']));
        return back()->with('success', 'Item updated!');
    }
}
