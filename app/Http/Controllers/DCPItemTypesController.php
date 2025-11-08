<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPCurrentCondition;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemLocation;
use App\Models\DCPItemAssignedType;
use App\Models\DCPItemBrand;
use App\Models\DCPItemModeDelivery;
use App\Models\DCPItemTypes;
use Illuminate\Http\Request;

class DCPItemTypesController extends Controller
{
    public function index()
    {

        $itemTypes = DCPItemTypes::orderBy('name', 'asc')->get();
        // Fetch all item types from the database
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
    public function search_item_type(Request $request)
    {
        $keyword = $request->query('query');

        $results = DCPItemTypes::where('code', 'like', "%{$keyword}%")
            ->orWhere('name', 'like', "%{$keyword}%")
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($results);
    }

    public function storeDeliveryMode(Request $request)
    {
        $request->validate([
            'delivery_mode' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPItemModeDelivery::create(['name' => $request->delivery_mode]);
        // $itemTypes = DCPItemTypes::all(); // Fetch all item types from the database
        // view()->share('itemTypes', $itemTypes); // Share item types with the view

        return redirect()->route('index.crud')->with('success', 'Delivery Mode added successfully.');
    }
    public function storeDeliveryCondition(Request $request)
    {
        $request->validate([
            'delivery_condition' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPDeliveryCondintion::create(['name' => $request->delivery_condition]);

        return redirect()->route('index.crud')->with('success', 'Item Condition Upon Delivery added successfully.');
    }
    public function storeCurrentCondition(Request $request)
    {
        $request->validate([
            'current_condition' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPCurrentCondition::create(['name' => $request->current_condition]);

        return redirect()->route('index.crud')->with('success', 'Item Current Condition added successfully.');
    }
    public function storeAssignedUserType(Request $request)
    {
        $request->validate([
            'assigned_user_type' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPItemAssignedType::create(['name' => $request->assigned_user_type]);

        return redirect()->route('index.crud')->with('success', 'The assigned user type has been added successfully.');
    }
    public function storeAssignedLocation(Request $request)
    {
        $request->validate([
            'assigned_location' => 'required|string|max:255',
        ]);

        // Logic to save the delivery mode in the database
        DCPItemLocation::create(['name' => $request->assigned_location]);

        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Items has been added successfully.');
    }
    public function storeSupplier(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        // Logic to save the brand supplier in the database
        DCPItemBrand::create(['name' => $request->brand_name]);
        return redirect()->route('index.crud')->with('success', 'Brand Supplier added successfully.');
    }
    public function storeBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        // Logic to save the brand supplier in the database
        DCPBatchItemBrand::create(['brand_name' => $request->brand_name]);
        return redirect()->route('index.crud')->with('success', 'Brand Supplier added successfully.');
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
    public function editDeliveryCondition(Request $request, $id)
    {
        $request->validate([
            'delivery_condition' => 'required|string|max:255',
        ]);

        $deliveryCondition_update = DCPDeliveryCondintion::findOrFail($id);
        $deliveryCondition_update->name = $request->delivery_condition;
        $deliveryCondition_update->save();

        return redirect()->back()->with('success', 'Item Condition Upon Delivery updated successfully!');
    }
    public function editCurrentCondition(Request $request, $id)
    {
        $request->validate([
            'current_condition' => 'required|string|max:255',
        ]);

        $currentCondition_update = DCPCurrentCondition::findOrFail($id);
        $currentCondition_update->name = $request->current_condition;
        $currentCondition_update->save();

        return redirect()->back()->with('success', 'Item Current Condition updated successfully!');
    }
    public function editSupplier(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->name = $request->brand_name;
        $brandSupplier->save();
        return redirect()->route('index.crud')->with('success', 'Brand Supplier updated successfully!');
    }
    public function editBrand(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->brand_name = $request->brand_name;
        $brandSupplier->save();
        return redirect()->route('index.crud')->with('success', 'Brand Supplier updated successfully!');
    }
    public function editAssignedUserType(Request $request, $id)
    {
        $request->validate([
            'assigned_user_type' => 'required|string|max:255',
        ]);
        $assigned_user_type_update = DCPItemAssignedType::findOrFail($id);
        $assigned_user_type_update->name = $request->assigned_user_type;
        $assigned_user_type_update->save();
        return redirect()->route('index.crud')->with('success', 'The assigned user type has been updated successfully!');
    }
    public function editAssignedLocation(Request $request, $id)
    {
        $request->validate([
            'assigned_location' => 'required|string|max:255',
        ]);
        $assigned_location_update = DCPItemLocation::findOrFail($id);
        $assigned_location_update->name = $request->assigned_location;
        $assigned_location_update->save();
        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Item has been updated successfully!');
    }
    public function deleteDeliveryMode($id)
    {
        $deliveryMode = DCPItemModeDelivery::findOrFail($id);
        $deliveryMode->delete();
        return redirect()->route('index.crud')->with('success', 'Delivery Mode deleted successfully!');
    }
    public function deleteDeliveryCondition($id)
    {
        $deliveryMode = DCPDeliveryCondintion::findOrFail($id);
        $deliveryMode->delete();
        return redirect()->route('index.crud')->with('success', 'Item Condition Upon Delivery deleted successfully!');
    }
    public function deleteCurrentCondition($id)
    {
        $deliveryMode = DCPCurrentCondition::findOrFail($id);
        $deliveryMode->delete();
        return redirect()->route('index.crud')->with('success', 'Item Current Condition deleted successfully!');
    }
    public function deleteSupplier($id)
    {
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->delete();
        return redirect()->route('index.crud')->with('success', '  Supplier deleted successfully!');
    }
    public function deleteBrand($id)
    {
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->delete();
        return redirect()->route('index.crud')->with('success', 'Brand   deleted successfully!');
    }
    public function deleteAssignedUserType($id)
    {
        $assigned_delete = DCPItemAssignedType::findOrFail($id);
        $assigned_delete->delete();
        return redirect()->route('index.crud')->with('success', 'The assigned user type deleted successfully!');
    }
    public function deleteAssignedLocation($id)
    {
        $assigned_location_delete = DCPItemLocation::findOrFail($id);
        $assigned_location_delete->delete();
        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Item deleted successfully!');
    }
}
