<?php

namespace App\Http\Controllers;

use App\Models\School;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function updateSchoolDetails(Request $request)
    {
        $user = auth()->guard('school')->user();

        if (!$user || !$user->pk_school_id) {
            return redirect()->back()->with('error', 'No school found for this account.');
        }

        $validated = $request->validate([
       
            'Region' => 'required|string|max:100',
            'Division' => 'required|string|max:100',
            'District' => 'required|string|max:100',
            'Province' => 'nullable|string|max:100',
            'CityMunicipality' => 'nullable|string|max:100',
            'SchoolContactNumber' => 'nullable|string|max:50',
            'SchoolEmailAddress' => 'nullable|email|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = uniqid('logo_') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('school-logo'), $imageName);
                $validated['image_path'] = $imageName;
            }

            $school = School::where('pk_school_id', $user->pk_school_id)->first();
            if (!$school) {
                return redirect()->back()->with('error', 'No school found for this account.');
            }
            $school->update($validated);
            return redirect()->back()->with('success', 'School details updated successfully.');
        } catch ( Exception $e) {
           Log::error('School update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function updateSchoolOfficials(Request $request)
    {
        $user = auth()->guard('school')->user();
        if (!$user || !$user->school) {
            return redirect()->back()->with('error', 'No school found for this account.');
        }
        $validated = $request->validate([
            'PrincipalName' => 'nullable|string|max:255',
            'PrincipalContact' => 'nullable|string|max:50',
            'PrincipalEmail' => 'nullable|email|max:255',
            'ICTName' => 'nullable|string|max:255',
            'ICTContact' => 'nullable|string|max:50',
            'ICTEmail' => 'nullable|email|max:255',
            'CustodianName' => 'nullable|string|max:255',
            'CustodianContact' => 'nullable|string|max:50',
            'CustodianEmail' => 'nullable|email|max:255',
        ]);
        $user->school->update($validated);
        return redirect()->back()->with('success', 'School officials updated successfully.');
    }
}
