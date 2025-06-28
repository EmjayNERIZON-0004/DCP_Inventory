<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPPackageTypes;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DCPBatchController extends Controller
{
               public function index()
       {
             $packageTypes = DCPPackageTypes::all();
               $dcpBatches = DB::table('dcp_batches')
        ->join('dcp_package_types', 'dcp_batches.dcp_package_type_id', '=', 'dcp_package_types.pk_dcp_package_types_id')
        ->join('schools', 'dcp_batches.school_id', '=', 'schools.pk_school_id')
        ->select(
            'dcp_batches.*',
            'dcp_package_types.name as package_type_name',
            'schools.SchoolName as school_name',
            'schools.SchoolLevel as school_level',
            'schools.SchoolID as school_id'
        )
        ->orderBy('dcp_batches.created_at', 'desc')
        ->get();
               
               $schools = School::all();
           return view('AdminSide.DCPBatch.Batch', compact('dcpBatches','packageTypes','schools'));
       }
         public function store(Request $request)
    {
        $validated = $request->validate([
            'dcp_package_type_id' => 'required|integer',
            'school_id' => 'required|integer',
            'batch_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'budget_year' => 'required|integer',
            'delivery_date' => 'required|date',
            'supplier_name' => 'required|string|max:255',
            'mode_of_delivery' => 'required|string|max:255',
            'submission_status' => 'required|string|max:50',
        ]);

        DCPBatch::create($validated);

        return redirect()->back()->with('success', 'DCP Batch created successfully!');
    }

    }
