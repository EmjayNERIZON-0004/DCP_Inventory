<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemCondition;
use App\Models\DCPPackageTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolDashboardController extends Controller
{
    public function index()
    {
        $school = Auth::guard('school')->user()->school;
        $batches = DCPBatch::where('school_id', $school->pk_school_id)->get();

        $items = collect();
        $packages = collect();

        foreach ($batches as $batch) {
            $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();
            $items = $items->merge($batch_items);

            // Merge the single ID as array to prevent weird merges
            $packages = $packages->merge([$batch->dcp_package_type_id]);
        }

        // Count how many times each package ID appears
        $packageCounts = $packages->countBy(); // key = package ID, value = count

        // Get unique package IDs for querying names
        $uniquePackageIds = $packages->unique()->values();

        // Get package names keyed by ID
        $packageNames = DCPPackageTypes::whereIn('pk_dcp_package_types_id', $uniquePackageIds)
            ->pluck('name', 'pk_dcp_package_types_id');  // key by ID for easy lookup

        // Now you can combine names + counts
        $packagesWithCounts = collect();

        foreach ($packageCounts as $packageId => $count) {
            $name = $packageNames[$packageId] ?? 'Unknown';
            $packagesWithCounts->push([
                'id' => $packageId,
                'name' => $name,
                'count' => $count,
            ]);
        }

        $totalGood = 0;
        $totalDamaged = 0;
        $totalForRepair = 0;
        $nostatus = 0;
        $totalForDisposal = 0;
        foreach ($items as $batch_items) {
            $current_condition =  DCPItemCondition::where(
                'dcp_batch_item_id',
                $batch_items->pk_dcp_batch_items_id,
            )->value('current_condition_id');
            if ($current_condition == 1) {
                $totalGood++;
            } elseif ($current_condition == 2) {
                $totalForRepair++;
            } elseif ($current_condition == 4) {
                $totalDamaged++;
            } elseif ($current_condition == 5) {
                $totalForDisposal++;
            } else {
                $nostatus++;
            }
        }


        $totalBatches = $batches->count();
        $totalItems = $items->count();
        return view('SchoolSide.dashboard', compact('packagesWithCounts', 'totalItems', 'totalGood', 'totalForRepair', 'totalDamaged', 'totalForDisposal', 'nostatus', 'totalBatches'));
    }
}
