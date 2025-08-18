<?php

namespace App\Http\Controllers;

use App\Models\ISP\ISPAreaDetails;
use App\Models\ISP\ISPDetails;
use App\Models\ISP\ISPSpeedTest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolISPController extends Controller
{
    function index()
    {

        $schoolsISP = ISPDetails::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get();
        $isp_content = DB::table('isp_details')
            ->join('isp_list', 'isp_details.isp_list_id', '=', 'isp_list.pk_isp_list_id')
            ->join('isp_connection_type', 'isp_details.isp_connection_type_id', '=', 'isp_connection_type.pk_isp_connection_type_id')
            ->join('isp_internet_quality', 'isp_internet_quality.pk_isp_internet_quality_id', '=', 'isp_details.isp_internet_quality_id')
            ->join('isp_speed_test', 'isp_speed_test.isp_details_id', '=', 'isp_details.pk_isp_details_id')
            ->join('isp_area_details', 'isp_area_details.isp_details_id', '=', 'isp_details.pk_isp_details_id')
            ->join('isp_area_available', 'isp_area_details.isp_area_available_id', '=', 'isp_area_available.pk_isp_area_available_id')

            ->select(
                'isp_list.name as isp_name',
                'isp_list.pk_isp_list_id as list_id',
                'isp_details.purpose as purpose',
                'isp_details.pk_isp_details_id as id',
                'isp_internet_quality.name as quality',
                'isp_internet_quality.pk_isp_internet_quality_id as quality_id',
                'isp_connection_type.name as connection_type_name',
                'isp_connection_type.pk_isp_connection_type_id as connection_type_id',
                DB::raw('GROUP_CONCAT(DISTINCT isp_area_available.pk_isp_area_available_id ORDER BY isp_area_available.name SEPARATOR ",") as area_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT isp_area_available.name ORDER BY isp_area_available.name SEPARATOR ", ") as area_names'),
                DB::raw('CAST(AVG(isp_speed_test.upload) AS UNSIGNED) as upload'),
                DB::raw('CAST(AVG(isp_speed_test.download) AS UNSIGNED) as download'),
                DB::raw('CAST(AVG(isp_speed_test.ping) AS UNSIGNED) as ping')
            )
            ->where('school_id', Auth::guard('school')->user()->school->pk_school_id)
            ->groupBy('id', 'connection_type_id', 'quality_id', 'list_id', 'isp_list.name', 'quality', 'isp_details.purpose', 'isp_connection_type.name')

            ->get()
            ->map(function ($item) {
                // convert into collections
                $ids   = collect(explode(',', $item->area_ids))->map(fn($v) => (int) $v);
                $names = collect(explode(',', $item->area_names))->filter();

                // pair them together
                $item->areas = $ids->map(function ($id, $i) use ($names) {
                    return [
                        'id'   => $id,
                        'name' => $names[$i] ?? null,
                    ];
                });

                return $item;
            });
        // dd($isp_content);





        return view('SchoolSide.ISP.index', compact('isp_content'));
    }
    function storeData(Request $request)
    {
        $validated = $request->validate([
            'isp_list_id' => 'required|integer',
            'isp_connection_type' => 'required|integer',
            'isp_internet_quality' => 'required|integer',
            'isp_purpose' => 'required|string',
            'isp_upload' => 'required|integer',
            'isp_download' => 'required|integer',
            'isp_ping' => 'required|integer',
            'areas' => 'required|array|min:1',
            'areas.*' => 'distinct'
        ]);
        try {
            $isp_details = ISPDetails::create([
                'school_id' => Auth::guard('school')->user()->school->pk_school_id,
                'isp_list_id' => $validated['isp_list_id'],
                'purpose' => $validated['isp_purpose'],
                'isp_connection_type_id' => $validated['isp_connection_type'],
                'isp_internet_quality_id' => $validated['isp_internet_quality'],

            ]);
            $collection = collect($validated['areas']);
            foreach ($collection as $areas) {

                $isp_area = ISPAreaDetails::create([
                    'isp_details_id' => $isp_details->pk_isp_details_id,
                    'isp_area_available_id' => $areas
                ]);
            }

            $speed_test = ISPSpeedTest::create([
                'isp_details_id' => $isp_details->pk_isp_details_id,
                'upload' => $validated['isp_upload'],
                'ping' => $validated['isp_ping'],
                'download' => $validated['isp_download'],
            ]);


            return redirect()->back()->with('success', 'Succesfully Added');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Saving Failed due to ' . $e);
        }
    }
}
