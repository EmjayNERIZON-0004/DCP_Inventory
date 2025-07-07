<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemTypes;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolDCPBatchController extends Controller
{
    public function batch_item_list()
    {
        $batches = DB::table('dcp_batches')
            ->join('dcp_batch_items', 'dcp_batches.pk_dcp_batches_id', '=', 'dcp_batch_items.dcp_batch_id')
            ->select('dcp_batches.batch_label', 'dcp_batch_items.*')
            ->where('dcp_batches.school_id', Auth::guard('school')->user()->school->pk_school_id)
            ->get()
            ->groupBy('batch_label');

        // dd($batches);
        return view('SchoolSide.DCPBatch.BatchItemFolder', compact('batches'));
    }
    public function updateBatchStatus(Request $request, $batchId)
    {

        $school = Auth::guard('school')->user()->school;
        $validated = $request->validate([
            'iar_ref_code' => 'nullable|string|max:100',
            'iar_value' => 'nullable|string|max:100',
            'iar_date' => 'nullable|date',
            'iar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'itr_ref_code' => 'nullable|string|max:100',
            'itr_value' => 'nullable|string|max:100',
            'itr_date' => 'nullable|date',
            'itr_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate_of_completion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'coc_status' => 'nullable|string|max:50',
            'training_acceptance_status' => 'nullable|string|max:50',
            'training_acceptance_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'delivery_receipt_status' => 'nullable|string|max:50',
            'delivery_receipt_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'invoice_receipt_status' => 'nullable|string|max:50',
            'invoice_receipt_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        if ($request->iar_value == 'yes') {
            $validated['iar_value'] = 'with IAR';
        } else {
            $validated['iar_value'] = 'without IAR';
        }


        if ($request->itr_value == 'yes') {
            $validated['itr_value'] = 'with ITR';
        } else {
            $validated['itr_value'] = 'without ITR';
        }

        if ($request->hasFile('certificate_of_completion')) {
            $file = $request->file('certificate_of_completion');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/certificate-completion');
            $file->move($destination, $filename);
            $validated['certificate_of_completion'] =  $filename;
        }

        if ($request->hasFile('training_acceptance_file')) {
            $file = $request->file('training_acceptance_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/training-acceptance');
            $file->move($destination, $filename);
            $validated['training_acceptance_file'] =  $filename;
        }

        if ($request->hasFile('delivery_receipt_file')) {
            $file = $request->file('delivery_receipt_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/delivery-receipt');
            $file->move($destination, $filename);
            $validated['delivery_receipt_file'] =  $filename;
        }

        if ($request->hasFile('invoice_receipt_file')) {
            $file = $request->file('invoice_receipt_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/invoice-receipt');
            $file->move($destination, $filename);
            $validated['invoice_receipt_file'] =  $filename;
        }
        if ($request->hasFile('itr_file')) {
            $file = $request->file('itr_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/itr');
            $file->move($destination, $filename);
            $validated['itr_file'] =  $filename;
        }
        if ($request->hasFile('iar_file')) {
            $file = $request->file('iar_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = public_path('certificates/iar');
            $file->move($destination, $filename);
            $validated['iar_file'] =  $filename;
        }

        $batchItems = DCPBatchItem::where('dcp_batch_id', $batchId)->get();

        foreach ($batchItems as $item) {
            $item->update([
                'iar_ref_code' => $validated['iar_ref_code'] ?? null,
                'iar_value' => $validated['iar_value'] ?? null,
                'iar_date' => $validated['iar_date'] ?? null,
                'iar_file' => $validated['iar_file'] ?? null,

                'itr_ref_code' => $validated['itr_ref_code'] ?? null,
                'itr_value' => $validated['itr_value'] ?? null,
                'itr_date' => $validated['itr_date'] ?? null,
                'itr_file' => $validated['itr_file'] ?? null,

                'coc_status' => $validated['coc_status'] ?? null,
                'certificate_of_completion' => $validated['certificate_of_completion'] ?? null,

                'training_acceptance_status' => $validated['training_acceptance_status'] ?? null,
                'training_acceptance_file' => $validated['training_acceptance_file'] ?? null,

                'delivery_receipt_status' => $validated['delivery_receipt_status'] ?? null,
                'delivery_receipt_file' => $validated['delivery_receipt_file'] ?? null,

                'invoice_receipt_status' => $validated['invoice_receipt_status'] ?? null,
                'invoice_receipt_file' => $validated['invoice_receipt_file'] ?? null,
            ]);
        }



        return redirect()->route('school.dcp_inventory')->with('success', 'Batch status updated successfully.');
    }
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

        return view('SchoolSide.DCPBatch.Batch', compact('batch'));
    }

    public function items($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);

        $itemTypes = DCPItemTypes::all();
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->get();
        $conditions = DCPDeliveryCondintion::all();
        $batchStatus = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        $batch_approved = DCPBatchItem::where('dcp_batch_id', $batchId)->value('date_approved');
        $batchName = $batch->batch_label;

        return view('SchoolSide.DCPBatch.Items', compact('batchId', 'batchName', 'batch', 'items', 'itemTypes', 'conditions', 'batchId', 'batchStatus', 'batch_approved'));
    }

    public function itemStatus($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        // dd($batch);
        $itemTypes = DCPItemTypes::all();
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->get();
        $conditions = DCPDeliveryCondintion::all();
        $batchStatus = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        $batch_approved = DCPBatchItem::where('dcp_batch_id', $batchId)->value('date_approved');
        $batchName = $batch->batch_label;
        $batchDeliveryDate = $batch->delivery_date;


        return view('SchoolSide.DCPBatch.Status', compact('batchDeliveryDate',  'batchName', 'batch', 'items', 'itemTypes', 'conditions', 'batchId', 'batchStatus', 'batch_approved'));
    }
    public function showItems($code)
    {
        $items =   DCPBatchItem::where('generated_code', $code)->get();

        return view('SchoolSide.DCPInventory.ShowItems', compact('items'));
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
            // 'iar_ref_code' => 'nullable|string|max:100',
            // 'iar_value' => 'nullable|string|max:100',
            // 'iar_date' => 'nullable|date',
            // 'itr_value' => 'nullable|string|max:100',

            // 'itr_ref_code' => 'nullable|string|max:100',
            // 'itr_date' => 'nullable|date',
            // 'certificate_of_completion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
