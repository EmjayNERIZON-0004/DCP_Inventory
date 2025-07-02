<?php

namespace App\Http\Controllers;

use App\Models\DCPItemTypes;
use App\Models\DCPPackageContent;
use App\Models\DCPPackageTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DCPPackageTypeController extends Controller
{

    public function insertPackageItem(Request $request)
    {

        $validated = $request->validate([
            'insert_package_id' => 'required|exists:dcp_package_content,dcp_package_types_id',
            'insert_package_content_id' => 'required|exists:dcp_item_types,pk_dcp_item_types_id',
            'insert_quantity' => 'required|integer|min:1',
        ]);

        $exists = DCPPackageContent::where('dcp_package_types_id', $validated['insert_package_id'])
            ->where('dcp_item_types_id', $validated['insert_package_content_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Item already exists in the package.');
        }

        DCPPackageContent::create([
            'dcp_package_types_id' => $validated['insert_package_id'],
            'dcp_item_types_id' => $validated['insert_package_content_id'],
            'quantity' => $validated['insert_quantity'],
        ]);

        return back()->with('success', 'Item inserted successfully.');
    }

    public function getItems($id)
    {
        $items =  DCPPackageContent::where('dcp_package_types_id', $id)
            ->join('dcp_item_types', 'dcp_item_types.pk_dcp_item_types_id', '=', 'dcp_package_content.dcp_item_types_id')
            ->select('dcp_item_types.name as item_name', 'dcp_package_content.quantity')
            ->get();

        return response()->json($items);
    }
    public function create()
    {
        $itemTypes = DCPItemTypes::all();

        $packages = DB::table('dcp_package_types')
            ->join('dcp_package_content', 'dcp_package_types.pk_dcp_package_types_id', '=', 'dcp_package_content.dcp_package_types_id')
            ->join('dcp_item_types', 'dcp_package_content.dcp_item_types_id', '=', 'dcp_item_types.pk_dcp_item_types_id')
            ->select(
                'dcp_package_content.pk_dcp_package_content_id as id',
                'dcp_item_types.pk_dcp_item_types_id as item_type_id',
                'dcp_package_types.name as package_name',
                'dcp_package_types.pk_dcp_package_types_id as dcp_packages_id',
                'dcp_item_types.name as item_name',
                'dcp_package_content.quantity'
            )
            ->get();

        if ($packages->isEmpty()) {
            return redirect()->route('index.batch')->with('error', 'No packages found.');
        }

        return view('AdminSide.DCPBatch.PackageType', compact('itemTypes', 'packages'));
    }

    public function store(Request $request)
    {
        // Store the package type data
        $packageType = new DCPPackageTypes();
        $packageType->code = $request->input('code');
        $packageType->name = $request->input('name');
        $packageType->save();

        // Store the package content data
        foreach ($request->input('item_type_id') as $key => $itemTypeId) {
            $packageContent = new DCPPackageContent();
            $packageContent->dcp_package_types_id = $packageType->pk_dcp_package_types_id;
            $packageContent->dcp_item_types_id = $itemTypeId;
            $packageContent->quantity = $request->input('quantity')[$key];
            $packageContent->save();
        }




        return redirect()->route('index.package_type')->with('success', 'Package Type created successfully.');
    }

    public function update(Request $request)
    {
        $validated =   $request->validate([
            'id' => 'required',
            'package_name' => 'required',
            'package_content_name' => 'required',
            'quantity' => 'required',
            'package_id' => 'required',
        ]);

        $package = DCPPackageContent::where('dcp_package_types_id', $validated['package_id'])->get();


        $package = DCPPackageContent::findOrFail($validated['id']);
        $package->dcp_item_types_id = $validated['package_content_name'];
        $package->quantity = $validated['quantity'];
        $package->save();

        return redirect()->back()->with('success', 'Package updated successfully.');
    }
}
