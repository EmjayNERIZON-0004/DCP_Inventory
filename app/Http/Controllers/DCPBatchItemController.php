<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemType;
use App\Models\DCPItemTypes;
use App\Models\DCPPackageTypes;
use App\Models\School;

class DCPBatchItemController extends Controller
{
    public function index($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->get();
        $itemTypes = DCPItemTypes::all();
        $conditions = DCPDeliveryCondintion::all();

        return view('AdminSide.DCPBatch.Items', compact('batch', 'items', 'itemTypes','conditions'));
    }


public function store(Request $request, $batchId)
{
    $validated = $request->validate([
        'item_type_id' => 'required|integer', 
        'quantity' => 'required|integer',
        'unit' => 'required|string|max:50',
        'condition_id' => 'integer|nullable',
        // add other fields as needed
    ]);

    $batch = DCPBatch::findOrFail($batchId);
    $packageType = DCPPackageTypes::findOrFail($batch->dcp_package_type_id);
    $itemType = DCPItemTypes::findOrFail($validated['item_type_id']);
    $school = School::findOrFail($batch->school_id);
    $schoolLevel = $school->SchoolLevel;
    $deliveryDate = \Carbon\Carbon::parse($batch->delivery_date)->format('mdy');

    // Generate the code prefix (without the count)
    $codePrefix = "{$batch->batch_label}-{$packageType->code}-{$itemType->code}-{$schoolLevel}-{$school->SchoolID}-{$deliveryDate}-";

    // Find the latest count for this prefix
    $latestItem = DCPBatchItem::where('generated_code', 'like', $codePrefix . '%')
        ->orderByDesc('generated_code')
        ->first();

    if ($latestItem) {
        $lastCount = (int)substr($latestItem->generated_code, -5);
    } else {
        $lastCount = 0;
    }

    // Create the specified quantity of items
    for ($i = 1; $i <= $validated['quantity']; $i++) {
        $itemCountPadded = str_pad($lastCount + $i, 5, '0', STR_PAD_LEFT);
        $generatedCode = $codePrefix . $itemCountPadded;

        $itemData = $validated;
        $itemData['generated_code'] = $generatedCode;
        $itemData['dcp_batch_id'] = $batchId;
        $itemData['quantity'] = 1; // Each record is for 1 item

        DCPBatchItem::create($itemData);
    }

    return redirect()->route('index.items', $batchId)->with('success', 'Items added!');
}
}