<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchApproval;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPItemTypes;
use App\Models\DCPItemWarrantyStatus;
use App\Models\DCPPackageContent;
use App\Models\DCPPackageTypes;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DCPBatchController extends Controller
{
    public function approve($id)
    {
        $batch = DCPBatch::findOrFail($id);
        $batch->submission_status = 'Approved';
        $batch->date_approved = now()->format('Y-m-d');
        $batch->update();

        // Also update all related DCPBatchItem date_approved fields
        DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id ?? $batch->id)
            ->update(['date_approved' => $batch->date_approved]);
        DCPBatchApproval::where('dcp_batches_id', $batch->pk_dcp_batches_id ?? '')
            ->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'DCP Batch approved successfully!');
    }

    public function index()
    {
        $packageTypes = DCPPackageTypes::all();
        $dcpBatches = DB::table('dcp_batches')
            ->join('dcp_package_types', 'dcp_batches.dcp_package_type_id', '=', 'dcp_package_types.pk_dcp_package_types_id')
            ->join('schools', 'dcp_batches.school_id', '=', 'schools.pk_school_id')
            ->leftJoin('dcp_batch_approval', 'dcp_batch_approval.dcp_batches_id', '=', 'dcp_batches.pk_dcp_batches_id')
            ->select(
                'dcp_batches.*',
                'dcp_package_types.name as package_type_name',
                'schools.SchoolName as school_name',
                'schools.SchoolLevel as school_level',
                'schools.SchoolID as school_id',
                'dcp_batch_approval.status as approval_status'
            )
            ->orderBy('dcp_batches.delivery_date', 'desc')
            ->get();


        $schools = School::all();
        return view('AdminSide.DCPBatch.Batch', compact('dcpBatches', 'packageTypes', 'schools'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dcp_package_type_id' => 'required|integer',
            'school_id' => 'nullable|integer',
            'batch_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'school_email' => 'nullable|email',
            'budget_year' => 'required|integer',
            'delivery_date' => 'required|date',
            'supplier_name' => 'required|string|max:255',
            'mode_of_delivery' => 'required|string|max:255',
            'submission_status' => 'required|string|max:50',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $batch = DCPBatch::create($validator->validated());





        $contents = DCPPackageContent::where('dcp_package_types_id', $batch->dcp_package_type_id)->get();

        foreach ($contents as $content) {
            $this->storeBatchItem($batch->pk_dcp_batches_id, $content); // ✅ calling the method
        }


        return redirect()->back()->with('success', 'DCP Batch created successfully!');
    }

    public function storeBatchItem($batchId, DCPPackageContent $packageContent)
    {
        $batch = DCPBatch::findOrFail($batchId);
        $packageType = DCPPackageTypes::findOrFail($batch->dcp_package_type_id);
        $itemType = DCPItemTypes::findOrFail($packageContent->dcp_item_types_id);
        $brand = DCPBatchItemBrand::findOrFail($packageContent->dcp_batch_item_brands_id);
        $school = School::findOrFail($batch->school_id);

        // Normalize school level
        $schoolLevel = match ($school->SchoolLevel) {
            'Elementary School', 'ELEM' => 'ELEM',
            'Junior High School', 'JHS' => 'JHS',
            'Senior High School', 'SHS' => 'SHS',
            default => 'Unknown',
        };

        $deliveryDate = \Carbon\Carbon::parse($batch->delivery_date)->format('mdy');

        // Build code prefix
        $codePrefix = "DCP{$batch->budget_year}-{$packageType->code}-{$itemType->code}-{$schoolLevel}-{$school->SchoolID}-{$deliveryDate}-";

        // Get latest code count for this prefix
        $latestItem = DCPBatchItem::where('generated_code', 'like', $codePrefix . '%')
            ->orderByDesc('generated_code')
            ->first();

        $lastCount = $latestItem ? (int)substr($latestItem->generated_code, -5) : 0;

        // Loop based on quantity in package content
        for ($i = 1; $i <= $packageContent->quantity; $i++) {
            $itemCountPadded = str_pad($lastCount + $i, 5, '0', STR_PAD_LEFT);
            $generatedCode = $codePrefix . $itemCountPadded;

            $batchItem = DCPBatchItem::create([
                'dcp_batch_id' => $batch->pk_dcp_batches_id,
                'item_type_id' => $itemType->pk_dcp_item_types_id,
                'generated_code' => $generatedCode,
                'unit' => 'unit ',
                'brand' => $brand->brand_name,
                'quantity' => 1
            ]);
            DCPItemWarrantyStatus::create([
                'dcp_batch_item_id' => $batchItem->pk_dcp_batch_items_id,
                'warranty_start_date' => $batch->delivery_date,
                'warranty_end_date' => Carbon::parse($batch->delivery_date)->addYears(3)->toDateString(),
                'warranty_contract' => 'Standard 3-Year Warranty',
                'warranty_remaining' => '3 years',
                'warranty_status_id' => 1, // assuming 1 = "Active"
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "{$packageContent->quantity} items created from package content.",
            'data' => [
                'batch_label' => $batch->batch_label,
                'package_type' => $packageType->name,
                'item_type' => $itemType->name,
                'quantity' => $packageContent->quantity
            ]
        ]);
    }


    public function destroy($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        $batch->delete();

        return response()->json([
            'success' => true,
            'message' => 'DCP Batch deleted successfully!'
        ]);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $dcpBatches = DB::table('dcp_batches')
            ->join('dcp_package_types', 'dcp_batches.dcp_package_type_id', '=', 'dcp_package_types.pk_dcp_package_types_id')
            ->join('schools', 'dcp_batches.school_id', '=', 'schools.pk_school_id')
            ->leftJoin('dcp_batch_approval', 'dcp_batch_approval.dcp_batches_id', '=', 'dcp_batches.pk_dcp_batches_id')
            ->select(
                'dcp_batches.*',
                'dcp_package_types.name as package_type_name',
                'schools.SchoolName as school_name',
                'schools.SchoolLevel as school_level',
                'schools.SchoolID as school_id',
                'dcp_batch_approval.status as approval_status'
            )
            ->where(function ($q) use ($query) {
                $q->where('batch_label', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('schools.SchoolName', 'like', "%{$query}%")
                    ->orWhere('budget_year', 'like', "%{$query}%");
            })
            ->get();

        // Format delivery_date
        $dcpBatches->transform(function ($item) {
            $item->delivery_date = $item->delivery_date
                ? \Carbon\Carbon::parse($item->delivery_date)->format('F d, Y')
                : null;
            return $item;
        });

        return response()->json($dcpBatches);
    }
}
