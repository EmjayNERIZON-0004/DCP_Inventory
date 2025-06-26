<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        return view('AdminSide.schools.index')->with('schools',$schools);
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
     $validated_img =  $request->validate([
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);

     if ($request->hasFile('image_path')) {
                    $image = $request->file('image_path');
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('school-logo'), $imageName);
                    $validated_img['image_path'] = $imageName;
                }


    $school = School::create([
    'SchoolID'       => $request->SchoolID,
    'SchoolName'     => $request->SchoolName,
    'Region'         => $request->Region,
    'Division'       => $request->Division,
    'District'       => $request->District,
    'SchoolHead'     => $request->SchoolHead,
    'ContactNumber'  => $request->ContactNumber,
    'Email'          => $request->Email,
    'image_path'     => $validated_img['image_path'] ?? null,
]);

Log::info("New School Added with School ID:". $school->SchoolID);
return redirect()->route('index.schools');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
