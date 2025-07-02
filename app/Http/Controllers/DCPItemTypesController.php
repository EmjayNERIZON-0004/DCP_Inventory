<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemTypes;
use Illuminate\Http\Request;

class DCPItemTypesController extends Controller
{
    public function index()
    {

        $itemTypes = DCPItemTypes::all(); // Fetch all item types from the database
        return view('AdminSide.DCPBatch.ItemTypes', compact('itemTypes'));
    }


    public function store(Request $request)
    {
        // Validate and store the item type data
        $request->validate([
            'code' => 'required|string|max:255|unique:dcp_item_types,code',
            'name' => 'required|string|max:255',
        ]);

        // Logic to save the item type in the database
        DCPItemTypes::create($request->all());
        return redirect()->route('index.item_type')->with('success', 'Item Type created successfully.');
    }
    public function destroy($id)
    {
        // Logic to delete the item type by ID
        $itemType = DCPItemTypes::findOrFail($id);
        $itemType->delete();
        return redirect()->route('index.item_type')->with('success', 'Item Type deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $itemType = DCPItemTypes::findOrFail($id);
        $itemType->code = $request->code;
        $itemType->name = $request->name;
        $itemType->save();

        return redirect()->back()->with('success', 'Item Type updated successfully!');
    }
}
