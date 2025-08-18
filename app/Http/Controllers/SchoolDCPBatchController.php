<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPCurrentCondition;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemAssignedLocation;
use App\Models\DCPItemAssignedUser;
use App\Models\DCPItemBrand;
use App\Models\DCPItemCondition;
use App\Models\DCPItemTypes;
use App\Models\School;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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



        return redirect()->back()->with('success', 'Batch Information submitted successfully.');
    }
    public function index()
    {

        $school = Auth::guard('school')->user()->school;
        $batch = DB::table('dcp_batches')
            ->join('dcp_package_types', 'dcp_batches.dcp_package_type_id', '=', 'dcp_package_types.pk_dcp_package_types_id')
            ->join('schools', 'dcp_batches.school_id', '=', 'schools.pk_school_id')
            ->leftJoin('dcp_batch_approval', 'dcp_batch_approval.dcp_batches_id', "=", 'dcp_batches.pk_dcp_batches_id')

            ->select(
                'dcp_batches.*',
                'dcp_package_types.name as package_type_name',
                'schools.SchoolName as school_name',
                'schools.SchoolLevel as school_level',
                'schools.SchoolID as school_id',
                'dcp_batches.pk_dcp_batches_id as id',
                'dcp_batch_approval.status as status_submitted',
                'dcp_batch_approval.submitted_at'
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
        $brand_list = DCPBatchItemBrand::all();
        return view('SchoolSide.DCPBatch.Items', compact('batchId', 'brand_list', 'batchName', 'batch', 'items', 'itemTypes', 'conditions', 'batchId', 'batchStatus', 'batch_approved'));
    }
    public function warranty($batchItemId)
    {
        $batchItem = DCPBatchItem::findOrFail($batchItemId);
        $warranties = $batchItem->dcpItemWarranties;
        // dd($warranties);
        return view('SchoolSide.DCPBatch.Warranty', compact('batchItem', 'warranties'));
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
    public function assigned_for_items(Request $request)
    {
        $request->validate([
            'pk_dcp_batch_items_id' => 'required|integer',
            'assigned_user_type_id' => 'required|integer',
            'assigned_user_name' => 'required|string|max:255',
            'assigned_user_location_id' => 'nullable|integer',
        ]);

        $item = DCPBatchItem::findOrFail($request->pk_dcp_batch_items_id);
        $batch_delivery_date = $item->dcpBatch->delivery_date;

        // Update or create assigned user
        $assignedUser = DCPItemAssignedUser::where('dcp_batch_item_id', $item->pk_dcp_batch_items_id)->first();

        if ($assignedUser) {
            $assignedUser->update([
                'assignment_type_id' => $request->assigned_user_type_id,
                'assigned_user_name' => $request->assigned_user_name,
                'date_assigned' => $batch_delivery_date,
            ]);
        } else {
            $item->dcpAssignedUsers()->create([
                'assignment_type_id' => $request->assigned_user_type_id,
                'assigned_user_name' => $request->assigned_user_name,
                'date_assigned' => $batch_delivery_date,
            ]);
        }

        // Update or create assigned location
        $assignedLocation = DCPItemAssignedLocation::where('dcp_batch_item_id', $item->pk_dcp_batch_items_id)->first();

        if ($assignedLocation) {
            $assignedLocation->update([
                'assigned_location_id' => $request->assigned_user_location_id,
            ]);
        } else {
            $item->dcpBatchItemLocation()->create([
                'assigned_location_id' => $request->assigned_user_location_id,
            ]);
        }

        return redirect()->back()->with('success', 'Item assignment updated successfully.');
    }



    public function showItems($code)
    {
        $items =   DCPBatchItem::where('generated_code', $code)->get();

        $items_val =   DCPBatchItem::where('generated_code', $code)->first();

        $user_type = $items_val->dcpAssignedUsers->dcpAssignedType->name ?? 'N/A';
        $user_name = $items_val->dcpAssignedUsers->assigned_user_name ?? 'N/A';
        $item_location = $items_val->dcpBatchItemLocation->dcpAssignedLocation->name ?? 'N/A';
        $user_date_assigned = $items_val->dcpAssignedUsers->date_assigned ?? 'N/A';
        return view('SchoolSide.DCPInventory.ShowItems', compact('items', 'user_name', 'item_location', 'user_type', 'user_date_assigned'));
    }
    public function updateItem(Request $request, $itemId)
    {
        try {
            $item = DCPBatchItem::findOrFail($itemId);

            $validated = $request->validate([
                'unit' => 'nullable|string|max:50',
                'quantity' => 'nullable|integer',
                'condition_id' => 'nullable|integer',
                'brand' => 'nullable|string|max:100',
                'serial_number' => [
                    'nullable',
                    'string',
                    'max:100',
                    Rule::unique('dcp_batch_items', 'serial_number')->ignore($itemId, 'pk_dcp_batch_items_id'),
                ],
                'date_approved' => 'nullable|date',
            ]);

            if ($validated['condition_id'] == 1) {
                $condition_id = DCPCurrentCondition::where('name', 'Good')->value('pk_dcp_current_conditions_id');

                $getCondition = DCPItemCondition::where('dcp_batch_item_id', $itemId)->first();

                if ($getCondition) {
                    $getCondition->update([
                        'current_condition_id' => $condition_id,
                    ]);
                } else {
                    DCPItemCondition::create([
                        'dcp_batch_item_id' => $itemId,
                        'current_condition_id' => $condition_id,
                    ]);
                }
            } elseif ($validated['condition_id'] == 2) {
                $condition_id = DCPCurrentCondition::where('name', 'Needs Repair')->value('pk_dcp_current_conditions_id');

                $getCondition = DCPItemCondition::where('dcp_batch_item_id', $itemId)->first();

                if ($getCondition) {
                    $getCondition->update([
                        'current_condition_id' => $condition_id,
                    ]);
                } else {
                    DCPItemCondition::create([
                        'dcp_batch_item_id' => $itemId,
                        'current_condition_id' => $condition_id,
                    ]);
                }
            } elseif ($validated['condition_id'] == 3) {
                $condition_id = DCPCurrentCondition::where('name', 'Damaged')->value('pk_dcp_current_conditions_id');

                $getCondition = DCPItemCondition::where('dcp_batch_item_id', $itemId)->first();

                if ($getCondition) {
                    $getCondition->update([
                        'current_condition_id' => $condition_id,
                    ]);
                } else {
                    DCPItemCondition::create([
                        'dcp_batch_item_id' => $itemId,
                        'current_condition_id' => $condition_id,
                    ]);
                }
            } else {
                $getCondition = DCPItemCondition::where('dcp_batch_item_id', $itemId)->first();

                if ($getCondition) {
                    $getCondition->update([
                        'current_condition_id' => 1,
                    ]);
                } else {
                    DCPItemCondition::create([
                        'dcp_batch_item_id' => $itemId,
                        'current_condition_id' => 1,
                    ]);
                }
            }




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
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'This serial number is already assigned to another item.',
                'errors' => $e->errors(), // will include 'serial_number' => ['The serial number has already been taken.']
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function insertCondition(Request $request)
    {
        $validated = $request->validate([
            'dcp_batch_item_id' => 'required',
            'current_condition_id' => 'required|Integer'
        ]);
        $results =  DCPItemCondition::create($validated);
        return response()->json($results);
    }
}
