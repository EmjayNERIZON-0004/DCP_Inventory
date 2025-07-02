<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolCoordinates;
use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SchoolDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store_data(Request $request)
{
    $validated = $request->validate([
        'pk_school_id' => 'required|string',
        'GradeLevelID' => 'required|string',
        'RegisteredLearners' => 'required|integer|min:0',
        'Teachers' => 'required|integer|min:0',
        'Sections' => 'required|integer|min:0',
        'Classrooms' => 'required|integer|min:0',
        'NonTeachingPersonnel' => 'required|integer|min:0',
    ]);

    // Save to SchoolData model (make sure you have this model and table)
    \App\Models\SchoolData::create($validated);

    return back()->with('success', 'School data submitted successfully!');
}


    public function index(Request $request)
    {
        $query = School::query()
            ->join('school_users', 'schools.pk_school_id', '=', 'school_users.pk_school_id')
            ->select('schools.*', 'school_users.username as user_username',  );
        if ($request->has('pk_school_id')) {
            $query->where('schools.pk_school_id', $request->input('pk_school_id'));
        }
        $schools = $query->get();
        $schools_count = $schools->count();
        return view('AdminSide.schools.index')->with('schools',$schools)
        ->with('schools_count', $schools_count);
        
    }

    public function user(){ 
        // This method is intentionally left empty.
       $query = School::query()
            ->join('school_users', 'schools.pk_school_id', '=', 'school_users.pk_school_id')
            ->select('schools.*', 'school_users.username as user_username', 'school_users.default_password as default_password');
        if (request()->has('pk_school_id')) {
            $query->where('schools.pk_school_id', request()->input('pk_school_id'));
        }
               $users = $query->get();
   return view('AdminSide.schools.user')->with('users',$users);
        
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
        $validator = Validator::make($request->all(), [
            'SchoolID' => 'required|string|max:255',
            'SchoolName' => 'required|string|max:255',
            'SchoolLevel' => 'required|string|max:255',
            'SchoolEmailAddress' => 'required|email|max:255',
            'Latitude' => 'required|numeric',
            'Longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $validated = $validator->validated();

        // Save the school (pk_school_id will be auto-incremented)
        $school = School::create($validated);

        // Save coordinates using pk_school_id as FK
        SchoolCoordinates::create([
            'pk_school_id' => $school->pk_school_id, // FK to schools  
            'Latitude' => $validated['Latitude'],
            'Longitude' => $validated['Longitude'],
        ]);

        // Create a school user using pk_school_id as FK
            $password = $validated['SchoolID'] . '-' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
            SchoolUser::create([
                'pk_school_id' => $school->pk_school_id,   
                'username' => $validated['SchoolEmailAddress'],
                'default_password' => $password,
                'password' => bcrypt($password),
            ]);

     
            return response()->json([
                'success' => true,
                'message' => 'School created successfully!',
                'school' => $school,
            ]);


    }

    /**
     * Display the specified resource.
     */
 
public function show($SchoolID)
{
    $school = School::where('SchoolID', $SchoolID)->firstOrFail();
    return view('AdminSide.schools.show', compact('school'));
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
        $school = School::findOrFail($id);
        $school->delete();
        
        // Optionally, delete the associated coordinates and user
        SchoolCoordinates::where('pk_school_id', $id)->delete();
        $schoolUser = $school->schoolUser;
        if ($schoolUser) {
            $schoolUser->delete();
        }

        Log::info("School with ID: $id has been deleted.");


      return response()->json([
                'success' => true,
                'message' => 'School deleted successfully!' 
      ]);
        
    }
}
