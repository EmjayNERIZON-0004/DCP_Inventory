<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\Equipment\EquipmentBiometricDetails;
use App\Models\Equipment\EquipmentCCTVDetails;
use App\Models\ISP\ISPDetails;
use App\Models\NonDCPItem;
use App\Models\SchoolData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolReportController extends Controller
{
    public function index()
    {
        $school_id = Auth::guard('school')->user()->school->pk_school_id;
        $batch = DCPBatch::where('school_id', $school_id)->orderBy('delivery_date', 'asc')->get();

        $ISP = ISPDetails::where('school_id', $school_id)->get();
        $CCTVDetails = EquipmentCCTVDetails::where('school_id', $school_id)->get();
        $BiometricDetails = EquipmentBiometricDetails::where('school_id', $school_id)->get();
        $batches = DCPBatch::where('school_id', $school_id)->orderBy('delivery_date', 'asc')->get();
        $total_batches = DCPBatch::where('school_id', $school_id)->count();
        $non_dcp = NonDCPItem::with('fund_source')->where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get();
        // $total_classrooms = SchoolData::where('pk_school_id', $school_id)->value('total_classrooms')->count;
        return view("SchoolSide.Report.index", compact("batch", "ISP", "CCTVDetails", "BiometricDetails", "batches", "total_batches", "non_dcp"));
    }
}
