<?php

namespace App\Http\Controllers;

use App\Models\EmpPosition;
use Illuminate\Http\Request;

class EmpPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $model = EmpPosition::create([
            'name' => $validated['name'],
        ]);
        if ($model) {
            return redirect()->back()->with('success', 'Position created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create Position.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $model = EmpPosition::findOrFail($id);
        $model->update([
            'name' => $validated['name'],
        ]);
        if ($model) {
            return redirect()->back()->with('success', 'Position  updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Position .');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = EmpPosition::findOrFail($id);
        $model->delete();
        if ($model) {
            return redirect()->back()->with('success', 'Position  deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Position .');
        }
    }
}
