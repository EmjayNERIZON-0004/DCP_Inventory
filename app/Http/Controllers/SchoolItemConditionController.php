<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolItemConditionController extends Controller
{
    public function index(int $id)
    {
        $batches = DCPBatch::where('school_id', Auth::guard('school')->user()->pk_school_id)->get();

        $results = collect();
        $items_result = collect();
        if ($id === 0) {
            foreach ($batches as $batch) {
                $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();
                // $results->push([
                //     'batch' => $batch->batch_label,
                //     'batch_items' => $batch_items
                // ]);
                foreach ($batch_items as $items) {
                    $condition = DCPItemCondition::where('dcp_batch_item_id', $items->pk_dcp_batch_items_id)

                        ->first();
                    if ($condition) {
                        $items_result->push($condition);
                    }
                }
            }
        } else {
            foreach ($batches as $batch) {
                $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();
                // $results->push([
                //     'batch' => $batch->batch_label,
                //     'batch_items' => $batch_items
                // ]);
                foreach ($batch_items as $items) {
                    $condition = DCPItemCondition::where('dcp_batch_item_id', $items->pk_dcp_batch_items_id)
                        ->where('current_condition_id', $id)
                        ->first();
                    if ($condition) {
                        $items_result->push($condition);
                    }
                }
            }
        }


        return view('SchoolSide.ItemsCondition', compact('items_result', 'id'));
    }
    public function comboSearch(Request $request)
    {
        return redirect()->route('schools.item.condition', ['id' => $request->condition_id]);
    }
}
