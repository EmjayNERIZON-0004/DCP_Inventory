<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPItemBrand;
use App\Models\DCPItemModeDelivery;
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

    public function storeDeliveryMode(Request $request)
    {
        $request->validate([
            'delivery_mode' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPItemModeDelivery::create(['name' => $request->delivery_mode]);
        $itemTypes = DCPItemTypes::all(); // Fetch all item types from the database
        view()->share('itemTypes', $itemTypes); // Share item types with the view

        return redirect()->route('index.item_type')->with('success', 'Delivery Mode added successfully.');
    }
    public function storeSupplier(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        // Logic to save the brand supplier in the database
        DCPItemBrand::create(['name' => $request->brand_name]);
        $itemTypes = DCPItemTypes::all(); // Fetch all item types from the database
        view()->share('itemTypes', $itemTypes); // Share item types with the view

        return redirect()->route('index.item_type')->with('success', 'Brand Supplier added successfully.');
    }
    public function storeBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        // Logic to save the brand supplier in the database
        DCPBatchItemBrand::create(['brand_name' => $request->brand_name]);
        $itemTypes = DCPItemTypes::all(); // Fetch all item types from the database
        view()->share('itemTypes', $itemTypes); // Share item types with the view

        return redirect()->route('index.item_type')->with('success', 'Brand Supplier added successfully.');
    }
    public function editDeliveryMode(Request $request, $id)
    {
        $request->validate([
            'delivery_mode' => 'required|string|max:255',
        ]);

        $deliveryMode = DCPItemModeDelivery::findOrFail($id);
        $deliveryMode->name = $request->delivery_mode;
        $deliveryMode->save();

        return redirect()->back()->with('success', 'Delivery Mode updated successfully!');
    }
    public function editSupplier(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->name = $request->brand_name;
        $brandSupplier->save();
        return redirect()->route('index.item_type')->with('success', 'Brand Supplier updated successfully!');
    }
    public function editBrand(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->brand_name = $request->brand_name;
        $brandSupplier->save();
        return redirect()->route('index.item_type')->with('success', 'Brand Supplier updated successfully!');
    }
    public function deleteDeliveryMode($id)
    {
        $deliveryMode = DCPItemModeDelivery::findOrFail($id);
        $deliveryMode->delete();
        return redirect()->route('index.item_type')->with('success', 'Delivery Mode deleted successfully!');
    }
    public function deleteSupplier($id)
    {
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->delete();
        return redirect()->route('index.item_type')->with('success', 'Brand Supplier deleted successfully!');
    }
    public function deleteBrand($id)
    {
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->delete();
        return redirect()->route('index.item_type')->with('success', 'Brand Supplier deleted successfully!');
    }
}
