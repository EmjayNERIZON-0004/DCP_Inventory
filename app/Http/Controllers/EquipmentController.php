<?php

namespace App\Http\Controllers;

use App\Models\Equipment\EquipmentBiometricDetails;
use App\Models\Equipment\EquipmentBiometricType;
use App\Models\Equipment\EquipmentBrand;
use App\Models\Equipment\EquipmentCCTVType;
use App\Models\Equipment\EquipmentDetails;
use App\Models\Equipment\EquipmentIncharge;
use App\Models\Equipment\EquipmentInstaller;
use App\Models\Equipment\EquipmentLocation;
use App\Models\Equipment\EquipmentPowerSource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    function showBiometrics()
    {
        $totals = EquipmentBiometricDetails::select('school_id', DB::raw('SUM(no_of_units) as total_amount'))

            ->with('schools') // assuming you have a relation in your model
            ->groupBy('school_id')
            ->orderBy('total_amount', 'DESC')
            ->get();

        $biometrics_model = EquipmentDetails::where('equipment_type_id', 2)
            ->with(['brand_model', 'biometric_details'])
            ->get()
            ->groupBy('equipment_brand_model_id')
            ->map(function ($group) {
                $brand = $group->first()->brand_model;
                $count = $group->count(); // how many records share this model

                // Sum up all no_of_units across biometric_details of this model
                $totalUnits = $group->sum(function ($item) {
                    return $item->biometric_details->sum('no_of_units');
                });

                return (object) [
                    'brand' => $brand,
                    'count' => $count,
                    'total_units' => $totalUnits,
                    'total' => $count * $totalUnits,
                ];
            })
            ->values(); // reset collection keys
        $biometrics_power_source = EquipmentDetails::where('equipment_type_id', 2)
            ->with(['powersource', 'biometric_details'])
            ->get()
            ->groupBy('equipment_power_source_id')
            ->map(function ($group) {
                $power_source = $group->first()->powersource;
                $count = $group->count(); // how many records share this model

                // Sum up all no_of_units across biometric_details of this model
                $totalUnits = $group->sum(function ($item) {
                    return $item->biometric_details->sum('no_of_units');
                });

                return (object) [
                    'power_source' => $power_source,
                    'count' => $count,
                    'total_units' => $totalUnits,
                    'total' => $count * $totalUnits,
                ];
            })
            ->values();
        // dd($biometrics_model);
        return view('AdminSide.Equipment.Biometrics.show', compact('totals', 'biometrics_model', 'biometrics_power_source'));
    }
    function index()
    {
        $cameraType = EquipmentCCTVType::all();
        $biometric = EquipmentBiometricType::all();
        $installer = EquipmentInstaller::all();
        $incharge = EquipmentIncharge::all();
        $location = EquipmentLocation::all();
        $powersource = EquipmentPowerSource::all();
        $brand = EquipmentBrand::all();
        return view("AdminSide.Equipment.index", compact("powersource", "cameraType", "biometric", "installer", "incharge", "location", "brand"));
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "target" => "required",
        ]);
        $status = false;
        if ($request->target == "biometric_type") {
            EquipmentBiometricType::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "incharge") {
            EquipmentIncharge::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "installer") {
            EquipmentInstaller::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "location") {
            EquipmentLocation::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "powersource") {
            EquipmentPowerSource::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "brand") {
            EquipmentBrand::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        } else if ($request->target == "camera_type") {
            EquipmentCCTVType::create([
                "name" => $validated["name"],
            ]);
            $status = true;
        }

        if ($status) {
            return redirect()->back()->with('success', 'New Equipment has been added.');
        }
    }
    function update(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "target" => "required",
        ]);
        $status = false;
        if ($request->target == "biometric_type") {
            $biometric_type = EquipmentBiometricType::findOrFail($request->id)
                ->update([
                    "name" => $validated["name"],
                ]);

            $status = true;
        } else if ($request->target == "incharge") {
            $incharge = EquipmentIncharge::findOrFail($request->id)
                ->update([
                    "name" => $validated["name"],
                ]);
            if ($incharge) {
                $status = true;
            }
        } else if ($request->target == "installer") {
            $installer = EquipmentInstaller::findOrFail($request->id)
                ->update([
                    "name" => $validated["name"],
                ]);
            if ($installer) {
                $status = true;
            }
        } else if ($request->target == "location") {
            $location = EquipmentLocation::findOrFail($request->id)->update([
                "name" => $validated["name"],
            ]);

            if ($location) {
                $status = true;
            }
        } else if ($request->target == "powersource") {
            $powersource = EquipmentPowerSource::findOrFail($request->id)->update([
                "name" => $validated["name"],
            ]);
            if ($powersource) {
                $status = true;
            }
        } else if ($request->target == "brand") {
            $brand = EquipmentBrand::findOrFail($request->id)
                ->update([
                    "name" => $validated["name"],
                ]);
            if ($brand) {
                $status = true;
            }
        } else if ($request->target == "camera_type") {
            $cameraType = EquipmentCCTVType::findOrFail($request->id)->update([
                "name" => $validated["name"],
            ]);
            if ($cameraType) {
                $status = true;
            }
        }

        if ($status) {
            return redirect()->back()->with('success', ' Equipment has been update.');
        }
    }
    function destroy(int $id, String $target)
    {
        try {
            $status = false;

            if ($target == "biometric_type") {
                EquipmentBiometricType::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "incharge") {
                EquipmentIncharge::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "installer") {
                EquipmentInstaller::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "location") {
                EquipmentLocation::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "powersource") {
                EquipmentPowerSource::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "brand") {
                EquipmentBrand::findOrFail($id)->delete();
                $status = true;
            } else if ($target == "camera_type") {
                EquipmentCCTVType::findOrFail($id)->delete();
                $status = true;
            }

            if ($status) {
                return redirect()->back()->with('success', ucfirst($target) . ' has been deleted.');
            }
        } catch (QueryException $e) {
            // Check for foreign key constraint violation (1451 in MySQL)
            if ($e->errorInfo[1] == 1451) {
                return redirect()->back()
                    ->with('error', 'This ' . $target . ' cannot be deleted because it is still assigned to other records.');
            }

            // Any other DB error
            return redirect()->back()
                ->with('error', 'An error occurred while trying to delete the ' . $target . '.');
        }
    }
}
